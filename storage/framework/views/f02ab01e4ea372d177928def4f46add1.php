 <!--header starts-->
 <header class="header transparent scroll-hide"> 
    <!--Main Menu starts-->
    <div class="vfx-site-navbar-area vfx2">
      <div class="container">
        <div class="site-navbar">
          <div class="row align-items-center">
            <div class="col-lg-2 col-md-5 col-6"> 
               
              <?php if(getcong('site_logo')): ?>                 
                <a href="<?php echo e(URL::to('/')); ?>" title="logo" class="navbar-brand"><img src="<?php echo e(URL::asset('/'.getcong('site_logo'))); ?>" alt="logo" title="logo" class="img-fluid"></a>
              <?php else: ?>
                <a href="<?php echo e(URL::to('/')); ?>" title="logo" class="navbar-brand"><img src="<?php echo e(URL::asset('site_assets/images/site_logo.png')); ?>" alt="logo" title="logo" class="img-fluid"></a>                          
              <?php endif; ?>
                  
            </div>
            <div class="col-lg-7 col-md-1 col-1 order-2 order-lg-1 pl-xs-0 nav-menu-mobile">
              <nav class="site-navigation text-left">
                <div class="container">
                  <ul class="site-menu vfx-clone-navigation d-none d-lg-block">
                    <li><a class="<?php echo e(classActivePathSite('')); ?>" href="<?php echo e(URL::to('/')); ?>" title="<?php echo e(trans('words.home')); ?>"><?php echo e(trans('words.home')); ?></a></li>
                    
                    <li><a class="<?php echo e(classActivePathSite('types')); ?>" href="<?php echo e(URL::to('/types')); ?>" title="<?php echo e(trans('words.type_text')); ?>"><?php echo e(trans('words.type_text')); ?></a></li>

                    <li><a class="<?php echo e(classActivePathSite('properties')); ?>" href="<?php echo e(URL::to('/properties')); ?>" title="<?php echo e(trans('words.property_text')); ?>"><?php echo e(trans('words.property_text')); ?></a></li>

                    <li><a class="<?php echo e(classActivePathSite('pricing')); ?>" href="<?php echo e(URL::to('/pricing')); ?>" title="<?php echo e(trans('words.pricing')); ?>"><?php echo e(trans('words.pricing')); ?></a></li>

                    <?php $__currentLoopData = \App\Pages::where('status','1')->where('page_position','Top')->orderBy('page_order')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page_data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><a class="<?php echo e((request()->is('page/'.$page_data->page_slug)) ? 'active' : ''); ?>" href="<?php echo e(URL::to('page/'.$page_data->page_slug)); ?>" title="<?php echo e($page_data->page_title); ?>"><?php echo e($page_data->page_title); ?></a></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                     
                   
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
             
              <?php if(Auth::check()): ?>
              <div class="header-button">
							<div class="vfx-header-button-item js-sidebar-btn">								 
                <?php if(Auth::User()->user_image AND file_exists(public_path('upload/'.Auth::User()->user_image))): ?>
                  <img src="<?php echo e(URL::asset('upload/'.Auth::User()->user_image)); ?>" alt="profile_img" title="<?php echo e(Auth::User()->name); ?>" id="userPic">
                <?php else: ?>  
                    <img src="<?php echo e(URL::asset('site_assets/images/user-avatar.png')); ?>" alt="profile_img" title="<?php echo e(Auth::User()->name); ?>" id="userPic">
                <?php endif; ?>

								<span>Hi, <?php echo e(Str::limit(Auth::User()->name,6)); ?> <i class="ion-arrow-down-b"></i></span>
							</div>
							<div class="vfx-setting-menu vfx-js-right-sidebar d-none d-lg-block">
								<div class="vfx-account-dropdown-item">
                  <div class="vfx-account-dropdown-item-area">
								    <a href="<?php echo e(URL::to('dashboard')); ?>" title="<?php echo e(trans('words.dashboard_text')); ?>"><i class="ion-ios-speedometer-outline"></i> <?php echo e(trans('words.dashboard_text')); ?></a>
							    </div>
                  <?php if(Auth::User()->usertype=="User"): ?>
                  <div class="vfx-account-dropdown-item-area">
                    <a href="<?php echo e(URL::to('user/property')); ?>" title="<?php echo e(trans('words.my_properties')); ?>"><i class="ion-social-buffer-outline"></i>  <?php echo e(trans('words.my_properties')); ?></a>
                  </div>
                  <div class="vfx-account-dropdown-item-area">
                    <a href="<?php echo e(URL::to('user/property/add')); ?>" title="<?php echo e(trans('words.add_properties')); ?>"><i class="ion-ios-plus-outline"></i> <?php echo e(trans('words.add_properties')); ?></a>
                  </div>
                  <?php endif; ?>
                  <div class="vfx-account-dropdown-item-area">
                    <a href="<?php echo e(URL::to('user/favourites')); ?>" title="<?php echo e(trans('words.favourite_properties')); ?>"><i class="ionicons ion-android-favorite-outline"></i> <?php echo e(trans('words.favourite_properties')); ?></a>
                  </div>
                  
									<div class="vfx-account-dropdown-item-area">
										<a href="<?php echo e(URL::to('profile')); ?>" title="<?php echo e(trans('words.profile')); ?>"><i class="ionicons ion-person"></i> <?php echo e(trans('words.profile')); ?></a>
									</div>									 
									<div class="vfx-account-dropdown-item-area">
										<a href="<?php echo e(URL::to('logout')); ?>" title="<?php echo e(trans('words.logout')); ?>"><i class="ionicons ion-log-out"></i> <?php echo e(trans('words.logout')); ?></a>
									</div>
								</div>
							</div>
						</div>

            <?php else: ?>

            <div class="vfx-menu-btn">
				        <ul class="user-btn vfx2">
                  <li><a href="<?php echo e(URL::to('/login')); ?>" title="<?php echo e(trans('words.login_text')); ?>"><i class="lnr lnr-user"></i><span class="user-login-text"><?php echo e(trans('words.login_text')); ?></span></a></li>
                </ul>
              </div>	

            <?php endif; ?>

            </div>
          </div>
        </div>
      </div>
    </div>
    <!--Main Menu ends--> 
  </header>
  <!--Header ends--> 
 <?php /**PATH /home/dextragr/public_html/realestate.dextragroups.com/resources/views/_particles/header.blade.php ENDPATH**/ ?>