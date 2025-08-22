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

<!--About section starts-->
<div class="about-section pt-30 pb-20">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 col-md-12">
          <div class="about-text res-box"> 
			<h3>{{stripslashes($page_info->page_title)}}</h3>
            <p>{!!stripslashes($page_info->page_content)!!}</p>
          </div>
        </div>
      </div>

        <!-- Add banner Section -->
        @if(get_web_banner('other_page_bottom')!="")      
          <div class="add_banner_section pb-0">
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
  <!--About section ends--> 
 

@endsection