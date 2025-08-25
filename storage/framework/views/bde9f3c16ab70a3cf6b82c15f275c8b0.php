<div class="left side-menu">
  <div class="sidebar-inner slimscrollleft">
    <div id="sidebar-menu">

      <?php if(Auth::User()->usertype == "Admin"): ?>
      <ul>
      <li><a href="<?php echo e(URL::to('admin/dashboard')); ?>" class="waves-effect <?php echo e(classActivePath('dashboard')); ?>"><i
          class="fa fa-dashboard"></i><span><?php echo e(trans('words.dashboard_text')); ?></span></a></li>

      <li><a href="<?php echo e(URL::to('admin/type')); ?>" class="waves-effect <?php echo e(classActivePath('type')); ?>"><i
          class="fa fa-list"></i><span><?php echo e(trans('words.type_text')); ?></span></a></li>

      <li><a href="<?php echo e(URL::to('admin/location')); ?>" class="waves-effect <?php echo e(classActivePath('location')); ?>"><i
          class="fa fa-globe"></i><span><?php echo e(trans('words.location_text')); ?></span></a></li>    

      <li><a href="<?php echo e(URL::to('admin/property')); ?>" class="waves-effect <?php echo e(classActivePath('property')); ?>"><i
          class="fa fa-home"></i><span><?php echo e(trans('words.property_text')); ?></span></a></li>

      <li class="has_sub">
        <a href="javascript:void(0);" class="waves-effect"><i
          class="fa fa-users"></i><span><?php echo e(trans('words.users')); ?></span><span class="menu-arrow"></span></a>
        <ul class="list-unstyled">
        <li class="<?php echo e(classActivePath('users')); ?>"><a href="<?php echo e(URL::to('admin/users')); ?>"
          class="<?php echo e(classActivePath('users')); ?>"><i
            class="fa fa-users"></i><span><?php echo e(trans('words.users')); ?></span></a></li>

        <li class="<?php echo e(classActivePath('sub_admin')); ?>"><a href="<?php echo e(URL::to('admin/sub_admin')); ?>"
          class="<?php echo e(classActivePath('sub_admin')); ?>"><i
            class="fa fa-users"></i><span><?php echo e(trans('words.admin')); ?></span></a></li>
        </ul>
      </li>

      <li><a href="<?php echo e(URL::to('admin/subscription_plan')); ?>"
        class="waves-effect <?php echo e(classActivePath('subscription_plan')); ?>"><i
          class="fa fa-dollar"></i><span><?php echo e(trans('words.subscription_plan')); ?></span></a></li>

      <li><a href="<?php echo e(URL::to('admin/payment_gateway')); ?>"
        class="waves-effect <?php echo e(classActivePath('payment_gateway')); ?>"><i
          class="fa fa-credit-card-alt"></i><span><?php echo e(trans('words.payment_gateway')); ?></span></a></li>

      <li><a href="<?php echo e(URL::to('admin/transactions')); ?>" class="waves-effect <?php echo e(classActivePath('transactions')); ?>"><i
          class="fa fa-list"></i><span><?php echo e(trans('words.transactions')); ?></span></a></li>


      <li><a href="<?php echo e(URL::to('admin/reports')); ?>" class="waves-effect <?php echo e(classActivePath('reports')); ?>"><i
          class="fa fa-bug"></i><span><?php echo e(trans('words.reports')); ?></span></a></li>

      <li><a href="<?php echo e(URL::to('admin/pages')); ?>" class="waves-effect <?php echo e(classActivePath('pages')); ?>"><i
          class="fa fa-edit"></i><span><?php echo e(trans('words.pages')); ?></span></a></li>


      <li><a href="<?php echo e(URL::to('admin/notification_send')); ?>"
        class="waves-effect <?php echo e(classActivePath('notification_send')); ?>"><i
          class="fa fa-bell"></i><span><?php echo e(trans('words.notification_send')); ?></span></a></li>


      <li class="has_sub">
        <a href="javascript:void(0);" class="waves-effect"><i
          class="fa fa-cog"></i><span><?php echo e(trans('words.settings')); ?></span><span class="menu-arrow"></span></a>
        <ul class="list-unstyled">
        <li class="<?php echo e(classActivePath('general_settings')); ?>"><a href="<?php echo e(URL::to('admin/general_settings')); ?>"
          class="<?php echo e(classActivePath('general_settings')); ?>"><i
            class="fa fa-cog"></i><span><?php echo e(trans('words.general')); ?></span></a></li>
        <li class="<?php echo e(classActivePath('email_settings')); ?>"><a href="<?php echo e(URL::to('admin/email_settings')); ?>"
          class="<?php echo e(classActivePath('email_settings')); ?>"><i
            class="fa fa-envelope"></i><span><?php echo e(trans('words.smtp_email')); ?></span></a></li>
        <li class="<?php echo e(classActivePath('social_login_settings')); ?>"><a
          href="<?php echo e(URL::to('admin/social_login_settings')); ?>"
          class="<?php echo e(classActivePath('social_login_settings')); ?>"><i
            class="fa fa-usb"></i><span><?php echo e(trans('words.social_login')); ?></span></a></li>

        <li class="<?php echo e(classActivePath('recaptcha_settings')); ?>"><a href="<?php echo e(URL::to('admin/recaptcha_settings')); ?>"
          class="<?php echo e(classActivePath('recaptcha_settings')); ?>"><i class="fa fa-refresh"></i><span>
            <?php echo e(trans('words.reCAPTCHA')); ?></span></a></li>

        <li class="<?php echo e(classActivePath('web_ads_settings')); ?>"><a href="<?php echo e(URL::to('admin/web_ads_settings')); ?>"
          class="<?php echo e(classActivePath('web_ads_settings')); ?>"><i class="fa fa-buysellads"></i><span>
            <?php echo e(trans('words.banner_ads')); ?></span></a></li>

        </ul>
      </li>

      <li class="has_sub">
        <a href="javascript:void(0);" class="waves-effect"><i
          class="fa fa-android"></i><span><?php echo e(trans('words.android_app')); ?></span><span class="menu-arrow"></span></a>
        <ul class="list-unstyled">
        <li class="<?php echo e(classActivePath('verify_purchase_app')); ?>"><a href="<?php echo e(URL::to('admin/verify_purchase_app')); ?>"
          class="<?php echo e(classActivePath('verify_purchase_app')); ?>"><i class="fa fa-lock"></i><span>App Verify</span></a>
        </li>
      <?php if(env('BUYER_NAME') and env('BUYER_PURCHASE_CODE')): ?>
      <li class="<?php echo e(classActivePath('android_settings')); ?>"><a href="<?php echo e(URL::to('admin/android_settings')); ?>"
        class="<?php echo e(classActivePath('android_settings')); ?>"><i
        class="fa fa-cog"></i><span><?php echo e(trans('words.android_app_settings')); ?></span></a></li>
      <li class="<?php echo e(classActivePath('ad_list')); ?>"><a href="<?php echo e(URL::to('admin/ad_list')); ?>"
        class="waves-effect <?php echo e(classActivePath('ad_list')); ?>"><i class="fa fa-buysellads"></i><span>Ad
        Settings</span></a></li>
      <li class="<?php echo e(classActivePath('onesignal_notification')); ?>"><a
        href="<?php echo e(URL::to('admin/onesignal_notification')); ?>"
        class="<?php echo e(classActivePath('onesignal_notification')); ?>"><i
        class="fa fa-podcast"></i><span><?php echo e(trans('words.onesignal_notification')); ?></span></a></li>

      <li class="<?php echo e(classActivePath('app_update_popup')); ?>"><a href="<?php echo e(URL::to('admin/app_update_popup')); ?>"
        class="<?php echo e(classActivePath('app_update_popup')); ?>"><i
        class="fa fa-external-link"></i><span><?php echo e(trans('words.app_update_popup')); ?></span></a></li>

      <li class="<?php echo e(classActivePath('others_settings')); ?>"><a href="<?php echo e(URL::to('admin/others_settings')); ?>"
        class="<?php echo e(classActivePath('others_settings')); ?>"><i
        class="fa fa-asterisk"></i><span><?php echo e(trans('words.others_settings')); ?></span></a></li>
    
        </ul>
      </li>

      <li><a href="<?php echo e(URL::to('admin/api_urls')); ?>" class="waves-effect <?php echo e(classActivePath('api_urls')); ?>"><i
          class="fa fa-align-justify"></i><span><?php echo e(trans('words.app_api')); ?></span></a></li>
      <?php endif; ?> 

  <?php else: ?>

  <ul>

    <li><a href="<?php echo e(URL::to('admin/dashboard')); ?>" class="waves-effect <?php echo e(classActivePath('dashboard')); ?>"><i
      class="fa fa-dashboard"></i><span><?php echo e(trans('words.dashboard_text')); ?></span></a></li>

    <li><a href="<?php echo e(URL::to('admin/type')); ?>" class="waves-effect <?php echo e(classActivePath('type')); ?>"><i
      class="fa fa-list"></i><span><?php echo e(trans('words.type_text')); ?></span></a></li>

    <li><a href="<?php echo e(URL::to('admin/location')); ?>" class="waves-effect <?php echo e(classActivePath('location')); ?>"><i
      class="fa fa-globe"></i><span><?php echo e(trans('words.location_text')); ?></span></a></li>    

    <li><a href="<?php echo e(URL::to('admin/property')); ?>" class="waves-effect <?php echo e(classActivePath('property')); ?>"><i
      class="fa fa-home"></i><span><?php echo e(trans('words.property_text')); ?></span></a></li>

    <li><a href="<?php echo e(URL::to('admin/users')); ?>" class="waves-effect <?php echo e(classActivePath('users')); ?>"><i
      class="fa fa-users"></i><span><?php echo e(trans('words.users')); ?></span></a></li>

    <li><a href="<?php echo e(URL::to('admin/transactions')); ?>" class="waves-effect <?php echo e(classActivePath('transactions')); ?>"><i
      class="fa fa-list"></i><span><?php echo e(trans('words.transactions')); ?></span></a></li>


    <li><a href="<?php echo e(URL::to('admin/reports')); ?>" class="waves-effect <?php echo e(classActivePath('reports')); ?>"><i
      class="fa fa-bug"></i><span><?php echo e(trans('words.reports')); ?></span></a></li>

  </ul>

<?php endif; ?>


      </ul>
    </div>
  </div>
</div><?php /**PATH C:\Users\USER\Documents\Dextra Properties\realestate.dextragroups.com\realestate.dextragroups.com\resources\views/admin/sidebar.blade.php ENDPATH**/ ?>