<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="<?php echo e(getcong('app_name')); ?> Admin">
  <meta name="author" content="Viaviwebtech">
  
  <?php if(getcong('app_logo')): ?>
  <link rel="shortcut icon" href="<?php echo e(URL::asset('/'.getcong('app_logo'))); ?>">
  <?php else: ?>
  <link rel="shortcut icon" href="<?php echo e(URL::asset('site_assets/images/favicon.png')); ?>">
  <?php endif; ?>
  <title><?php echo e(getcong('app_name')); ?> Admin</title>

  <!-- App css -->
 
  <link href="<?php echo e(URL::asset('admin_assets/css/bootstrap.min.css')); ?>" rel="stylesheet" type="text/css" />
  <link href="<?php echo e(URL::asset('admin_assets/css/icons.css')); ?>" rel="stylesheet" type="text/css" />
  <link href="<?php echo e(URL::asset('admin_assets/css/style.css')); ?>" rel="stylesheet" type="text/css" />
  <link href="<?php echo e(URL::asset('admin_assets/css/font-awesome.min.css')); ?>" rel="stylesheet" type="text/css" />
  
  <!-- SweetAlert2 -->
  <script src="<?php echo e(URL::asset('admin_assets/js/sweetalert2@11.js')); ?>"></script>
  
</head>

<body>
   
  <div class="clearfix"></div>
  <div class="wrapper-page">
    <div class="text-center">
       
      <?php if(getcong('admin_logo')): ?>
        <a class="navbar-brand" href="<?php echo e(URL::to('/admin')); ?>"> <img src="<?php echo e(URL::asset('/'.getcong('admin_logo'))); ?>" alt="Site Logo" width="150"> </a> 
      <?php else: ?>
        <a class="navbar-brand" href="<?php echo e(URL::to('/admin')); ?>"> <img src="<?php echo e(URL::asset('site_assets/images/logo.png')); ?>" alt="Site Logo"> </a>          
      <?php endif; ?>
     
    </div>
    <div class="m-t-20 card-box">
      <div class="text-center">
        <h3 class="text-uppercase font-bold m-b-0" style="color: #f9f9f9;"><?php echo e(trans('words.sign_in')); ?></h3>
  
      </div>
      <div class="p-10">
           
         <?php echo e(html()->form('POST', url('/admin/login'))
                     ->attributes(['class' => 'form-horizontal m-t-20', 'id' => 'loginform'])->open()); ?>


          <div class="form-group">
            <div class="col-xs-12">
              <input name="email" class="form-control" type="text" required placeholder="<?php echo e(trans('words.email')); ?>">
            </div>
          </div>
          <div class="form-group">
            <div class="col-xs-12">
              <input name="password" class="form-control" type="password" required placeholder="<?php echo e(trans('words.password')); ?>">
            </div>
          </div>
          <div class="form-group ">
            <div class="col-xs-12">
              <div class="checkbox checkbox-custom">
                <input id="checkbox-signup" type="checkbox" name="remember" value="remember">
                <label for="checkbox-signup"> <?php echo e(trans('words.remember_me')); ?> </label>
              </div>
            </div>
          </div>
          <div class="form-group text-center m-t-10">
            <div class="col-xs-12">
              <button class="btn btn-custom btn-bordred btn-block waves-effect waves-light" type="submit"><?php echo e(trans('words.login_text')); ?></button>
            </div>
          </div>
          <div class="form-group m-t-20 m-b-0 text-center">
            <div class="col-sm-12"> <a href="<?php echo e(URL::to('password/email')); ?>" class="text-muted"><i class="fa fa-lock m-r-5"></i>
                <?php echo e(trans('words.forgot_pass_text')); ?></a> </div>
          </div>
           
          <?php echo e(html()->form()->close()); ?>

      </div>
    </div>
  </div>

 
  <script src="<?php echo e(URL::asset('admin_assets/js/jquery.min.js')); ?>"></script>
  <script src="<?php echo e(URL::asset('admin_assets/js/bootstrap.min.js')); ?>"></script>   
 
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

</body>

</html><?php /**PATH /home/dextragr/public_html/realestate.dextragroups.com/resources/views/admin/index.blade.php ENDPATH**/ ?>