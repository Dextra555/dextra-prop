<?php

namespace App\Http\Controllers\Admin;

use Auth;
use App\Location;

use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Str; 

class LocationController extends MainAdminController
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
            $list = Location::where("type_name", "LIKE","%$keyword%")->orderBy('type_name')->paginate(8);

            $list->appends(\Request::only('s'))->links();
        }         
        else
        {
            $list = Location::orderBy('id','DESC')->paginate(8);

        }

        $page_title=trans('words.location_text');
         
        return view('admin.pages.location.list',compact('page_title','list'));
    }

     
    public function addnew(Request $request)
    {  
       
       $data =  \Request::except(array('_token')) ;
        
        if(!empty($inputs['id'])){
                
                $rule=array(
                'name' => 'required',
                  );
        }else
        {
            $rule=array(
                'name' => 'required',                                   
                 );
        }

        
        
         $validator = \Validator::make($data,$rule);
 
        if ($validator->fails())
        {
                return redirect()->back()->withErrors($validator->messages());
        } 
        $inputs = $request->all();
        
        if(!empty($inputs['id'])){
           
            $data_obj = Location::findOrFail($inputs['id']);

        }else{

            $data_obj = new Location;
        }         

         
         $data_obj->name = addslashes($inputs['name']);
        
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
