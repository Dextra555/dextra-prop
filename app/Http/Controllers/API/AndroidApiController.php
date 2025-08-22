<?php

namespace App\Http\Controllers\API;
 
use App\User; 
use App\AppAds;
use App\Type;
use App\Location;
use App\Property;
use App\PropertyGallery;
use App\Pages;
use App\Reports;
use App\Settings;
use App\PostViewsDownload;
use App\Favourite;
use App\PaymentGateway;
use App\SubscriptionPlan;
use App\Transactions;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image; 
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use URL;

require(base_path() . '/public/stripe-php/init.php'); 

require(base_path() . '/public/paytm/PaytmChecksum.php');

require(base_path() . '/public/razorpay/vendor/autoload.php');
 
use Razorpay\Api\Api;
 
class AndroidApiController extends MainAPIController
{
    public function __construct()
    {
        $this->pagination_limit=getcong('pagination_limit')?getcong('pagination_limit'):10;
    }
      
    public function index()
    {   
          $response = array(); 
        
        return \Response::json(array(            
            'REAL_ESTATE_APP' => $response,
            'status_code' => 200,
            'msg' => "API",
            'success' => 1
        ));   
         
    }
    public function app_details()
    {   
        
        $get_data=checkSignSalt($_POST['data']);

        if(isset($get_data['user_id']) && $get_data['user_id']!='')
        {
            $user_id=$get_data['user_id'];        
            $user_info = User::getUserInfo($user_id);

           if(!empty($user_info))
           {
                if($user_info!='' AND $user_info->status==1)
                {
                    $user_status=true;
                }
                else
                {
                    $user_status=false;
                }
            }
            else
            {
               $user_status=false; 
            }
        }
        else
        {
            $user_status=false;
        }
 
        $settings = Settings::findOrFail('1'); 

        $default_language=$settings->default_language;
        $currency_code=$settings->currency_code;
        $app_name=$settings->app_name;
        $app_email=$settings->app_email;
        $app_logo=URL::to('/'.$settings->app_logo);
        $app_company=$settings->app_company?$settings->app_company:'';
        $app_website=$settings->app_website?$settings->app_website:'';
        $app_contact=$settings->app_contact?$settings->app_contact:'';
        $app_version=$settings->app_version?$settings->app_version:'';

        $facebook_link=$settings->facebook_link?$settings->facebook_link:'';
        $twitter_link=$settings->twitter_link?$settings->twitter_link:'';
        $instagram_link=$settings->instagram_link?$settings->instagram_link:'';
        $youtube_link=$settings->youtube_link?$settings->youtube_link:'';
         

        $app_update_hide_show=$settings->app_update_hide_show;
        $app_update_version_code=$settings->app_update_version_code?$settings->app_update_version_code:'1';
        $app_update_desc=stripslashes($settings->app_update_desc);
        $app_update_link=$settings->app_update_link;
        $app_update_cancel_option=$settings->app_update_cancel_option;
         
        $app_package_name=$settings->app_package_name?$settings->app_package_name:"com.app.realestate";

        //Ad List
        $ads_list = AppAds::where('status','1')->orderby('id')->get();  
        
        if(count($ads_list) > 0)
        {
            foreach($ads_list as $ad_data)
            {
                    $ad_id= $ad_data->id;
                    $ads_name= $ad_data->ads_name; 
                    $ads_info= json_decode($ad_data->ads_info);                  
                    $status= $ad_data->status?"true":"false";;                 
                     
                    $ads_obj[]=array("ad_id"=>$ad_id,"ads_name"=>$ads_name,"ads_info"=>$ads_info,"status"=>$status);   
            }
        }
        else
        {
            $ads_obj= array();
        }

        //Page List
        $page_list = Pages::where('status','1')->where('id','!=','2')->orderby('page_order')->get();  
  
        foreach($page_list as $page_data)
        {
                $page_id= $page_data->id;
                $page_title= stripslashes($page_data->page_title); 
                $page_content= stripslashes($page_data->page_content);                  
                  
                $pages_obj[]=array("page_id"=>$page_id,"page_title"=>$page_title,"page_content"=>$page_content);   
        }

        //Contact details
        $contact_info = Pages::where('status','1')->where('id','2')->first();

        $contact_obj=array("contact_title"=>stripslashes($contact_info->page_title),"contact_address"=>stripslashes($contact_info->page_contact_address),"contact_phone"=>stripslashes($contact_info->page_contact_phone),"contact_email"=>stripslashes($contact_info->page_contact_email),"contact_map"=>stripslashes($contact_info->page_contact_map));   

        /***********Save visitor user info start************/
        $user_ip=\Request::ip();                
        $os_name = isset($get_data['os_name'])?$get_data['os_name']:"";   
        $browser_name = '';    
 
        save_visitor_analytics_info($user_ip,$os_name,$browser_name);

        /***********Save visitor user info end************/
                

        $min_price= Property::min('price');
        $max_price= Property::max('price');

        $response = array('app_package_name'=>$app_package_name,'default_language' => $default_language,'currency_code' => $currency_code,'app_name' => $app_name,'app_email' => $app_email,'app_logo' => $app_logo,'app_company' => $app_company,'app_website' => $app_website,'app_contact' => $app_contact,'facebook_link' => $facebook_link,'twitter_link' => $twitter_link,'instagram_link' => $instagram_link,'youtube_link' => $youtube_link,'app_version' => $app_version,'app_update_hide_show' => $app_update_hide_show,'app_update_version_code' => $app_update_version_code,'app_update_desc' => $app_update_desc,'app_update_link' => $app_update_link,'app_update_cancel_option' => $app_update_cancel_option,'ads_list'=>$ads_obj,'page_list'=>$pages_obj,'contact_info'=>$contact_obj,'min_price'=>$min_price,'max_price'=>$max_price);

        return \Response::json(array(            
            'REAL_ESTATE_APP' => $response,
            'user_status' => $user_status,
             'status_code' => 200,
             'success' => 1
        )); 

    }

    public function payment_settings()
    {
        $get_data=checkSignSalt($_POST['data']);

        $settings = Settings::findOrFail('1'); 
        
        $gateway_list = PaymentGateway::where('status','1')->orderby('id')->get(); 

        $settings = Settings::findOrFail('1'); 

        $currency_code=$settings->currency_code;
        
        if(count($gateway_list))
        {
            foreach($gateway_list as $gateway_data)
            {
                    $gateway_id= $gateway_data->id;
                    $gateway_name= $gateway_data->gateway_name;
                    $gateway_logo= URL::to('/admin_assets/images/gateway/'.$gateway_data->id.'.png'); 
                    $gateway_info= json_decode($gateway_data->gateway_info);                  
                    $status= $gateway_data->status?"true":"false";;                 
                    
                    $response[]=array("gateway_id"=>$gateway_id,"gateway_name"=>$gateway_name,"gateway_logo"=>$gateway_logo,"gateway_info"=>$gateway_info,"status"=>$status);   
            }    
        }
        else
        {
            $response=array();    
        }
        

        return \Response::json(array(            
            'REAL_ESTATE_APP' => $response,
            'currency_code' => $currency_code,
            'status_code' => 200,
            'success' => 1
        ));
 
    }
    
