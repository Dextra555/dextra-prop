<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use App\SubscriptionPlan;
use App\Transactions;
use App\Property;
use App\Favourite;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image; 
use Illuminate\Support\Str; 
use Session;

class UserController extends Controller
{
      
    public function dashboard()
    {
        if(!Auth::check())
        {

            Session::flash('error_flash_message', trans('words.access_denied'));

            return redirect('login');
            
        }

        if(Auth::user()->usertype=='Admin' OR Auth::user()->usertype=='Sub_Admin')
        {
            return redirect('admin/dashboard'); 
        }

        $user_id=Auth::user()->id;
        $user = User::findOrFail($user_id);

        $property_total = Property::where('user_id',$user_id)->count();
        $property_active = Property::where('status',1)->where('user_id',$user_id)->count();
        $property_pending = Property::where('status',0)->where('user_id',$user_id)->count();

        $favourite_total = Favourite::where('user_id',$user_id)->count();
 
        $transactions_list = Transactions::where('user_id',$user_id)->orderBy('id','DESC')->paginate(10);

        return view('pages.user.dashboard',compact('user','property_total','property_active','property_pending','favourite_total','transactions_list'));
    }

    public function profile()
    { 
       
        if(!Auth::check())
        {

            Session::flash('error_flash_message', trans('words.access_denied'));

            return redirect('login');
            
        }

        if(Auth::User()->usertype=="Admin" OR Auth::User()->usertype=="Sub_Admin")
        { 
            return redirect('admin');            
        } 

        $user_id=Auth::user()->id;
        $user = User::findOrFail($user_id); 

        return view('pages.user.profile',compact('user'));
    } 
    

    public function editprofile(Request $request)
    { 
        
        $id=Auth::user()->id;    
        $user = User::findOrFail($id);

        $data =  \Request::except(array('_token'));
        
        $rule=array(
                'name' => 'required',
                'email' => 'required|email|max:255|unique:users,email,'.$id,
                'user_image' => 'mimes:jpg,jpeg,gif,png'
                 );
        
         $validator = \Validator::make($data,$rule);
 
            if ($validator->fails())
            {
                    return redirect()->back()->withErrors($validator->messages());
            }
        

        $inputs = $request->all();
        
        $icon = $request->file('user_image');
        
                 
        if($icon){

            \File::delete(public_path('/upload/').$user->user_image);            

            $tmpFilePath = public_path('/upload/');

            $hardPath =  Str::slug($inputs['name'], '-').'-'.md5(time());

            $img = Image::make($icon);

            $img->fit(250, 250)->save($tmpFilePath.$hardPath.'-b.jpg');
 
            $user->user_image = $hardPath.'-b.jpg';
        }
        
        
        $user->name = $inputs['name'];          
        $user->email = $inputs['email']; 
        $user->phone = $inputs['phone'];
         
        if($inputs['password'])
        {
            $user->password = bcrypt($inputs['password']);
        }         
       
        $user->save();

        Session::flash('flash_message', trans('words.successfully_updated'));

        return redirect()->back();
         
         
    }

    public function phone_update(Request $request)
    {
        $id=Auth::user()->id;    
        $user = User::findOrFail($id);

        $data =  \Request::except(array('_token'));
        
        $rule=array(
                'phone' => 'required' 
                 );
        
         $validator = \Validator::make($data,$rule);
 
            if ($validator->fails())
            {
                    return redirect()->back()->withErrors($validator->messages());
            }
        

        $inputs = $request->all();
       
        $user->phone = $inputs['phone'];        
        $user->save();

        Session::flash('flash_message', trans('words.successfully_updated'));

        return redirect()->back();
    }

    public function pricing()
    {         
        $plan_list = SubscriptionPlan::where('status','1')->orderby('id')->get(); 

        return view('pages.payment.pricing',compact('plan_list'));
    }

    public function payment_method($plan_id)
    { 
       
        if(!Auth::check())
        {
            Session::flash('error_flash_message', trans('words.access_denied'));
            return redirect('login');            
        }
        if(Auth::User()->usertype=="Admin" OR Auth::User()->usertype=="Sub_Admin")
        { 
            return redirect('admin');            
        } 

        $plan_info = SubscriptionPlan::where('id',$plan_id)->where('status','1')->first();

        if(!$plan_info)
        {
            Session::flash('flash_message', 'Select plan!');
            return redirect('pricing'); 
        }  

        //For free plan
        if($plan_info->plan_price <=0)
        {
            $plan_days=$plan_info->plan_days;
            $plan_amount=$plan_info->plan_price;
 
            $currency_code=getcong('currency_code')?getcong('currency_code'):'USD';

            $user_id=Auth::user()->id;           
            $user = User::findOrFail($user_id);

            $user->plan_id = $plan_id;                    
            $user->start_date = strtotime(date('m/d/Y'));             
            $user->exp_date = strtotime(date('m/d/Y', strtotime("+$plan_days days")));            
             
            $user->plan_amount = $plan_amount;
            $user->save();


            $payment_trans = new Transactions;

            $payment_trans->user_id = Auth::user()->id;
            $payment_trans->email = Auth::user()->email;
            $payment_trans->plan_id = $plan_id;
            $payment_trans->gateway = 'NA';
            $payment_trans->payment_amount = $plan_amount;
            $payment_trans->payment_id = '-';
            $payment_trans->date = strtotime(date('m/d/Y H:i:s'));                    
            $payment_trans->save();

            Session::flash('plan_id',Session::get('plan_id'));

            Session::flash('success',trans('words.payment_success'));
             return redirect('dashboard');
        }

        Session::put('plan_id', $plan_id);
        Session::flash('razorpay_order_id',Session::get('razorpay_order_id'));
  
 
        return view('pages.payment.payment_method',compact('plan_info'));
    }
    
      
    public function account_delete()
    { 

        if(!Auth::check())
        {
            Session::flash('error_flash_message', trans('words.access_denied'));
            return redirect('login');            
        }
 
        $user_id=Auth::user()->id;
        $user = User::findOrFail($user_id); 

        $user_name=$user->name;
        $user_email=$user->email;

        //Change Status
        $user_obj = User::findOrFail($user_id); 
        $user_obj->status=0;
        $user_obj->save(); 
  
        //Delete session file
        $user_session_name=Session::getId();        
        Session::getHandler()->destroy($user_session_name);
  
        Auth::logout();

        //Account Delete Email

        if(getenv("MAIL_USERNAME"))
        {
             
            $data_email = array(
                'name' => $user_name,
                'email' => $user_email
                );    

            \Mail::send('emails.account_delete', $data_email, function($message) use ($user_name,$user_email){
                $message->to($user_email, $user_name)
                ->from(getcong('site_email'), getcong('site_name'))
                ->subject(trans('words.user_dlt_email_subject'));
            });    
        }

        $response['status'] = 1;

        echo json_encode($response);
        exit;         
    }

     
}
