<div class="topbar">
  <div class="topbar-left">
    <a href="{{ URL::to('admin/dashboard') }}" class="logo">
      <span>
        @if(getcong('admin_logo'))
      <img src="{{ URL::asset('/' . getcong('admin_logo')) }}" alt="Admin Logo" width="190">
    @else
    <span>APP Admin</span>
  @endif        </span>
      <i class="mdi mdi-layers"></i>
    </a>
  </div>
  <div class="navbar navbar-default" role="navigation">
    <div class="container-fluid">
      <ul class="nav navbar-nav list-inline navbar-left">
        <li class="list-inline-item">
          <button class="button-menu-mobile open-left"> <i class="mdi mdi-menu"></i> </button>
        </li>
        <li class="list-inline-item">
          <h4 class="page-title">{{$page_title}}</h4>
        </li>
      </ul>
      <nav class="navbar-custom">
        <ul class="list-unstyled topbar-right-menu float-right mb-0">

          <li>
            <!-- Notification -->
            <div class="notification-box">
              <ul class="list-inline mb-0">

                <li>
                  <a href="{{ URL::to('admin/cache') }}" class="right-bar-toggle mr-3" data-toggle="Tooltip" title="Clear Cache">
                    <i class="fa fa-refresh"></i>
                  </a>
                </li>
                
                <li>
                  <a href="{{ URL::to('/') }}" class="right-bar-toggle" data-toggle="Tooltip" title="Front End"
                    target="_blank">
                    <i class="fa fa-desktop"></i>
                  </a>
                </li>
              </ul>
            </div>
            <!-- End Notification bar -->
          </li>

          <li class="dropdown notification-list">
            <a class="nav-link dropdown-toggle waves-effect waves-light nav-user" data-toggle="dropdown" href="#"
              role="button" aria-haspopup="false" aria-expanded="false">

              @if(Auth::user()->user_image)

          <img src="{{URL::to('upload/' . Auth::user()->user_image)}}" alt="person" class="rounded-circle" />

        @else

        <img src="{{ URL::asset('admin_assets/images/user-default.png') }}" alt="person"
        class="rounded-circle" />

      @endif

            </a>
            <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
              <a href="{{ URL::to('admin/profile') }}" class="dropdown-item notify-item">
                <i class="ti-user m-r-5"></i> {{trans('words.profile')}}
              </a>
              <a href="{{ URL::to('admin/logout') }}" class="dropdown-item notify-item">
                <i class="ti-power-off m-r-5"></i> {{trans('words.logout')}}
              </a>
            </div>
          </li>
        </ul>
      </nav>
    </div>
  </div>
</div>