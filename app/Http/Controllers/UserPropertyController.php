<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use App\Type;
use App\Location;
use App\Property;
use App\PropertyGallery;
use App\Favourite; 
use App\SubscriptionPlan;

use Illuminate\Http\Request;
use Session;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str; 

class UserPropertyController extends Controller
{ 
    public function list()
    {  

        if(Auth::User()->usertype!="User")
        { 
            return redirect('admin/property');            
        }

        $user_id = Auth::User()->id;

        $user_info = User::find($user_id);

        $property_list = $user_info->userproperty()->orderby('id','DESC')->paginate(12);
 
        $page_title=trans('words.property_text');

           
        return view('pages.user.property_list',compact('page_title','property_list'));
    }

    public function add()    
    {      
        
         
        if(Auth::User()->usertype!="User")
        { 
            return redirect('admin/property/add');            
        }

          //Check Plan Exp
        if(Auth::User()->usertype =="User")
        {   
            $user_id=Auth::User()->id;

            $user_info = User::findOrFail($user_id);
            $user_plan_id=$user_info->plan_id;
            $user_plan_exp_date=$user_info->exp_date;

            if($user_plan_id==0 OR strtotime(date('m/d/Y'))>$user_plan_exp_date)
            {   
                Session::flash('error_flash_message', trans('words.renew_sub_plan'));
                
                return redirect('pricing');
            }
        }  

        //Check Limit
        $user_id = Auth::User()->id;
        $user_plan_id = Auth::User()->plan_id;

        $plan_info = SubscriptionPlan::findOrFail($user_plan_id);
        $plan_listing_limit=$plan_info->plan_property_limit;
         
        $total_property = Property::where('user_id',$user_id)->count();
 
        if($total_property >= $plan_listing_limit)
        {
            Session::flash('error_flash_message', trans('words.limit_reached'));

            return redirect('dashboard');
        }

          $page_title=trans('words.add_property');

          $type_list = Type::orderBy('type_name')->get();

          $location_list = Location::orderBy('name')->get();
           
          return view('pages.user.property_addedit',compact('page_title','type_list','location_list'));
        
    }

    public function edit($post_id)    
    {      
          $page_title=trans('words.edit_property');

          $info = Property::findOrFail($post_id);

          $user_id = Auth::User()->id;

          if($info->user_id != $user_id)
          {
                Session::flash('error_flash_message', trans('words.access_denied'));

                return redirect('dashboard');
          }

          $gallery_images = PropertyGallery::where('post_id',$info->id)->orderBy('id')->get();

          $type_list = Type::orderBy('type_name')->get();  
          
          $location_list = Location::orderBy('name')->get();
        
          return view('pages.user.property_addedit',compact('page_title','info','type_list','type_list','location_list','gallery_images'));
        
    }

    public function addnew(Request $request)
    {  
       
       $data =  \Request::except(array('_token'));

       $inputs = $request->all();
       
       if(!empty($inputs['id'])){
         $rule=array(
                'type' => 'required',
                'location' => 'required',
                'title' => 'required'
                );
         
        }else
        {
            $rule=array(
                    'type' => 'required',
                    'title' => 'required',
                    'location' => 'required',
                    'image' => 'required'                               
                     );
        }

         
         $validator = \Validator::make($data,$rule);
 
        if ($validator->fails())
        {
                return redirect()->back()->withInput()->withErrors($validator->messages());
        } 
        
        
        if(!empty($inputs['id'])){
           
            $data_obj = Property::findOrFail($inputs['id']);

        }else{

            $data_obj = new Property;

            $data_obj->user_id = Auth::User()->id;
        } 
        
        $title_slug = Str::slug($inputs['title'], '-',null);

        $data_obj->type_id = $inputs['type']; 
        $data_obj->title = addslashes($inputs['title']);
        $data_obj->slug = $title_slug;
        $data_obj->description = addslashes($inputs['description']);
        $data_obj->phone = $inputs['phone']; 
        $data_obj->location_id = $inputs['location'];
        $data_obj->address = $inputs['address']; 
        $data_obj->latitude = $inputs['latitude']; 
        $data_obj->longitude = $inputs['longitude']; 
        $data_obj->purpose = $inputs['purpose']; 
        $data_obj->bedrooms = $inputs['bedrooms']; 
        $data_obj->bathrooms = $inputs['bathrooms']; 
        $data_obj->area = $inputs['area']; 
        $data_obj->furnishing = $inputs['furnishing']; 
        $data_obj->amenities = addslashes($inputs['amenities']);
        $data_obj->price = $inputs['price']; 
        $data_obj->verified = $inputs['verified']; 
        
          
        $featured_image = $request->file('image');

        if($featured_image){
            
            $tmpFilePath = public_path('/upload/');

            $featured_hardPath =  'featured-'.rand(0,99999).'-'.md5(time());
    
            $fp_img = Image::make($featured_image);
            $fp_img->save($tmpFilePath.$featured_hardPath.'-b.jpg');
    
            $data_obj->image = 'upload/'.$featured_hardPath.'-b.jpg';
        }

        //Floor Plan Image
        $floor_plan_image = $request->file('floor_plan_image');

        if($floor_plan_image){
            
            $fp_tmpFilePath = public_path('/floorplan/');

            $fp_hardPath =  'floor-plan-'.rand(0,99999).'-'.md5(time());
    
            $fp_img = Image::make($floor_plan_image);
            $fp_img->save($fp_tmpFilePath.$fp_hardPath.'-b.jpg');
    
            $data_obj->floor_plan_image = 'floorplan/'.$fp_hardPath.'-b.jpg';
        }
        
        $data_obj->save();
        
        
            //News Gallery Image           

            if(!empty($inputs['id']))
            {
               $property_id= $inputs['id'];
            }
            else
            {
                $property_id= $data_obj->id; 
            }

            if ($request->hasFile('image_gallery')) {
                foreach ($request->file('image_gallery') as $image) {
                    
                    $tmpFilePath1 = public_path('/gallery/');
                    $fileOriginalName = $image->getClientOriginalExtension();

                    $gallery_hardPath =  'gallery-'.rand(0,999999).'.'.$fileOriginalName;
            
                    $gall_img = Image::make($image);
                    $gall_img->save($tmpFilePath1.$gallery_hardPath);

                    $gallery_obj = new PropertyGallery;

                    $gallery_obj->post_id = $property_id; 
                    $gallery_obj->image = 'gallery/'.$gallery_hardPath;       
    
                    $gallery_obj->save();
                     
                }
            }
           
         
 
        if(!empty($inputs['id'])){

            Session::flash('flash_message', trans('words.successfully_updated'));

            return \Redirect::back();
        }else{

            Session::flash('flash_message', trans('words.added'));

            return \Redirect::back();

        }   
    }
    
    public function favourites_list()
    {  
        $user_id = Auth::User()->id;

        $favourites_list = Favourite::where('user_id',$user_id)->orderBy('id','DESC')->paginate(12);

        $page_title=trans('words.property_text');

           
        return view('pages.user.favourites_list',compact('page_title','favourites_list'));
    }
}
