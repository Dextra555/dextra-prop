<?php $__env->startSection('head_title', stripslashes($page_info->page_title).' - '. getcong('site_name') ); ?>

<?php $__env->startSection('head_url', Request::url()); ?>

<?php $__env->startSection('content'); ?>

<!--Breadcrumb section starts-->
<div class="breadcrumb-section bg-xs" style="background-image: url(<?php echo e(URL::asset('site_assets/images/breadcrumb-1.jpg')); ?>)">
    <div class="overlay op-2"></div>
    <div class="container">
      <div class="row">
        <div class="col-md-8 offset-md-2 text-center">
          <div class="breadcrumb-menu">
            <h2><?php echo e(stripslashes($page_info->page_title)); ?></h2>
            <span><a href="<?php echo e(URL::to('/')); ?>"><?php echo e(trans('words.home')); ?></a></span> <span><?php echo e(stripslashes($page_info->page_title)); ?></span> 
		      </div>
        </div>
      </div>
    </div>
  </div>
  <!--Breadcrumb section ends--> 

  <!-- Add banner Section -->
  <?php if(get_web_banner('other_page_top')!=""): ?>      
      <div class="add_banner_section pb-0">
        <div class="container">
          <div class="row">
              <div class="col-md-12">
              <?php echo stripslashes(get_web_banner('other_page_top')); ?>

            </div>
          </div>  
        </div>
      </div>
  <?php endif; ?>   
  <!-- Add banner Section -->


    <!--Always Provide Section starts-->
    <div class="about-section pt-30 pb-20">
    <div class="container">
      <div class="row align-items-center">
	    <div class="col-lg-5 col-md-12 mb-20">
			<img src="<?php echo e(\URL::to('/'.$page_info->page_about_image)); ?>" alt="about_img" title="about_img">
		</div>
        <div class="col-lg-7 col-md-12">
          <div class="about-text res-box"> 
                <?php echo stripslashes($page_info->page_content); ?>

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
              <?php echo stripslashes($page_info->page_about_text2); ?>

          </div>
        </div>
		<div class="col-lg-6 col-md-12">
			<div class="popup-vid pt-2 pb-2"> 
				<img src="<?php echo e(\URL::to('/'.$page_info->page_about_image2)); ?>" alt="about-img" title="about-img" class="popup-img rounded"> 				 
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
						<h3><?php echo e(trans('words.list_your_properties')); ?> <?php echo e(getcong('site_name')); ?>!</h3>
						 
					</div>
					<a href="<?php echo e(URL::to('/signup')); ?>" class="btn vfx6" title="<?php echo e(trans('words.join_now')); ?>"><?php echo e(trans('words.join_now')); ?></a>
				</div>
			</div>
		</div>
	</div>
  </div>
  <!--Want to Become Section ends--> 


  <!-- Add banner Section -->
  <?php if(get_web_banner('other_page_bottom')!=""): ?>      
      <div class="add_banner_section pb-20">
        <div class="container">
          <div class="row">
              <div class="col-md-12">
              <?php echo stripslashes(get_web_banner('other_page_bottom')); ?>

            </div>
          </div>  
        </div>
      </div>
    <?php endif; ?>   
  <!-- Add banner Section -->
 
 

<?php $__env->stopSection(); ?>
<?php echo $__env->make('site_app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/dextragr/public_html/realestate.dextragroups.com/resources/views//pages/extra/about.blade.php ENDPATH**/ ?>