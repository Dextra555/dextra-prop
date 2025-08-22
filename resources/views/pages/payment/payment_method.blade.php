@extends('site_app')

@section('head_title', trans('words.payment_method').' - '.getcong('site_name') )

@section('head_url', Request::url())

@section('content')
 

<div id="loading" style="display: none;"></div>
   
<!--Breadcrumb section starts-->
<div class="breadcrumb-section bg-xs" style="background-image: url({{ URL::asset('site_assets/images/breadcrumb-1.jpg') }})">
    <div class="overlay op-2"></div>
    <div class="container">
      <div class="row">
        <div class="col-md-8 offset-md-2 text-center">
          <div class="breadcrumb-menu">
            <h2>{{trans('words.payment_method')}} </h2>
            <span><a href="{{ URL::to('/') }}">Home</a></span> <span>{{trans('words.payment_method')}}</span> 
		      </div>
        </div>
      </div>
    </div>
  </div>
  <!--Breadcrumb section ends--> 

  <!--Payment Method starts-->
  <div class="about-section pt-30 pb-10">
     <div class="container">
        <div class="vid-payment-item mb-4">
			<div class="row">
				<div class="col-lg-3 col-md-4 col-sm-12 col-xs-12">
					<div class="payment-details-area mb-20">
						<h3>{{trans('words.payment_method')}}</h3>
						<div class="select-plan-text">{{trans('words.you_have_selected')}} <span>{{$plan_info->plan_name}}</span></div>
						<p>{{trans('words.you_are_logged')}} <a href="#">{{Auth::User()->email}}</a> {{trans('words.if_you_would_like')}} {{trans('words.different_account_subscription')}}, <a href="{{ URL::to('logout') }}" title="logout">{{trans('words.logout')}}</a> {{trans('words.now')}}.</p>
						<div class="mt-3"><a href="{{ URL::to('pricing') }}" class="btn vfx7">{{trans('words.change_plan')}}</a></div>
					</div>
				</div>
				<div class="col-lg-9 col-md-8 col-sm-12 col-xs-12">
					<div class="row">
          			@if(getPaymentGatewayInfo(1)->status)
						<div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
							<div class="select-payment-method d-flex">
								<div class="vid-payment-logo d-flex align-items-center">
									<img src="{{\URL::to('site_assets/images/gateway/1.png')}}" alt="paypal-logo" title="paypal-logo">
								</div>
								<div class="p-2">
									<h3>{{getPaymentGatewayInfo(1)->gateway_name}}</h3>
									<span>{{getPaymentGatewayInfo(1)->gateway_short_info}}</span>
								</div>								 
								{{ html()->form('POST', url('/paypal/pay'))
                     ->attributes(['class' => '', 'id' => 'paypal_form', 'name' => 'paypal_form', 'role' => 'form'])->open() }}
								<input id="plan_id" type="hidden" class="form-control" name="plan_id" value="{{$plan_info->id}}">
								<input id="plan_price" type="hidden" class="form-control" name="plan_price" value="{{$plan_info->plan_price}}">
								
								<input id="plan_name" type="hidden" class="form-control" name="plan_name" value="{{$plan_info->plan_name}}">
								<button type="submit" class="btn vfx7">{{trans('words.pay_now')}}</button>
								{{ html()->form()->close() }}
 							</div>
						</div>
            		@endif

					@if(getPaymentGatewayInfo(2)->status)
						<div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
							<div class="select-payment-method d-flex">
								<div class="vid-payment-logo d-flex align-items-center">
									<img src="{{\URL::to('site_assets/images/gateway/2.png')}}" alt="stripe-logo" title="stripe-logo">
								</div>
								<div class="p-2">
									<h3>{{getPaymentGatewayInfo(2)->gateway_name}}</h3>
									<span>{{getPaymentGatewayInfo(2)->gateway_short_info}}</span>
								</div>
								<a href="{{ URL::to('stripe/pay') }}" class="btn vfx7" title="{{trans('words.pay_now')}}">{{trans('words.pay_now')}}</a>
								 
							</div>
						</div>
		   			@endif		
					
					@if(getPaymentGatewayInfo(3)->status)
						<div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
							<div class="select-payment-method d-flex">
								<div class="vid-payment-logo d-flex align-items-center">
									<img src="{{\URL::to('site_assets/images/gateway/3.png')}}" alt="razorpay-logo" title="razorpay-logo">
								</div>
								<div class="p-2">
									<h3>{{getPaymentGatewayInfo(3)->gateway_name}}</h3>
									<span>{{getPaymentGatewayInfo(3)->gateway_short_info}}</span>
								</div>
								<button type="submit" class="btn vfx7" id="razorpayId" data-bs-toggle="modal">{{trans('words.pay_now')}}</button>
							</div>
						</div>
					@endif
					
					@if(getPaymentGatewayInfo(4)->status)
					<div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
							<div class="select-payment-method d-flex">
								<div class="vid-payment-logo d-flex align-items-center">
									<img src="{{\URL::to('site_assets/images/gateway/4.png')}}" alt="paystack-logo" title="paystack-logo">
								</div>
								<div class="p-2">
									<h3>{{getPaymentGatewayInfo(4)->gateway_name}}</h3>
									<span>{{getPaymentGatewayInfo(4)->gateway_short_info}}</span>
								</div>
								 
								{{ html()->form('POST', url('/pay'))
                     ->attributes(['class' => '', 'id' => 'paystack_form', 'name' => 'paystack_form', 'role' => 'form'])->open() }}          
								<input type="hidden" name="amount" value="{{number_format($plan_info->plan_price,2)}}">

								<button type="submit" class="btn vfx7">{{trans('words.pay_now')}}</button>
								{{ html()->form()->close() }}
								 
							</div>
						</div>
					@endif

					@if(getPaymentGatewayInfo(6)->status)

					<?php 
					$payu_mode=getPaymentGatewayInfo(6,'mode');

					$key=getPaymentGatewayInfo(6,'payu_key'); //posted merchant key from client
					$salt=getPaymentGatewayInfo(6,'payu_salt'); // add salt here from your credentials in payUMoney dashboard
					$txnId=substr(hash('sha256', mt_rand() . microtime()), 0, 20); //posted txnid from client
					$amount=number_format($plan_info->plan_price,2); 
					$productName=$plan_info->plan_name; 
					$firstName=Auth::User()->name; 
					$email=Auth::User()->email; 


					/***************** USER DEFINED VARIABLES GOES HERE ***********************/
					//all varibles posted from client
					$udf1="";
					$udf2="";
					$udf3="";
					$udf4="";
					$udf5="";

					/***************** DO NOT EDIT ***********************/
					$payhash_str = $key . '|' . $txnId . '|' .$amount  . '|' .$productName  . '|' . $firstName . '|' . $email . '|' . $udf1 . '|' . $udf2 . '|' . $udf3 . '|' . $udf4 . '|' . $udf5 . '||||||'. $salt;
					

					$hash = strtolower(hash('sha512', $payhash_str));
					/***************** DO NOT EDIT ***********************/

					if($payu_mode=="live")
					{
					$payu_url="https://secure.payu.in/_payment";
					}
					else
					{
					$payu_url="https://test.payu.in/_payment";
					}

					?>

						<div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
							<div class="select-payment-method d-flex">
								<div class="vid-payment-logo d-flex align-items-center">
									<img src="{{\URL::to('site_assets/images/gateway/6.png')}}" alt="payumoney-logo" title="payumoney-logo">
								</div>
								<div class="p-2">
									<h3>{{getPaymentGatewayInfo(6)->gateway_name}}</h3>
									<span>{{getPaymentGatewayInfo(6)->gateway_short_info}}</span>
								</div>
								{{ html()->form('POST', url($payu_url))
                     ->attributes(['class' => '', 'id' => 'payu_form', 'name' => 'payu_form', 'role' => 'form', 'enctype' => 'multipart/form-data'])->open() }}
 
           
								<input type="hidden" name="key" value="<?php echo $key;?>" />
								<input type="hidden" name="txnid" value="<?php echo $txnId;?>" />
								<input type="hidden" name="productinfo" value="<?php echo $productName;?>" />
								<input type="hidden" name="amount" value="<?php echo $amount;?>" />
								<input type="hidden" name="email" value="<?php echo $email;?>" />
								<input type="hidden" name="firstname" value="<?php echo $firstName;?>" />
						
								<input type="hidden" name="udf1" value="" />
								<input type="hidden" name="udf2" value="" />
								<input type="hidden" name="udf3" value="" />
								<input type="hidden" name="udf4" value="" />
								<input type="hidden" name="udf5" value="" />

								<input type="hidden" name="surl" value="{{\URL::to('payu_success/')}}" />
								<input type="hidden" name="furl" value="{{\URL::to('payu_fail/')}}" />
								<input type="hidden" name="phone" value="{{Auth::User()->phone}}" />
								<input type="hidden" name="hash" value="<?php echo $hash;?>"/>

								<button type="submit" class="btn vfx7">{{trans('words.pay_now')}}</button>

								{{ html()->form()->close() }}
							</div>
						</div>

					@endif	

					@if(getPaymentGatewayInfo(8)->status)
						<div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
							<div class="select-payment-method d-flex">
								<div class="vid-payment-logo d-flex align-items-center">
									<img src="{{\URL::to('site_assets/images/gateway/6.png')}}" alt="flutterwave-logo" title="flutterwave-logo">
								</div>
								<div class="p-2">
									<h3>{{getPaymentGatewayInfo(8)->gateway_name}}</h3>
									<span>{{getPaymentGatewayInfo(8)->gateway_short_info}}</span>
								</div>
								{{ html()->form('POST', url('/flutterwave/pay'))
                     ->attributes(['class' => 'form-horizontal', 'id' => 'flutterwave_form', 'name' => 'flutterwave_form', 'role' => 'form'])->open() }}
 
           
								<button type="submit" class="btn vfx7">{{trans('words.pay_now')}}</button>
								{{ html()->form()->close() }}
								 
							</div>
						</div>

					@endif

					@if(getPaymentGatewayInfo(12)->status)
					<div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
						
							<div class="select-payment-method d-flex">
								<div class="vid-payment-logo d-flex align-items-center">
									<img src="{{\URL::to('site_assets/images/gateway/12.png')}}" alt="flutterwave-logo" title="flutterwave-logo">
								</div>
								<div class="p-2">
									<h3>{{getPaymentGatewayInfo(12)->gateway_name}}</h3>
									<span>{{getPaymentGatewayInfo(12)->gateway_short_info}}</span>
								</div>
								 
								<a href="Javascript:void(0);" data-toggle="modal" data-target="#bank_transfer_info" class="btn vfx7" title="{{trans('words.pay_now')}}">{{trans('words.pay_now')}}</a>
								 
							</div>			
 
					</div>
					@endif

					@if(getPaymentGatewayInfo(14)->status)
					<div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
							<div class="select-payment-method d-flex">
								<div class="vid-payment-logo d-flex align-items-center">
									<img src="{{\URL::to('site_assets/images/gateway/14.png')}}" alt="flutterwave-logo" title="flutterwave-logo">
								</div>
								<div class="p-2">
									<h3>{{getPaymentGatewayInfo(14)->gateway_name}}</h3>
									<span>{{getPaymentGatewayInfo(14)->gateway_short_info}}</span>
								</div>
								{{ html()->form('POST', url('/flutterwave/pay'))
                     ->attributes(['class' => 'form-horizontal', 'id' => 'flutterwave_form', 'name' => 'flutterwave_form', 'role' => 'form'])->open() }}
  
								 
								<a href="{{ URL::to('sslcommerz/pay') }}" class="btn vfx7" title="{{trans('words.pay_now')}}">{{trans('words.pay_now')}}</a>

								{{ html()->form()->close() }}
								 
							</div>
 
					</div>
					@endif

					@if(getPaymentGatewayInfo(15)->status)
					<div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
						
							<div class="select-payment-method d-flex">
								<div class="vid-payment-logo d-flex align-items-center">
									<img src="{{\URL::to('site_assets/images/gateway/15.png')}}" alt="flutterwave-logo" title="flutterwave-logo">
								</div>
								<div class="p-2">
									<h3>{{getPaymentGatewayInfo(15)->gateway_name}}</h3>
									<span>{{getPaymentGatewayInfo(15)->gateway_short_info}}</span>
								</div>
								{{ html()->form('POST', url('/flutterwave/pay'))
                     ->attributes(['class' => 'form-horizontal', 'id' => 'flutterwave_form', 'name' => 'flutterwave_form', 'role' => 'form'])->open() }}
  
								 
								<a href="{{ URL::to('cinetpay/pay') }}" class="btn vfx7" title="{{trans('words.pay_now')}}">{{trans('words.pay_now')}}</a>

								{{ html()->form()->close() }}
								 
							</div>
			 
					</div>
					@endif

					</div>
				</div>
			</div>
		</div>
    </div>
  </div>
  <!--Payment Method ends--> 

  @if(getPaymentGatewayInfo(12)->status)
