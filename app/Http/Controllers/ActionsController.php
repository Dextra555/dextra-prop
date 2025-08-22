<?php

namespace App\Http\Controllers;

use Auth;
use App\Property;
use App\PropertyGallery;
use App\Reports;
use App\Favourite;
use App\PostViewsDownload;

use Illuminate\Http\Request;

class ActionsController extends Controller
{ 
    public function ajax_actions(Request $request)
    {  
        $inputs = $request->all();         

        $post_id=$inputs['id'];
        $action_for=$inputs['action_for'];
        
        if($action_for=="property_favourite")
        { 
            if(Auth::check())
            {
                $user_id= Auth::user()->id;

                $post_type = 'Property';
    
                $fav_info = Favourite::where('post_type', '=', $post_type)->where('post_id', '=', $post_id)->where('user_id', '=', $user_id)->first();   
    
    
                if($fav_info)
                { 
                    $fav_obj = Favourite::findOrFail($fav_info->id);        
                    $fav_obj->delete();
                    
                    $response['set_title'] ='Set Favourite';
                    $response['msg_text'] =trans('words.fav_deleted');
    
                    $response['fav_del'] ='Yes';
                    
                }
                else
                {
                    $fav_obj = new Favourite;
    
                    $fav_obj->post_id = $post_id;
                    $fav_obj->user_id = $user_id;
                    $fav_obj->post_type = $post_type;
                    $fav_obj->save();
                    
                    $response['set_title'] ='Favourite';
                    $response['msg_text']=trans('words.fav_success');
                    
                    $response['fav_del'] ='no';
                }
                        
                $response['status'] = 1;
            }
            else
            {
                $response['msg_text']=trans('words.login_req');
                $response['status'] = 0;
            }
            
            
        }
        else if($action_for=="gallery_img_delete")
        {
            $data_obj = PropertyGallery::findOrFail($post_id);
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
        else if($action_for=="fav_delete")
        {
            $user_id = Auth::User()->id;

            $fav_obj = Favourite::where('user_id',$user_id)->where('post_id',$post_id)->delete();   

            $response['status'] = 1;    
        }
        else if($action_for=="property_status")
        {

            $status_value=$inputs['value'];

            $data_obj = Property::findOrFail($post_id);        
     
            if($status_value==1)
            {
                $data_obj->status = 0; 

                $response['status_set_icon'] = "ion-flash-off";
                $response['new_status_value'] = 0;
 
                $response['set_title'] = trans('words.pending');
                $response['set_class'] = 'lt_pending';
            }
            else
            {
                $data_obj->status = 1; 

                $response['status_set_icon'] = "ion-flash";
                $response['new_status_value'] = 1;
 
                $response['set_title'] = trans('words.active');
                $response['set_class'] = 'lt_active';
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

     
}
