

<?php $__env->startSection("content"); ?>

  <div class="content-page">
      <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-xl-12">
              <div class="card-box">
                 
              <?php echo e(html()->form('POST', url('/admin/verify_purchase_app'))
                     ->attributes(['class' => 'form-horizontal', 'id' => 'post_form', 'name' => 'post_form', 'role' => 'form', 'enctype' => 'multipart/form-data'])->open()); ?>

 
                    
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Envato Username *</label>
                    <div class="col-sm-8">
                       <input type="text" name="buyer_name" value="<?php echo e(env('BUYER_NAME')); ?>" class="form-control">
                    </div>
                  </div>                   
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Buyer Purchase Code *</label>
                    <div class="col-sm-8">
                       <input type="text" name="purchase_code" value="<?php echo e(env('BUYER_PURCHASE_CODE')); ?>" class="form-control" value="">
                       <small id="emailHelp" class="form-text text-muted">If you don't know <a href="https://help.market.envato.com/hc/en-us/articles/202822600-Where-Is-My-Purchase-Code-" target="_blank">click here</a></small>
                    </div>
                  </div>                   
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">App Package Name *</label>
                    <div class="col-sm-8">
                       <input type="text" name="app_package_name" value="<?php echo e($settings->app_package_name); ?>" class="form-control">
                    </div>
                  </div> 
                  <div class="form-group">
                    <div class="offset-sm-3 col-sm-9 pl-1">
                      <button type="submit" class="btn btn-primary waves-effect waves-light"> <?php echo e(trans('words.save')); ?> </button>                      
                    </div>
                  </div>
                 
                  <?php echo e(html()->form()->close()); ?>


                  <div class="alert alert-info">
                       
                        <b>Note:</b>  Use app purchase code only, not work with script purchase code.
                  </div>

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
<?php echo $__env->make("admin.admin_app", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/dextragr/public_html/realestate.dextragroups.com/resources/views/admin/pages/android/verify_purchase_app.blade.php ENDPATH**/ ?>