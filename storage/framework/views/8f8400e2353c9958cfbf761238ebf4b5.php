<?php $__env->startSection('head_title', get_user_info($owner_id,'name').' - '.trans('words.property_text').' - '.getcong('site_name') ); ?>

<?php $__env->startSection('head_url', Request::url()); ?>

<?php $__env->startSection('content'); ?>

<script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "ItemList",
        "name": "<?php echo e(get_user_info($owner_id,'name')); ?> - <?php echo e(trans('words.property_text')); ?>",
        "description": "",
        "itemListElement": [
          <?php $i = 1; ?> 
          <?php $__currentLoopData = $property_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $property_data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>            
            <?php
              $separator = ',';
              if($i == count($property_list)){
                $separator = '';
                }
            $i++;
          ?>

              {
                  "@type": "ListItem",                  
                  "name": "<?php echo e(stripslashes($property_data->title)); ?>",
                  "image": "<?php echo e(\URL::to('/'.$property_data->image)); ?>",
                  "position": "<?php echo e($i); ?>",                  
                  "url": "<?php echo e(URL::to('properties/'.$property_data->slug.'/'.$property_data->id)); ?>",
                  "telephone": "",
                  "priceCurrency": "<?php echo e(getcong('currency_code')); ?>",
                  "price": "<?php echo e($property_data->price); ?>",
                  "address": {
                    "@type": "PostalAddress",
                    "streetAddress": "<?php echo e(stripslashes($property_data->address)); ?>",
                    "addressLocality": "<?php echo e(isset($property_data->locations->name)?$property_data->locations->name:''); ?>",
                    "postalCode": "",
                    "addressCountry": ""
                  }  
                   
            }<?php echo e($separator); ?>

 
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                 
        ]
    }
    </script>
   