<div id="bank_transfer_info" class="modal fade stripe-payment-block" role="dialog" aria-labelledby="bank_transfer_info" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
        
        <div class="modal-content">
        <div class="modal-header">
			<h5 class="modal-title text-dark">{{trans('words.bank_transfer_info')}}</h5>
 		   <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="lnr lnr-cross"></i></span></button>
        </div>
        <div class="modal-body pl-0 pr-0">
			<div class="container"> 
               {!!json_decode(getPaymentGatewayInfo(12)->gateway_info)->banktransfer_info!!}
            </div>  
    
        </div>
        
      </div>

    </div>
   
  </div>
@endif


  <script src="{{ URL::asset('site_assets/js/jquery.min.js') }}"></script>

<script src="https://checkout.razorpay.com/v1/checkout.js"></script>


<script type="text/javascript">
  $("#razorpayId").on('click', function (e) {      
    e.preventDefault();

    $('.vfx-item-ptb').addClass('payment_loading');
    $("#loading").show();

    $.ajax({
        type: "POST",
        url: "{{ URL::to('razorpay_get_order_id') }}",
        data: { 
            id: $(this).val(), // < note use of 'this' here
            _token: "{{ csrf_token() }}" 
        },
        success: function(result) {
            
            $('.vfx-item-ptb').removeClass('payment_loading');
            $("#loading").hide();

            var options = {
                      "key": "{{getPaymentGatewayInfo(3,'razorpay_key')}}", // Enter the Key ID generated from the Dashboard
                      "amount": "{{$plan_info->plan_price*100}}", // Amount is in currency subunits. Default currency is INR. Hence, 50000 refers to 50000 paise
                      "currency": "INR",
                      "name": "{{getcong('site_name')}}",
                      "description": "{{$plan_info->plan_name}}",
                      "image": "{{ URL::asset('/'.getcong('site_logo')) }}",
                      "order_id": result, //This is a sample Order ID. Pass the `id` obtained in the response of Step 1
                      "callback_url": "{{ URL::to('razorpay-success') }}",
                      "prefill": {
                          "name": "{{Auth::user()->name}}",
                          "email": "{{Auth::user()->email}}",
                          "contact": "{{Auth::user()->phone}}"
                      },                       
                      "theme": {
                          "color": "#3399cc"
                      }
                  };

            var rzp1 = new Razorpay(options);

            rzp1.open();  
 
        },
        error: function(result) {
            alert('error');
        }
    });
});
</script>

<script type="text/javascript">
 
 $('#open_phone_update').on('click', function(e) {    
    $('#phone_update').modal('show');
 }); 

</script>

  @endsection