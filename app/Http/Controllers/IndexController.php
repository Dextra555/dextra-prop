<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use App\Type;
use App\Property; 

use Illuminate\Http\Request; 
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Session;
 
 
class IndexController extends Controller
{   
 	  
    public function index()
    {   

        if(!alreadyInstalled()){
            return redirect('public/install');
        }

        //Type
        $type_list= Type::where('status',1)->orderby('type_name')->take(8)->get();

        //Latest Property
        $latest_list= Property::with(['types', 'locations', 'users'])->where('status',1)->where('approval_status','approved')->orderby('id','DESC')->limit(10)->get();

        //Trending Property        
        $trending_start_date = date('Y-m-d', strtotime('today - 30 days'));
        $trending_end_date = date('Y-m-d');

        $trending_list = DB::table('post_views')
                ->select('post_views.post_id','post_views.post_type','property.id')
                ->join('property','property.id','=','post_views.post_id')
                ->where('property.status',1)
                ->where('property.approval_status','approved')
                ->whereBetween('post_views.date', array(strtotime($trending_start_date), strtotime($trending_end_date)))
                ->selectRaw('SUM(post_views) as total_views')
                ->groupBy('property.id','post_views.post_id','post_views.post_type')
                ->orderby('total_views','DESC')
                ->limit(10)
                ->get();

        $banners = DB::table('banners')
                ->where('status', 1)
                ->where(function ($query) {
                    $query->whereNull('starts_at')->orWhere('starts_at', '<=', now());
                })
                ->where(function ($query) {
                    $query->whereNull('ends_at')->orWhere('ends_at', '>=', now());
                })
                ->inRandomOrder()
                ->limit(3)
                ->get();
         

        return view('pages.index',compact('banners','type_list','latest_list','trending_list','banners'));              
         
    }

    public function latest()
    {
        $property_list= Property::with(['types', 'locations', 'users'])->where('status',1)->where('approval_status','approved')->orderby('id','DESC')->limit(12)->get();

        return view('pages.home.latest',compact('property_list'));   
    }

    public function popular()
    {
        $trending_start_date = date('Y-m-d', strtotime('today - 30 days'));
        $trending_end_date = date('Y-m-d');

        $property_list = DB::table('post_views')
                ->select('post_views.post_id','post_views.post_type','property.id')
                ->join('property','property.id','=','post_views.post_id')
                ->where('property.status',1)
                ->where('property.approval_status','approved')
                ->whereBetween('post_views.date', array(strtotime($trending_start_date), strtotime($trending_end_date)))
                ->selectRaw('SUM(post_views) as total_views')
                ->groupBy('property.id','post_views.post_id','post_views.post_type')
                ->orderby('total_views','DESC')
                ->limit(getcong('trending_limit'))
                ->get();
 
        return view('pages.home.popular',compact('property_list'));   
    }

    public function login()
    {
        if (Auth::check()) {
                        
            return redirect('dashboard'); 
        }

        return view('pages.user.login');
    }

    public function postLogin(Request $request)
    { 
   
        $data =  \Request::except(array('_token'));     
        $inputs = $request->all();
        
        if(getcong('recaptcha_on_login'))
        {
            $rule=array(
                'email' => 'required|email',
                'password' => 'required',
                'g-recaptcha-response' => 'required'                
                 );
        }
        else
        {
            $rule=array(
                'email' => 'required|email',
                'password' => 'required'              
                 );
        }
         
         $validator = \Validator::make($data,$rule);
 
        if ($validator->fails())
        {
                Session::flash('login_flash_error', 'required');
                return redirect()->back()->withInput()->withErrors($validator->messages());
         }

         //check reCaptcha
          if(getcong('recaptcha_on_login'))
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

            $credentials = $request->only('email', 'password');

            $remember_me = $request->has('remember') ? true : false;  
            
            if (Auth::attempt($credentials, $remember_me)) {

                if(Auth::user()->status=='0' AND Auth::user()->deleted_at!=NULL){
                    Auth::logout();
                      
                    Session::flash('login_flash_error', 'required'); 
                    return redirect('/login')->withInput()->withErrors(trans('words.account_delete_msg'));
                }

                if(Auth::user()->status=='0'){
                    Auth::logout();
                    Session::flash('login_flash_error', 'required'); 
                    return redirect('/login')->withInput()->withErrors(trans('words.account_banned'));
                 }
 
                return $this->handleUserWasAuthenticated($request);
            }
 
            Session::flash('login_flash_error', 'required'); 
            return redirect('/login')->withInput()->withErrors(trans('words.email_password_invalid'));
 
        
    }
    
     /**
     * Send the response after the user was authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  bool  $throttles
     * @return \Illuminate\Http\Response
     */
    protected function handleUserWasAuthenticated(Request $request)
    {

        if (method_exists($this, 'authenticated')) {
            return $this->authenticated($request, Auth::user());
        }
 
        if(Auth::user()->usertype=='Admin' OR Auth::user()->usertype=='Sub_Admin')
        {
            return redirect('admin/dashboard'); 
        }
        else
        {
 
            return redirect('dashboard'); 
        }
        
    }
    

    public function signup()
    {  

        if (Auth::check()) {
                        
            return redirect('dashboard'); 
        }
        
        return view('pages.user.signup');
    }

    public function postSignup(Request $request)
    { 
         

        $data =  \Request::except(array('_token'));
        
        $inputs = $request->all();

        if(getcong('recaptcha_on_signup'))
        {
            $rule=array(
                'name' => 'required',                
                'email' => 'required|email|max:200|unique:users',
                'password' => 'required|confirmed|min:8',
                'password_confirmation' => 'required',
                'g-recaptcha-response' => 'required'                
                 );
            
        }
        else
        {
            $rule=array(
                'name' => 'required',                
                'email' => 'required|email|max:200|unique:users',
                'password' => 'required|confirmed|min:8',
                'password_confirmation' => 'required'                
                 );
        }
         
        
         $validator = \Validator::make($data,$rule);
 
        if ($validator->fails())
        {
                Session::flash('signup_flash_error', 'required');
                return redirect()->back()->withInput()->withErrors($validator->messages());
        } 

        //check reCaptcha
        if(getcong('recaptcha_on_signup'))
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
       
        $user = new User;

        $user->usertype = 'User';
        $user->name = $inputs['name']; 
        $user->email = $inputs['email'];         
        $user->password= bcrypt($inputs['password']);          
        $user->save();

        //Welcome Email

        try{
            $user_name=$inputs['name'];
            $user_email=$inputs['email'];

            $data_email = array(
                'name' => $user_name,
                'email' => $user_email
                );    

            \Mail::send('emails.welcome', $data_email, function($message) use ($user_name,$user_email){
                $message->to($user_email, $user_name)
                ->from(getcong('site_email'), getcong('site_name'))
                ->subject('Welcome to '.getcong('site_name'));
            });    
        }catch (\Throwable $e) {
                 
            \Log::info($e->getMessage());    
        }        

        
        Session::flash('signup_flash_message', trans('words.account_created_successfully'));

        return redirect('signup');
         
    }

    
    /**
     * Log the user out of the application.
     *
     * @return \Illuminate\Http\Response
     */
    public function logout()
    {
        $user_id=Auth::user()->id;
 
        Auth::logout();

        return redirect('/');
    }


}
