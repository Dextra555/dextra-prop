<?php $__env->startSection('head_title', getcong('site_name') ); ?>

<?php $__env->startSection('head_url', Request::url()); ?>

<?php $__env->startSection('content'); ?>
  
  <?php echo $__env->make("pages.home.slider", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

  
  <!-- Add banner Section -->
  <?php if(get_web_banner('home_top')!=""): ?>      
      <div class="add_banner_section pb-0 mb-20">
        <div class="container">
          <div class="row">
              <div class="col-md-12">
              <?php echo stripslashes(get_web_banner('home_top')); ?>

            </div>
          </div>  
        </div>
      </div>
  <?php endif; ?>
  <!-- Add banner Section -->
  
  <!--Category section starts-->
  <div class="vfx-team-section-area bg-cb-gra pb-20 pt-20">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="section-title vid-item-section mb-15">
            <h2><?php echo e(trans('words.property_type')); ?></h2>
			<span class="view-more">
			   <a href="<?php echo e(URL::to('types')); ?>" title="types"><?php echo e(trans('words.view_all')); ?><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 512 512" style="vertical-align: text-top"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="60" d="m184 112l144 144l-144 144"></path></svg></a>
		    </span>
          </div>
        </div>
        <div class="col-md-12">
          <div class="vfx-team-wrapper swiper-container">
            <div class="swiper-wrapper">
              <?php $__currentLoopData = $type_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type_data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <div class="swiper-slide">
                <div class="vfx-single-team-member vfx-cat-item vfx2"> <a href="<?php echo e(URL::to('types/'.$type_data->type_slug.'/'.$type_data->id)); ?>" title="<?php echo e($type_data->type_name); ?>"><img src="<?php echo e(URL::to('/'.$type_data->type_image)); ?>" alt="<?php echo e($type_data->type_name); ?>" title="<?php echo e($type_data->type_name); ?>"></a>
                  <div class="vfx-single-team-info">
                    <h4><a href="<?php echo e(URL::to('types/'.$type_data->type_slug.'/'.$type_data->id)); ?>" title="<?php echo e($type_data->type_name); ?>"><?php echo e($type_data->type_name); ?></a></h4>
                  </div>
                </div>
              </div>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			   
            </div>
            <div class="slider-btn vfx2 team_next"><i class="lnr lnr-arrow-right"></i></div>
            <div class="slider-btn vfx2 team_prev"><i class="lnr lnr-arrow-left"></i></div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--Category section starts-->

    <!--Latest Property Starts-->
    <div class="vfx-trending-places bg-cb pb-30 pt-20">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="section-title vid-item-section mb-15">
            <h2><?php echo e(trans('words.latest_property')); ?></h2>
			  <span class="view-more">
			   <a href="<?php echo e(URL::to('latest')); ?>" title="view all"><?php echo e(trans('words.view_all')); ?><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 512 512" style="vertical-align: text-top"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="60" d="m184 112l144 144l-144 144"></path></svg></a>
		    </span>
          </div>
        </div>
        <div class="swiper-container vfx-latest-property-wrap">
          <div class="swiper-wrapper">

          <?php $__currentLoopData = $latest_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $latest_data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="swiper-slide">
              <div class="vfx-single-property-box-area">
                <div class="vfx-property-item"> <a class="vfx-property-img" href="<?php echo e(URL::to('properties/'.$latest_data->slug.'/'.$latest_data->id)); ?>" title="<?php echo e(stripslashes($latest_data->title)); ?>"><img src="<?php echo e(\URL::to('/'.$latest_data->image)); ?>" alt="image" title="image"> </a>
                  <ul class="vfx-feature-text">
                    <?php if($latest_data->purpose=='Rent'): ?>
                    <li class="feature_cb"><span><?php echo e(trans('words.rent')); ?></span></li>
                    <?php else: ?>
                    <li class="feature_or"><span><?php echo e(trans('words.sale')); ?></span></li>
                    <?php endif; ?>
                    <?php if($latest_data->verified=='YES'): ?>
                    <li class="feature_cb verified_item"><i class="fa fa-check 1" data-toggle="tooltip" data-placement="top" title="" data-original-title="<?php echo e(trans('words.verified')); ?>"></i></li>
                    <?php endif; ?>	
                  </ul>
                  <div class="vfx-property-author-wrap"> 
                    <p class="text-tlt"><?php echo e($latest_data->types->type_name); ?></p>
                    <ul class="vfx-save-btn">
                       
                        <li data-toggle="tooltip" data-placement="top" title="" data-original-title="Set Favourite" class="favourite_property favourite_title_id<?php echo e($latest_data->id); ?>" data-id="<?php echo e($latest_data->id); ?>">
                            <?php if(check_favourite("Property",$latest_data->id,isset(Auth::user()->id)?Auth::user()->id:"")): ?>
                            <a href="Javascript:void(0);" title="fav"><i class="fa fa-heart favourite_icon_id<?php echo e($latest_data->id); ?>"></i></a>
                            <?php else: ?>
                            <a href="Javascript:void(0);" title="fav"><i class="fa fa-heart-o favourite_icon_id<?php echo e($latest_data->id); ?>"></i></a>
                            <?php endif; ?>
                        </li>
                     
                    </ul>
                  </div>
                </div>
                <div class="vfx-property-title-box-area">
				  <h4><a href="<?php echo e(URL::to('properties/'.$latest_data->slug.'/'.$latest_data->id)); ?>" title="<?php echo e(stripslashes($latest_data->title)); ?>"><?php echo e(Str::limit(stripslashes($latest_data->title),30)); ?></a></h4>
                  <div class="vfx-property-location"> <i class="fa fa-map-marker"></i>
                    <p>
                      <?php if(isset($latest_data->locations->name) AND $latest_data->locations->name!=""): ?>
                        <?php echo e($latest_data->locations->name); ?>

                      <?php else: ?>
                        <?php echo e(Str::limit(stripslashes($latest_data->address),40)); ?>

                      <?php endif; ?>
                    </p>
                  </div>                
                  <div class="trending-bottom">
                    <div class="trend-left float-left">
                      <div class="vfx-property-author-wrap"> 
                        <a href="<?php echo e(URL::to('properties/owner/'.$latest_data->user_id)); ?>" class="property-author" title="user profile"> 

                          <?php if($latest_data->users->user_image): ?>
                          <img src="<?php echo e(\URL::to('upload/'.$latest_data->users->user_image)); ?>" alt="user_image" title="<?php echo e(stripslashes($latest_data->title)); ?>"> 
                          <?php else: ?>
                          <img src="<?php echo e(\URL::to('site_assets/images/user-default.jpg')); ?>" alt="user" title="title">
                          <?php endif; ?>

                          <span><?php echo e($latest_data->users->name); ?></span> 
                        </a>
                      </div>
                    </div>
                    <a href="<?php echo e(URL::to('properties/'.$latest_data->slug.'/'.$latest_data->id)); ?>" class="vfx-trend-right float-right" title="<?php echo e(stripslashes($latest_data->title)); ?>">
						          <div class="vfx-trend-open-price"><?php echo e(html_entity_decode(getCurrencySymbols(getcong('currency_code')))); ?><?php echo e(number_format($latest_data->price)); ?></div>
                    </a> 
				  </div>
                </div>
              </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
 
             
          </div>
        </div>
        <div class="vfx-latest-property-pagination"></div>
      </div>
    </div>
  </div>
  <!--Latest Property Ends-->

  <?php if(count($trending_list) > 0): ?>
  <!--Popular Property Starts-->
  <div class="vfx-trending-places our-story-bg-2 pb-30 mt-20">
    <div class="container">
      <div class="row">
		<div class="col-md-12">
          <div class="section-title vid-item-section mb-15">
            <h2><?php echo e(trans('words.trending_now')); ?></h2>
			<span class="view-more">
			   <a href="<?php echo e(URL::to('popular')); ?>" title="popular"><?php echo e(trans('words.view_all')); ?><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 512 512" style="vertical-align: text-top"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="60" d="m184 112l144 144l-144 144"></path></svg></a>
		    </span>
          </div>
        </div>
        <div class="swiper-container vfx-popular-property-wrap">
          <div class="swiper-wrapper">

          <?php $__currentLoopData = $trending_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $trending_data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php 
                $property_info= \App\Property::find($trending_data->post_id);                 
            ?>
            <div class="swiper-slide">
              <div class="vfx-single-property-box-area">
                <div class="vfx-property-item"> <a class="vfx-property-img" href="<?php echo e(URL::to('properties/'.$property_info->slug.'/'.$property_info->id)); ?>" title="<?php echo e(stripslashes($property_info->title)); ?>"><img src="<?php echo e(\URL::to('/'.$property_info->image)); ?>" alt="image" title="image"> </a>
                  <ul class="vfx-feature-text">
                      <?php if($property_info->purpose=='Rent'): ?>
                      <li class="feature_cb"><span><?php echo e(trans('words.rent')); ?></span></li>
                      <?php else: ?>
                      <li class="feature_or"><span><?php echo e(trans('words.sale')); ?></span></li>
                      <?php endif; ?>

                      <?php if($property_info->verified=='YES'): ?>
                      <li class="feature_cb verified_item"><i class="fa fa-check 1" data-toggle="tooltip" data-placement="top" title="" data-original-title="<?php echo e(trans('words.verified')); ?>"></i></li>
                      <?php endif; ?>
                  </ul>
                  <div class="vfx-property-author-wrap"> 
                    <p class="text-tlt"><?php echo e($property_info->types->type_name); ?></p>
                    <ul class="vfx-save-btn">
                       
                        <li data-toggle="tooltip" data-placement="top" title="" data-original-title="Set Favourite" class="favourite_property favourite_title_id<?php echo e($property_info->id); ?>" data-id="<?php echo e($property_info->id); ?>">
                            <?php if(check_favourite("Property",$property_info->id,isset(Auth::user()->id)?Auth::user()->id:"")): ?>
                            <a href="Javascript:void(0);" title="view"><i class="fa fa-heart favourite_icon_id<?php echo e($property_info->id); ?>"></i></a>
                            <?php else: ?>
                            <a href="Javascript:void(0);" title="view"><i class="fa fa-heart-o favourite_icon_id<?php echo e($property_info->id); ?>"></i></a>
                            <?php endif; ?>
                        </li>

                    </ul>
                  </div>
                </div>
                <div class="vfx-property-title-box-area">
				  <h4><a href="<?php echo e(URL::to('properties/'.$property_info->slug.'/'.$property_info->id)); ?>" title="<?php echo e(stripslashes($property_info->title)); ?>"><?php echo e(Str::limit(stripslashes($property_info->title),30)); ?></a></h4>
                  <div class="vfx-property-location"> <i class="fa fa-map-marker"></i>
                    <p>
                      <?php if(isset($property_info->locations->name) AND $property_info->locations->name!=""): ?>
                        <?php echo e($property_info->locations->name); ?>

                      <?php else: ?>
                      <?php echo e(Str::limit(stripslashes($property_info->address),40)); ?>

                      <?php endif; ?>
                    </p>
                  </div>                
                  <div class="trending-bottom">
                    <div class="trend-left float-left">
                      <div class="vfx-property-author-wrap"> 
                        <a href="<?php echo e(URL::to('properties/owner/'.$property_info->user_id)); ?>" class="property-author"> 

                            <?php if($property_info->users->user_image): ?>
                              <img src="<?php echo e(\URL::to('upload/'.$property_info->users->user_image)); ?>" alt="user_image" title="<?php echo e(stripslashes($property_info->title)); ?>"> 
                            <?php else: ?>
                            <img src="<?php echo e(\URL::to('site_assets/images/user-default.jpg')); ?>" alt="user_image" title="<?php echo e(stripslashes($property_info->title)); ?>">
                            <?php endif; ?>

                          <span><?php echo e($property_info->users->name); ?></span> 
                        </a>
                      </div>
                    </div>
                    <a href="<?php echo e(URL::to('properties/'.$property_info->slug.'/'.$property_info->id)); ?>" class="vfx-trend-right float-right" title="<?php echo e(stripslashes($property_info->title)); ?>">
						          <div class="vfx-trend-open-price"><?php echo e(html_entity_decode(getCurrencySymbols(getcong('currency_code')))); ?><?php echo e(number_format($property_info->price)); ?></div>
                    </a> 
				  </div>
                </div>
              </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
             
            
          </div>
        </div>
        <div class="vfx-popular-property-pagination"></div>
      </div>
    </div>
  </div>
  <!--Popular Property Ends--> 
  <?php endif; ?>
   
  <!-- Add banner Section -->
  <?php if(get_web_banner('home_bottom')!=""): ?>      
      <div class="add_banner_section pt-0">
        <div class="container">
          <div class="row">
              <div class="col-md-12">
              <?php echo stripslashes(get_web_banner('home_bottom')); ?>

            </div>
          </div>  
        </div>
      </div>
  <?php endif; ?>
 
  <span class="vfx-scroll-top-btn"><i class="lnr lnr-arrow-up"></i></span> 


<!--Page Wrapper ends--> 
<?php $__env->stopSection(); ?>
<?php echo $__env->make('site_app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\USER\Documents\Dextra Properties\realestate.dextragroups.com\realestate.dextragroups.com\resources\views/pages/index.blade.php ENDPATH**/ ?>