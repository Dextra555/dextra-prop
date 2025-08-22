@extends('site_app')

@section('head_title', stripslashes($page_info->page_title).' - '. getcong('site_name') )

@section('head_url', Request::url())

@section('content')

<!--Breadcrumb section starts-->
<div class="breadcrumb-section bg-xs" style="background-image: url({{ URL::asset('site_assets/images/breadcrumb-1.jpg') }})">
    <div class="overlay op-2"></div>
    <div class="container">
      <div class="row">
        <div class="col-md-8 offset-md-2 text-center">
          <div class="breadcrumb-menu">
            <h2>{{stripslashes($page_info->page_title)}}</h2>
            <span><a href="{{URL::to('/')}}">{{trans('words.home')}}</a></span> <span>{{stripslashes($page_info->page_title)}}</span> 
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


    <!--Always Provide Section starts-->
    <div class="about-section pt-30 pb-20">
    <div class="container">
      <div class="row align-items-center">
	    <div class="col-lg-5 col-md-12 mb-20">
			<img src="{{\URL::to('/'.$page_info->page_about_image)}}" alt="about_img" title="about_img">
		</div>
        <div class="col-lg-7 col-md-12">
          <div class="about-text res-box"> 
                {!!stripslashes($page_info->page_content)!!}
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--Always Provide Section ends--> 
  
  <!--Great Services Section starts-->
  <div class="about-section bg-cb pt-40 pb-40">
    <div class="container">
      <div class="row align-items-center">
	    <div class="col-lg-6 col-md-12">
          <div class="about-text res-box"> 
              {!!stripslashes($page_info->page_about_text2)!!}
          </div>
        </div>
		<div class="col-lg-6 col-md-12">
			<div class="popup-vid pt-2 pb-2"> 
				<img src="{{\URL::to('/'.$page_info->page_about_image2)}}" alt="about-img" title="about-img" class="popup-img rounded"> 				 
			</div>
		</div>
      </div>
    </div>
  </div>
  <!--Great Services Section ends--> 
  
  <!--Want to Become Section starts--> 
  <div class="become_widget">
    <div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="call-to-act">
					<div class="call-to-act-head">
						<h3>{{trans('words.list_your_properties')}} {{getcong('site_name')}}!</h3>
						 
					</div>
					<a href="{{ URL::to('/signup') }}" class="btn vfx6" title="{{trans('words.join_now')}}">{{trans('words.join_now')}}</a>
				</div>
			</div>
		</div>
	</div>
  </div>
  <!--Want to Become Section ends--> 


  <!-- Add banner Section -->
  @if(get_web_banner('other_page_bottom')!="")      
      <div class="add_banner_section pb-20">
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
 
 

@endsection