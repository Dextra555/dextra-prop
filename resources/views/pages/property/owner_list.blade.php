@extends('site_app')

@section('head_title', get_user_info($owner_id,'name').' - '.trans('words.property_text').' - '.getcong('site_name') )

@section('head_url', Request::url())

@section('content')

<script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "ItemList",
        "name": "{{get_user_info($owner_id,'name')}} - {{trans('words.property_text')}}",
        "description": "",
        "itemListElement": [
          @php $i = 1; @endphp 
          @foreach($property_list as $property_data)            
            @php
              $separator = ',';
              if($i == count($property_list)){
                $separator = '';
                }
            $i++;
          @endphp

              {
                  "@type": "ListItem",                  
                  "name": "{{stripslashes($property_data->title)}}",
                  "image": "{{\URL::to('/'.$property_data->image)}}",
                  "position": "{{$i}}",                  
                  "url": "{{ URL::to('properties/'.$property_data->slug.'/'.$property_data->id) }}",
                  "telephone": "",
                  "priceCurrency": "{{getcong('currency_code')}}",
                  "price": "{{$property_data->price}}",
                  "address": {
                    "@type": "PostalAddress",
                    "streetAddress": "{{stripslashes($property_data->address)}}",
                    "addressLocality": "{{isset($property_data->locations->name)?$property_data->locations->name:''}}",
                    "postalCode": "",
                    "addressCountry": ""
                  }  
                   
            }{{$separator}}
 
            @endforeach                 
        ]
    }
    </script>
   