    public function home()
    {   

        $get_data=checkSignSalt($_POST['data']);

        $user_id= isset($get_data['user_id'])?$get_data['user_id']:"";
        
        //Type
        $type= Type::where('status',1)->orderby('type_name')->limit(5)->get();

        if(count($type) > 0)
        {
            foreach($type as $type_data)
            {   
                $post_id=$type_data->id;
                $post_title=stripslashes($type_data->type_name);
                $post_image = URL::to('/'.$type_data->type_image);
 
                $response['types_list'][]=array('post_id'=>$post_id,'post_title'=>$post_title,'post_image'=>$post_image);
            }
        }
        else
        {
            $response['types_list']=array();
        }
 
        
        //Latest Property
        $data_list= Property::where('status',1)->orderby('id','DESC')->with(['types', 'locations', 'users'])->limit(5)->get();
 
        if(count($data_list) > 0)
        {
            foreach($data_list as $obj_data)
            {  
                $post_id = $obj_data->id;
                $post_title = stripslashes($obj_data->title);

                if(isset($obj_data->locations->name) AND $obj_data->locations->name!="")
                {
                    $address = $obj_data->locations->name;

                }
                else
                {
                    $address = stripslashes($obj_data->address);
                }

                
                $purpose = $obj_data->purpose;
                $price = $obj_data->price;
                $post_image = URL::to('/'.$obj_data->image);

                $total_views= post_views_count($post_id,"Property");
                $favourite=check_favourite("Property",$post_id,isset($get_data['user_id'])?$get_data['user_id']:"");

                $response['latest_property'][]=array("post_id"=>$post_id,"post_title"=>$post_title,"address"=>$address,"purpose"=>$purpose,"price"=>$price,"post_image"=>$post_image,"total_views"=>$total_views,"favourite"=>$favourite);
            }
        }
        else
        {
            $response['latest_property'] = array();
        }

        //Trending Property         

        $trending_start_date = date('Y-m-d', strtotime('today - 30 days'));
        $trending_end_date = date('Y-m-d');        

        $trending_now = DB::table('post_views')
                ->select('post_views.post_id','post_views.post_type','property.id')
                ->join('property','property.id','=','post_views.post_id')
                ->where('property.status',1)->whereBetween('post_views.date', array(strtotime($trending_start_date), strtotime($trending_end_date)))->selectRaw('SUM(post_views) as total_views')->groupBy('property.id','post_views.post_id','post_views.post_type')->orderby('total_views','DESC')->take(getcong('trending_limit'))->get();
        
        if(count($trending_now)>0) 
        {
            foreach($trending_now as $property_data)
            { 
                $trend_post_id= $property_data->post_id;

                $property_info= Property::find($trend_post_id);
 
                $trend_post_title = stripslashes($property_info->title);
                
                if(isset($property_info->locations->name) AND $property_info->locations->name!="")
                {
                    $trend_address = $property_info->locations->name;
                }
                else
                {
                    $trend_address = stripslashes($property_info->address);
                }

                $trend_purpose = $property_info->purpose;
                $trend_price = $property_info->price;
                $trend_post_image = URL::to('/'.$property_info->image);

                $trend_total_views= post_views_count($trend_post_id,"Property");
                $trend_favourite=check_favourite("Property",$trend_post_id,isset($get_data['user_id'])?$get_data['user_id']:"");
  

                $response['trending_property'][]=array("post_id"=>$trend_post_id,"post_title"=>$trend_post_title,"address"=>$trend_address,"purpose"=>$trend_purpose,"price"=>$trend_price,"post_image"=>$trend_post_image,"total_views"=>$trend_total_views,"favourite"=>$trend_favourite);

            }
        }
        else
        {
            $response['trending_property'] = array();
        }
 
        return \Response::json(array(            
            'REAL_ESTATE_APP' => $response,
            'status_code' => 200 
        ));
    }

    public function location()
    {    
 
        $get_data=checkSignSalt($_POST['data']);

        $data_list= Location::where('status',1)->orderby('name')->get();
        
        $total_records=Location::where('status',1)->count();

       

        if($total_records > 0)
        {
            foreach($data_list as $obj_data)
            {  
                $response[]=array("post_id"=>$obj_data->id,"post_title"=>stripslashes($obj_data->name));
            }
        }
        else
        {
            $response = array();
        }


         return \Response::json(array(            
            'REAL_ESTATE_APP' => $response,
            'total_records' => $total_records,
            'status_code' => 200 
        ));

    }
 
 
    public function types()
    {    
 
        $get_data=checkSignSalt($_POST['data']);

        $data_list= Type::where('status',1)->orderby('type_name')->paginate($this->pagination_limit);
        
        $total_records=Type::where('status',1)->count();

       if($data_list->currentPage() == $data_list->lastPage())
       {
            $load_more=false;  
       }
       else
       {
            $load_more=true;  
       }

        if($total_records > 0)
        {
            foreach($data_list as $obj_data)
            {  
                $response[]=array("post_id"=>$obj_data->id,"post_title"=>stripslashes($obj_data->type_name),"post_image"=>URL::to('/'.$obj_data->type_image));
            }
        }
        else
        {
            $response = array();
        }


         return \Response::json(array(            
            'REAL_ESTATE_APP' => $response,
            'total_records' => $total_records,
            'load_more' => $load_more,
            'status_code' => 200 
        ));

    } 

    public function types_all()
    {    
 
        $get_data=checkSignSalt($_POST['data']);

        $data_list= Type::where('status',1)->orderby('type_name')->get();
        
        $total_records=Type::where('status',1)->count();
 
        if($total_records > 0)
        {
            foreach($data_list as $obj_data)
            {  
                $response[]=array("post_id"=>$obj_data->id,"post_title"=>stripslashes($obj_data->type_name),"post_image"=>URL::to('/'.$obj_data->type_image));
            }
        }
        else
        {
            $response = array();
        }


         return \Response::json(array(            
            'REAL_ESTATE_APP' => $response,
            'status_code' => 200 
        ));

    } 
    

    public function property_by_types()
    {
        $get_data=checkSignSalt($_POST['data']);

        $type_id = $get_data['type_id'];

        $data_list= Property::where('status',1)->where('type_id',$type_id)->with(['types', 'locations', 'users'])->orderby('id','DESC')->paginate($this->pagination_limit);

        $total_records=$data_list->count();

       if($data_list->currentPage() == $data_list->lastPage())
       {
            $load_more=false;  
       }
       else
       {
            $load_more=true;  
       }

        if($total_records > 0)
        {
            foreach($data_list as $obj_data)
            {  
                $post_id = $obj_data->id;
                $post_title = stripslashes($obj_data->title);
                
                if(isset($obj_data->locations->name) AND $obj_data->locations->name!="")
                {
                    $address = $obj_data->locations->name;

                }
                else
                {
                    $address = stripslashes($obj_data->address);
                }


                $purpose = $obj_data->purpose;
                $price = $obj_data->price;
                $post_image = URL::to('/'.$obj_data->image);

                $total_views= post_views_count($post_id,"Property");
                $favourite=check_favourite("Property",$post_id,isset($get_data['user_id'])?$get_data['user_id']:"");

                $response[]=array("post_id"=>$post_id,"post_title"=>$post_title,"address"=>$address,"purpose"=>$purpose,"price"=>$price,"post_image"=>$post_image,"total_views"=>$total_views,"favourite"=>$favourite);
            }
        }
        else
        {
            $response = array();
        }


         return \Response::json(array(            
            'REAL_ESTATE_APP' => $response,
            'total_records' => $total_records,
            'load_more' => $load_more,
            'status_code' => 200 
        ));
    }
     
    public function trending_property()
    {
        $get_data=checkSignSalt($_POST['data']);

        $trending_start_date = date('Y-m-d', strtotime('today - 30 days'));
        $trending_end_date = date('Y-m-d');

        $trending_now = PostViewsDownload::select("post_id","post_type")->whereBetween('date', array(strtotime($trending_start_date), strtotime($trending_end_date)))->selectRaw('SUM(post_views) as total_views')->groupBy('post_id','post_type')->orderby('total_views','DESC')->take(getcong('trending_limit'))->get();
       
        if(count($trending_now)>0) 
        {
            foreach($trending_now as $property_data)
            { 
                $trend_post_id= $property_data->post_id;

                $property_info= Property::find($trend_post_id);   
 
                $trend_post_title = stripslashes($property_info->title);
                
                if(isset($property_info->locations->name) AND $property_info->locations->name!="")
                {
                    $trend_address = $property_info->locations->name;

                }
                else
                {
                    $trend_address = stripslashes($property_info->address);
                }
                
                $trend_purpose = $property_info->purpose;
                $trend_price = $property_info->price;
                $trend_post_image = URL::to('/'.$property_info->image);

                $trend_total_views= post_views_count($trend_post_id,"Property");
                $trend_favourite=check_favourite("Property",$trend_post_id,isset($get_data['user_id'])?$get_data['user_id']:"");

                $response[]=array("post_id"=>$trend_post_id,"post_title"=>$trend_post_title,"address"=>$trend_address,"purpose"=>$trend_purpose,"price"=>$trend_price,"post_image"=>$trend_post_image,"total_views"=>$trend_total_views,"favourite"=>$trend_favourite);

            }
        }
        else
        {
            $response = array();
        }
 
        return \Response::json(array(            
            'REAL_ESTATE_APP' => $response,
            'status_code' => 200 
        ));
    }

