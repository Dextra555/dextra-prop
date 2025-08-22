<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use App\Property;
use App\PropertyGallery;
use App\Reports;

use App\Http\Controllers\Controller; 
use Session;
use Illuminate\Http\Request; 
 
class PropertyController extends Controller
{   

    public function __construct()
    {
        $this->pagination_limit=getcong('pagination_limit')?getcong('pagination_limit'):10;
    }
 	   
    public function properties(Request $request)
    {    

        $sort_by = $request->input('sort_by', 'New');
         
        $property_list = Property::where('status', 1);

        switch ($sort_by) {
            case 'Old':
                $property_list = $property_list->orderBy('id', 'ASC');
                break;

            case 'High':
                $property_list = $property_list->orderBy('price', 'DESC');
                break;

            case 'Low':
                $property_list = $property_list->orderBy('price', 'ASC');
                break;

            case 'New':
            default:
                $property_list = $property_list->orderBy('id', 'DESC');
                break;
        }

         $property_list = $property_list->with(['types', 'locations', 'users'])->paginate(10)->appends(['sort_by' => $sort_by]);

          
        return view('pages.property.list',compact('property_list'));              
         
    }

    public function property_details($slug,$id)
    { 
        $property_info= Property::where('status',1)->where('id',$id)->first();

        if(empty($property_info))
        {
            Session::flash('error_flash_message', trans('words.access_denied'));

            return redirect()->back();
        }

        $gallery_images = PropertyGallery::where('post_id',$property_info->id)->orderBy('id')->get();

        $latest_list= Property::where('status',1)->orderby('id','DESC')->limit(5)->get();

        $type_id = $property_info->type_id;

        $related_list= Property::where('status',1)->where('type_id',$type_id)->orderby('id','DESC')->limit(5)->get();

        $user_id = $property_info->user_id;

        //View Update
        post_views_save($id,'Property');

        return view('pages.property.details',compact('property_info','gallery_images','related_list','latest_list','user_id'));    
    }

    public function property_search()
    { 

        $property_query = Property::with(['types', 'locations', 'users'])->where('status', 1)
                          ->where(function ($query) {
                            // Search text
                            if ($search_text = request()->get('search_text')) {
                                $query->where('title', 'LIKE', '%' . trim($search_text) . '%');
                            }

                            // Purpose
                            if ($purpose = request()->get('purpose')) {
                                $query->where('purpose', $purpose);
                            }

                            // Type 
                            if ($type_id = request()->get('type_id')) {
                                $query->where('type_id', $type_id);
                            }

                            // Location 
                            if ($location_id = request()->get('location_id')) {
                                $query->where('location_id', $location_id);
                            }

                            // Bedrooms
                            if ($bedrooms = request()->get('bedrooms')) {

                                if($bedrooms==4)
                                {
                                    $query->where('bedrooms','>=',$bedrooms);
                                }
                                else
                                {
                                    $query->where('bedrooms',$bedrooms);
                                }

                             }

                            // Bathrooms
                            if ($bathrooms = request()->get('bathrooms')) {

                                if($bathrooms==4)
                                {
                                    $query->where('bathrooms','>=',$bathrooms);
                                }
                                else
                                {
                                    $query->where('bathrooms', $bathrooms);
                                }
                                
                            }

                            // Furnishing
                            if ($furnishing = request()->get('furnishing')) {
                                $query->where('furnishing', $furnishing);
                            }

                            // Verified
                            if ($verified = request()->get('verified')) {
                                $query->where('verified', $verified);
                            }

                            // Price range
                              
                            if ($price_range = request()->get('price_range')) {
                               
                                $price_parts = explode('-', $price_range);
                                $price_start = substr($price_parts[0],1);
                                $price_end= substr($price_parts[1],2); 
                                 
                                $query->whereBetween('price', [$price_start, $price_end]);
                            }
                        });

                    $total_records = $property_query->count();

                    $property_list = $property_query->orderBy('id', 'DESC')->paginate($this->pagination_limit);

                    $property_list->appends(request()->input())->links();

                    $total_property = $total_records;
 

        return view('pages.property.search',compact('property_list','total_property'));    
    }

