<?php

namespace App\Http\Controllers\Admin;

use Auth;
use App\Settings;
use App\Type; 

use Illuminate\Http\Request;
use Session;


class SettingsAndroidAppController extends MainAdminController
{
    public function android_settings()
    { 
    	if(Auth::User()->usertype!="Admin"){

            Session::flash('flash_message', trans('words.access_denied'));
            return redirect('admin/dashboard');            
        }

        $page_title=trans('words.android_app_settings_t');
        
        $settings = Settings::findOrFail('1'); 
        
        return view('admin.pages.android.settings',compact('page_title','settings'));
    }	 
    
    public function update_android_settings(Request $request)
    {  
    	  
    	$settings = Settings::findOrFail('1');
 
	    
	    $data =  \Request::except(array('_token')) ;
	    
	    $rule=array(		        
                'app_name' => 'required',
		        'app_logo' => 'required',
                'app_email' => 'required'
		   		 );
	    
	   	 $validator = \Validator::make($data,$rule);
 
            if ($validator->fails())
            {
                    return redirect()->back()->withErrors($validator->messages());
            }
	    

	    $inputs = $request->all();
 
		$settings->app_name = addslashes($inputs['app_name']); 
		$settings->app_logo = $inputs['app_logo'];
        $settings->app_email = $inputs['app_email'];  
        $settings->app_company = addslashes($inputs['app_company']);
        $settings->app_website = addslashes($inputs['app_website']);
        $settings->app_contact = addslashes($inputs['app_contact']);
        $settings->app_version = addslashes($inputs['app_version']);        
 
	    $settings->save(); 
        
 
	    Session::flash('flash_message', trans('words.successfully_updated'));

        return redirect()->back();
    }

    
    public function onesignal_notification()
    { 
        if(Auth::User()->usertype!="Admin"){

            Session::flash('flash_message', trans('words.access_denied'));
            return redirect('admin/dashboard');
            
        }

        $page_title=trans('words.onesignal_notification');
        
        $settings = Settings::findOrFail('1');
 
        
        return view('admin.pages.android.onesignal_notification',compact('page_title','settings'));
    }

    public function update_onesignal_notification(Request $request)
    {  
          
        $settings = Settings::findOrFail('1');
  
        $data =  \Request::except(array('_token')) ;  

        $rule=array(
                'onesignal_app_id' => 'required',
                'onesignal_rest_key' => 'required'                 
                 );
        
         $validator = \Validator::make($data,$rule);
 
            if ($validator->fails())
            {
                    return redirect()->back()->withErrors($validator->messages());
            }      
          
        $inputs = $request->all();
     
        
        $settings->onesignal_app_id = $inputs['onesignal_app_id'];
        $settings->onesignal_rest_key = $inputs['onesignal_rest_key']; 
       
        $settings->save(); 
 
        Session::flash('flash_message', trans('words.successfully_updated'));

        return redirect()->back();
    }

    public function app_update_popup()
    { 
        if(Auth::User()->usertype!="Admin"){

            Session::flash('flash_message', trans('words.access_denied'));
            return redirect('admin/dashboard');            
        }

        $page_title=trans('words.app_update_popup');
        
        $settings = Settings::findOrFail('1');
 
        
        return view('admin.pages.android.app_update_popup',compact('page_title','settings'));
    }

    public function update_app_update_popup(Request $request)
    {  
          
        $settings = Settings::findOrFail('1');
  
        $data =  \Request::except(array('_token')) ;  
 
        $inputs = $request->all();     
        
        $settings->app_update_hide_show = $inputs['app_update_hide_show'];  
        $settings->app_update_version_code = $inputs['app_update_version_code'];  
        $settings->app_update_desc = addslashes($inputs['app_update_desc']);
        $settings->app_update_link = $inputs['app_update_link'];    
        $settings->app_update_cancel_option = $inputs['app_update_cancel_option'];
       
        $settings->save(); 
 
        Session::flash('flash_message', trans('words.successfully_updated'));
        return redirect()->back();
    }

    public function others_settings()
    { 
        if(Auth::User()->usertype!="Admin"){

            Session::flash('flash_message', trans('words.access_denied'));
            return redirect('admin/dashboard');
            
        }

        $page_title=trans('words.others_settings');
        
        $settings = Settings::findOrFail('1'); 
        
        return view('admin.pages.android.others_settings',compact('page_title','settings'));
    }

    public function update_others_settings(Request $request)
    {  
          
        $settings = Settings::findOrFail('1');
  
        $data =  \Request::except(array('_token')) ;  
 
        $inputs = $request->all();
     
        $settings->pagination_limit = $inputs['pagination_limit'];
        $settings->latest_limit = $inputs['latest_limit'];  
        
        $settings->save(); 
 
        Session::flash('flash_message', trans('words.successfully_updated'));
        return redirect()->back();
    }


