@extends('site_app')

@section('head_title', trans('words.dashboard_text').' | '.getcong('site_name') )

@section('head_url', Request::url())

@section('content')
  

<!--Breadcrumb section starts-->
<div class="breadcrumb-section bg-xs" style="background-image: url({{ URL::asset('site_assets/images/breadcrumb-1.jpg') }})">
    <div class="overlay op-2"></div>
    <div class="container">
      <div class="row">
        <div class="col-md-12 text-center">
          <div class="breadcrumb-menu">
            <h2>{{trans('words.dashboard_text')}}</h2>
            <span><a href="{{ URL::to('/') }}">{{trans('words.home')}}</a></span> <span>{{trans('words.dashboard_text')}}</span></div>
        </div>
      </div>
    </div>
  </div>
  <!--Breadcrumb section ends--> 
  
  <!--Dashboard section starts-->
  <div class="about-section pt-30 pb-20">
    <div class="container">
      <div class="row">
         <div class="col-lg-12 col-md-12">
			  <div class="vfx-statistic-wrap-area">
				<div class="row">
					<div class="col-xl-3 col-md-6 col-12">
						<a href="{{ URL::to('user/property') }}">
						<div class="vfx-statistic-item vfx-item-blue-violet">
							<div class="icon">
								<i class="fa fa-home"></i>
							</div>
							<h2 class="counter-value">{{$property_total}}</h2>
							<span class="desc">{{trans('words.total_properties')}}</span>                                
						</div>
						</a>
					</div>
					<div class="col-xl-3 col-md-6 col-12">
						<a href="{{ URL::to('user/property') }}">
						<div class="vfx-statistic-item vfx-item-green">
							<div class="icon">
								<i class="fa fa-home"></i>
							</div>
							<h2 class="counter-value">{{$property_active}}</h2>
							<span class="desc">{{trans('words.active_properties')}}</span>                                
						</div>
						</a>
					</div>
					<div class="col-xl-3 col-md-6 col-12">
						<a href="{{ URL::to('user/property') }}">
						<div class="vfx-statistic-item vfx-item-orange">
							<div class="icon">
								<i class="fa fa-home"></i>
							</div>
							<h2 class="counter-value">{{$property_pending}}</h2>
							<span class="desc">{{trans('words.pending_properties')}}</span>                                
						</div>
						</a>
					</div>
					<div class="col-xl-3 col-md-6 col-12">
						<a href="{{ URL::to('user/favourites') }}">
						<div class="vfx-statistic-item vfx-item-blue">
							<div class="icon">
								<i class="fa fa-heart"></i>
							</div>
							<h2 class="counter-value">{{$favourite_total}}</h2>
							<span class="desc">{{trans('words.favourites')}}</span>                                
						</div>
						</a>
					</div>
				</div>
			</div>
		
			<div class="vfx-dashboard-content-area">
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					   <div class="profile-section">
						 <div class="row">
							<div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
							  <div class="member-ship-option">
							  <h5 class="color-up">{{trans('words.my_subscription')}}</h5>
							  @if($user->plan_id!=0)
								<span class="premuim-memplan-bold-text"><strong>{{trans('words.current_plan')}}:</strong><span>{{\App\SubscriptionPlan::getSubscriptionPlanInfo($user->plan_id,'plan_name')}}</span></span>

								<span class="premuim-memplan-bold-text"><strong>{{trans('words.property_limit')}}:</strong><span>{{\App\SubscriptionPlan::getSubscriptionPlanInfo($user->plan_id,'plan_property_limit')}}</span></span>				

								@if($user->exp_date)
								<span class="premuim-memplan-bold-text"><strong>{{trans('words.subscription_expires_on')}}:</strong><span>{{date('F,  d, Y',$user->exp_date)}}</span></span>
								@endif
 
								<a href="{{ URL::to('pricing') }}" class="btn vfx7 mt-2 mb-0 upgrad_plan">{{trans('words.upgrade_plan')}}</a>

								@else
								<a href="{{ URL::to('pricing') }}" class="btn vfx7 mt-2 mb-0 upgrad_plan">{{trans('words.select_plan')}}</a>	
								 
								@endif
 

							  </div>
							</div>
							<div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
							   <div class="member-ship-option">
								  <h5 class="color-up">{{trans('words.last_invoice')}}</h5>
								  <span class="premuim-memplan-bold-text"><strong>{{trans('words.date')}}:</strong>
								  	@if($user->start_date)
									<span>{{date('F,  d, Y',$user->start_date)}}</span>
									@endif
								  </span>
								  <span class="premuim-memplan-bold-text"><strong>{{trans('words.plan')}}:</strong>
								  	@if($user->plan_id)
									<span>{{\App\SubscriptionPlan::getSubscriptionPlanInfo($user->plan_id,'plan_name')}}</span>
									@endif
								  </span>
								  <span class="premuim-memplan-bold-text"><strong>{{trans('words.amount')}}:</strong>
								  	@if($user->plan_amount)
									<span>{{number_format($user->plan_amount,2,'.', '') }}</span>
									@endif
								  </span> 
							   </div>
							</div>
						  </div>
					   </div>
					</div>
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<div class="vfx-popular-listing">
							<div class="vfx-act-title mb-15">
								<h5>{{trans('words.user_plan_history')}}</h5>
							</div>
							<div class="table-wrapper">
							  <table class="fl-table">
								<thead>
								  <tr>            
									<th>{{trans('words.plan')}}</th>
									<th>{{trans('words.amount')}}</th>
									<th>{{trans('words.payment_gateway')}}</th>
									<th>{{trans('words.payment_id')}}</th>
									<th>{{trans('words.payment_date')}}</th>
								  </tr>
								</thead> 
								<tbody>
									@foreach($transactions_list as $transaction_data)
									<tr>                      
										<td><span class="current-plan-item">{{\App\SubscriptionPlan::getSubscriptionPlanInfo($transaction_data->plan_id,'plan_name')}}</span></td>
										<td>{{html_entity_decode(getCurrencySymbols(getcong('currency_code')))}} {{ number_format($transaction_data->payment_amount,2) }}</td>
										<td>{{ $transaction_data->gateway }}</td>
										<td>{{ $transaction_data->payment_id }}</td>    
										<td><span class="expires-plan-item">{{ date('M d Y h:i A',$transaction_data->date) }}</span></td>            
								  	</tr>
									@endforeach
						 
								</tbody>
							  </table>

							  <!--pagination starts-->
							<div class="post-nav nav-res pt-20">
								<div class="row">
								
								@include('_particles.pagination', ['paginator' => $transactions_list])	 

								</div>
							</div>
							<!--pagination ends-->

							  						

							</div>
						</div>
					</div>
				</div>
			</div>
        </div>
      </div>
    </div>
  </div>
  <!--Dashboard section ends--> 

  <script type="text/javascript">

	'use strict';
    
    @if(Session::has('flash_message'))     
 
      const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: false,        
      })

      Toast.fire({
        icon: 'success',
        title: '{{ Session::get('flash_message') }}'
      })     
     
  @endif

  @if(Session::has('success'))     
 
      const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: false,       
      })

      Toast.fire({
        icon: 'success',
        title: '{{ Session::get('success') }}'
      })     
     
  @endif

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