<div class="left side-menu">
  <div class="sidebar-inner slimscrollleft">
    <div id="sidebar-menu">

      @if(Auth::User()->usertype == "Admin")
      <ul>
      <li><a href="{{ URL::to('admin/dashboard') }}" class="waves-effect {{classActivePath('dashboard')}}"><i
          class="fa fa-dashboard"></i><span>{{trans('words.dashboard_text')}}</span></a></li>

      <li><a href="{{ URL::to('admin/type') }}" class="waves-effect {{classActivePath('type')}}"><i
          class="fa fa-list"></i><span>{{trans('words.type_text')}}</span></a></li>

      <li><a href="{{ URL::to('admin/location') }}" class="waves-effect {{classActivePath('location')}}"><i
          class="fa fa-globe"></i><span>{{trans('words.location_text')}}</span></a></li>    

      <li><a href="{{ URL::to('admin/property') }}" class="waves-effect {{classActivePath('property')}}"><i
          class="fa fa-home"></i><span>{{trans('words.property_text')}}</span></a></li>

      <li class="has_sub">
        <a href="javascript:void(0);" class="waves-effect"><i
          class="fa fa-users"></i><span>{{trans('words.users')}}</span><span class="menu-arrow"></span></a>
        <ul class="list-unstyled">
        <li class="{{classActivePath('users')}}"><a href="{{ URL::to('admin/users') }}"
          class="{{classActivePath('users')}}"><i
            class="fa fa-users"></i><span>{{trans('words.users')}}</span></a></li>

        <li class="{{classActivePath('sub_admin')}}"><a href="{{ URL::to('admin/sub_admin') }}"
          class="{{classActivePath('sub_admin')}}"><i
            class="fa fa-users"></i><span>{{trans('words.admin')}}</span></a></li>
        </ul>
      </li>

      <li><a href="{{ URL::to('admin/subscription_plan') }}"
        class="waves-effect {{classActivePath('subscription_plan')}}"><i
          class="fa fa-dollar"></i><span>{{trans('words.subscription_plan')}}</span></a></li>

      <li><a href="{{ URL::to('admin/payment_gateway') }}"
        class="waves-effect {{classActivePath('payment_gateway')}}"><i
          class="fa fa-credit-card-alt"></i><span>{{trans('words.payment_gateway')}}</span></a></li>

      <li><a href="{{ URL::to('admin/transactions') }}" class="waves-effect {{classActivePath('transactions')}}"><i
          class="fa fa-list"></i><span>{{trans('words.transactions')}}</span></a></li>


      <li><a href="{{ URL::to('admin/reports') }}" class="waves-effect {{classActivePath('reports')}}"><i
          class="fa fa-bug"></i><span>{{trans('words.reports')}}</span></a></li>

      <li><a href="{{ URL::to('admin/pages') }}" class="waves-effect {{classActivePath('pages')}}"><i
          class="fa fa-edit"></i><span>{{trans('words.pages')}}</span></a></li>


      <li><a href="{{ URL::to('admin/notification_send') }}"
        class="waves-effect {{classActivePath('notification_send')}}"><i
          class="fa fa-bell"></i><span>{{trans('words.notification_send')}}</span></a></li>


      <li class="has_sub">
        <a href="javascript:void(0);" class="waves-effect"><i
          class="fa fa-cog"></i><span>{{trans('words.settings')}}</span><span class="menu-arrow"></span></a>
        <ul class="list-unstyled">
        <li class="{{classActivePath('general_settings')}}"><a href="{{ URL::to('admin/general_settings') }}"
          class="{{classActivePath('general_settings')}}"><i
            class="fa fa-cog"></i><span>{{trans('words.general')}}</span></a></li>
        <li class="{{classActivePath('email_settings')}}"><a href="{{ URL::to('admin/email_settings') }}"
          class="{{classActivePath('email_settings')}}"><i
            class="fa fa-envelope"></i><span>{{trans('words.smtp_email')}}</span></a></li>
        <li class="{{classActivePath('social_login_settings')}}"><a
          href="{{ URL::to('admin/social_login_settings') }}"
          class="{{classActivePath('social_login_settings')}}"><i
            class="fa fa-usb"></i><span>{{trans('words.social_login')}}</span></a></li>

        <li class="{{classActivePath('recaptcha_settings')}}"><a href="{{ URL::to('admin/recaptcha_settings') }}"
          class="{{classActivePath('recaptcha_settings')}}"><i class="fa fa-refresh"></i><span>
            {{trans('words.reCAPTCHA')}}</span></a></li>

        <li class="{{classActivePath('web_ads_settings')}}"><a href="{{ URL::to('admin/web_ads_settings') }}"
          class="{{classActivePath('web_ads_settings')}}"><i class="fa fa-buysellads"></i><span>
            {{trans('words.banner_ads')}}</span></a></li>

        </ul>
      </li>

      <li class="has_sub">
        <a href="javascript:void(0);" class="waves-effect"><i
          class="fa fa-android"></i><span>{{trans('words.android_app')}}</span><span class="menu-arrow"></span></a>
        <ul class="list-unstyled">
        <li class="{{classActivePath('verify_purchase_app')}}"><a href="{{ URL::to('admin/verify_purchase_app') }}"
          class="{{classActivePath('verify_purchase_app')}}"><i class="fa fa-lock"></i><span>App Verify</span></a>
        </li>
      @if(env('BUYER_NAME') and env('BUYER_PURCHASE_CODE'))
      <li class="{{classActivePath('android_settings')}}"><a href="{{ URL::to('admin/android_settings') }}"
        class="{{classActivePath('android_settings')}}"><i
        class="fa fa-cog"></i><span>{{trans('words.android_app_settings')}}</span></a></li>
      <li class="{{classActivePath('ad_list')}}"><a href="{{ URL::to('admin/ad_list') }}"
        class="waves-effect {{classActivePath('ad_list')}}"><i class="fa fa-buysellads"></i><span>Ad
        Settings</span></a></li>
      <li class="{{classActivePath('onesignal_notification')}}"><a
        href="{{ URL::to('admin/onesignal_notification') }}"
        class="{{classActivePath('onesignal_notification')}}"><i
        class="fa fa-podcast"></i><span>{{trans('words.onesignal_notification')}}</span></a></li>

      <li class="{{classActivePath('app_update_popup')}}"><a href="{{ URL::to('admin/app_update_popup') }}"
        class="{{classActivePath('app_update_popup')}}"><i
        class="fa fa-external-link"></i><span>{{trans('words.app_update_popup')}}</span></a></li>

      <li class="{{classActivePath('others_settings')}}"><a href="{{ URL::to('admin/others_settings') }}"
        class="{{classActivePath('others_settings')}}"><i
        class="fa fa-asterisk"></i><span>{{trans('words.others_settings')}}</span></a></li>
    
        </ul>
      </li>

      <li><a href="{{ URL::to('admin/api_urls') }}" class="waves-effect {{classActivePath('api_urls')}}"><i
          class="fa fa-align-justify"></i><span>{{trans('words.app_api')}}</span></a></li>
      @endif 

  @else

  <ul>

    <li><a href="{{ URL::to('admin/dashboard') }}" class="waves-effect {{classActivePath('dashboard')}}"><i
      class="fa fa-dashboard"></i><span>{{trans('words.dashboard_text')}}</span></a></li>

    <li><a href="{{ URL::to('admin/type') }}" class="waves-effect {{classActivePath('type')}}"><i
      class="fa fa-list"></i><span>{{trans('words.type_text')}}</span></a></li>

    <li><a href="{{ URL::to('admin/location') }}" class="waves-effect {{classActivePath('location')}}"><i
      class="fa fa-globe"></i><span>{{trans('words.location_text')}}</span></a></li>    

    <li><a href="{{ URL::to('admin/property') }}" class="waves-effect {{classActivePath('property')}}"><i
      class="fa fa-home"></i><span>{{trans('words.property_text')}}</span></a></li>

    <li><a href="{{ URL::to('admin/users') }}" class="waves-effect {{classActivePath('users')}}"><i
      class="fa fa-users"></i><span>{{trans('words.users')}}</span></a></li>

    <li><a href="{{ URL::to('admin/transactions') }}" class="waves-effect {{classActivePath('transactions')}}"><i
      class="fa fa-list"></i><span>{{trans('words.transactions')}}</span></a></li>


    <li><a href="{{ URL::to('admin/reports') }}" class="waves-effect {{classActivePath('reports')}}"><i
      class="fa fa-bug"></i><span>{{trans('words.reports')}}</span></a></li>

  </ul>

@endif


      </ul>
    </div>
  </div>
</div>