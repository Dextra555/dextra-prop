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

<!--About section starts-->
<div class="about-section pt-30 pb-20">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 col-md-12">
          <div class="about-text res-box"> 
			<h3><?php echo e(stripslashes($page_info->page_title)); ?></h3>
            <p><?php echo stripslashes($page_info->page_content); ?></p>
          </div>
        </div>
      </div>

        <!-- Add banner Section -->
        <?php if(get_web_banner('other_page_bottom')!=""): ?>      
          <div class="add_banner_section pb-0">
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

    </div>
  </div>
  <!--About section ends--> 
 

<?php $__env->stopSection(); ?>
<?php echo $__env->make('site_app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/dextragr/public_html/realestate.dextragroups.com/resources/views//pages/extra/page.blade.php ENDPATH**/ ?>