<!--Breadcrumb section starts-->
<div class="breadcrumb-section bg-xs" style="background-image: url({{ URL::asset('site_assets/images/breadcrumb-1.jpg') }})">
    <div class="overlay op-2"></div>
    <div class="container">
      <div class="row">
        <div class="col-md-8 offset-md-2 text-center">
          <div class="breadcrumb-menu">
            <h2>{{get_user_info($owner_id,'name')}} - {{trans('words.property_text')}} </h2>
            <span><a href="{{ URL::to('/') }}" title="{{trans('words.home')}}">{{trans('words.home')}}</a></span> <span>{{get_user_info($owner_id,'name')}} - {{trans('words.property_text')}}</span> 
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

  <!-- Agent section starts -->
  <div class="agent-section pt-30 pb-20">
    <div class="container">
      <div class="row">
        <div class="col-xl-8 order-xl-12 order-xl-2 order-2">
          <div class="vfx-agent-details-wrapper">
            <div class="row mb-50">
              <div class="col-lg-4 col-md-6 col-sm-5"> 
              @if(file_exists(URL::to('upload/'.get_user_info($owner_id,'user_image'))))
                <img src="{{\URL::to('upload/'.get_user_info($owner_id,'user_image'))}}" alt="user" title="user" class="img-responsive"> 
              @else
              <img src="{{\URL::to('site_assets/images/user-default.jpg')}}" alt="user" title="user" class="img-responsive">
              @endif 
                 
              </div>
              <div class="col-lg-8 col-md-6 col-sm-7">
                <div class="vfx-agent-details">
                  <h3>{{get_user_info($owner_id,'name')}}</h3>
                  <ul class="vfx-address-list">                    
                    <li><span>Phone: </span> {{get_user_info($owner_id,'phone')}}</li>
                    <li><span>Email: </span> {{get_user_info($owner_id,'email')}}</li>
                     
                  </ul>
                   
                </div>
              </div>
            </div>
            <div class="row">
              
              <div class="col-md-12">
                <h3>{{trans('words.property_text')}}</h3>
                <div class="agent-listings">

                <div class="tab-pane fade show active property-grid" id="grid-view">
                  <div class="row">

                  
                  @foreach($property_list as $property_data)
                  <div class="col-md-6 col-sm-12">
                      <div class="vfx-single-property-box-area">
                        <div class="vfx-property-item"> <a class="vfx-property-img" href="{{ URL::to('properties/'.$property_data->slug.'/'.$property_data->id) }}" title="{{stripslashes($property_data->title)}}"><img src="{{\URL::to('/'.$property_data->image)}}" alt="#" title="{{stripslashes($property_data->title)}}"> </a>
                          <ul class="vfx-feature-text">
                          @if($property_data->purpose=='Rent')
                          <li class="feature_cb"><span>{{trans('words.rent')}}</span></li>
                          @else
                          <li class="feature_or"><span>{{trans('words.sale')}}</span></li>
                          @endif	 
                          @if($property_data->verified=='YES')
                          <li class="feature_cb verified_item"><i class="fa fa-check 1" data-toggle="tooltip" data-placement="top" title="" data-original-title="{{trans('words.verified')}}"></i></li>
                          @endif
                          </ul>
                          <div class="vfx-property-author-wrap"> 
                          <p class="text-tlt">{{ $property_data->types->type_name }}</p>
                          <ul class="vfx-save-btn">

                          @if(check_favourite("Property",$property_data->id,isset(Auth::user()->id)?Auth::user()->id:"")) 
                            <li data-toggle="tooltip" data-placement="top" title="" data-original-title="Favourite" class="favourite_property favourite_title_id{{$property_data->id}}" data-id="{{$property_data->id}}">
                              
                              <a href="Javascript:void(0);" title="fav"><i class="fa fa-heart favourite_icon_id{{$property_data->id}}"></i></a>
                              
                            </li>
                          @else
                            <li data-toggle="tooltip" data-placement="top" title="" data-original-title="Set Favourite" class="favourite_property favourite_title_id{{$property_data->id}}" data-id="{{$property_data->id}}">
                               
                              <a href="Javascript:void(0);" title="fav"><i class="fa fa-heart-o favourite_icon_id{{$property_data->id}}"></i></a>
                               
                            </li>                          
                          @endif
                          </ul>
                        </div>
                        </div>
                        <div class="vfx-property-title-box-area">
                          <h4><a href="{{ URL::to('properties/'.$property_data->slug.'/'.$property_data->id) }}" title="{{stripslashes($property_data->title)}}">{{Str::limit(stripslashes($property_data->title),30)}}</a></h4>
                          <div class="vfx-property-location"> <i class="fa fa-map-marker"></i>
                            <p>
                            @if(isset($property_data->locations->name) AND $property_data->locations->name!="")
                              {{$property_data->locations->name}}
                            @else
                              {{Str::limit(stripslashes($property_data->address),40)}}
                            @endif
                            </p>
                          </div>
                          <div class="trending-bottom">
                            <div class="trend-left float-left">
                              <div class="vfx-property-author-wrap"> <a href="{{ URL::to('properties/owner/'.$property_data->user_id) }}" class="property-author" title="{{stripslashes($property_data->title)}}"> 
                                  
                              @if($property_data->users->user_image)
                                <img src="{{\URL::to('upload/'.$property_data->users->user_image)}}" alt="user_image" title="{{stripslashes($property_data->title)}}"> 
                              @else
                              <img src="{{\URL::to('site_assets/images/user-default.jpg')}}" alt="user_image" title="{{stripslashes($property_data->title)}}">
                              @endif

                              <span>{{ $property_data->users->name }}</span> </a></div>
                            </div>
                            <a href="{{ URL::to('properties/'.$property_data->slug.'/'.$property_data->id) }}" class="vfx-trend-right float-right">
                              <div class="vfx-trend-open-price">{{html_entity_decode(getCurrencySymbols(getcong('currency_code')))}}{{number_format($property_data->price)}}</div>
                            </a> 
                            </div>
                        </div>
                      </div>
                    </div>
                    @endforeach

                     
                    
                  </div>
                </div>

                <!--pagination starts-->
                <div class="post-nav nav-res pt-20">
                  <div class="row">
                  
                      @include('_particles.pagination', ['paginator' => $property_list]) 

                  </div>
                </div>
                <!--pagination ends-->

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


        @include("pages.sidebar_right")

         
      </div>
    </div>
  </div>
  <!-- Agent section ends --> 
  
  <!-- Scroll to top starts--> 
  <span class="vfx-scroll-top-btn"><i class="lnr lnr-arrow-up"></i></span> 
  <!-- Scroll to top ends--> 
</div>
<!--Page Wrapper ends--> 
   
 
@endsection