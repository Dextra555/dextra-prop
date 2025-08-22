@extends('site_app')

@section('head_title', getcong('site_name') )

@section('head_url', Request::url())

@section('content')
  
  @include("pages.home.slider")

  
  <!-- Add banner Section -->
  @if(get_web_banner('home_top')!="")      
      <div class="add_banner_section pb-0 mb-20">
        <div class="container">
          <div class="row">
              <div class="col-md-12">
              {!!stripslashes(get_web_banner('home_top'))!!}
            </div>
          </div>  
        </div>
      </div>
  @endif
  <!-- Add banner Section -->
  
  <!--Category section starts-->
  <div class="vfx-team-section-area bg-cb-gra pb-20 pt-20">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="section-title vid-item-section mb-15">
            <h2>{{trans('words.property_type')}}</h2>
			<span class="view-more">
			   <a href="{{ URL::to('types') }}" title="types">{{trans('words.view_all')}}<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 512 512" style="vertical-align: text-top"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="60" d="m184 112l144 144l-144 144"></path></svg></a>
		    </span>
          </div>
        </div>
        <div class="col-md-12">
          <div class="vfx-team-wrapper swiper-container">
            <div class="swiper-wrapper">
              @foreach($type_list as $type_data)
              <div class="swiper-slide">
                <div class="vfx-single-team-member vfx-cat-item vfx2"> <a href="{{ URL::to('types/'.$type_data->type_slug.'/'.$type_data->id) }}" title="{{$type_data->type_name}}"><img src="{{URL::to('/'.$type_data->type_image)}}" alt="{{$type_data->type_name}}" title="{{$type_data->type_name}}"></a>
                  <div class="vfx-single-team-info">
                    <h4><a href="{{ URL::to('types/'.$type_data->type_slug.'/'.$type_data->id) }}" title="{{$type_data->type_name}}">{{$type_data->type_name}}</a></h4>
                  </div>
                </div>
              </div>
              @endforeach
			   
            </div>
            <div class="slider-btn vfx2 team_next"><i class="lnr lnr-arrow-right"></i></div>
            <div class="slider-btn vfx2 team_prev"><i class="lnr lnr-arrow-left"></i></div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--Category section starts-->

    <!--Latest Property Starts-->
    <div class="vfx-trending-places bg-cb pb-30 pt-20">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="section-title vid-item-section mb-15">
            <h2>{{trans('words.latest_property')}}</h2>
			  <span class="view-more">
			   <a href="{{ URL::to('latest') }}" title="view all">{{trans('words.view_all')}}<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 512 512" style="vertical-align: text-top"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="60" d="m184 112l144 144l-144 144"></path></svg></a>
		    </span>
          </div>
        </div>
        <div class="swiper-container vfx-latest-property-wrap">
          <div class="swiper-wrapper">

          @foreach($latest_list as $latest_data)
            <div class="swiper-slide">
              <div class="vfx-single-property-box-area">
                <div class="vfx-property-item"> <a class="vfx-property-img" href="{{ URL::to('properties/'.$latest_data->slug.'/'.$latest_data->id) }}" title="{{stripslashes($latest_data->title)}}"><img src="{{\URL::to('/'.$latest_data->image)}}" alt="image" title="image"> </a>
                  <ul class="vfx-feature-text">
                    @if($latest_data->purpose=='Rent')
                    <li class="feature_cb"><span>{{trans('words.rent')}}</span></li>
                    @else
                    <li class="feature_or"><span>{{trans('words.sale')}}</span></li>
                    @endif
                    @if($latest_data->verified=='YES')
                    <li class="feature_cb verified_item"><i class="fa fa-check 1" data-toggle="tooltip" data-placement="top" title="" data-original-title="{{trans('words.verified')}}"></i></li>
                    @endif	
                  </ul>
                  <div class="vfx-property-author-wrap"> 
                    <p class="text-tlt">{{ $latest_data->types->type_name }}</p>
                    <ul class="vfx-save-btn">
                       
                        <li data-toggle="tooltip" data-placement="top" title="" data-original-title="Set Favourite" class="favourite_property favourite_title_id{{$latest_data->id}}" data-id="{{$latest_data->id}}">
                            @if(check_favourite("Property",$latest_data->id,isset(Auth::user()->id)?Auth::user()->id:""))
                            <a href="Javascript:void(0);" title="fav"><i class="fa fa-heart favourite_icon_id{{$latest_data->id}}"></i></a>
                            @else
                            <a href="Javascript:void(0);" title="fav"><i class="fa fa-heart-o favourite_icon_id{{$latest_data->id}}"></i></a>
                            @endif
                        </li>
                     
                    </ul>
                  </div>
                </div>
                <div class="vfx-property-title-box-area">
				  <h4><a href="{{ URL::to('properties/'.$latest_data->slug.'/'.$latest_data->id) }}" title="{{stripslashes($latest_data->title)}}">{{Str::limit(stripslashes($latest_data->title),30)}}</a></h4>
                  <div class="vfx-property-location"> <i class="fa fa-map-marker"></i>
                    <p>
                      @if(isset($latest_data->locations->name) AND $latest_data->locations->name!="")
                        {{$latest_data->locations->name}}
                      @else
                        {{Str::limit(stripslashes($latest_data->address),40)}}
                      @endif
                    </p>
                  </div>                
                  <div class="trending-bottom">
                    <div class="trend-left float-left">
                      <div class="vfx-property-author-wrap"> 
                        <a href="{{ URL::to('properties/owner/'.$latest_data->user_id) }}" class="property-author" title="user profile"> 

                          @if($latest_data->users->user_image)
                          <img src="{{\URL::to('upload/'.$latest_data->users->user_image)}}" alt="user_image" title="{{stripslashes($latest_data->title)}}"> 
                          @else
                          <img src="{{\URL::to('site_assets/images/user-default.jpg')}}" alt="user" title="title">
                          @endif

                          <span>{{ $latest_data->users->name }}</span> 
                        </a>
                      </div>
                    </div>
                    <a href="{{ URL::to('properties/'.$latest_data->slug.'/'.$latest_data->id) }}" class="vfx-trend-right float-right" title="{{stripslashes($latest_data->title)}}">
						          <div class="vfx-trend-open-price">{{html_entity_decode(getCurrencySymbols(getcong('currency_code')))}}{{number_format($latest_data->price)}}</div>
                    </a> 
				  </div>
                </div>
              </div>
            </div>
        @endforeach
 
             
          </div>
        </div>
        <div class="vfx-latest-property-pagination"></div>
      </div>
    </div>
  </div>
  <!--Latest Property Ends-->

  @if(count($trending_list) > 0)
  <!--Popular Property Starts-->
  <div class="vfx-trending-places our-story-bg-2 pb-30 mt-20">
    <div class="container">
      <div class="row">
		<div class="col-md-12">
          <div class="section-title vid-item-section mb-15">
            <h2>{{trans('words.trending_now')}}</h2>
			<span class="view-more">
			   <a href="{{ URL::to('popular') }}" title="popular">{{trans('words.view_all')}}<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 512 512" style="vertical-align: text-top"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="60" d="m184 112l144 144l-144 144"></path></svg></a>
		    </span>
          </div>
        </div>
        <div class="swiper-container vfx-popular-property-wrap">
          <div class="swiper-wrapper">

          @foreach($trending_list as $trending_data)
            @php 
                $property_info= \App\Property::find($trending_data->post_id);                 
            @endphp
            <div class="swiper-slide">
              <div class="vfx-single-property-box-area">
                <div class="vfx-property-item"> <a class="vfx-property-img" href="{{ URL::to('properties/'.$property_info->slug.'/'.$property_info->id) }}" title="{{stripslashes($property_info->title)}}"><img src="{{\URL::to('/'.$property_info->image)}}" alt="image" title="image"> </a>
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
                       
                        <li data-toggle="tooltip" data-placement="top" title="" data-original-title="Set Favourite" class="favourite_property favourite_title_id{{$property_info->id}}" data-id="{{$property_info->id}}">
                            @if(check_favourite("Property",$property_info->id,isset(Auth::user()->id)?Auth::user()->id:""))
                            <a href="Javascript:void(0);" title="view"><i class="fa fa-heart favourite_icon_id{{$property_info->id}}"></i></a>
                            @else
                            <a href="Javascript:void(0);" title="view"><i class="fa fa-heart-o favourite_icon_id{{$property_info->id}}"></i></a>
                            @endif
                        </li>

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
                      <div class="vfx-property-author-wrap"> 
                        <a href="{{ URL::to('properties/owner/'.$property_info->user_id) }}" class="property-author"> 

                            @if($property_info->users->user_image)
                              <img src="{{\URL::to('upload/'.$property_info->users->user_image)}}" alt="user_image" title="{{stripslashes($property_info->title)}}"> 
                            @else
                            <img src="{{\URL::to('site_assets/images/user-default.jpg')}}" alt="user_image" title="{{stripslashes($property_info->title)}}">
                            @endif

                          <span>{{ $property_info->users->name }}</span> 
                        </a>
                      </div>
                    </div>
                    <a href="{{ URL::to('properties/'.$property_info->slug.'/'.$property_info->id) }}" class="vfx-trend-right float-right" title="{{stripslashes($property_info->title)}}">
						          <div class="vfx-trend-open-price">{{html_entity_decode(getCurrencySymbols(getcong('currency_code')))}}{{number_format($property_info->price)}}</div>
                    </a> 
				  </div>
                </div>
              </div>
            </div>
        @endforeach
             
            
          </div>
        </div>
        <div class="vfx-popular-property-pagination"></div>
      </div>
    </div>
  </div>
  <!--Popular Property Ends--> 
  @endif
   
  <!-- Add banner Section -->
  @if(get_web_banner('home_bottom')!="")      
      <div class="add_banner_section pt-0">
        <div class="container">
          <div class="row">
              <div class="col-md-12">
              {!!stripslashes(get_web_banner('home_bottom'))!!}
            </div>
          </div>  
        </div>
      </div>
  @endif
 
  <span class="vfx-scroll-top-btn"><i class="lnr lnr-arrow-up"></i></span> 


<!--Page Wrapper ends--> 
@endsection