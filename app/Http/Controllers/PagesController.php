<?php

namespace App\Http\Controllers;

use App\Pages;
use Illuminate\Http\Request;
use Session;
 

class PagesController extends Controller
{
	public function page_details($page_slug)    
    {      
          $page_info = Pages::where('page_slug',$page_slug)->first();

          if($page_info->id==1)
          {
            return view('.pages.extra.about',compact('page_info'));
          }
          else if($page_info->id==2)
          {
            return view('.pages.extra.contact',compact('page_info'));
          }
          else
          {
            return view('.pages.extra.page',compact('page_info'));
          }
        
          
        
    }

    public function page_contact()
    {        
        return view('pages.extra.contact');
    }

    public function contact_send(Request $request)
    { 
        
        $data =  \Request::except(array('_token')) ;
        
        $inputs = $request->all();

        if(getcong('recaptcha_on_contact_us'))
        {
            $rule=array(
                'name' => 'required',
                'email' => 'required|email|max:100',
                'subject' => 'required',
                'g-recaptcha-response' => 'required'                
                 );
        }
        else
        {
            $rule=array(                
                'name' => 'required',
                'email' => 'required|email|max:100',
                'subject' => 'required',
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
          
            $data = array(
            'name' => $inputs['name'],
            'email' => $inputs['email'],
            'phone' => $inputs['phone'],           
            'subject' => $inputs['subject'],
            'user_message' => $inputs['message'],
             );

            $subject=$inputs['subject'];
            
           $from_email= getenv("MAIL_FROM_ADDRESS"); 

            try{ 

            \Mail::send('emails.contact', $data, function ($message) use ($subject,$from_email){

                $message->from($from_email, getcong('site_name'));

                $message->to(getcong('site_email'))->subject($subject);

            });

            }catch (\Throwable $e) {
                
                \Log::info($e->getMessage()); 
                
                Session::flash('flash_message',$e->getMessage());
                return \Redirect::back();
                        
            }
             
            Session::flash('flash_message', trans('words.contact_msg'));
            return \Redirect::back();
         
    }

    
}