    public function notification_send()
    { 
        if(Auth::User()->usertype!="Admin")
        {
            Session::flash('flash_message', trans('words.access_denied'));
            return redirect('dashboard');            
        }

        $type_list = Type::orderBy('id')->get();           

        $page_title=trans('words.android_app_notification_t');
         
        return view('admin.pages.android.notification_send',compact('page_title','type_list'));
    }
    
    public function send_android_notification(Request $request)
    {  
          
        $settings = Settings::findOrFail('1');
 
        
        $data =  \Request::except(array('_token')) ;
        
        $rule=array(
                'notification_title' => 'required',
                'notification_msg' => 'required' 
                 );
        
         $validator = \Validator::make($data,$rule);
 
            if ($validator->fails())
            {
                    return redirect()->back()->withErrors($validator->messages());
            }
        

        $inputs = $request->all();

        //Onesignal info 
        $onesignal_app_id=$settings->onesignal_app_id;
        $onesignal_rest_key=$settings->onesignal_rest_key;
        
        if($onesignal_app_id=='' OR $onesignal_rest_key=='')
        {
            Session::flash('flash_error_message', 'Onesignal app id or rest key not set.');
            return redirect()->back();
        } 

        $notification_title= $inputs['notification_title'];
        $notification_msg= $inputs['notification_msg'];
        $notification_image=$inputs['notification_image'];
        
 
        if($inputs['type_id']!="")
        {
            $post_id=$inputs['type_id'];
            $post_title=stripslashes(Type::getTypeInfo($post_id,'type_name'));             
        }         
        else
        {
            $post_id='';
            $post_title='';
        }    

        if($inputs['external_link']!="")
        {
        $external_link = $inputs['external_link'];
        }
        else
        {
        $external_link = false;
        }
        
        if($notification_image!='')
        {                 

                $file_path = \URL::to('/'.$notification_image);
                 
                $content = array(
                         "en" => $notification_msg
                          );

                $fields = array(
                                'app_id' => $onesignal_app_id,
                                'included_segments' => array('All'),                                            
                                'data' => array("foo" => "bar", "type"=>"type","post_id"=>$post_id,"post_title"=>$post_title,"external_link"=>$external_link),
                                'headings'=> array("en" => $notification_title),
                                'contents' => $content,
                                'big_picture' =>$file_path,
                                'ios_attachments' => array(
                                     'id' => $file_path,
                                ),                     
                                );

                $fields = json_encode($fields);
               
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
                curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8',
                                                           'Authorization: Basic '.$onesignal_rest_key));
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
                curl_setopt($ch, CURLOPT_HEADER, FALSE);
                curl_setopt($ch, CURLOPT_POST, TRUE);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

                $response = curl_exec($ch);
                curl_close($ch);
        } 
        else
        {
            $content = array(
                         "en" => $notification_msg
                          );

            $fields = array(
                            'app_id' => $onesignal_app_id,
                            'included_segments' => array('All'),                                      
                            'data' => array("foo" => "bar", "type"=>"type","post_id"=>$post_id,"post_title"=>$post_title,"external_link"=>$external_link),
                            'headings'=> array("en" => $notification_title),
                            'contents' => $content
                            );

            $fields = json_encode($fields);
          
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8',
                                                       'Authorization: Basic '.$onesignal_rest_key));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($ch, CURLOPT_HEADER, FALSE);
            curl_setopt($ch, CURLOPT_POST, TRUE);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

            $response = curl_exec($ch);
            curl_close($ch);
        }        
 
        Session::flash('flash_message', trans('words.android_app_notification_msg'));
        return redirect()->back();
    } 
    

    public function verify_purchase_app()
    { 
        if(Auth::User()->usertype!="Admin")
        {
            Session::flash('flash_message', trans('words.access_denied'));
            return redirect('admin/dashboard');            
        }

        $page_title = trans('words.app_verify');

        $settings = Settings::findOrFail('1');

        return view('admin.pages.android.verify_purchase_app',compact('page_title','settings'));
    } 

    public function verify_purchase_app_update(Request $request)
    {       
        $data =  \Request::except(array('_token'));
        
        $rule = [                
            'buyer_name' => 'required',
            'purchase_code' => 'required',
            'app_package_name' => 'required'                              
        ];
        
        $validator = \Validator::make($data, $rule);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->messages());
        }
        
        $inputs = $request->all();

        $buyer_name = trim($inputs['buyer_name']);
        $purchase_code = trim($inputs['purchase_code']);
        $app_package_name = trim($inputs['app_package_name']);

        putPermanentEnv('BUYER_NAME', $buyer_name);
        putPermanentEnv('BUYER_PURCHASE_CODE', $purchase_code);

        $settings = Settings::findOrFail('1');                     
        $settings->app_package_name = $app_package_name;       
        $settings->save();  
        
        Session::flash('flash_message', 'Verify success');
        return redirect()->back();

    }
    	
}