    public function latest_property()
    {
        $get_data=checkSignSalt($_POST['data']);

        if(isset($get_data['filter_by']) AND $get_data['filter_by']=="price_high")
        {
            $data_list= Property::where('status',1)->orderby('price','DESC')->with(['types', 'locations', 'users'])->limit(getcong('latest_limit'))->get();
        }
        else if(isset($get_data['filter_by']) AND $get_data['filter_by']=="price_low")
        {
            $data_list= Property::where('status',1)->orderby('price','ASC')->with(['types', 'locations', 'users'])->limit(getcong('latest_limit'))->get();
        }
        else if(isset($get_data['filter_by']) AND $get_data['filter_by']=="distance")
        {
            $latitude = $get_data['lat'];
            $longitude = $get_data['long'];
             
            $haversine = "(
                6371 * acos(
                    cos(radians(" .$latitude. "))
                    * cos(radians(`latitude`))
                    * cos(radians(`longitude`) - radians(" .$longitude. "))
                    + sin(radians(" .$latitude. ")) * sin(radians(`latitude`))
                )
            )";            

            $data_list= Property::select("*")
                        ->selectRaw("round($haversine, 1) AS distance")
                        ->orderby("distance", "desc")
                        ->with(['types', 'locations', 'users'])
                        ->limit(getcong('latest_limit'))
                        ->get();    
                        
        }
        else
        {
            $data_list= Property::where('status',1)->with(['types', 'locations', 'users'])->orderby('id','DESC')->limit(getcong('latest_limit'))->get();
        }
 
        if(count($data_list) > 0)
        {
            foreach($data_list as $obj_data)
            {  
                $post_id = $obj_data->id;
                $post_title = stripslashes($obj_data->title);
                
                if(isset($obj_data->locations->name) AND $obj_data->locations->name!="")
                {
                    $address = $obj_data->locations->name;

                }
                else
                {
                    $address = stripslashes($obj_data->address);
                }
                
                $purpose = $obj_data->purpose;
                $price = $obj_data->price;
                $post_image = URL::to('/'.$obj_data->image);

                $total_views= post_views_count($post_id,"Property");
                $favourite=check_favourite("Property",$post_id,isset($get_data['user_id'])?$get_data['user_id']:"");

                $response[]=array("post_id"=>$post_id,"post_title"=>$post_title,"address"=>$address,"purpose"=>$purpose,"price"=>$price,"post_image"=>$post_image,"total_views"=>$total_views,"favourite"=>$favourite);
            }
        }
        else
        {
            $response = array();
        }

