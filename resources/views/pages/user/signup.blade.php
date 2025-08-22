@extends('site_app')

@section('head_title', trans('words.sign_up').' | '.getcong('site_name') )

@section('head_url', Request::url())

@section('content')

@if(getcong('recaptcha_on_signup'))
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
            <h2>{{trans('words.sign_up')}}</h2>
            <span><a href="{{ URL::to('/') }}" title="{{trans('words.home')}}">{{trans('words.home')}}</a></span> <span>{{trans('words.sign_up')}}</span></div>
        </div>
      </div>
    </div>
  </div>
  <!--Breadcrumb section ends--> 
  
  <!--Register starts-->
  <div class="about-section pt-30 pb-20">
    <div class="container">
      <div class="row">
        <div class="col-lg-5 mx-auto">
           <div class="login-wrapper">
			  <div class="ui-dash">
        {{ html()->form('POST', url('/signup'))
                     ->attributes(['class' => '', 'id' => 'signupform','role' => 'form','onsubmit' => 'return submitForm();'])->open() }}

          
					<div class="text-left vid_title mb-25">
                        <h4 class="font-weight-semi-bold">{{trans('words.sign_up')}}</h4>    
                    </div>
					<div class="form-group">
					  <input type="text" name="name" id="name" tabindex="1" class="form-control" placeholder="{{trans('words.name')}}" value="{{old('name')}}">
					</div>
					<div class="form-group">
					  <input type="email" name="email" id="email" tabindex="1" class="form-control" placeholder="{{trans('words.email')}}" value="{{old('email')}}">
					</div>
					<div class="form-group">
					  <input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="{{trans('words.password')}} {{trans('words.at_least_8_char')}}">
					</div>
					<div class="form-group">
					  <input type="password" name="password_confirmation" id="password_confirmation" tabindex="2" class="form-control" placeholder="{{trans('words.confirm_password')}}">
					</div>
          @if(getcong('recaptcha_on_signup'))
            <div class="form-group">
               <div class="g-recaptcha" data-sitekey="{{getcong('recaptcha_site_key')}}" data-callback="verifyCaptcha"></div>
               <div id="g-recaptcha-error"></div>
            </div>     
          @endif

					<div class="res-box text-left">
					  <input type="checkbox" tabindex="3" class="" name="remember" id="remember" checked onclick="return false">
					  <label for="remember">{{trans('words.by_signing_accept')}} <a href="{{ URL::to('page/'.\App\Pages::getPageInfo(3,'page_slug')) }}" class="btn-link" target="_blank" title="privacy">{{\App\Pages::getPageInfo(3,'page_title')}}</a></label>
					</div>
					<div class="res-box text-center mt-2">
					  <button type="submit" class="btn vfx8">{{trans('words.sign_up')}}</button>
					</div>
					<p class="mt-2 mb-0 text-center">{{trans('words.already_have_account')}} <a href="{{ url('login') }}" class="btn-link">{{trans('words.login_text')}}</a></p>
				  {{ html()->form()->close() }}
			   </div>
			</div>
         </div>
      </div>
    </div>
  </div>
  <!--Register ends--> 
 
<script type="text/javascript">
    
    'use strict';

    @if(Session::has('signup_flash_message'))     
 
      const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: false,         
      })

      Toast.fire({
        icon: 'success',
        title: '{{ Session::get('signup_flash_message') }}'
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