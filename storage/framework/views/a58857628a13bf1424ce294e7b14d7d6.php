<?php $__env->startSection('head_title', trans('words.pricing').' - '.getcong('site_name') ); ?>

<?php $__env->startSection('head_url', Request::url()); ?>

<?php $__env->startSection('content'); ?>
   
<!--Breadcrumb section starts-->
<div class="breadcrumb-section bg-xs" style="background-image: url(<?php echo e(URL::asset('site_assets/images/breadcrumb-1.jpg')); ?>)">
    <div class="overlay op-2"></div>
    <div class="container">
      <div class="row">
        <div class="col-md-8 offset-md-2 text-center">
          <div class="breadcrumb-menu">
            <h2><?php echo e(trans('words.pricing')); ?> </h2>
            <span><a href="<?php echo e(URL::to('/')); ?>" title="<?php echo e(trans('words.home')); ?>"><?php echo e(trans('words.home')); ?></a></span> <span><?php echo e(trans('words.pricing')); ?></span> 
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

   <!--Subscription Plan starts-->
   <div class="about-section pt-30 pb-10">
    <div class="container">
      <div class="row">
      
      <?php $__currentLoopData = $plan_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $plan_data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>  
          <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
            <div class="membership-plan-list">
            <h3><?php echo e($plan_data->plan_name); ?></h3>
            <h1><span><?php echo e(html_entity_decode(getCurrencySymbols(getcong('currency_code')))); ?></span><?php echo e($plan_data->plan_price); ?></h1>
            <ul>
              
              <li><?php echo e(trans('words.validity')); ?>: <span><?php echo e(App\SubscriptionPlan::getPlanDuration($plan_data->id)); ?></span></li>
              <li><?php echo e(trans('words.property_limit')); ?> : <span><?php echo e($plan_data->plan_property_limit); ?></span></li>
            </ul>
            <a href="<?php echo e(URL::to('payment_method/'.$plan_data->id)); ?>" class="btn vfx7 mb-15" title="<?php echo e(trans('words.select_plan')); ?>"><?php echo e(trans('words.select_plan')); ?></a>
          </div>
          </div>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

		  
     </div>

      <!-- Add banner Section -->
    <?php if(get_web_banner('other_page_bottom')!=""): ?>      
      <div class="add_banner_section pb-15">
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
  <!--Subscription Plan ends--> 

  <script type="text/javascript">
    
  <?php if(Session::has('error_flash_message')): ?>     
 
      const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: false,        
      })

      Toast.fire({
        icon: 'error',
        title: '<?php echo e(Session::get('error_flash_message')); ?>'
      })     
     
  <?php endif; ?>
 
  </script>

  <?php $__env->stopSection(); ?>
<?php echo $__env->make('site_app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/dextragr/public_html/realestate.dextragroups.com/resources/views/pages/payment/pricing.blade.php ENDPATH**/ ?>