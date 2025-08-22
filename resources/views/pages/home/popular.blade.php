@extends('site_app')

@section('head_title', trans('words.trending_now').' - '. getcong('site_name') )

@section('head_url', Request::url())

@section('content')
   
<!--Breadcrumb section starts-->
<div class="breadcrumb-section bg-xs" style="background-image: url({{ URL::asset('site_assets/images/breadcrumb-1.jpg') }})">
    <div class="overlay op-2"></div>
    <div class="container">
      <div class="row">
        <div class="col-md-8 offset-md-2 text-center">
          <div class="breadcrumb-menu">
            <h2>{{trans('words.trending_now')}} </h2>
            <span><a href="{{URL::to('/')}}" title="{{trans('words.home')}}">{{trans('words.home')}}</a></span> <span>{{trans('words.trending_now')}}</span> 
		      </div>
        </div>
      </div>
    </div>
  </div>
  <!--Breadcrumb section ends--> 

 <!-- Add banner Section -->
 @if(get_web_banner('list_top')!="")      
      <div class="add_banner_section pb-0">
        <div class="container">
          <div class="row">
              <div class="col-md-12">
              {!!stripslashes(get_web_banner('list_top'))!!}
            </div>
          </div>  
        </div>
      </div>
  @endif   
  <!-- Add banner Section -->

 <!--Listing Filter starts-->
 <div class="filter-wrapper style1 pt-30 pb-30">
    <div class="container">
      <div class="row">
        
        <div class="col-md-12">
          <div class="sidebar-content-right">
             
            <div class="item-wrapper pt-20">
              <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active property-grid" id="grid-view">
                  <div class="row">

                  
                  @foreach($property_list as $property_data)

                  @php 
                     $property_info= \App\Property::find($property_data->post_id);                 
                  @endphp

                  <div class="col-xl-4 col-md-6 col-sm-12">
                      <div class="vfx-single-property-box-area">
                        <div class="vfx-property-item"> <a class="vfx-property-img" href="{{ URL::to('properties/'.$property_info->slug.'/'.$property_info->id) }}" title="{{stripslashes($property_info->title)}}"><img src="{{\URL::to('/'.$property_info->image)}}" alt="#" title="{{stripslashes($property_info->title)}}"> </a>
                          <ul class="vfx-feature-text">
                          @if($property_info->purpose=='Rent')
                          <li class="feature_cb"><span>{{trans('words.rent')}}</span></li>
                          @else
                          <li class="feature_or"><span>{{trans('words.sale')}}</span></li>
                          @endif
                          @if($property_info->verified=='YES')
                          <li class="feature_cb verified_item"><i class="fa fa-check 1" data-toggle="tooltip" data-placement="top" title="" data-original-title="{{trans('words.verified')}}"></i></li>
                          @endif	 
                          </ul>
                          <div class="vfx-property-author-wrap"> 
                          <p class="text-tlt">{{ $property_info->types->type_name }}</p>
                          <ul class="vfx-save-btn">

                          @if(check_favourite("Property",$property_info->id,isset(Auth::user()->id)?Auth::user()->id:"")) 
                            <li data-toggle="tooltip" data-placement="top" title="" data-original-title="Favourite" class="favourite_property favourite_title_id{{$property_info->id}}" data-id="{{$property_info->id}}">
                              
                              <a href="Javascript:void(0);" title="fav"><i class="fa fa-heart favourite_icon_id{{$property_info->id}}"></i></a>
                              
                            </li>
                          @else
                            <li data-toggle="tooltip" data-placement="top" title="" data-original-title="Set Favourite" class="favourite_property favourite_title_id{{$property_info->id}}" data-id="{{$property_info->id}}">
                               
                              <a href="Javascript:void(0);" title="fav"><i class="fa fa-heart-o favourite_icon_id{{$property_info->id}}"></i></a>
                               
                            </li>                          
                          @endif
                          </ul>
                        </div>
                        </div>
                        <div class="vfx-property-title-box-area">
                          <h4><a href="{{ URL::to('properties/'.$property_info->slug.'/'.$property_info->id) }}" title="{{stripslashes($property_info->title)}}">{{Str::limit(stripslashes($property_info->title),30)}}</a></h4>
                          <div class="vfx-property-location"> <i class="fa fa-map-marker"></i>
                            <p>
                            @if(isset($property_info->locations->name) AND $property_info->locations->name!="")
                              {{$property_info->locations->name}}
                            @else
                            {{Str::limit(stripslashes($property_info->address),40)}}
                            @endif
                            </p>
                          </div>
                          <div class="trending-bottom">
                            <div class="trend-left float-left">
                              <div class="vfx-property-author-wrap"> <a href="{{ URL::to('properties/owner/'.$property_info->user_id) }}" class="property-author" title="{{stripslashes($property_info->title)}}"> 
                                
                              @if($property_info->users->user_image)
                                <img src="{{\URL::to('upload/'.$property_info->users->user_image)}}" alt="user_image" title="{{stripslashes($property_info->title)}}"> 
                              @else
                              <img src="{{\URL::to('site_assets/images/user-default.jpg')}}" alt="user_image" title="{{stripslashes($property_info->title)}}">
                              @endif

                              <span>{{ $property_info->users->name }}</span> </a></div>
                            </div>
                            <a href="{{ URL::to('properties/'.$property_info->slug.'/'.$property_info->id) }}" class="vfx-trend-right float-right">
                              <div class="vfx-trend-open-price">{{html_entity_decode(getCurrencySymbols(getcong('currency_code')))}}{{number_format($property_info->price)}}</div>
                            </a> 
                            </div>
                        </div>
                      </div>
                    </div>
                    @endforeach
                     
                    
                  </div>
                </div>

                @if(get_web_banner('list_bottom')!="")      
                    <div class="add_banner_section pb-0">
                      <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                            {!!stripslashes(get_web_banner('list_bottom'))!!}
                          </div>
                        </div>  
                      </div>
                    </div>
                @endif
                 
				 
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--Listing Filter ends--> 
   
 
@endsection