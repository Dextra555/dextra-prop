@extends('site_app')

@section('head_title', trans('words.profile').' | '.getcong('site_name') )

@section('head_url', Request::url())

@section('content')

  
  <!--Breadcrumb section starts-->
  <div class="breadcrumb-section bg-xs" style="background-image: url({{ URL::asset('site_assets/images/breadcrumb-1.jpg') }})">
    <div class="overlay op-2"></div>
    <div class="container">
      <div class="row">
        <div class="col-md-12 text-center">
          <div class="breadcrumb-menu">
            <h2>{{trans('words.edit_profile')}}</h2>
            <span><a href="{{ URL::to('/') }}">{{trans('words.home')}}</a></span> <span>{{trans('words.edit_profile')}}</span></div>
        </div>
      </div>
    </div>
  </div>
  <!--Breadcrumb section ends--> 
  
  <!--Edit Profile section starts-->
  <div class="about-section pt-30 pb-20">
    <div class="container">
      <div class="row">
         <div class="col-lg-10 col-md-10 m-auto">
		 {{ html()->form('POST', url('/profile'))
                     ->attributes(['class' => '', 'id' => 'profile_form','role' => 'form','enctype' => 'multipart/form-data'])->open() }}
       
			  <div class="vfx-dashboard-add-list-wrap">
				<div class="vfx-dashboard-add-listing">
				  <div class="row">
					<div class="col-lg-2 col-md-3 col-sm-4 col-xs-12 col-6 m-auto">
					  <div class="vfx-change-photo-btn-item"> 
					   	 
					  	@if(Auth::User()->user_image)
						<img class="fileupload_img" src="{{ URL::asset('upload/'.Auth::User()->user_image) }}"  alt="profile pic" title="profile pic">
						@else  
						<img class="fileupload_img" src="{{ URL::asset('site_assets/images/user-avatar.png') }}" alt="profile pic" title="profile pic">
						@endif
 
						<div class="change-photo-btn">
						  <div class="vfx-contact-upload-btn xs-left">
							<input class="vfx-contact-input-file" id="user_image" type="file" name="user_image" aria-label="Profile picture browse" onchange="readURL(this);" accept=".png, .jpg, .jpeg">
							<span>{{trans('words.upload_photos')}}</span> 
						  </div>
						</div>
					  </div>
					</div>
					<div class="col-lg-10 col-md-9 col-sm-8 col-xs-12 col-12">
					  <div class="row">
						<div class="col-lg-6 col-md-6 col-sm-12">
						  <div class="form-group">
							<label>{{trans('words.name')}}</label>
							<input type="text" name="name" id="name" value="{{$user->name}}" class="form-control filter-input" placeholder="">
						  </div>
						</div>						 
						<div class="col-lg-6 col-md-6 col-sm-12">
						  <div class="form-group">
							<label>{{trans('words.email')}}</label>
							<input type="text" name="email" id="email" value="{{$user->email}}" class="form-control filter-input" placeholder="info@example.com">
						  </div>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-12">
						  <div class="form-group">
							<label>{{trans('words.phone')}}</label>
							<input type="text" name="phone" id="phone" value="{{$user->phone}}" class="form-control filter-input" placeholder="(+21) 124 123 4546">
						  </div>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-12">
						  <div class="form-group">
							<label>{{trans('words.password')}}</label>
							<input type="password" name="password" id="password" value="" class="form-control filter-input" placeholder="">
						  </div>
						</div>
						 

						<div class="col-md-12">
							<button type="submit" name="profile_submit" class="btn vfx3 pull-right">{{trans('words.save_settings')}}</button>
						</div>

					  </div>
					</div>
				  </div>
				</div>
			  </div>
			   
			  {{ html()->form()->close() }}
         </div>
      </div>
    </div>
  </div>
  <!--Edit Profile section ends--> 
  
  <!-- Scroll to top starts--> 
  <span class="vfx-scroll-top-btn"><i class="lnr lnr-arrow-up"></i></span> 
  <!-- Scroll to top ends--> 
</div>
<!--Page Wrapper ends--> 

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

<script>
function readURL(input) {
	'use strict';
	if (input.files && input.files[0]) {
	var reader = new FileReader();

	reader.onload = function(e) {
		 $(".fileupload_img").attr('src', e.target.result);
	}

	reader.readAsDataURL(input.files[0]);
	}
}
</script>
 
@endsection