<?php

namespace App\Http\Controllers\Admin;

use Auth;
use App\Type;

use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Str; 

class TypeController extends MainAdminController
{
	 
    public function list()
    {  
        if(Auth::User()->usertype!="Admin" AND Auth::User()->usertype!="Sub_Admin")
        {
            Session::flash('flash_message', trans('words.access_denied'));
            return redirect('dashboard');
            
        }

        if(isset($_GET['s']))
        {
            $keyword = $_GET['s'];  
            $list = Type::where("type_name", "LIKE","%$keyword%")->orderBy('type_name')->paginate(8);

            $list->appends(\Request::only('s'))->links();
        }         
        else
        {
            $list = Type::orderBy('id','DESC')->paginate(8);

        }

        $page_title=trans('words.type_text');
         
        return view('admin.pages.type.list',compact('page_title','list'));
    }

    public function add()    
    {     
          if(Auth::User()->usertype!="Admin" AND Auth::User()->usertype!="Sub_Admin")
            {
                Session::flash('flash_message', trans('words.access_denied'));
                return redirect('dashboard');                
             }  

          $page_title=trans('words.add_type');
         
          return view('admin.pages.type.addedit',compact('page_title'));
        
    }

    public function edit($page_id)    
    {     
          if(Auth::User()->usertype!="Admin" AND Auth::User()->usertype!="Sub_Admin")
            {
                Session::flash('flash_message', trans('words.access_denied'));
                return redirect('dashboard');                
             }  

          $page_title=trans('words.edit_type');

          $info = Type::findOrFail($page_id);
        
          return view('admin.pages.type.addedit',compact('page_title','info'));
        
    }

    public function addnew(Request $request)
    {  
       
       $data =  \Request::except(array('_token')) ;
        
        if(!empty($inputs['id'])){
                
                $rule=array(
                'type_name' => 'required',
                  );
        }else
        {
            $rule=array(
                'type_name' => 'required',                                   
                 );
        }

        
        
         $validator = \Validator::make($data,$rule);
 
        if ($validator->fails())
        {
                return redirect()->back()->withErrors($validator->messages());
        } 
        $inputs = $request->all();
        
        if(!empty($inputs['id'])){
           
            $data_obj = Type::findOrFail($inputs['id']);

        }else{

            $data_obj = new Type;
        }         

         $type_slug = Str::slug($inputs['type_name'], '-',null);
 
         $data_obj->type_name = addslashes($inputs['type_name']);
         $data_obj->type_slug = $type_slug;
         $data_obj->type_image = $inputs['type_image'];       

         $data_obj->status = $inputs['status']; 
         
         $data_obj->save();
         
        
        if(!empty($inputs['id'])){

            Session::flash('flash_message', trans('words.successfully_updated'));
            return \Redirect::back();

        }else{

            Session::flash('flash_message', trans('words.added'));
            return \Redirect::back();
        }             
                
    }
 
}
