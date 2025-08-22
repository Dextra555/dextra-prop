<?php $__env->startSection('head_title', trans('words.dashboard_text').' | '.getcong('site_name') ); ?>

<?php $__env->startSection('head_url', Request::url()); ?>

<?php $__env->startSection('content'); ?>
  

<!--Breadcrumb section starts-->
<div class="breadcrumb-section bg-xs" style="background-image: url(<?php echo e(URL::asset('site_assets/images/breadcrumb-1.jpg')); ?>)">
    <div class="overlay op-2"></div>
    <div class="container">
      <div class="row">
        <div class="col-md-12 text-center">
          <div class="breadcrumb-menu">
            <h2><?php echo e(trans('words.dashboard_text')); ?></h2>
            <span><a href="<?php echo e(URL::to('/')); ?>"><?php echo e(trans('words.home')); ?></a></span> <span><?php echo e(trans('words.dashboard_text')); ?></span></div>
        </div>
      </div>
    </div>
  </div>
  <!--Breadcrumb section ends--> 
  
  <!--Dashboard section starts-->
  <div class="about-section pt-30 pb-20">
    <div class="container">
      <div class="row">
         <div class="col-lg-12 col-md-12">
			  <div class="vfx-statistic-wrap-area">
				<div class="row">
					<div class="col-xl-3 col-md-6 col-12">
						<a href="<?php echo e(URL::to('user/property')); ?>">
						<div class="vfx-statistic-item vfx-item-blue-violet">
							<div class="icon">
								<i class="fa fa-home"></i>
							</div>
							<h2 class="counter-value"><?php echo e($property_total); ?></h2>
							<span class="desc"><?php echo e(trans('words.total_properties')); ?></span>                                
						</div>
						</a>
					</div>
					<div class="col-xl-3 col-md-6 col-12">
						<a href="<?php echo e(URL::to('user/property')); ?>">
						<div class="vfx-statistic-item vfx-item-green">
							<div class="icon">
								<i class="fa fa-home"></i>
							</div>
							<h2 class="counter-value"><?php echo e($property_active); ?></h2>
							<span class="desc"><?php echo e(trans('words.active_properties')); ?></span>                                
						</div>
						</a>
					</div>
					<div class="col-xl-3 col-md-6 col-12">
						<a href="<?php echo e(URL::to('user/property')); ?>">
						<div class="vfx-statistic-item vfx-item-orange">
							<div class="icon">
								<i class="fa fa-home"></i>
							</div>
							<h2 class="counter-value"><?php echo e($property_pending); ?></h2>
							<span class="desc"><?php echo e(trans('words.pending_properties')); ?></span>                                
						</div>
						</a>
					</div>
					<div class="col-xl-3 col-md-6 col-12">
						<a href="<?php echo e(URL::to('user/favourites')); ?>">
						<div class="vfx-statistic-item vfx-item-blue">
							<div class="icon">
								<i class="fa fa-heart"></i>
							</div>
							<h2 class="counter-value"><?php echo e($favourite_total); ?></h2>
							<span class="desc"><?php echo e(trans('words.favourites')); ?></span>                                
						</div>
						</a>
					</div>
				</div>
			</div>
		
			<div class="vfx-dashboard-content-area">
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					   <div class="profile-section">
						 <div class="row">
							<div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
							  <div class="member-ship-option">
							  <h5 class="color-up"><?php echo e(trans('words.my_subscription')); ?></h5>
							  <?php if($user->plan_id!=0): ?>
								<span class="premuim-memplan-bold-text"><strong><?php echo e(trans('words.current_plan')); ?>:</strong><span><?php echo e(\App\SubscriptionPlan::getSubscriptionPlanInfo($user->plan_id,'plan_name')); ?></span></span>

								<span class="premuim-memplan-bold-text"><strong><?php echo e(trans('words.property_limit')); ?>:</strong><span><?php echo e(\App\SubscriptionPlan::getSubscriptionPlanInfo($user->plan_id,'plan_property_limit')); ?></span></span>				

								<?php if($user->exp_date): ?>
								<span class="premuim-memplan-bold-text"><strong><?php echo e(trans('words.subscription_expires_on')); ?>:</strong><span><?php echo e(date('F,  d, Y',$user->exp_date)); ?></span></span>
								<?php endif; ?>
 
								<a href="<?php echo e(URL::to('pricing')); ?>" class="btn vfx7 mt-2 mb-0 upgrad_plan"><?php echo e(trans('words.upgrade_plan')); ?></a>

								<?php else: ?>
								<a href="<?php echo e(URL::to('pricing')); ?>" class="btn vfx7 mt-2 mb-0 upgrad_plan"><?php echo e(trans('words.select_plan')); ?></a>	
								 
								<?php endif; ?>
 

							  </div>
							</div>
							<div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
							   <div class="member-ship-option">
								  <h5 class="color-up"><?php echo e(trans('words.last_invoice')); ?></h5>
								  <span class="premuim-memplan-bold-text"><strong><?php echo e(trans('words.date')); ?>:</strong>
								  	<?php if($user->start_date): ?>
									<span><?php echo e(date('F,  d, Y',$user->start_date)); ?></span>
									<?php endif; ?>
								  </span>
								  <span class="premuim-memplan-bold-text"><strong><?php echo e(trans('words.plan')); ?>:</strong>
								  	<?php if($user->plan_id): ?>
									<span><?php echo e(\App\SubscriptionPlan::getSubscriptionPlanInfo($user->plan_id,'plan_name')); ?></span>
									<?php endif; ?>
								  </span>
								  <span class="premuim-memplan-bold-text"><strong><?php echo e(trans('words.amount')); ?>:</strong>
								  	<?php if($user->plan_amount): ?>
									<span><?php echo e(number_format($user->plan_amount,2,'.', '')); ?></span>
									<?php endif; ?>
								  </span> 
							   </div>
							</div>
						  </div>
					   </div>
					</div>
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<div class="vfx-popular-listing">
							<div class="vfx-act-title mb-15">
								<h5><?php echo e(trans('words.user_plan_history')); ?></h5>
							</div>
							<div class="table-wrapper">
							  <table class="fl-table">
								<thead>
								  <tr>            
									<th><?php echo e(trans('words.plan')); ?></th>
									<th><?php echo e(trans('words.amount')); ?></th>
									<th><?php echo e(trans('words.payment_gateway')); ?></th>
									<th><?php echo e(trans('words.payment_id')); ?></th>
									<th><?php echo e(trans('words.payment_date')); ?></th>
								  </tr>
								</thead> 
								<tbody>
									<?php $__currentLoopData = $transactions_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $transaction_data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<tr>                      
										<td><span class="current-plan-item"><?php echo e(\App\SubscriptionPlan::getSubscriptionPlanInfo($transaction_data->plan_id,'plan_name')); ?></span></td>
										<td><?php echo e(html_entity_decode(getCurrencySymbols(getcong('currency_code')))); ?> <?php echo e(number_format($transaction_data->payment_amount,2)); ?></td>
										<td><?php echo e($transaction_data->gateway); ?></td>
										<td><?php echo e($transaction_data->payment_id); ?></td>    
										<td><span class="expires-plan-item"><?php echo e(date('M d Y h:i A',$transaction_data->date)); ?></span></td>            
								  	</tr>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						 
								</tbody>
							  </table>

							  <!--pagination starts-->
							<div class="post-nav nav-res pt-20">
								<div class="row">
								
								<?php echo $__env->make('_particles.pagination', ['paginator' => $transactions_list], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>	 

								</div>
							</div>
							<!--pagination ends-->

							  						

							</div>
						</div>
					</div>
				</div>
			</div>
        </div>
      </div>
    </div>
  </div>
  <!--Dashboard section ends--> 

  <script type="text/javascript">

	'use strict';
    
    <?php if(Session::has('flash_message')): ?>     
 
      const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: false,        
      })

      Toast.fire({
        icon: 'success',
        title: '<?php echo e(Session::get('flash_message')); ?>'
      })     
     
  <?php endif; ?>

  <?php if(Session::has('success')): ?>     
 
      const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: false,       
      })

      Toast.fire({
        icon: 'success',
        title: '<?php echo e(Session::get('success')); ?>'
      })     
     
  <?php endif; ?>

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
<?php echo $__env->make('site_app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/dextragr/public_html/realestate.dextragroups.com/resources/views/pages/user/dashboard.blade.php ENDPATH**/ ?>