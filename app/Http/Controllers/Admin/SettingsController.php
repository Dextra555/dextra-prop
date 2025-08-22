<?php

namespace App\Http\Controllers\Admin;

use Auth;
use App\Settings;
use App\WebAds; 

use Illuminate\Http\Request;
use Session;
class SettingsController extends MainAdminController
{
	 
    public function general_settings()
    { 
    	if(Auth::User()->usertype!="Admin"){

            Session::flash('flash_message', trans('words.access_denied'));
            return redirect('admin/dashboard');            
        }

        $page_title=trans('words.general');
        
        $settings = Settings::findOrFail('1'); 
        
        return view('admin.pages.settings.general_settings',compact('page_title','settings'));
    }	 
    
    public function update_general_settings(Request $request)
    {      	  
    	$settings = Settings::findOrFail('1'); 
	    
	    $data =  \Request::except(array('_token')) ;
	    
	    $rule=array(
            'site_name' => 'required',
            'site_logo' => 'required',
            'site_favicon' => 'required',
            'site_email' => 'required'
                );
	    
	   	 $validator = \Validator::make($data,$rule);
 
            if ($validator->fails())
            {
                    return redirect()->back()->withErrors($validator->messages());
            }
	    

	    $inputs = $request->all();

        putPermanentEnv('APP_TIMEZONE', $inputs['time_zone']);        
        
        $settings->styling = $inputs['styling'];
        $settings->time_zone = $inputs['time_zone'];
        $settings->currency_code = $inputs['currency_code'];
         
        $settings->site_name = addslashes($inputs['site_name']);
		$settings->site_logo = $inputs['site_logo'];
        $settings->site_favicon = $inputs['site_favicon'];
        $settings->site_email = $inputs['site_email'];  
        $settings->site_description = addslashes($inputs['site_description']);
        $settings->site_keywords = addslashes($inputs['site_keywords']);

        $settings->site_header_code = addslashes($inputs['site_header_code']);
        $settings->site_footer_code = addslashes($inputs['site_footer_code']);
		
        $settings->site_copyright = addslashes($inputs['site_copyright']); 
        
        $settings->contact_email = addslashes($inputs['contact_email']);
        $settings->contact_phone = addslashes($inputs['contact_phone']);
        $settings->contact_address = addslashes($inputs['contact_address']);

        $settings->facebook_link = addslashes($inputs['facebook_link']);
        $settings->twitter_link = addslashes($inputs['twitter_link']);
        $settings->instagram_link = addslashes($inputs['instagram_link']);
        $settings->youtube_link = addslashes($inputs['youtube_link']);
         
        $settings->gdpr_cookie_on_off = $inputs['gdpr_cookie_on_off'];
        $settings->gdpr_cookie_title = addslashes($inputs['gdpr_cookie_title']);
        $settings->gdpr_cookie_text = addslashes($inputs['gdpr_cookie_text']); 
        $settings->gdpr_cookie_url = addslashes($inputs['gdpr_cookie_url']); 
		  
	    $settings->save();         
 
	    Session::flash('flash_message', trans('words.successfully_updated'));
        return redirect()->back();
    }
    
    public function email_settings()
    { 
        if(Auth::User()->usertype!="Admin"){

            Session::flash('flash_message', trans('words.access_denied'));
            return redirect('admin/dashboard');
            
        }

        $page_title=trans('words.smtp_email');
        
        $settings = Settings::findOrFail('1'); 
        
        return view('admin.pages.settings.email_settings',compact('page_title','settings'));
    }

    public function update_email_settings(Request $request)
    {            
        $settings = Settings::findOrFail('1'); 
        
        $data =  \Request::except(array('_token')) ;
        
        $rule=array(
                'smtp_host' => 'required',
                'smtp_port' => 'required',
                'smtp_email' => 'required',
                'smtp_password' => 'required' 
                 );
        
         $validator = \Validator::make($data,$rule);
 
            if ($validator->fails())
            {
                    return redirect()->back()->withErrors($validator->messages());
            }
        
        $inputs = $request->all();
        
        putPermanentEnv('MAIL_HOST', $inputs['smtp_host']);
        putPermanentEnv('MAIL_PORT', $inputs['smtp_port']);
        putPermanentEnv('MAIL_USERNAME', $inputs['smtp_email']);
        putPermanentEnv('MAIL_PASSWORD', $inputs['smtp_password']);
        putPermanentEnv('MAIL_ENCRYPTION', $inputs['smtp_encryption']);
        putPermanentEnv('MAIL_FROM_ADDRESS', $inputs['smtp_email']);
        
        $settings->smtp_host = $inputs['smtp_host'];
        $settings->smtp_port = $inputs['smtp_port'];
        $settings->smtp_email = $inputs['smtp_email'];
        $settings->smtp_password = $inputs['smtp_password'];
        $settings->smtp_encryption = $inputs['smtp_encryption'];

        $settings->save(); 
 
        Session::flash('flash_message', trans('words.successfully_updated'));
        return redirect()->back();
    }