    public function properties_contact(Request $request)
    {

        $data =  \Request::except(array('_token')) ;
        
        $inputs = $request->all();

        if(getcong('recaptcha_on_contact_us'))
        {
            $rule=array(
                'name' => 'required',
                'email' => 'required|email|max:100',
                'g-recaptcha-response' => 'required'                
                 );
        }
        else
        {
            $rule=array(                
                'name' => 'required',
                'email' => 'required|email|max:100' 
                 );
        }
        
         
        
         $validator = \Validator::make($data,$rule);
 
        if ($validator->fails())
        {
                return redirect()->back()->withErrors($validator->messages());
        } 

        //check reCaptcha
        if(getcong('recaptcha_on_contact_us'))
        {

              $recaptcha_response= $inputs['g-recaptcha-response'];
          
              $ch = curl_init();
              curl_setopt($ch, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify");
              curl_setopt($ch, CURLOPT_HEADER, 0);
              curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
              curl_setopt($ch, CURLOPT_POST, 1);
              curl_setopt($ch, CURLOPT_POSTFIELDS, [
                  'secret' => getcong('recaptcha_secret_key'),
                  'response' => $recaptcha_response,
                  'remoteip' => $_SERVER['REMOTE_ADDR']
              ]);
      
              $resp = json_decode(curl_exec($ch));
              curl_close($ch);

            
              if ($resp->success!=true) {

                  Session::flash('error_flash_message', 'Captcha timeout or duplicate');
                  return \Redirect::back();                
              }  
        }
        
        $user_id = $inputs['property_owner_id'];

        $user_info = User::where('id',$user_id)->first();

        $to_name=$user_info->name;
        $to_email=$user_info->email;

            $data = array(
            'name' => $inputs['name'],
            'email' => $inputs['email'],
            'phone' => $inputs['phone'], 
            'user_message' => $inputs['message'],
             );

            $subject=$inputs['property_title'].' - Contact';
            
           $from_email= getenv("MAIL_FROM_ADDRESS"); 

            try{ 

            \Mail::send('emails.property_contact', $data, function ($message) use ($subject,$from_email,$to_name,$to_email){

                $message->from($from_email, getcong('site_name'));

                $message->to($to_email, $to_name)->subject($subject);

            });

            }catch (\Throwable $e) {
                
                \Log::info($e->getMessage()); 
                
                Session::flash('flash_message',$e->getMessage());
                return \Redirect::back();
                        
            }
             
            Session::flash('flash_message', trans('words.contact_msg'));
            return \Redirect::back();
    }

    public function properties_report(Request $request)
    {

        $data =  \Request::except(array('_token')) ;
        
        $inputs = $request->all();
        
        $rule=array(                
                'report_text' => 'required' 
                 );
                
        
         $validator = \Validator::make($data,$rule);
 
        if ($validator->fails())
        {
                return redirect()->back()->withErrors($validator->messages());
        } 
        
        $user_id = Auth::User()->id;

        $post_id = $inputs['property_id'];
        $message = $inputs['report_text'];

        $re_obj = new Reports;

        $re_obj->post_type = 'Property';
        $re_obj->post_id = $post_id;
        $re_obj->user_id = $user_id;
        $re_obj->message = $message;
        $re_obj->date = strtotime(date('m/d/Y H:i:s'));
        $re_obj->save();

        Session::flash('flash_message', trans('words.reports_success'));
        return \Redirect::back();

    }

    public function properties_owner($owner_id)
    { 
        
        $user_info = User::where('id', $owner_id)->first();

        $property_list = $user_info->userproperty()->where('status',1)->orderby('id','DESC')->paginate(10);
       
        $user_plan_id=$user_info->plan_id;
        $user_plan_exp_date=$user_info->exp_date;
 

        if($user_info->usertype =="User")
        {           
            if($user_plan_id==0 OR strtotime(date('m/d/Y')) >= $user_plan_exp_date)
            {   
                Session::flash('error_flash_message', trans('words.access_denied'));
                
                return \Redirect::back();
            }
        }
          
        $latest_list= Property::with(['types', 'locations', 'users'])->where('status',1)->orderby('id','DESC')->limit(5)->get();
        
         
        return view('pages.property.owner_list',compact('property_list','owner_id','latest_list'));              
         
    }
}
