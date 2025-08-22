

<?php $__env->startSection("content"); ?>
 
 
  <div class="content-page">
      <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-lg-12">
              <div class="card-box">

              <div class="row">
                 <div class="col-sm-6">
                      <a href="<?php echo e(URL::to('admin/subscription_plan')); ?>"><h4 class="header-title m-t-0 m-b-30 text-primary pull-left" style="font-size: 20px;"><i class="fa fa-arrow-left"></i> <?php echo e(trans('words.back')); ?></h4></a>
                 </div>                  
                </div>
                  
                <?php echo e(html()->form('POST', url('/admin/subscription_plan/add_edit'))
                     ->attributes(['class' => 'form-horizontal', 'id' => 'post_form', 'name' => 'post_form', 'role' => 'form', 'enctype' => 'multipart/form-data'])->open()); ?>

 
                  
                  <input type="hidden" name="id" value="<?php echo e(isset($plan_info->id) ? $plan_info->id : null); ?>">
  
                   
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label"><?php echo e(trans('words.plan_name')); ?> *</label>
                    <div class="col-sm-8">
                      <input type="text" name="plan_name" value="<?php echo e(isset($plan_info->plan_name) ? $plan_info->plan_name : null); ?>" class="form-control">
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label"><?php echo e(trans('words.duration')); ?> *</label>
                    <div class="col-sm-4">
                      <input type="number" name="plan_duration" value="<?php echo e(isset($plan_info->plan_duration) ? $plan_info->plan_duration : null); ?>" class="form-control" placeholder="7">
                    </div>
                    <div class="col-sm-4">
                        <select name="plan_duration_type" class="form-control">
                         <option value="1" <?php if(isset($plan_info->plan_duration_type) AND $plan_info->plan_duration_type=='1'): ?> selected <?php endif; ?>>Day(s)</option>
                         <option value="30" <?php if(isset($plan_info->plan_duration_type) AND $plan_info->plan_duration_type=='30'): ?> selected <?php endif; ?>>Month(s)</option>
                         <option value="365" <?php if(isset($plan_info->plan_duration_type) AND $plan_info->plan_duration_type=='365'): ?> selected <?php endif; ?>>Year(s)</option>
                        </select>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label"><?php echo e(trans('words.price')); ?> *</label>
                    <div class="col-sm-8">
                      <input type="number" name="plan_price" value="<?php echo e(isset($plan_info->plan_price) ? $plan_info->plan_price : null); ?>" class="form-control" placeholder="9.99" min="0" step="0.1">
                      <small id="emailHelp" class="form-text text-muted mb-2">The minimum amount for processing a transaction through Stripe in USD is $0.50. For more info <a href="https://support.chargebee.com/support/solutions/articles/228511-transaction-amount-limit-in-stripe" target="_blank">click here</a></small>
                    </div>
                  </div>
                  
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label"><?php echo e(trans('words.property_limit')); ?> *</label>
                    <div class="col-sm-8">
                      <input type="number" name="plan_property_limit" value="<?php echo e(isset($plan_info->plan_property_limit) ? $plan_info->plan_property_limit : null); ?>" class="form-control" placeholder="5" min="1" step="1">
                       
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label"><?php echo e(trans('words.status')); ?></label>
                      <div class="col-sm-8">
                            <select class="form-control" name="status">                               
                                <option value="1" <?php if(isset($plan_info->status) AND $plan_info->status==1): ?> selected <?php endif; ?>><?php echo e(trans('words.active')); ?></option>
                                <option value="0" <?php if(isset($plan_info->status) AND $plan_info->status==0): ?> selected <?php endif; ?>><?php echo e(trans('words.inactive')); ?></option>                            
                            </select>
                      </div>
                  </div>

                  <div class="form-group row mb-0">
                     
                  </div>

                  <div class="form-group">
                    <div class="offset-sm-2 col-sm-9 pl-1">
                      <button type="submit" class="btn btn-primary waves-effect waves-light"> <?php echo e(trans('words.save')); ?> </button>                      
                    </div>
                  </div>
                  <?php echo e(html()->form()->close()); ?>

              </div>
            </div>            
          </div>              
        </div>
      </div>
      <?php echo $__env->make("admin.copyright", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> 
    </div> 
 
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

  <?php if(count($errors) > 0): ?>
                  
          Swal.fire({
            icon: 'error',
            title: 'Oops...',
            html: '<p><?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <?php echo e($error); ?><br/> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></p>',
            showConfirmButton: true,
            confirmButtonColor: '#10c469',
            background:"#1a2234",
            color:"#fff"
           }) 
  <?php endif; ?>

  </script> 

<?php $__env->stopSection(); ?>
<?php echo $__env->make("admin.admin_app", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/dextragr/public_html/realestate.dextragroups.com/resources/views/admin/pages/plan/addedit.blade.php ENDPATH**/ ?>