    public function test_smtp_settings()
    { 
        if(Auth::User()->usertype!="Admin"){

            Session::flash('flash_message', trans('words.access_denied'));
            return redirect('admin/dashboard');            
        }

        $test_email= $_GET['test_email'];
 
        $user_name='John Deo';

        $data_email = array(
            'name' => $user_name
             );    
      
        try{

            \Mail::send('emails.test_smtp', $data_email, function($message) use ($test_email,$user_name){
            $message->to($test_email, $user_name)
                ->from(getcong('site_email'), getcong('site_name')) 
                ->subject('Test SMTP');
            });                

            $response['resp_status']    = 'success';
            $response['resp_msg']    = 'Email sent successfully.';
        
        }catch (\Throwable $e) {
             
            $response['resp_status']    = 'failed';
            $response['resp_msg']    = $e->getMessage();                        
        }
         
        echo json_encode($response);
        exit;
         
    }

    public function social_login_settings()
    { 
        if(Auth::User()->usertype!="Admin"){

            Session::flash('flash_message', trans('words.access_denied'));
            return redirect('admin/dashboard');            
        }

        $page_title=trans('words.social_login');
        
        $settings = Settings::findOrFail('1'); 
        
        return view('admin.pages.settings.social_login_settings',compact('page_title','settings'));
    }

    public function update_social_login_settings(Request $request)
    {  
          
        $settings = Settings::findOrFail('1');
  
        $data =  \Request::except(array('_token')) ;       
          
        $inputs = $request->all();
        
        $google_redirect=\URL::to('auth/google/callback');
 
        putPermanentEnv('GOOGLE_CLIENT_DI', $inputs['google_client_id']);
        putPermanentEnv('GOOGLE_SECRET', $inputs['google_client_secret']);
        putPermanentEnv('GOOGLE_REDIRECT', $google_redirect);
          
        $settings->google_login = $inputs['google_login'];
        $settings->google_client_id = $inputs['google_client_id'];
        $settings->google_client_secret = $inputs['google_client_secret'];
        $settings->google_redirect = $google_redirect;
 
        $settings->save(); 
 
        Session::flash('flash_message', trans('words.successfully_updated'));
        return redirect()->back();
    }

    public function recaptcha_settings()
    { 
        if(Auth::User()->usertype!="Admin"){

            Session::flash('flash_message', trans('words.access_denied'));
            return redirect('admin/dashboard');            
        }

        $page_title='reCAPTCHA';
        
        $settings = Settings::findOrFail('1'); 
        
        return view('admin.pages.settings.recaptcha',compact('page_title','settings'));
    }

    public function update_recaptcha_settings(Request $request)
    {  
          
        $settings = Settings::findOrFail('1');
  
        $data =  \Request::except(array('_token')) ;        
          
        $inputs = $request->all();
                 
        $settings->recaptcha_site_key = $inputs['recaptcha_site_key'];
        $settings->recaptcha_secret_key = $inputs['recaptcha_secret_key'];
        
        $settings->recaptcha_on_login = $inputs['recaptcha_on_login'];
        $settings->recaptcha_on_signup = $inputs['recaptcha_on_signup'];
        $settings->recaptcha_on_forgot_pass = $inputs['recaptcha_on_forgot_pass'];
        $settings->recaptcha_on_contact_us = $inputs['recaptcha_on_contact_us'];
        
        $settings->save(); 
 
        Session::flash('flash_message', trans('words.successfully_updated'));
        return redirect()->back();
    }

    public function web_ads_settings()
    { 
        if(Auth::User()->usertype!="Admin"){

            Session::flash('flash_message', trans('words.access_denied'));
            return redirect('admin/dashboard');            
        }

        $page_title='Banner Ads';
        
        $settings = WebAds::findOrFail('1'); 
        
        return view('admin.pages.settings.web_ads',compact('page_title','settings'));
    }

    public function update_web_ads_settings(Request $request)
    {  
          
        $web_ads_obj = WebAds::findOrFail('1');
  
        $data =  \Request::except(array('_token')) ;        
          
        $inputs = $request->all();
                 
        $web_ads_obj->home_top = addslashes($inputs['home_top']);
        $web_ads_obj->home_bottom = addslashes($inputs['home_bottom']);

        $web_ads_obj->list_top = addslashes($inputs['list_top']);
        $web_ads_obj->list_bottom = addslashes($inputs['list_bottom']);
        
        $web_ads_obj->details_top = addslashes($inputs['details_top']);
        $web_ads_obj->details_bottom = addslashes($inputs['details_bottom']);

        $web_ads_obj->other_page_top = addslashes($inputs['other_page_top']);
        $web_ads_obj->other_page_bottom = addslashes($inputs['other_page_bottom']);

        $web_ads_obj->sidebar = addslashes($inputs['sidebar']);

        $web_ads_obj->save(); 
 
        Session::flash('flash_message', trans('words.successfully_updated'));
        return redirect()->back();
    }
   

    public function api_urls()
    { 
        if(Auth::User()->usertype!="Admin"){

            Session::flash('flash_message', trans('words.access_denied'));
            return redirect('admin/dashboard');            
        }

        $page_title=trans('words.app_api');       
        
        return view('admin.pages.api_urls',compact('page_title'));
    }    
    	
}
