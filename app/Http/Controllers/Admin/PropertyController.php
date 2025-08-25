<?php

namespace App\Http\Controllers\Admin;

use Auth;
use App\Type;
use App\Location;
use App\Property;
use App\PropertyGallery;
use App\User;


use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Str; 

class PropertyController extends MainAdminController
{
	  
    public function list(Request $request)
    { 
 
        if(Auth::User()->usertype!="Admin" AND Auth::User()->usertype!="Sub_Admin")
        {
            Session::flash('flash_message', trans('words.access_denied'));
            return redirect('dashboard');            
        }

        // Combined filters: search (s), type_id, location_id, user_id
        $query = Property::with(['types', 'users']);

        if ($request->filled('s')) {
            $keyword = $request->get('s');
            $query->where('title', 'LIKE', "%{$keyword}%");
        }
        if ($request->filled('type_id')) {
            $query->where('type_id', $request->get('type_id'));
        }
        if ($request->filled('location_id')) {
            $query->where('location_id', $request->get('location_id'));
        }
        if ($request->filled('user_id')) {
            $query->where('user_id', $request->get('user_id'));
        }

        $list = $query->orderBy('id','DESC')->paginate(12);
        $list->appends($request->all())->links();

        $page_title=trans('words.property_text');

        $type_list = Type::orderBy('type_name')->get();

        $location_list = Location::orderBy('name')->get();
        
        // For user filter
        $users = User::orderBy('name')->get();
          
        return view('admin.pages.property.list',compact('page_title','list','type_list','location_list','users'));
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
          
          $users = User::orderBy('name')->get();
           
          return view('admin.pages.property.addedit',compact('page_title','type_list','location_list','users'));
        
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
         
          $users = User::orderBy('name')->get();
        
          return view('admin.pages.property.addedit',compact('page_title','info','type_list','location_list','gallery_images','users'));
        
    }

    public function addnew(Request $request)
    {  
       
       $data =  \Request::except(array('_token')) ;
       $inputs = $request->all();

       if(!empty($inputs['id'])){
         $rule=array(
               'user_id' => 'required|exists:users,id',
                'type' => 'required',
                'title' => 'required',
                'location' => 'required'
                );
        
        }else
        {
            $rule=array(
                    'user_id' => 'required|exists:users,id',
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
        if(!empty($inputs['id'])){
           
           $data_obj = Property::findOrFail($inputs['id']);

        }else{

            $data_obj = new Property;
        } 

        $title_slug = Str::slug($inputs['title'], '-',null);
        
        // Assign property owner (required)
        $data_obj->user_id = $inputs['user_id'];
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

        // Auto-approve when created/updated from Admin panel
        $data_obj->approval_status = 'approved';
        $data_obj->rejection_reason = null;
        $data_obj->approved_at = now();
        
        $data_obj->save();
        
        
            //News Gallery Image
           $gallery_count = isset($inputs['image_gallery']) ? count($inputs['image_gallery']) : 0;
 
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

    public function approve($id, Request $request)
    {
        if(Auth::User()->usertype!="Admin" && Auth::User()->usertype!="Sub_Admin"){
            return response()->json(['status' => 0, 'message' => trans('words.access_denied')]);
        }

        $property = Property::with('users')->findOrFail($id);
        $property->approval_status = 'approved';
        $property->rejection_reason = null;
        $property->approved_at = now();
        $property->status = 1; // make active
        $property->save();

        // Email notify
        try {
            $to_name = $property->users->name ?? '';
            $to_email = $property->users->email ?? '';
            $subject = $property->title.' - Property Approved';
            $data = [
                'user_name' => $to_name,
                'property_title' => $property->title,
                'property_url' => url('properties/'.$property->slug.'/'.$property->id),
                'property_image' => $property->image ? url('/'.$property->image) : null,
            ];
            \Mail::send('emails.property_approved', $data, function ($message) use ($subject, $to_name, $to_email) {
                $message->from(getenv('MAIL_FROM_ADDRESS'), getcong('site_name'));
                $message->to($to_email, $to_name)->subject($subject);
            });
        } catch (\Throwable $e) {
            \Log::info($e->getMessage());
        }

        return response()->json(['status' => 1]);
    }

    public function reject($id, Request $request)
    {
        if(Auth::User()->usertype!="Admin" && Auth::User()->usertype!="Sub_Admin"){
            return response()->json(['status' => 0, 'message' => trans('words.access_denied')]);
        }

        $request->validate([
            'reason' => 'required|string|max:2000',
        ]);

        $property = Property::with('users')->findOrFail($id);
        $property->approval_status = 'rejected';
        $property->rejection_reason = $request->input('reason');
        $property->approved_at = null;
        $property->status = 0; // keep inactive
        $property->save();

        // Email notify
        try {
            $to_name = $property->users->name ?? '';
            $to_email = $property->users->email ?? '';
            $subject = $property->title.' - Property Rejected';
            $data = [
                'user_name' => $to_name,
                'property_title' => $property->title,
                'reason' => $property->rejection_reason,
                'property_image' => $property->image ? url('/'.$property->image) : null,
            ];
            \Mail::send('emails.property_rejected', $data, function ($message) use ($subject, $to_name, $to_email) {
                $message->from(getenv('MAIL_FROM_ADDRESS'), getcong('site_name'));
                $message->to($to_email, $to_name)->subject($subject);
            });
        } catch (\Throwable $e) {
            \Log::info($e->getMessage());
        }

        return response()->json(['status' => 1]);
    }
  
}
