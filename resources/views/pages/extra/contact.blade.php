@extends('site_app')

@section('head_title', trans('words.contact_us').' - '. getcong('site_name') )

@section('head_url', Request::url())

@section('content')


@if(getcong('recaptcha_on_contact_us'))
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
            <h2>{{trans('words.contact_us')}}</h2>
            <span><a href="{{URL::to('/')}}">{{trans('words.home')}}</a></span> <span>{{trans('words.contact_us')}}</span> 
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

 <!--Contact section starts-->
 <div class="container">
      <div class="row vfx1 pt-30 pb-30">
		  <div class="col-md-12 mb-20">
			  <div class="row">
				   <div class="col-lg-4 col-md-6">
						<div class="contact-info-item">
							<i class="fa fa-map-marker"></i>
							<h4>{{trans('words.address')}}</h4>
							<p>{{$page_info->page_contact_address}}</p>
						</div>
					</div>
					<div class="col-lg-4 col-md-6">
						<div class="contact-info-item">
							<i class="fa fa-phone"></i>
							<h4>{{trans('words.contact_us')}}</h4>
							<ul>
								<li><strong>{{trans('words.phone')}}: </strong> <a href="#">{{$page_info->page_contact_phone}}</a></li>
								<li><strong>{{trans('words.email')}}: </strong> <a href="#">{{$page_info->page_contact_email}}</a></li>
							</ul>
						</div>
					</div>
					<div class="col-lg-4 col-md-6">
						<div class="contact-info-item">
							<i class="fa fa-calendar"></i>
							<h4>{{trans('words.follow_us')}}</h4>
							<ul class="vfx-social-button style2">
                <li><a href="{{stripslashes(getcong('facebook_link'))}}" title="facebook"><i class="fa fa-facebook-f"></i></a></li>
                <li><a href="{{stripslashes(getcong('twitter_link'))}}" title="twitter"><i class="fa fa-twitter"></i></a></li>
                <li><a href="{{stripslashes(getcong('youtube_link'))}}" title="youtube"><i class="fa fa-youtube"></i></a></li>				 
                <li><a href="{{stripslashes(getcong('instagram_link'))}}" title="instagram"><i class="fa fa-instagram"></i></a></li>
							</ul>
						</div>
					</div>
			  </div>  
		  </div>
		  <div class="col-md-6">
			<div class="section-title contact-itme-title vfx2">
				<h2>{{trans('words.get_in_touch')}}</h2>
			</div>
      {{ html()->form('POST', url('/page/contact_send'))
                     ->attributes(['class' => 'contact_form_block', 'id' => 'contact_form', 'name' => 'contact_form', 'role' => 'form', 'enctype' => 'multipart/form-data','onsubmit' => 'return submitForm();'])->open() }}
             
             <div class="form-control-wrap">
				  <div class="row">
					  <div class="col-lg-6 col-md-6">	
						  <div class="form-group">
							<input type="text" class="form-control" id="name" placeholder="{{trans('words.name')}}*" name="name">
						  </div>
					  </div>
					  <div class="col-lg-6 col-md-6">
						  <div class="form-group">
							<input type="email" class="form-control" id="email" placeholder="{{trans('words.email')}}*" name="email">
						  </div>
					  </div>
				  </div>
				  <div class="row">
					  <div class="col-lg-6 col-md-6">	
						  <div class="form-group">
							<input type="text" class="form-control" id="phone" placeholder="{{trans('words.phone')}}" name="phone">
						  </div>
					  </div>
					  <div class="col-lg-6 col-md-6">	
						  <div class="form-group">
							<input type="text" class="form-control" id="subject" placeholder="{{trans('words.subject')}}*" name="subject">
						  </div>
					  </div>
				  </div>
				  <div class="row">
					  <div class="col-lg-12 col-md-12">
						  <div class="form-group">
							<textarea class="form-control" rows="4" name="message" id="message" placeholder="{{trans('words.message')}}"></textarea>
						  </div>
					  </div>
				  </div>
          @if(getcong('recaptcha_on_contact_us'))
            <div class="form-group">
               <div class="g-recaptcha" data-sitekey="{{getcong('recaptcha_site_key')}}" data-callback="verifyCaptcha"></div>
               <div id="g-recaptcha-error"></div>
            </div>     
          @endif
				  <div class="row">
					  <div class="col-lg-12 col-md-12">
						  <div class="form-group">
							  <button type="submit" class="btn vfx7">{{trans('words.send_message')}}</button>
						  </div>
					  </div>
				  </div>
				</div>
        {{ html()->form()->close() }}
		 </div>
		 <div class="col-md-6">
			  <div class="contact-map">
				{!!stripslashes($page_info->page_contact_map)!!}
			  </div>
		 </div>
      </div>
  </div>
  <!--Contact section ends-->

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