        return \Response::json(array(            
            'REAL_ESTATE_APP' => $response,
             'status_code' => 200 
        ));
    }

    public function property_details()
    {
        $get_data=checkSignSalt($_POST['data']);

         $property_id = $get_data['property_id'];
         $property_info= Property::where('status',1)->where('id',$property_id)->with(['types', 'locations', 'users'])->first();

            
            $post_id = $property_info->id; 
            $type_id = $property_info->type_id;
            $type_name = $property_info->types->type_name;  

            $location_id = $property_info->location_id;
            $location_name = isset($property_info->locations->name)?$property_info->locations->name:''; 

            $p_user_id = $property_info->user_id;
            $user_name = $property_info->users->name;

            if(file_exists(public_path('upload/'.$property_info->users->user_image)))
            {
                $user_image = URL::to('upload/'.$property_info->users->user_image);  

            }
            else
            {
                $user_image = "";
            }


            $post_title = stripslashes($property_info->title);
            $post_description = stripslashes($property_info->description);
            $phone = $property_info->phone?$property_info->phone:'';
            $address = stripslashes($property_info->address);
            $latitude = $property_info->latitude?$property_info->latitude:'';
            $longitude = $property_info->longitude?$property_info->longitude:'';
            $purpose = $property_info->purpose?$property_info->purpose:'';
            $bedrooms = $property_info->bedrooms?$property_info->bedrooms:'';
            $bathrooms = $property_info->bathrooms?$property_info->bathrooms:'';
            $area = $property_info->area?$property_info->area:'';
            $furnishing = $property_info->furnishing?$property_info->furnishing:'';
            $amenities = $property_info->amenities?stripslashes($property_info->amenities):'';            
            $price = $property_info->price?$property_info->price:'';
            $verified = $property_info->verified;
            $post_image = URL::to('/'.$property_info->image);
            $floor_plan_image = URL::to('/'.$property_info->floor_plan_image);
 
            $total_views= post_views_count($post_id,"Property");
            $favourite=check_favourite("Property",$post_id,isset($get_data['user_id'])?$get_data['user_id']:"");

            $gallery_images = PropertyGallery::where('post_id',$post_id)->orderBy('id')->get();

            if(count($gallery_images) > 0)
            {
                foreach($gallery_images as $gallery_data)
                {  
                    $gallery_id = $gallery_data->id;                    
                    $gallery_image = URL::to('/'.$gallery_data->image);
 

                    $gallery_list[]=array("gallery_id"=>$gallery_id,"gallery_image"=>$gallery_image);
                }
            }
            else
            {
                $gallery_list = array();
            }

            //Related
            $related_data_list= Property::where('status',1)->where('type_id',$type_id)->where('id','!=',$post_id)->with(['types', 'locations', 'users'])->orderby('id','DESC')->paginate($this->pagination_limit);
 
            if(count($related_data_list) > 0)
            {
                foreach($related_data_list as $related_data)
                {  
                    $r_post_id = $related_data->id;
                    $r_post_title = stripslashes($related_data->title);
 
                    if(isset($related_data->locations->name) AND $related_data->locations->name!="")
                    {
                        $r_address = $related_data->locations->name;

                    }
                    else
                    {
                        $r_address = stripslashes($related_data->address);
                    }

                     
                    $r_purpose = $related_data->purpose;
                    $r_price = $related_data->price;
                    $r_post_image = URL::to('/'.$related_data->image);

                    $r_total_views= post_views_count($r_post_id,"Property");
                    $r_favourite=check_favourite("Property",$r_post_id,isset($get_data['user_id'])?$get_data['user_id']:"");

                    $related_property[]=array("post_id"=>$r_post_id,"post_title"=>$r_post_title,"address"=>$r_address,"purpose"=>$r_purpose,"price"=>$r_price,"post_image"=>$r_post_image,"total_views"=>$r_total_views,"favourite"=>$r_favourite);
                }
            }
            else
            {
                $related_property = array();
            }

            $response=array("post_id"=>$post_id,"type_id"=>$type_id,"type_name"=>$type_name,"location_id"=>$location_id,"location_name"=>$location_name,"user_name"=>$user_name,"user_image"=>$user_image,"post_title"=>$post_title,"post_description"=>$post_description,"phone"=>$phone,"address"=>$address,"latitude"=>$latitude,"longitude"=>$longitude,"purpose"=>$purpose,"bedrooms"=>$bedrooms,"bathrooms"=>$bathrooms,"area"=>$area,"furnishing"=>$furnishing,"amenities"=>$amenities,"price"=>$price,"verified"=>$verified,"post_image"=>$post_image,"floor_plan_image"=>$floor_plan_image,"total_views"=>$total_views,"favourite"=>$favourite,"gallery_list"=>$gallery_list,"related_property"=>$related_property);
          
         return \Response::json(array(            
            'REAL_ESTATE_APP' => $response,
            'status_code' => 200 
        ));
    }

    public function search_property()
    {
        $get_data=checkSignSalt($_POST['data']);
        
       
         $data_list= Property::with(['types', 'locations', 'users'])->where('status',1)->where(function($query) use($get_data) {
            
            if(isset($get_data['verified']) AND $get_data['verified'])
            {
                $query->where('verified',$get_data['verified']);
            }
            
            if(isset($get_data['price_start']) AND $get_data['price_start'] AND $get_data['price_end'])
            {
                $query->whereBetween('price', [$get_data['price_start'], $get_data['price_end']]);
            }

            if(isset($get_data['bedrooms']) AND $get_data['bedrooms'])
            {
                if($get_data['bedrooms']==4)
                {
                    $query->where('bedrooms','>=',$get_data['bedrooms']);
                }
                else
                {
                    $query->where('bedrooms',$get_data['bedrooms']);
                }
                
            }

            if(isset($get_data['bathrooms']) AND $get_data['bathrooms'])
            {
                if($get_data['bathrooms']==4)
                {
                    $query->where('bathrooms','>=',$get_data['bathrooms']);
                }
                else
                {
                    $query->where('bathrooms',$get_data['bathrooms']);
                }
            }

            if(isset($get_data['furnishing']) AND $get_data['furnishing'])
            {
                $query->where('furnishing',$get_data['furnishing']);
            }

            if(isset($get_data['type_id']) AND $get_data['type_id'])
            {
                $query->where('type_id',$get_data['type_id']);
            }

            if(isset($get_data['location_id']) AND $get_data['location_id'])
            {
                $query->where('location_id',$get_data['location_id']);
            }

        })->orderby('id','DESC')->paginate($this->pagination_limit); 
         
        
        if($data_list->currentPage() == $data_list->lastPage())
        {
            $load_more=false;  
        }
        else
        {
            $load_more=true;  
        }   
         
        if(count($data_list) > 0)
        {
            foreach($data_list as $obj_data)
            {  
                $post_id = $obj_data->id;
                $post_title = stripslashes($obj_data->title);
 
                if(isset($obj_data->locations->name) AND $obj_data->locations->name!="")
                {
                    $address = $obj_data->locations->name;

                }
                else
                {
                    $address = stripslashes($obj_data->address);
                }

                $purpose = $obj_data->purpose;
                $price = $obj_data->price;
                $post_image = URL::to('/'.$obj_data->image);

                $total_views= post_views_count($post_id,"Property");
                $favourite=check_favourite("Property",$post_id,isset($get_data['user_id'])?$get_data['user_id']:"");

                $response[]=array("post_id"=>$post_id,"post_title"=>$post_title,"address"=>$address,"purpose"=>$purpose,"price"=>$price,"post_image"=>$post_image,"total_views"=>$total_views,"favourite"=>$favourite);
            }
        }
        else
        {
            $response = array();
        }

        return \Response::json(array(            
            'REAL_ESTATE_APP' => $response,
            'load_more' => $load_more, 
            'status_code' => 200 
        ));
    }

    public function normal_search_property()
    {
        $get_data=checkSignSalt($_POST['data']);
        
       
         $data_list= Property::with(['types', 'locations', 'users'])->where('status',1)->where(function($query) use($get_data) {
            
            if(isset($get_data['purpose']) AND $get_data['purpose']!="")
            {
                $query->where('purpose',$get_data['purpose']);
            }
             
            if(isset($get_data['type_id']) AND $get_data['type_id']!="")
            {
                $query->where('type_id',$get_data['type_id']);
            }

            if(isset($get_data['location_id']) AND $get_data['location_id']!="")
            {
                $query->where('location_id',$get_data['location_id']);
            }

            if(isset($get_data['search_text']) AND $get_data['search_text']!="")
            {
                $query->where('title','LIKE',"%".$get_data['search_text']."%");
            }

        })->orderby('id','DESC')->paginate($this->pagination_limit); 
          
        
        if($data_list->currentPage() == $data_list->lastPage())
        {
            $load_more=false;  
        }
        else
        {
            $load_more=true;  
        }   
         
        if(count($data_list) > 0)
        {
            foreach($data_list as $obj_data)
            {  
                $post_id = $obj_data->id;
                $post_title = stripslashes($obj_data->title);
 
                if(isset($obj_data->locations->name) AND $obj_data->locations->name!="")
                {
                    $address = $obj_data->locations->name;

                }
                else
                {
                    $address = stripslashes($obj_data->address);
                }

                $purpose = $obj_data->purpose;
                $price = $obj_data->price;
                $post_image = URL::to('/'.$obj_data->image);

                $total_views= post_views_count($post_id,"Property");
                $favourite=check_favourite("Property",$post_id,isset($get_data['user_id'])?$get_data['user_id']:"");

                $response[]=array("post_id"=>$post_id,"post_title"=>$post_title,"address"=>$address,"purpose"=>$purpose,"price"=>$price,"post_image"=>$post_image,"total_views"=>$total_views,"favourite"=>$favourite);
            }
        }
        else
        {
            $response = array();
        }

        return \Response::json(array(            
            'REAL_ESTATE_APP' => $response,
            'load_more' => $load_more, 
            'status_code' => 200 
        ));
    }
 
    public function post_view()
    {           
        $get_data=checkSignSalt($_POST['data']);

        $post_id = $get_data['post_id'];
        $post_type = $get_data['post_type'];
          
        //View Update
        post_views_save($post_id,$post_type);

        $post_views= post_views_count($post_id,$post_type);

        $response=array("views"=>$post_views);
         
         return \Response::json(array(            
            'REAL_ESTATE_APP' => $response,
            'status_code' => 200,
            'success' => 1
        ));

    }
 

    public function post_favourite()
    {   
        
        $get_data=checkSignSalt($_POST['data']);

        $user_id = $get_data['user_id'];
        $post_id = $get_data['post_id'];
        $post_type = $get_data['post_type'];
 
        $fav_info = Favourite::where('post_type', '=', $post_type)->where('post_id', '=', $post_id)->where('user_id', '=', $user_id)->first();   


        if($fav_info)
        { 
            $fav_obj = Favourite::findOrFail($fav_info->id);        
            $fav_obj->delete();

            $success=false;
            $msg=trans('words.fav_deleted');
             
        }
        else
        {
            $fav_obj = new Favourite;

            $fav_obj->post_id = $post_id;
            $fav_obj->user_id = $user_id;
            $fav_obj->post_type = $post_type;
            $fav_obj->save();

            $success=true;
            $msg=trans('words.fav_success');
        }  
          
        $response=array();
         
         return \Response::json(array(            
            'REAL_ESTATE_APP' => $response,
            'status_code' => 200,
            'msg' => $msg,
            'success' => $success
        ));

    }

      
      
    public function login()
    {   
        
        $get_data=checkSignSalt($_POST['data']);

          
        $email=isset($get_data['email'])?$get_data['email']:'';
        $password=isset($get_data['password'])?$get_data['password']:'';
        
        if ($email=='' AND $password=='')
        {
                return \Response::json(array(            
                    'status_code' => 200,
                    'msg' => trans('words.email_pass_req'),
                    'success' => 0
                ));
        }
 
        $user_info = User::where('email',$email)->first(); 

        if (!$user_info)
        {
                 

                return \Response::json(array(            
                    'status_code' => 200,
                    'msg' => trans('words.email_password_invalid'),
                    'success' => 0
                ));
        }
         
        if (Hash::check($password, $user_info['password'])) 
        {
           
            if($user_info->status==0){                  

                  return \Response::json(array(            
                    'status_code' => 200,
                    'msg' => trans('words.account_banned'),
                    'success' => 0
                ));
            }             
            else
            { 
                $user_id=$user_info->id;
                $user = User::findOrFail($user_id);

                 
                if($user->user_image!='')
                {
                    $user_image=URL::asset('upload/'.$user->user_image);
                }
                else
                {
                    $user_image=URL::asset('upload/profile.jpg');
                }
                $phone= $user->phone?$user->phone:'';

                $response = array('user_id' => $user_id,'name' => $user->name,'email' => $user->email,'phone' => $phone,'user_image' => $user_image);
            }

            return \Response::json(array(            
                'REAL_ESTATE_APP' => $response,
                'status_code' => 200,
                'msg' => trans('words.login_success'),
                'success' => 1
            ));   

        }
        else
        {

            return \Response::json(array(            
                'status_code' => 200,
                'msg' => trans('words.email_password_invalid'),
                'success' => 0
            ));   
        }
                 
    }

    public function signup()
    { 
        $get_data=checkSignSalt($_POST['data']);
            
        $name= $get_data['name'];
        $email= $get_data['email'];
        $password= $get_data['password'];
        $phone= $get_data['phone'];
        
        $check_email = User::where('email', $email)->first();

        if($check_email)
        {

                return \Response::json(array(            
                    'status_code' => 200,
                    'msg' => trans('words.email_already_used'),
                    'success' => 0
                ));
        }
        else
        {   
            $user = new User;

            $user->usertype = 'User';
            $user->name = $name; 
            $user->email = $email;         
            $user->password= bcrypt($password);  
            $user->phone= $phone?$phone:'';        
            $user->save();

            $response = array();

            return \Response::json(array(            
                'REAL_ESTATE_APP' => $response,
                'status_code' => 200,
                'msg' => trans('words.account_created_successfully'),
                'success' => 1
            ));
        }
    }

    public function social_login()
    {   
        
        $get_data=checkSignSalt($_POST['data']);
            
        $login_type= $get_data['login_type']; // FB or Google
        $social_id= $get_data['social_id'];

        $name= $get_data['name'];
        $email= $get_data['email'];
        $password= bcrypt('123456dummy');
        $phone= '';
        
        $check_email = User::where('email', $email)->first();

        if($check_email)
        {
            $finduser = User::where('email', $email)->first();
        }
        else
        {
            if($login_type=="google")
            {
                 $finduser = User::where('google_id', $social_id)->first();
     
            }
            else
            {
                 $finduser = User::where('facebook_id', $social_id)->first();
      
            }
        }

        if($finduser)
        {   
                if($finduser->user_image!='')
                {
                    $user_image=URL::asset('upload/'.$finduser->user_image);
                }
                else
                {
                    $user_image=URL::asset('upload/profile.jpg');
                }

                if($finduser->status==0){
                 
                    $msg= trans('words.account_banned');
                    $success =0;

                    $response = array();
                }
                else
                {
                 $phone= $finduser->phone?$finduser->phone:'';  
                 
                 $msg= trans('words.login_success');
                 $success =1;
                
                 $response = array('user_id' => $finduser->id,'name' => $finduser->name,'email' => $finduser->email,'phone' => $phone,'user_image' => $user_image);
                }
        }
        else
        {

            if($login_type=="google")
            {
                 $social_login_type="google";
                 $google_id=$social_id;

                 $user_obj = new User;

                $user_obj->usertype = 'User';
                $user_obj->social_login_type = $social_login_type; 
                $user_obj->google_id = $google_id; 
                $user_obj->name = $name; 
                $user_obj->email = $email;         
                $user_obj->password= bcrypt($password);  
                $user_obj->phone= $phone?$phone:'';        
                $user_obj->save();
     
            }
            else
            {
                 $social_login_type="facebook";
                 $facebook_id=$social_id;

                 $user_obj = new User;

                $user_obj->usertype = 'User';
                $user_obj->social_login_type = $social_login_type; 
                $user_obj->facebook_id = $facebook_id; 
                $user_obj->name = $name; 
                $user_obj->email = $email;         
                $user_obj->password= bcrypt($password);  
                $user_obj->phone= $phone?$phone:'';        
                $user_obj->save();
      
            }

            //Get last insert user id
            $user_id=$user_obj->id;
 
            $user = User::findOrFail($user_id);

                 
            if($user->user_image!='')
            {
                $user_image=URL::asset('upload/'.$user->user_image);
            }
            else
            {
                $user_image=URL::asset('upload/profile.jpg');
            }
            $phone= $user->phone?$user->phone:'';

            $msg= trans('words.login_success');
            $success =1;

            $response = array('user_id' => $user_id,'name' => $user->name,'email' => $user->email,'phone' => $phone,'user_image' => $user_image);
        }

 
        return \Response::json(array(            
            'REAL_ESTATE_APP' => $response,
            'status_code' => 200,
            'msg' => $msg,
            'success' => $success
        ));   
    }
     
 
    public function forgot_password()
    {   
        $get_data=checkSignSalt($_POST['data']);

        $email=isset($get_data['email'])?$get_data['email']:'';
 
        $user = User::where('email', $email)->first();


        if(!$user)
        {   
            $msg = trans('words.email_not_found');
            $success = 0;

            $response = array();
        }
        else
        {  
           $user_id=$user->id;
           $name=$user->name;
           $email=$user->email;

           $password= Str::random(10);

           $user = User::findOrFail($user_id);
           $user->password= bcrypt($password);
           $user->save(); 
    
           try{

            $data_email = array(
                'name' => $name,
                'password' => $password
                );    

            \Mail::send('emails.password', $data_email, function($message) use ($name,$email){
                $message->to($email, $name)
                ->from(getcong('app_email'), getcong('app_name'))
                ->subject('Password Reset | '.getcong('app_name'));
            });    

            }catch (\Throwable $e) {
                     
                \Log::info($e->getMessage());    
            }     
     
            $msg =  trans('words.email_new_pass_sent');
            $success = 1;

 
        }

        return \Response::json(array(            
            'status_code' => 200,
            'msg' => $msg,
            'success' => $success
        ));
    }

     
    public function profile()
    {   
        $get_data=checkSignSalt($_POST['data']);

        $user_id=$get_data['user_id'];

        $user = User::where('id',$user_id)->first();

        if (!$user)
        {
            $msg =  'Something went wrong';

            return \Response::json(array(            
                'status_code' => 200,
                'msg' => $msg,
                'success' => 0
            ));
        }
                 
        if($user->user_image!='')
        {
            $user_image=URL::asset('upload/'.$user->user_image);
        }
        else
        {
            $user_image=URL::asset('upload/profile.jpg');
        }

        $phone=$user->phone?$user->phone:'';
 
        $response = array('user_id' => $user_id,'name' => $user->name,'email' => $user->email,'phone' => $phone,'user_image' => $user_image);


        return \Response::json(array(            
            'REAL_ESTATE_APP' => $response,
            'status_code' => 200,
            'msg' => trans('words.profile'),
            'success' => 1
        ));
    }

    public function profile_update(Request $request)
    { 
        
        $inputs = $request->all();
        
        $get_data=checkSignSalt($inputs['data']);
          
        $user_id=$get_data['user_id'];    
        $user_obj = User::findOrFail($user_id);

        $icon = $request->file('user_image');
        
                 
        if($icon){

            \File::delete(public_path('/upload/').$user_obj->user_image);            

            $tmpFilePath = public_path('/upload/');

            $hardPath =  Str::slug($get_data['name'], '-').'-'.md5(time());

            $img = Image::make($icon);

            $img->fit(250, 250)->save($tmpFilePath.$hardPath.'-b.jpg');

            $user_obj->user_image = $hardPath.'-b.jpg';
        }
        
        
        $user_obj->name = $get_data['name'];          
        $user_obj->email = $get_data['email']; 
        $user_obj->phone = $get_data['phone'];
        
        if($get_data['password'])
        {
            $user_obj->password = bcrypt($get_data['password']);
        }         
       
        $user_obj->save();

        $user_id=$get_data['user_id'];    
        $user = User::findOrFail($user_id);

        if($user->user_image!='')
        {
            $user_image=URL::asset('upload/'.$user->user_image);
        }
        else
        {
            $user_image=URL::asset('upload/profile.jpg');
        }


        $response = array('user_image' => $user_image);

        return \Response::json(array(            
            'REAL_ESTATE_APP' => $response,
            'status_code' => 200,
            'msg' => trans('words.successfully_updated'),
            'success' => 1
        ));
    }

    public function user_property()
    {   
        $get_data=checkSignSalt($_POST['data']);

        $user_id=$get_data['user_id'];

        $data_list = Property::where('user_id',$user_id)->get();

        if(count($data_list) > 0)
        {
            foreach($data_list as $obj_data)
            {  
                $post_id = $obj_data->id;
                $post_title = stripslashes($obj_data->title);
 
                if(isset($obj_data->locations->name) AND $obj_data->locations->name!="")
                {
                    $address = $obj_data->locations->name;

                }
                else
                {
                    $address = stripslashes($obj_data->address);
                }


                $purpose = $obj_data->purpose;
                $price = $obj_data->price;
                $post_image = URL::to('/'.$obj_data->image);
                $status = $obj_data->status;

                $total_views= post_views_count($post_id,"Property");
                

                $response[]=array("post_id"=>$post_id,"post_title"=>$post_title,"address"=>$address,"purpose"=>$purpose,"price"=>$price,"post_image"=>$post_image,"status"=>$status,"total_views"=>$total_views);
            }
        }
        else
        {
            $response = array();
        } 


        return \Response::json(array(            
            'REAL_ESTATE_APP' => $response,
            'status_code' => 200,
            'msg' => trans('words.profile'),
            'success' => 1
        ));
    }

    public function user_add_property(Request $request)
    { 
        $inputs = $request->all();
          
        $get_data=checkSignSalt($inputs['data']); 
         
        $prop_obj = new Property;

        $prop_obj->user_id = $get_data['user_id'];
        $prop_obj->type_id = $get_data['type_id'];
        $prop_obj->location_id = $get_data['location_id'];
        $prop_obj->title = addslashes($get_data['title']);
        $prop_obj->description = addslashes($get_data['description']);
        $prop_obj->phone = $get_data['phone'];
        $prop_obj->address = addslashes($get_data['address']);
        $prop_obj->latitude = $get_data['latitude'];
        $prop_obj->longitude = $get_data['longitude'];
        $prop_obj->purpose = $get_data['purpose'];
        $prop_obj->bedrooms = $get_data['bedrooms'];
        $prop_obj->bathrooms = $get_data['bathrooms'];
        $prop_obj->area = $get_data['area'];
        $prop_obj->furnishing = $get_data['furnishing'];
        $prop_obj->amenities = $get_data['amenities'];
        $prop_obj->price = $get_data['price'];
        $prop_obj->verified = $get_data['verified'];
        
        $featured_image = $request->file('featured_image');        
                 
        if($featured_image){

            $tmpFilePath = public_path('/upload/');

            $hardPath =  $get_data['user_id'].'-'.md5(time());

            $prop_img = Image::make($featured_image);

            $prop_img->save($tmpFilePath.$hardPath.'.jpg');

            $prop_obj->image = 'upload/'.$hardPath.'.jpg';
        }

        $floor_plan_image = $request->file('floor_plan_image');    

        if($floor_plan_image){

            $tmpFilePath = public_path('/upload/');

            $hardPath =  $get_data['user_id'].'-floor_plan-'.md5(time());

            $prop_img = Image::make($floor_plan_image);

            $prop_img->save($tmpFilePath.$hardPath.'.jpg');

            $prop_obj->floor_plan_image = 'upload/'.$hardPath.'.jpg';
        }

        $prop_obj->status = 0;

        $prop_obj->save();

        $property_id= $prop_obj->id; 

        $gallery_files=$request->file('image_gallery');

        if($request->hasFile('image_gallery'))
        {
            foreach($gallery_files as $file) {
                            
                $gallery_obj = new PropertyGallery;
                
                $tmpFilePath = public_path('upload/');           
                
                $hardPath = 'gallery_img_'.rand(0,9999).'.jpg';
                
                $g_img = Image::make($file);

                $g_img->save($tmpFilePath.$hardPath);
                

                $gallery_obj->post_id = $property_id;
                $gallery_obj->image = 'upload/'.$hardPath;
                $gallery_obj->save();
                
            }
        }
  
        $response=array();
         
         return \Response::json(array(            
            'REAL_ESTATE_APP' => $response,
            'status_code' => 200,
            'msg' => trans('words.property_added_success'),
            'success' => 1
        ));
        
    }
 
    public function user_edit_property()
    {   
        $get_data=checkSignSalt($_POST['data']);

        $post_id=$get_data['post_id'];

        $property_info = Property::where('id',$post_id)->first();

        if($property_info)
        {

            $gallery_list = PropertyGallery::where('post_id',$post_id)->get();

            if(count($gallery_list) > 0)
            {
                foreach($gallery_list as $gallery_data)
                {  
                    $gallery_img_id = $gallery_data->id;                    
                    $post_id = $gallery_data->post_id;
                    $gallery_image = URL::to('/'.$gallery_data->image);
 
                    $gallery[]=array("gallery_img_id"=>$gallery_img_id,"post_id"=>$post_id,"gallery_image"=>$gallery_image);
                }
            }
            else
            {
                $gallery = array();
            }

            $type_name= Type::getTypeInfo($property_info->type_id,'type_name');

            $response=array("post_id"=>$property_info->id,"user_id"=>$property_info->user_id,"type_id"=>$property_info->type_id,
            "location_id"=>$property_info->location_id,
            "type_name"=>$type_name,
            "title"=>stripslashes($property_info->title),
            "description"=>stripslashes($property_info->description),
            "phone"=>$property_info->phone,
            "address"=>stripslashes($property_info->address),
            "latitude"=>$property_info->latitude,
            "longitude"=>$property_info->longitude,
            "purpose"=>$property_info->purpose,
            "bedrooms"=>$property_info->bedrooms,
            "bathrooms"=>$property_info->bathrooms,
            "area"=>$property_info->area,
            "furnishing"=>$property_info->furnishing,
            "amenities"=>$property_info->amenities,
            "price"=>$property_info->price,
            "verified"=>$property_info->verified,
            "image"=>URL::to('/'.$property_info->image),
            "floor_plan_image"=>URL::to('/'.$property_info->floor_plan_image),
            "gallery_images"=>$gallery
                );
        }
        else
        {
            $response = array();
        } 


        return \Response::json(array(            
            'REAL_ESTATE_APP' => $response,
            'status_code' => 200,
            'msg' => trans('words.profile'),
            'success' => 1
        ));
    }


    public function user_edit_property_save(Request $request)
    { 
        $inputs = $request->all();
          
        $get_data=checkSignSalt($inputs['data']); 
        
        $post_id = $get_data['post_id'];
        
        $prop_obj = Property::findOrFail($post_id);

        $prop_obj->user_id = $get_data['user_id'];
        $prop_obj->type_id = $get_data['type_id'];
        $prop_obj->location_id = $get_data['location_id'];
        $prop_obj->title = addslashes($get_data['title']);
        $prop_obj->description = addslashes($get_data['description']);
        $prop_obj->phone = $get_data['phone'];
        $prop_obj->address = addslashes($get_data['address']);
        $prop_obj->latitude = $get_data['latitude'];
        $prop_obj->longitude = $get_data['longitude'];
        $prop_obj->purpose = $get_data['purpose'];
        $prop_obj->bedrooms = $get_data['bedrooms'];
        $prop_obj->bathrooms = $get_data['bathrooms'];
        $prop_obj->area = $get_data['area'];
        $prop_obj->furnishing = $get_data['furnishing'];
        $prop_obj->amenities = $get_data['amenities'];
        $prop_obj->price = $get_data['price'];
        $prop_obj->verified = $get_data['verified'];
        
        $featured_image = $request->file('featured_image');        
                 
        if($featured_image){

            $tmpFilePath = public_path('/upload/');

            $hardPath =  $get_data['user_id'].'-'.md5(time());

            $prop_img = Image::make($featured_image);

            $prop_img->save($tmpFilePath.$hardPath.'.jpg');

            $prop_obj->image = 'upload/'.$hardPath.'.jpg';
        }

        $floor_plan_image = $request->file('floor_plan_image');    

        if($floor_plan_image){

            $tmpFilePath = public_path('/upload/');

            $hardPath =  $get_data['user_id'].'-floor_plan-'.md5(time());

            $prop_img = Image::make($floor_plan_image);

            $prop_img->save($tmpFilePath.$hardPath.'.jpg');

            $prop_obj->floor_plan_image = 'upload/'.$hardPath.'.jpg';
        }

        $prop_obj->save();

        $property_id= $post_id; 

        $gallery_files=$request->file('image_gallery');

        if($request->hasFile('image_gallery'))
        {
            foreach($gallery_files as $file) {
                            
                $gallery_obj = new PropertyGallery;
                
                $tmpFilePath = public_path('upload/');           
                
                $hardPath = 'gallery_img_'.rand(0,9999).'.jpg';
                
                $g_img = Image::make($file);

                $g_img->save($tmpFilePath.$hardPath);
                

                $gallery_obj->post_id = $property_id;
                $gallery_obj->image = 'upload/'.$hardPath;
                $gallery_obj->save();
                
            }
        }
  
         
         return \Response::json(array(            
            'status_code' => 200,
            'msg' => trans('words.property_update_success'),
            'success' => 1
        ));
        
    }

    public function user_property_gallery_delete()
    {   
        $get_data=checkSignSalt($_POST['data']);

        $post_id=$get_data['post_id'];

        $data_obj = PropertyGallery::findOrFail($post_id);
        $data_obj->delete();

        return \Response::json(array(            
            'status_code' => 200,
            'msg' => trans('words.delete'),
            'success' => 1
        ));
    }

    public function user_favourite_post_list()
    {   
        
        $get_data=checkSignSalt($_POST['data']);

        $user_id=$get_data['user_id'];

        
        $data_list= Favourite::where('post_type','Property')->where('user_id',$user_id)->orderby('id','DESC')->paginate($this->pagination_limit);

        $total_records= Favourite::where('post_type','Property')->where('user_id',$user_id)->count();

        if($data_list->currentPage() == $data_list->lastPage())
       {
            $load_more=false;  
       }
       else
       {
            $load_more=true;  
       }

        if($total_records > 0)
        {

            foreach($data_list as $obj_data)
            { 
                 
                    $post_id=$obj_data->post_id;

                    $property_info= Property::find($post_id);   

                    $post_title = stripslashes($property_info->title);
                
                    if(isset($property_info->locations->name) AND $property_info->locations->name!="")
                    {
                        $address = $property_info->locations->name;

                    }
                    else
                    {
                        $address = stripslashes($property_info->address);
                    }

                    $purpose = $property_info->purpose;
                    $price = $property_info->price;
                    $post_image = URL::to('/'.$property_info->image);
 
                    $total_views= post_views_count($post_id,"Property");
                    $favourite=check_favourite("Property",$post_id,isset($get_data['user_id'])?$get_data['user_id']:"");

                    $response[]=array("post_id"=>$post_id,"post_title"=>$post_title,"address"=>$address,"purpose"=>$purpose,"price"=>$price,"post_image"=>$post_image,"total_views"=>$total_views,"favourite"=>$favourite);
                 
            }
        }
        else
        {
            $response=array();
        }
 
         return \Response::json(array(            
            'REAL_ESTATE_APP' => $response,
            'total_records' => $total_records,
            'load_more' => $load_more,
            'status_code' => 200,
            'success' => 1
        ));

    }

    
    public function user_reports()
    { 
         
        $get_data=checkSignSalt($_POST['data']);

        $user_id = $get_data['user_id'];
        $post_id = $get_data['post_id'];
        $post_type = $get_data['post_type'];
 
        $message = $get_data['message']; 
         
        $re_obj = new Reports;

        $re_obj->post_type = $post_type;
        $re_obj->post_id = $post_id;
        $re_obj->user_id = $user_id;
        $re_obj->message = $message;
        $re_obj->date = strtotime(date('m/d/Y H:i:s'));
        $re_obj->save();

            
        $response=array();
         
         return \Response::json(array(            
            'REAL_ESTATE_APP' => $response,
            'status_code' => 200,
            'msg' => trans('words.reports_success'),
            'success' => 1
        ));
        
    }
    
    public function check_user_plan()
    {
        $get_data=checkSignSalt($_POST['data']);

        $user_id=$get_data['user_id'];

        $user_info = User::where('id',$user_id)->first();
        $user_plan_id=$user_info->plan_id;
        $user_plan_exp_date=$user_info->exp_date;
        
        $user_total_property = Property::where('user_id',$user_id)->count();

        $plan_property_limit=SubscriptionPlan::getSubscriptionPlanInfo($user_plan_id,'plan_property_limit');

        if($user_total_property >= $plan_property_limit)
        {
            $property_limit_reached=true;
        }
        else
        {
            $property_limit_reached=false;
        }


        if($user_plan_id==0)
        {           
            return \Response::json(array(            
            'status_code' => 200,
            'msg' => trans('words.select_sub_plan'),
            'success' => 0
            ));
        }
        else if(strtotime(date('m/d/Y'))>$user_plan_exp_date)
        {

                $current_plan=SubscriptionPlan::getSubscriptionPlanInfo($user_plan_id,'plan_name');
                
                $expired_on=date('d, M Y',$user_plan_exp_date);
 
                $response = array('current_plan'=>$current_plan,'expired_on'=>$expired_on,'property_limit_reached'=>$property_limit_reached,'user_total_property'=>$user_total_property,'plan_property_limit'=>$plan_property_limit);

                return \Response::json(array(            
                'REAL_ESTATE_APP' => $response,
                'status_code' => 200,
                'msg' => trans('words.renew_sub_plan'),
                'success' => 0                 
                ));
        }
        else
        {
                $current_plan=SubscriptionPlan::getSubscriptionPlanInfo($user_plan_id,'plan_name');
                
                $expired_on=date('d, M Y',$user_plan_exp_date);

                $response = array('current_plan'=>$current_plan,'expired_on'=>$expired_on,'property_limit_reached'=>$property_limit_reached,'user_total_property'=>$user_total_property,'plan_property_limit'=>$plan_property_limit);

                return \Response::json(array(            
                'REAL_ESTATE_APP' => $response,
                'status_code' => 200,
                'msg' => trans('words.my_subscription'),
                'success' => 1
                ));
        }        
        
        
    }

    public function subscription_plan()
    {
        $get_data=checkSignSalt($_POST['data']);

        $plan_list = SubscriptionPlan::where('status','1')->orderby('id')->get(); 


        $settings = Settings::findOrFail('1'); 

        $currency_code=$settings->currency_code;
 
        foreach($plan_list as $plan_data)
        {
                $plan_id= $plan_data->id;
                $plan_name= $plan_data->plan_name;  
                $plan_duration= SubscriptionPlan::getPlanDuration($plan_data->id);
                $plan_price= $plan_data->plan_price; 
                $plan_property_limit= $plan_data->plan_property_limit;                 
                 
                $response[]=array("plan_id"=>$plan_id,"plan_name"=>$plan_name,"plan_duration"=>$plan_duration,"plan_price"=>$plan_price,"plan_property_limit"=>$plan_property_limit,"currency_code"=>$currency_code);   
        }    

        return \Response::json(array(            
            'REAL_ESTATE_APP' => $response,
            'status_code' => 200,
            'success' => 1
        ));
    }

     
    public function transaction_add()
    {
        $get_data=checkSignSalt($_POST['data']);

        $plan_id=$get_data['plan_id'];
        $user_id=$get_data['user_id'];
        $payment_id=$get_data['payment_id'];
        $payment_gateway=$get_data['payment_gateway'];

        $plan_info = SubscriptionPlan::where('id',$plan_id)->where('status','1')->first();
        $plan_name=$plan_info->plan_name;
        $plan_days=$plan_info->plan_days;
        $plan_amount=$plan_info->plan_price;

        //User info update        
           
        $user = User::findOrFail($user_id);

        $user_email=$user->email;

        $user->plan_id = $plan_id;                    
        $user->start_date = strtotime(date('m/d/Y'));             
        $user->exp_date = strtotime(date('m/d/Y', strtotime("+$plan_days days")));
                   
        $user->plan_amount = $plan_amount;         
        $user->save();

        //Check duplicate
        $trans_info = Transactions::where('user_id',$user_id)->where('payment_id',$payment_id)->first();

        if($trans_info=="")
        {
            //Transactions info update
            $payment_trans = new Transactions;

            $payment_trans->user_id = $user_id;
            $payment_trans->email = $user_email;
            $payment_trans->plan_id = $plan_id;
            $payment_trans->gateway = $payment_gateway;
            $payment_trans->payment_amount = $plan_amount;
            $payment_trans->payment_id = $payment_id;
            $payment_trans->date = strtotime(date('m/d/Y H:i:s'));                    
            $payment_trans->save();
        }

        $response = array();
        
        return \Response::json(array(            
            'REAL_ESTATE_APP' => $response,
            'status_code' => 200,
            'msg' => trans('words.payment_success'),
            'success' => 1
        ));
    }


    public function stripe_token_get()
    {

        $get_data=checkSignSalt($_POST['data']);

        $amount=$get_data['amount'];

 
        \Stripe\Stripe::setApiKey(getPaymentGatewayInfo(2,'stripe_secret_key'));


        $customer = \Stripe\Customer::create();
        $ephemeralKey = \Stripe\EphemeralKey::create(
            ['customer' => $customer->id],
            ['stripe_version' => '2020-08-27']
          );

        $currency_code=getcong('currency_code')?getcong('currency_code'):'USD';

        $intent = \Stripe\PaymentIntent::create([
                'amount' => $amount * 100,
                'currency' => $currency_code,
            ]);

        if (!isset($intent->client_secret))
        {   
            $msg = "The Stripe Token was not generated correctly";
            $success = 0;             
        }
        else
        {
            $id = $intent->id;

            $client_secret = $intent->client_secret;
            $ephemeralKey = $ephemeralKey->secret;
            $customer_id = $customer->id;

            $response=array("id"=>$id,"stripe_payment_token"=>$client_secret,'ephemeralKey' =>$ephemeralKey,"customer" => $customer_id);

            $msg = "Stripe Token";
            $success = 1;   
        }   
        

          return \Response::json(array(            
            'REAL_ESTATE_APP' => $response,
            'status_code' => 200,
            'msg' => $msg,
            'success' => $success
        ));  
    }

    public function get_braintree_token()
    {


        require_once(base_path() . '/public/paypal_braintree/lib/Braintree.php');

        $mode=getPaymentGatewayInfo(1,'mode');
        
        if($mode=="sandbox")
        {
            $environment='sandbox';
        }
        else
        {
            $environment='production';
        }


        $merchantId=getPaymentGatewayInfo(1,'braintree_merchant_id');
        $publicKey=getPaymentGatewayInfo(1,'braintree_public_key');
        $privateKey=getPaymentGatewayInfo(1,'braintree_private_key');
 

        $gateway = new \Braintree\Gateway([
                        'environment' => $environment,
                        'merchantId' => $merchantId,
                        'publicKey' => $publicKey,
                        'privateKey' => $privateKey
                        ]);


        $clientToken = $gateway->clientToken()->generate();

        $response = array('client_token' => $clientToken);

           return \Response::json(array(            
            'REAL_ESTATE_APP' => $response,
            'status_code' => 200,
            'msg' => 'Token created',
            'success' => 1
             ));

    }  

    public function braintree_checkout()
    {

        $get_data=checkSignSalt($_POST['data']); 
         
        require_once(base_path() . '/public/paypal_braintree/lib/Braintree.php');

        $mode=getPaymentGatewayInfo(1,'mode');
        
        if($mode=="sandbox")
        {
            $environment='sandbox';
        }
        else
        {
            $environment='production';
        }
 

        $merchantId=getPaymentGatewayInfo(1,'braintree_merchant_id');
        $publicKey=getPaymentGatewayInfo(1,'braintree_public_key');
        $privateKey=getPaymentGatewayInfo(1,'braintree_private_key');
        $merchantAccountId=getPaymentGatewayInfo(1,'braintree_merchant_account_id');

        $gateway = new \Braintree\Gateway([
                        'environment' => $environment,
                        'merchantId' => $merchantId,
                        'publicKey' => $publicKey,
                        'privateKey' => $privateKey
                        ]);

        $payment_amount=$get_data['payment_amount'];
        $payment_nonce=$get_data['payment_nonce'];
 

        $result = $gateway->transaction()->sale([
          'amount' => $payment_amount,
          'paymentMethodNonce' => $payment_nonce,
          'merchantAccountId' => $merchantAccountId,
          'options' => [
            'submitForSettlement' => True
          ]
        ]);
      

        if ($result->success) {

            $paypal_payment_id = $result->transaction->paypal['paymentId'];

            $transaction_id= $result->transaction->id;

            $response = array('transaction_id' => $transaction_id,'paypal_payment_id' => $paypal_payment_id,'msg' => 'Transaction successful','success'=>'1');

            $msg= "Transaction successful";
            $success=1;

        }
        else
        {
            $response = array();

            $msg= "Transaction failed";
            $success=0;
        }

           return \Response::json(array(            
            'REAL_ESTATE_APP' => $response,
            'status_code' => 200,
            'msg' => $msg,
            'success' => $success
             ));

    }

    public function razorpay_order_id_get()
    {

        $get_data=checkSignSalt($_POST['data']);

        $user_id=$get_data["user_id"];
        $amount=$get_data['amount']; 

        $razor_key=getPaymentGatewayInfo(3,'razorpay_key');
        $razor_secret=getPaymentGatewayInfo(3,'razorpay_secret');

        $api = new Api($razor_key, $razor_secret);

        $order = $api->order->create(array('receipt' => 'rcptid_'.$user_id, 'amount' => $amount, 'currency' => 'INR'));

        $orderId = $order['id'];

        $msg= "Order ID created";
        $success=1;
         
        $response=array("order_id"=>$orderId);
         
          return \Response::json(array(            
            'REAL_ESTATE_APP' => $response,
            'status_code' => 200,
            'msg' => $msg,
            'success' => $success
        ));  
    }
    
    public function payumoney_hash_generator()
    {
        
        $get_data=checkSignSalt($_POST['data']); 

        $hashdata=$get_data["hashdata"];
        $salt=getPaymentGatewayInfo(6,'payu_salt');
         
        /***************** DO NOT EDIT ***********************/
        $payhash_str = $hashdata.$salt;

        
        $hash = strtolower(hash('sha512', $payhash_str));
        /***************** DO NOT EDIT ***********************/

        $msg= "Hash created";
        $success=1;

        $response=array("payu_hash"=>$hash);
         
          return \Response::json(array(            
            'REAL_ESTATE_APP' => $response,
            'status_code' => 200,
            'msg' => $msg,
            'success' => $success
        ));
         
    }
}
