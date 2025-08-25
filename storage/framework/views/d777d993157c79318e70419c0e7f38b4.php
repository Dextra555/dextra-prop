

<?php $__env->startSection("content"); ?>
 
 
  <div class="content-page">
      <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-lg-12">
              <div class="card-box">
                   
                 <?php echo e(html()->form('POST', url('/admin/users/add_edit'))
                     ->attributes(['class' => 'form-horizontal', 'id' => 'post_form', 'name' => 'post_form', 'role' => 'form', 'enctype' => 'multipart/form-data'])->open()); ?>

                  
                  <input type="hidden" name="id" value="<?php echo e(isset($user->id) ? $user->id : null); ?>">
 
                   
                   
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label"><?php echo e(trans('words.name')); ?></label>
                    <div class="col-sm-8">
                      <input type="text" name="name" value="<?php echo e(isset($user->name) ? $user->name : null); ?>" class="form-control">
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label"><?php echo e(trans('words.email')); ?></label>
                    <div class="col-sm-8">
                      <input type="text" name="email" value="<?php echo e(isset($user->email) ? $user->email : null); ?>" class="form-control">
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label"><?php echo e(trans('words.password')); ?></label>
                    <div class="col-sm-8">
                      <input type="password" name="password" value="" class="form-control">
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label"><?php echo e(trans('words.phone')); ?></label>
                    <div class="col-sm-8">
                      <input type="text" name="phone" value="<?php echo e(isset($user->phone) ? $user->phone : null); ?>" class="form-control">
                    </div>
                  </div>

                 
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label"><?php echo e(trans('words.image')); ?></label>
                    <div class="col-sm-8">
                      <input type="file" name="user_image" class="form-control">                     
                    </div>
                  </div>

                  <?php if(isset($user->user_image)): ?> 
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">&nbsp;</label>
                    <div class="col-sm-8">
                      <img src="<?php echo e(URL::to('upload/'.$user->user_image)); ?>" alt="video image" class="img-thumbnail" width="140">       
                    </div>
                  </div>
                  <?php endif; ?>    
                  
                  <div class="form-group row">
                    <label class="control-label col-sm-3"><?php echo e(trans('words.expiry_date')); ?></label>
                    <div class="col-sm-8">
                      <div class="input-group"> 
                        <input type="text" id="datepicker-autoclose" name="exp_date" value="<?php echo e(isset($user->exp_date) ? date('m/d/Y',$user->exp_date) : null); ?>" class="form-control" placeholder="mm/dd/yyyy" autocomplete="off">
                         
                      </div>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label"><?php echo e(trans('words.subscription_plan')); ?></label>
                      <div class="col-sm-8">
                            <select class="form-control" name="subscription_plan">                               
                                <?php $__currentLoopData = $plan_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $plan_data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                  <option value="<?php echo e($plan_data->id); ?>" <?php if(isset($user->plan_id) AND $user->plan_id==$plan_data->id): ?> selected <?php endif; ?>><?php echo e($plan_data->plan_name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                            
                            </select>
                      </div>
                  </div>
                                  
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label"><?php echo e(trans('words.status')); ?></label>
                      <div class="col-sm-8">
                            <select class="form-control" name="status">                               
                                <option value="1" <?php if(isset($user->status) AND $user->status==1): ?> selected <?php endif; ?>><?php echo e(trans('words.active')); ?></option>
                                <option value="0" <?php if(isset($user->status) AND $user->status==0): ?> selected <?php endif; ?>><?php echo e(trans('words.inactive')); ?></option>                            
                            </select>
                      </div>
                  </div>

                  <div class="form-group">
                    <div class="offset-sm-3 col-sm-9 pl-1">
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
<?php echo $__env->make("admin.admin_app", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\USER\Documents\Dextra Properties\realestate.dextragroups.com\realestate.dextragroups.com\resources\views/admin/pages/users/addedit.blade.php ENDPATH**/ ?>