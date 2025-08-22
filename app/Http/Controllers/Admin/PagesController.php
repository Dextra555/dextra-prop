<?php

namespace App\Http\Controllers\Admin;

use Auth;
use App\Pages;

use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Str; 

class PagesController extends MainAdminController
{ 
    public function pages_list()
    { 
 
        if(Auth::User()->usertype!="Admin")
        {
            Session::flash('flash_message', trans('words.access_denied'));
            return redirect('dashboard');
            
        }

        $pages_list = Pages::orderBy('id','DESC')->paginate(10);

        $page_title=trans('words.pages');
         
        return view('admin.pages.pages.list',compact('page_title','pages_list'));
    }

    public function add()    
    {     
          if(Auth::User()->usertype!="Admin")
            {
                Session::flash('flash_message', trans('words.access_denied'));
                return redirect('dashboard');                
            }  

          $page_title=trans('words.add_page');
         
          return view('admin.pages.pages.addedit',compact('page_title'));
        
    }

    public function edit($page_id)    
    {     
           if(Auth::User()->usertype!="Admin")
            {
                Session::flash('flash_message', trans('words.access_denied'));
                return redirect('dashboard');                
            }  

          $page_title=trans('words.edit_page');

          $page_info = Pages::findOrFail($page_id);

          if($page_info->id==1)
          {
            return view('admin.pages.pages.about',compact('page_title','page_info'));
          }
          else if($page_info->id==2)
          {
            return view('admin.pages.pages.contact ',compact('page_title','page_info'));
          }
          else
          {
                return view('admin.pages.pages.addedit',compact('page_title','page_info'));
          }
         
    }

    public function addnew(Request $request)
    {  
       
       $data =  \Request::except(array('_token')) ;
        
        if(!empty($inputs['id'])){
                
                $rule=array(
                'page_title' => 'required'
                  );
        }else
        {
            $rule=array(
                'page_title' => 'required',                            
                 );
        }
        
        
         $validator = \Validator::make($data,$rule);
 
        if ($validator->fails())
        {
                return redirect()->back()->withErrors($validator->messages());
        } 
        $inputs = $request->all();
        
        if(!empty($inputs['id'])){
           
            $page_obj = Pages::findOrFail($inputs['id']);

        }else{

            $page_obj = new Pages;
        }

         
        $page_slug = Str::slug($inputs['page_title'], '-');

        $page_obj->page_title = addslashes($inputs['page_title']);
        $page_obj->page_slug = $page_slug;   
        $page_obj->page_content = addslashes($inputs['page_content']);    
        
        $page_obj->page_position = $inputs['page_position'];
        $page_obj->page_order = $inputs['page_order'];
        $page_obj->status = $inputs['status']; 
         
         $page_obj->save();
         
        
        if(!empty($inputs['id'])){

            Session::flash('flash_message', trans('words.successfully_updated'));
            return \Redirect::back();
        }else{

            Session::flash('flash_message', trans('words.added'));
            return \Redirect::back();

        }               
        
        
    }

    public function about_update(Request $request)
    {  
       
       $data =  \Request::except(array('_token')) ;
        
        if(!empty($inputs['id'])){
                
                $rule=array(
                'page_title' => 'required'
                  );
        }else
        {
            $rule=array(
                'page_title' => 'required',                            
                 );
        }
        
        
         $validator = \Validator::make($data,$rule);
 
        if ($validator->fails())
        {
                return redirect()->back()->withErrors($validator->messages());
        } 
        $inputs = $request->all();
        
        if(!empty($inputs['id'])){
           
            $page_obj = Pages::findOrFail($inputs['id']);

        }else{

            $page_obj = new Pages;
        }

         
        $page_slug = Str::slug($inputs['page_title'], '-');

        $page_obj->page_title = addslashes($inputs['page_title']);
        $page_obj->page_slug = $page_slug;   
        $page_obj->page_content = addslashes($inputs['page_content']);
        $page_obj->page_about_image = $inputs['page_about_image'];
        
        $page_obj->page_about_text2 = addslashes($inputs['page_about_text2']);$page_obj->page_about_image2 = $inputs['page_about_image2'];
        
        $page_obj->page_position = $inputs['page_position'];

        $page_obj->page_order = $inputs['page_order'];
        $page_obj->status = $inputs['status']; 
         
         $page_obj->save();
         
        
        if(!empty($inputs['id'])){

            Session::flash('flash_message', trans('words.successfully_updated'));
            return \Redirect::back();
        }else{

            Session::flash('flash_message', trans('words.added'));
            return \Redirect::back();

        }               
        
        
    }

    public function contact_update(Request $request)
    {  
       
       $data =  \Request::except(array('_token')) ;
        
        if(!empty($inputs['id'])){
                
                $rule=array(
                'page_title' => 'required'
                  );
        }else
        {
            $rule=array(
                'page_title' => 'required',                            
                 );
        }
        
        
         $validator = \Validator::make($data,$rule);
 
        if ($validator->fails())
        {
                return redirect()->back()->withErrors($validator->messages());
        } 
        $inputs = $request->all();
        
        if(!empty($inputs['id'])){
           
            $page_obj = Pages::findOrFail($inputs['id']);

        }else{

            $page_obj = new Pages;

        }
         
        $page_slug = Str::slug($inputs['page_title'], '-');

        $page_obj->page_title = addslashes($inputs['page_title']);
        $page_obj->page_slug = $page_slug;   
        $page_obj->page_contact_address = addslashes($inputs['page_contact_address']);
        $page_obj->page_contact_phone = addslashes($inputs['page_contact_phone']);
        $page_obj->page_contact_email = addslashes($inputs['page_contact_email']);
        $page_obj->page_contact_map = addslashes($inputs['page_contact_map']);
        
        $page_obj->page_position = $inputs['page_position'];
        $page_obj->page_order = $inputs['page_order'];
        $page_obj->status = $inputs['status']; 
         
        $page_obj->save();
         
        
        if(!empty($inputs['id'])){

            Session::flash('flash_message', trans('words.successfully_updated'));
            return \Redirect::back();
        }else{

            Session::flash('flash_message', trans('words.added'));
            return \Redirect::back();
        }               
        
        
    }
 
}
