

<?php $__env->startSection("content"); ?>
 
 
  <div class="content-page">
      <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-lg-12">
              <div class="card-box">
                  
               <?php echo e(html()->form('POST', url('/admin/recaptcha_settings'))
                     ->attributes(['class' => 'form-horizontal', 'id' => 'settings_form', 'name' => 'settings_form', 'role' => 'form', 'enctype' => 'multipart/form-data'])->open()); ?> 
 
                  
                  <input type="hidden" name="id" value="<?php echo e(isset($settings->id) ? $settings->id : null); ?>">
   
                 <h5 class="mb-4" style="color:#f9f9f9"><i class="fa fa-refresh pr-2"></i> <b><?php echo e(trans('words.recaptcha_settings')); ?></b></h5>
 
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label"><?php echo e(trans('words.site_key')); ?></label>
                    <div class="col-sm-8">
                      <input type="text" name="recaptcha_site_key" value="<?php echo e(isset($settings->recaptcha_site_key) ? $settings->recaptcha_site_key : null); ?>" class="form-control">
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label"><?php echo e(trans('words.secret_key')); ?></label>
                    <div class="col-sm-8">
                      <input type="text" name="recaptcha_secret_key" value="<?php echo e(isset($settings->recaptcha_secret_key) ? $settings->recaptcha_secret_key : null); ?>" class="form-control">
                    </div>
                  </div> 
                  <hr/>

                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label"><?php echo e(trans('words.display_on_login')); ?></label>
                      <div class="col-sm-8">
                            <select class="form-control" name="recaptcha_on_login">                               
                                 
                                <option value="1" <?php if($settings->recaptcha_on_login=="1"): ?> selected <?php endif; ?>><?php echo e(trans('words.on')); ?></option>
                                <option value="0" <?php if($settings->recaptcha_on_login=="0"): ?> selected <?php endif; ?>><?php echo e(trans('words.off')); ?></option>
                                              
                            </select>
                      </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label"><?php echo e(trans('words.display_on_signup')); ?></label>
                      <div class="col-sm-8">
                            <select class="form-control" name="recaptcha_on_signup">                               
                                 
                                <option value="1" <?php if($settings->recaptcha_on_signup=="1"): ?> selected <?php endif; ?>><?php echo e(trans('words.on')); ?></option>
                                <option value="0" <?php if($settings->recaptcha_on_signup=="0"): ?> selected <?php endif; ?>><?php echo e(trans('words.off')); ?></option>
                                              
                            </select>
                      </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label"><?php echo e(trans('words.recaptcha_on_forgot_pass')); ?></label>
                      <div class="col-sm-8">
                            <select class="form-control" name="recaptcha_on_forgot_pass">                               
                                 
                                <option value="1" <?php if($settings->recaptcha_on_forgot_pass=="1"): ?> selected <?php endif; ?>><?php echo e(trans('words.on')); ?></option>
                                <option value="0" <?php if($settings->recaptcha_on_forgot_pass=="0"): ?> selected <?php endif; ?>><?php echo e(trans('words.off')); ?></option>
                                              
                            </select>
                      </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label"><?php echo e(trans('words.recaptcha_on_contact_us')); ?></label>
                      <div class="col-sm-8">
                            <select class="form-control" name="recaptcha_on_contact_us">                               
                                 
                                <option value="1" <?php if($settings->recaptcha_on_contact_us=="1"): ?> selected <?php endif; ?>><?php echo e(trans('words.on')); ?></option>
                                <option value="0" <?php if($settings->recaptcha_on_contact_us=="0"): ?> selected <?php endif; ?>><?php echo e(trans('words.off')); ?></option>
                                              
                            </select>
                      </div>
                  </div>
                   
                  <div class="form-group">
                    <div class="offset-sm-3 col-sm-9 pl-1">
                      <button type="submit" class="btn btn-primary waves-effect waves-light"> <?php echo e(trans('words.save_settings')); ?> </button>                      
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
<?php echo $__env->make("admin.admin_app", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/dextragr/public_html/realestate.dextragroups.com/resources/views/admin/pages/settings/recaptcha.blade.php ENDPATH**/ ?>