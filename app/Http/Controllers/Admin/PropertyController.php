<?php

namespace App\Http\Controllers\Admin;

use Auth;
use App\Type;
use App\Location;
use App\Property;
use App\PropertyGallery;


use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Str; 

class PropertyController extends MainAdminController
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
            $list = Property::where("title", "LIKE","%$keyword%")->with(['types', 'users'])->orderBy('title')->paginate(12);

            $list->appends(\Request::only('s'))->links();
        }
        else if(isset($_GET['type_id']) AND $_GET['type_id']!="")
        {   
            $type_id = $_GET['type_id'];

            $list = Property::where("type_id", $type_id)->with(['types', 'users'])->orderBy('title')->paginate(12);
  
            $list->appends(\Request::only('type_id'))->links();
        }
        else if(isset($_GET['location_id']) AND $_GET['location_id']!="")
        {   
            $location_id = $_GET['location_id'];

            $list = Property::where("location_id", $location_id)->with(['types', 'users'])->orderBy('title')->paginate(12);
  
            $list->appends(\Request::only('location_id'))->links();
        }      
        else
        {
            $list = Property::with(['types', 'users'])->orderBy('id','DESC')->paginate(12);
        }

        $page_title=trans('words.property_text');

        $type_list = Type::orderBy('type_name')->get();

        $location_list = Location::orderBy('name')->get();
          
        return view('admin.pages.property.list',compact('page_title','list','type_list','location_list'));
    }

    public function add()    
    {     
          if(Auth::User()->usertype!="Admin" AND Auth::User()->usertype!="Sub_Admin")
            {
                Session::flash('flash_message', trans('words.access_denied'));
                return redirect('dashboard');                
             }  

          $page_title=trans('words.add_property');

          $type_list = Type::orderBy('type_name')->get();

          $location_list = Location::orderBy('name')->get();
           
          return view('admin.pages.property.addedit',compact('page_title','type_list','location_list'));
        
    }

    public function edit($post_id)    
    {     
          if(Auth::User()->usertype!="Admin" AND Auth::User()->usertype!="Sub_Admin")
            {
                Session::flash('flash_message', trans('words.access_denied'));
                return redirect('dashboard');                
             }  

          $page_title=trans('words.edit_property');

          $info = Property::findOrFail($post_id);

          $gallery_images = PropertyGallery::where('post_id',$info->id)->orderBy('id')->get();

          $type_list = Type::orderBy('type_name')->get();  
          
          $location_list = Location::orderBy('name')->get();
        
          return view('admin.pages.property.addedit',compact('page_title','info','type_list','location_list','gallery_images'));
        
    }

    public function addnew(Request $request)
    {  
       
       $data =  \Request::except(array('_token')) ;
       
       if(!empty($inputs['id'])){
         $rule=array(
                'type' => 'required',
                'title' => 'required',
                'location' => 'required'
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
                return redirect()->back()->withErrors($validator->messages());
        } 
        $inputs = $request->all();
        
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
        
        $data_obj->image = $inputs['image'];  
        $data_obj->floor_plan_image = $inputs['floor_plan_image'];      
         
        $data_obj->status = $inputs['status']; 
        
        $data_obj->save();
        
        
            //News Gallery Image
            $gallery_count=count($inputs['image_gallery']);
 
            if(!empty($inputs['id']))
            {
               $property_id= $inputs['id'];
            }
            else
            {
                $property_id= $data_obj->id; 
            }

            for($gallery_img=0; $gallery_img<$gallery_count; $gallery_img++)
            {  
                $gallery_obj = new PropertyGallery;
 
                if($inputs['image_gallery'][$gallery_img]!='')
                {
                    $gallery_obj->post_id = $property_id; 
                    $gallery_obj->image = $inputs['image_gallery'][$gallery_img];       
    
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
  
}