<!--Breadcrumb section starts-->
<div class="breadcrumb-section bg-xs" style="background-image: url(<?php echo e(URL::asset('site_assets/images/breadcrumb-1.jpg')); ?>)">
    <div class="overlay op-2"></div>
    <div class="container">
      <div class="row">
        <div class="col-md-8 offset-md-2 text-center">
          <div class="breadcrumb-menu">
            <h2><?php echo e(get_user_info($owner_id,'name')); ?> - <?php echo e(trans('words.property_text')); ?> </h2>
            <span><a href="<?php echo e(URL::to('/')); ?>" title="<?php echo e(trans('words.home')); ?>"><?php echo e(trans('words.home')); ?></a></span> <span><?php echo e(get_user_info($owner_id,'name')); ?> - <?php echo e(trans('words.property_text')); ?></span> 
		      </div>
        </div>
      </div>
    </div>
  </div>
  <!--Breadcrumb section ends--> 

  <!-- Add banner Section -->
  <?php if(get_web_banner('list_top')!=""): ?>      
      <div class="add_banner_section pb-0">
        <div class="container">
          <div class="row">
              <div class="col-md-12">
              <?php echo stripslashes(get_web_banner('list_top')); ?>

            </div>
          </div>  
        </div>
      </div>
  <?php endif; ?>   
  <!-- Add banner Section -->

  <!-- Agent section starts -->
  <div class="agent-section pt-30 pb-20">
    <div class="container">
      <div class="row">
        <div class="col-xl-8 order-xl-12 order-xl-2 order-2">
          <div class="vfx-agent-details-wrapper">
            <div class="row mb-50">
              <div class="col-lg-4 col-md-6 col-sm-5"> 
              <?php if(file_exists(URL::to('upload/'.get_user_info($owner_id,'user_image')))): ?>
                <img src="<?php echo e(\URL::to('upload/'.get_user_info($owner_id,'user_image'))); ?>" alt="user" title="user" class="img-responsive"> 
              <?php else: ?>
              <img src="<?php echo e(\URL::to('site_assets/images/user-default.jpg')); ?>" alt="user" title="user" class="img-responsive">
              <?php endif; ?> 
                 
              </div>
              <div class="col-lg-8 col-md-6 col-sm-7">
                <div class="vfx-agent-details">
                  <h3><?php echo e(get_user_info($owner_id,'name')); ?></h3>
                  <ul class="vfx-address-list">                    
                    <li><span>Phone: </span> <?php echo e(get_user_info($owner_id,'phone')); ?></li>
                    <li><span>Email: </span> <?php echo e(get_user_info($owner_id,'email')); ?></li>
                     
                  </ul>
                   
                </div>
              </div>
            </div>
            <div class="row">
              
              <div class="col-md-12">
                <h3><?php echo e(trans('words.property_text')); ?></h3>
                <div class="agent-listings">

                <div class="tab-pane fade show active property-grid" id="grid-view">
                  <div class="row">

                  
                  <?php $__currentLoopData = $property_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $property_data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <div class="col-md-6 col-sm-12">
                      <div class="vfx-single-property-box-area">
                        <div class="vfx-property-item"> <a class="vfx-property-img" href="<?php echo e(URL::to('properties/'.$property_data->slug.'/'.$property_data->id)); ?>" title="<?php echo e(stripslashes($property_data->title)); ?>"><img src="<?php echo e(\URL::to('/'.$property_data->image)); ?>" alt="#" title="<?php echo e(stripslashes($property_data->title)); ?>"> </a>
                          <ul class="vfx-feature-text">
                          <?php if($property_data->purpose=='Rent'): ?>
                          <li class="feature_cb"><span><?php echo e(trans('words.rent')); ?></span></li>
                          <?php else: ?>
                          <li class="feature_or"><span><?php echo e(trans('words.sale')); ?></span></li>
                          <?php endif; ?>	 
                          <?php if($property_data->verified=='YES'): ?>
                          <li class="feature_cb verified_item"><i class="fa fa-check 1" data-toggle="tooltip" data-placement="top" title="" data-original-title="<?php echo e(trans('words.verified')); ?>"></i></li>
                          <?php endif; ?>
                          </ul>
                          <div class="vfx-property-author-wrap"> 
                          <p class="text-tlt"><?php echo e($property_data->types->type_name); ?></p>
                          <ul class="vfx-save-btn">

                          <?php if(check_favourite("Property",$property_data->id,isset(Auth::user()->id)?Auth::user()->id:"")): ?> 
                            <li data-toggle="tooltip" data-placement="top" title="" data-original-title="Favourite" class="favourite_property favourite_title_id<?php echo e($property_data->id); ?>" data-id="<?php echo e($property_data->id); ?>">
                              
                              <a href="Javascript:void(0);" title="fav"><i class="fa fa-heart favourite_icon_id<?php echo e($property_data->id); ?>"></i></a>
                              
                            </li>
                          <?php else: ?>
                            <li data-toggle="tooltip" data-placement="top" title="" data-original-title="Set Favourite" class="favourite_property favourite_title_id<?php echo e($property_data->id); ?>" data-id="<?php echo e($property_data->id); ?>">
                               
                              <a href="Javascript:void(0);" title="fav"><i class="fa fa-heart-o favourite_icon_id<?php echo e($property_data->id); ?>"></i></a>
                               
                            </li>                          
                          <?php endif; ?>
                          </ul>
                        </div>
                        </div>
                        <div class="vfx-property-title-box-area">
                          <h4><a href="<?php echo e(URL::to('properties/'.$property_data->slug.'/'.$property_data->id)); ?>" title="<?php echo e(stripslashes($property_data->title)); ?>"><?php echo e(Str::limit(stripslashes($property_data->title),30)); ?></a></h4>
                          <div class="vfx-property-location"> <i class="fa fa-map-marker"></i>
                            <p>
                            <?php if(isset($property_data->locations->name) AND $property_data->locations->name!=""): ?>
                              <?php echo e($property_data->locations->name); ?>

                            <?php else: ?>
                              <?php echo e(Str::limit(stripslashes($property_data->address),40)); ?>

                            <?php endif; ?>
                            </p>
                          </div>
                          <div class="trending-bottom">
                            <div class="trend-left float-left">
                              <div class="vfx-property-author-wrap"> <a href="<?php echo e(URL::to('properties/owner/'.$property_data->user_id)); ?>" class="property-author" title="<?php echo e(stripslashes($property_data->title)); ?>"> 
                                  
                              <?php if($property_data->users->user_image): ?>
                                <img src="<?php echo e(\URL::to('upload/'.$property_data->users->user_image)); ?>" alt="user_image" title="<?php echo e(stripslashes($property_data->title)); ?>"> 
                              <?php else: ?>
                              <img src="<?php echo e(\URL::to('site_assets/images/user-default.jpg')); ?>" alt="user_image" title="<?php echo e(stripslashes($property_data->title)); ?>">
                              <?php endif; ?>

                              <span><?php echo e($property_data->users->name); ?></span> </a></div>
                            </div>
                            <a href="<?php echo e(URL::to('properties/'.$property_data->slug.'/'.$property_data->id)); ?>" class="vfx-trend-right float-right">
                              <div class="vfx-trend-open-price"><?php echo e(html_entity_decode(getCurrencySymbols(getcong('currency_code')))); ?><?php echo e(number_format($property_data->price)); ?></div>
                            </a> 
                            </div>
                        </div>
                      </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                     
                    
                  </div>
                </div>

                <!--pagination starts-->
                <div class="post-nav nav-res pt-20">
                  <div class="row">
                  
                      <?php echo $__env->make('_particles.pagination', ['paginator' => $property_list], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> 

                  </div>
                </div>
                <!--pagination ends-->

                <?php if(get_web_banner('list_bottom')!=""): ?>      
                    <div class="add_banner_section pb-0">
                      <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                            <?php echo stripslashes(get_web_banner('list_bottom')); ?>

                          </div>
                        </div>  
                      </div>
                    </div>
                <?php endif; ?>
                   
                </div>
              </div>
            </div>
          </div>
        </div>


        <?php echo $__env->make("pages.sidebar_right", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

         
      </div>
    </div>
  </div>
  <!-- Agent section ends --> 
  
  <!-- Scroll to top starts--> 
  <span class="vfx-scroll-top-btn"><i class="lnr lnr-arrow-up"></i></span> 
  <!-- Scroll to top ends--> 
</div>
<!--Page Wrapper ends--> 
   
 
<?php $__env->stopSection(); ?>
<?php echo $__env->make('site_app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/dextragr/public_html/realestate.dextragroups.com/resources/views/pages/property/owner_list.blade.php ENDPATH**/ ?>