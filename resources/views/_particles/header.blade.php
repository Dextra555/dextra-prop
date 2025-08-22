 <!--header starts-->
 <header class="header transparent scroll-hide"> 
    <!--Main Menu starts-->
    <div class="vfx-site-navbar-area vfx2">
      <div class="container">
        <div class="site-navbar">
          <div class="row align-items-center">
            <div class="col-lg-2 col-md-5 col-6"> 
               
              @if(getcong('site_logo'))                 
                <a href="{{ URL::to('/') }}" title="logo" class="navbar-brand"><img src="{{ URL::asset('/'.getcong('site_logo')) }}" alt="logo" title="logo" class="img-fluid"></a>
              @else
                <a href="{{ URL::to('/') }}" title="logo" class="navbar-brand"><img src="{{ URL::asset('site_assets/images/site_logo.png') }}" alt="logo" title="logo" class="img-fluid"></a>                          
              @endif
                  
            </div>
            <div class="col-lg-7 col-md-1 col-1 order-2 order-lg-1 pl-xs-0 nav-menu-mobile">
              <nav class="site-navigation text-left">
                <div class="container">
                  <ul class="site-menu vfx-clone-navigation d-none d-lg-block">
                    <li><a class="{{classActivePathSite('')}}" href="{{ URL::to('/') }}" title="{{trans('words.home')}}">{{trans('words.home')}}</a></li>
                    
                    <li><a class="{{classActivePathSite('types')}}" href="{{ URL::to('/types') }}" title="{{trans('words.type_text')}}">{{trans('words.type_text')}}</a></li>

                    <li><a class="{{classActivePathSite('properties')}}" href="{{ URL::to('/properties') }}" title="{{trans('words.property_text')}}">{{trans('words.property_text')}}</a></li>

                    <li><a class="{{classActivePathSite('pricing')}}" href="{{ URL::to('/pricing') }}" title="{{trans('words.pricing')}}">{{trans('words.pricing')}}</a></li>

                    @foreach(\App\Pages::where('status','1')->where('page_position','Top')->orderBy('page_order')->get() as $page_data)
                    <li><a class="{{ (request()->is('page/'.$page_data->page_slug)) ? 'active' : '' }}" href="{{ URL::to('page/'.$page_data->page_slug) }}" title="{{$page_data->page_title}}">{{$page_data->page_title}}</a></li>
                    @endforeach                     
                   
                  </ul>
                </div>
              </nav>
              <div class="vfx-lg-none sm-right"> <a href="#" class="mobile-bar js-menu-toggle" title="menu"> <span class="lnr lnr-menu"></span> </a> </div>
              <!--mobile-menu starts -->
              <div class="vfx-mobile-navigation-menu">
                <div class="vfx-mobile-navigation-menu-header">
                  <div class="vfx-mobile-navigation-menu-close js-menu-toggle"> <span class="lnr lnr-cross"></span> </div>
                </div>
                <div class="vfx-mobile-navigation-menu-body"></div>
              </div>
              <!--mobile-menu ends--> 
            </div>
            <div class="col-lg-3 col-md-6 col-5 order-1 order-lg-2 text-right pr-xs-0">
             
              @if(Auth::check())
              <div class="header-button">
							<div class="vfx-header-button-item js-sidebar-btn">								 
                @if(Auth::User()->user_image AND file_exists(public_path('upload/'.Auth::User()->user_image)))
                  <img src="{{ URL::asset('upload/'.Auth::User()->user_image) }}" alt="profile_img" title="{{Auth::User()->name}}" id="userPic">
                @else  
                    <img src="{{ URL::asset('site_assets/images/user-avatar.png') }}" alt="profile_img" title="{{Auth::User()->name}}" id="userPic">
                @endif

								<span>Hi, {{ Str::limit(Auth::User()->name,6)}} <i class="ion-arrow-down-b"></i></span>
							</div>
							<div class="vfx-setting-menu vfx-js-right-sidebar d-none d-lg-block">
								<div class="vfx-account-dropdown-item">
                  <div class="vfx-account-dropdown-item-area">
								    <a href="{{ URL::to('dashboard') }}" title="{{trans('words.dashboard_text')}}"><i class="ion-ios-speedometer-outline"></i> {{trans('words.dashboard_text')}}</a>
							    </div>
                  @if(Auth::User()->usertype=="User")
                  <div class="vfx-account-dropdown-item-area">
                    <a href="{{ URL::to('user/property') }}" title="{{trans('words.my_properties')}}"><i class="ion-social-buffer-outline"></i>  {{trans('words.my_properties')}}</a>
                  </div>
                  <div class="vfx-account-dropdown-item-area">
                    <a href="{{ URL::to('user/property/add') }}" title="{{trans('words.add_properties')}}"><i class="ion-ios-plus-outline"></i> {{trans('words.add_properties')}}</a>
                  </div>
                  @endif
                  <div class="vfx-account-dropdown-item-area">
                    <a href="{{ URL::to('user/favourites') }}" title="{{trans('words.favourite_properties')}}"><i class="ionicons ion-android-favorite-outline"></i> {{trans('words.favourite_properties')}}</a>
                  </div>
                  
									<div class="vfx-account-dropdown-item-area">
										<a href="{{ URL::to('profile') }}" title="{{trans('words.profile')}}"><i class="ionicons ion-person"></i> {{trans('words.profile')}}</a>
									</div>									 
									<div class="vfx-account-dropdown-item-area">
										<a href="{{ URL::to('logout') }}" title="{{trans('words.logout')}}"><i class="ionicons ion-log-out"></i> {{trans('words.logout')}}</a>
									</div>
								</div>
							</div>
						</div>

            @else

            <div class="vfx-menu-btn">
				        <ul class="user-btn vfx2">
                  <li><a href="{{ URL::to('/login') }}" title="{{trans('words.login_text')}}"><i class="lnr lnr-user"></i><span class="user-login-text">{{trans('words.login_text')}}</span></a></li>
                </ul>
              </div>	

            @endif

            </div>
          </div>
        </div>
      </div>
    </div>
    <!--Main Menu ends--> 
  </header>
  <!--Header ends--> 
 