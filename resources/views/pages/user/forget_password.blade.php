@extends('site_app')

@section('head_title', trans('words.forgot_password').' | '.getcong('site_name') )

@section('head_url', Request::url())

@section('content')
  
@if(getcong('recaptcha_on_forgot_pass'))
<script src='https://www.google.com/recaptcha/api.js'></script>
<script>
function submitForm() {
    var response = grecaptcha.getResponse();
    if(response.length == 0) {
        document.getElementById('g-recaptcha-error').innerHTML = '<span style="color:red;">This field is required.</span>';
        return false;
    }
   
    return true;
}
 
function verifyCaptcha() {
    document.getElementById('g-recaptcha-error').innerHTML = '';
}
</script>
@endif
 

  <!--Breadcrumb section starts-->
  <div class="breadcrumb-section bg-xs" style="background-image: url({{ URL::asset('site_assets/images/breadcrumb-1.jpg') }})">
    <div class="overlay op-2"></div>
    <div class="container">
      <div class="row">
        <div class="col-md-8 offset-md-2 text-center">
          <div class="breadcrumb-menu">
            <h2>{{trans('words.forgot_password')}}</h2>
            <span><a href="{{ URL::to('/') }}">{{trans('words.home')}}</a></span> <span>{{trans('words.forgot_password')}}</span></div>
        </div>
      </div>
    </div>
  </div>
  <!--Breadcrumb section ends--> 
  
  <!--Forgot Password starts-->
  <div class="about-section pt-30 pb-20">
    <div class="container">
      <div class="row">
        <div class="col-lg-5 mx-auto">
           <div class="login-wrapper">
			  <div class="ui-dash">			  
           
         {{ html()->form('POST', url('/password/email'))
                     ->attributes(['class' => '', 'id' => 'forgotform','role' => 'form','onsubmit' => 'return submitForm();'])->open() }}

					<div class="text-left vid_title mb-25">
                        <h4 class="font-weight-semi-bold">{{trans('words.forgot_pass')}}</h4>    
                    </div>
					<div class="form-group">
					  <input type="text" name="email" id="email" tabindex="1" class="form-control" placeholder="Email" value="" required>
					</div>
          @if(getcong('recaptcha_on_forgot_pass'))
            <div class="form-group">
               <div class="g-recaptcha" data-sitekey="{{getcong('recaptcha_site_key')}}" data-callback="verifyCaptcha"></div>
               <div id="g-recaptcha-error"></div>
            </div>     
            @endif
					<div class="res-box text-center mt-2">
					  <button type="submit" class="btn vfx8">{{trans('words.reset_password')}}</button>
					</div>
				  {{ html()->form()->close() }}
			   </div>
			</div>
         </div>
      </div>
    </div>
  </div>
  <!--Forgot Password ends-->  

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

  @if(Session::has('error_flash_message'))     
 
      const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: false,        
      })

      Toast.fire({
        icon: 'success',
        title: '{{ Session::get('error_flash_message') }}'
      })     
     
  @endif
  
 
  @if (count($errors) > 0)
                  
          Swal.fire({
            icon: 'error',
            title: 'Oops...',
            html: '<p>@foreach ($errors->all() as $error) {{$error}}<br/> @endforeach</p>',
            showConfirmButton: true,
            confirmButtonColor: '#10c469',
            background:"#1a2234",
            color:"#fff"
           }) 
  @endif
 

  </script>
 
@endsection