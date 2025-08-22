@extends('site_app')

@section('head_title', trans('words.pricing').' - '.getcong('site_name') )

@section('head_url', Request::url())

@section('content')
   
<!--Breadcrumb section starts-->
<div class="breadcrumb-section bg-xs" style="background-image: url({{ URL::asset('site_assets/images/breadcrumb-1.jpg') }})">
    <div class="overlay op-2"></div>
    <div class="container">
      <div class="row">
        <div class="col-md-8 offset-md-2 text-center">
          <div class="breadcrumb-menu">
            <h2>{{trans('words.pricing')}} </h2>
            <span><a href="{{ URL::to('/') }}" title="{{trans('words.home')}}">{{trans('words.home')}}</a></span> <span>{{trans('words.pricing')}}</span> 
		      </div>
        </div>
      </div>
    </div>
  </div>
  <!--Breadcrumb section ends--> 

    <!-- Add banner Section -->
    @if(get_web_banner('other_page_top')!="")      
      <div class="add_banner_section pb-0">
        <div class="container">
          <div class="row">
              <div class="col-md-12">
              {!!stripslashes(get_web_banner('other_page_top'))!!}
            </div>
          </div>  
        </div>
      </div>
  @endif   
  <!-- Add banner Section -->

   <!--Subscription Plan starts-->
   <div class="about-section pt-30 pb-10">
    <div class="container">
      <div class="row">
      
      @foreach($plan_list as $plan_data)  
          <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
            <div class="membership-plan-list">
            <h3>{{$plan_data->plan_name}}</h3>
            <h1><span>{{html_entity_decode(getCurrencySymbols(getcong('currency_code')))}}</span>{{$plan_data->plan_price}}</h1>
            <ul>
              
              <li>{{trans('words.validity')}}: <span>{{ App\SubscriptionPlan::getPlanDuration($plan_data->id) }}</span></li>
              <li>{{trans('words.property_limit')}} : <span>{{ $plan_data->plan_property_limit }}</span></li>
            </ul>
            <a href="{{ URL::to('payment_method/'.$plan_data->id) }}" class="btn vfx7 mb-15" title="{{trans('words.select_plan')}}">{{trans('words.select_plan')}}</a>
          </div>
          </div>
      @endforeach

		  
     </div>

      <!-- Add banner Section -->
    @if(get_web_banner('other_page_bottom')!="")      
      <div class="add_banner_section pb-15">
        <div class="container">
          <div class="row">
              <div class="col-md-12">
              {!!stripslashes(get_web_banner('other_page_bottom'))!!}
            </div>
          </div>  
        </div>
      </div>
  @endif   
  <!-- Add banner Section -->

    </div>
  </div>
  <!--Subscription Plan ends--> 

  <script type="text/javascript">
    
  @if(Session::has('error_flash_message'))     
 
      const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: false,        
      })

      Toast.fire({
        icon: 'error',
        title: '{{ Session::get('error_flash_message') }}'
      })     
     
  @endif
 
  </script>

  @endsection