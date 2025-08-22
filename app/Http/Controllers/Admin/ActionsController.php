<?php

namespace App\Http\Controllers\Admin;

use Auth;
use App\User;
use App\Type;
use App\Location;
use App\Property;
use App\PropertyGallery;
use App\Reports;
use App\Pages;
use App\Favourite;
use App\PostViewsDownload;
use App\SubscriptionPlan;
use App\AppAds;
use App\PaymentGateway;

use Illuminate\Http\Request;

class ActionsController extends MainAdminController
{
	 

    public function ajax_status(Request $request)
    {   
        $inputs = $request->all(); 
        
        $post_id=$inputs['id'];
        $value=$inputs['value'];
        $action_for=$inputs['action_for'];
        
        if($action_for=="type_status")
        {

            $data_obj = Type::findOrFail($post_id);        
     
            if($value=="true")
            {
                $data_obj->status = 1; 
            }
            else
            {
                $data_obj->status = 0; 
            }        
             
            $data_obj->save();             
            $response['status'] = 1;
            
        }
        else if($action_for=="location_status")
        {

            $data_obj = Location::findOrFail($post_id);        
     
            if($value=="true")
            {
                $data_obj->status = 1; 
            }
            else
            {
                $data_obj->status = 0; 
            }        
             
            $data_obj->save();             
            $response['status'] = 1;
            
        }       
        else if($action_for=="property_status")
        {

            $data_obj = Property::findOrFail($post_id);        
     
            if($value=="true")
            {
                $data_obj->status = 1; 
            }
            else
            {
                $data_obj->status = 0; 
            }        
             
            $data_obj->save();             
            $response['status'] = 1;
            
        }         
        else if($action_for=="ads_status")
        {

            $data_obj = AppAds::findOrFail($post_id);        
     
            if($value=="true")
            {
                $data_obj->status = 1; 

                //Other Ads Disable
                AppAds::where('id','!=', $post_id)->update(['status' => 0]);
            }
            else
            {
                $data_obj->status = 0; 
            }        
             
            $data_obj->save();             
            $response['status'] = 1;
            
        }     
        else if($action_for=="payment_status")
        {

            $data_obj = PaymentGateway::findOrFail($post_id);        
     
            if($value=="true")
            {
                $data_obj->status = 1; 
 
            }
            else
            {
                $data_obj->status = 0; 
            }        
             
            $data_obj->save();             
            $response['status'] = 1;
            
        }    
        else
        {
            $response['status'] = 0;
        }     

        echo json_encode($response);
        exit;   
    }

    public function ajax_delete(Request $request)
    {  
        
        $inputs = $request->all(); 
       
        if(!isset($inputs['id']))
        {
            $response['status'] = 0;           
              
            echo json_encode($response);
            exit;

        }
        
        if(is_array($inputs['id']))
        {
            $post_ids=$inputs['id'];
        }
        else
        {
            $post_id=$inputs['id'];
        }
 
        $action_for=$inputs['action_for'];
        
        if($action_for=="type_delete")
        {
            $data_obj = Type::findOrFail($post_id);
            $data_obj->delete(); 
             
            $response['status'] = 1;            
        }
        else if($action_for=="location_delete")
        {
            $data_obj = Location::findOrFail($post_id);
            $data_obj->delete(); 
             
            $response['status'] = 1;            
        }       
        else if($action_for=="property_delete")
        {
            
            $view_obj = PostViewsDownload::where('post_type','Property')->where('post_id',$post_id)->delete();

            $fav_obj = Favourite::where('post_type','Property')->where('post_id',$post_id)->delete();                
            $rep_obj = Reports::where('post_type','Property')->where('post_id',$post_id)->delete();
            
            $gall_obj = PropertyGallery::where('post_id',$post_id)->delete(); 

            $data_obj = Property::findOrFail($post_id);
            $data_obj->delete(); 
             
            $response['status'] = 1;            
        } 
        else if($action_for=="property_delete_selected")
        {   
            foreach($post_ids as $pid){

                $view_obj = PostViewsDownload::where('post_type','Property')->where('post_id',$pid)->delete();

                $fav_obj = Favourite::where('post_type','Property')->where('post_id',$pid)->delete();                
                $rep_obj = Reports::where('post_type','Property')->where('post_id',$pid)->delete(); 
                
                $gall_obj = PropertyGallery::where('post_id',$pid)->delete(); 

                $data_obj = Property::findOrFail($pid);
                $data_obj->delete();

            }
            
            $response['status'] = 1;
        }
        else if($action_for=="gallery_img_delete")
        {
            $data_obj = PropertyGallery::findOrFail($post_id);
            $data_obj->delete(); 
             
            $response['status'] = 1;            
        }
        else if($action_for=="plan_delete")
        {
            $data_obj = SubscriptionPlan::findOrFail($post_id);
            $data_obj->delete(); 
             
            $response['status'] = 1;            
        }        
        else if($action_for=="report_delete")
        {
            $data_obj = Reports::findOrFail($post_id);
            $data_obj->delete(); 
             
            $response['status'] = 1;            
        }
        else if($action_for=="page_delete")
        {
            $data_obj = Pages::findOrFail($post_id);
            $data_obj->delete(); 
             
            $response['status'] = 1;            
        }
        else if($action_for=="user_delete")
        {
            if($post_id==1)
            { 
                $response['status'] = 0;
            }
            else
            {
                $pro_obj = Property::where('user_id',$post_id)->delete();
                $fav_obj = Favourite::where('user_id',$post_id)->delete();
                $rep_obj = Reports::where('user_id',$post_id)->delete();

                $data_obj = User::findOrFail($post_id);
                $data_obj->delete(); 
             
                $response['status'] = 1;     
            }
                   
        }   
        else
        {
            $response['status'] = 0;            
        }     

        echo json_encode($response);
        exit;    
             
    }
     
}
