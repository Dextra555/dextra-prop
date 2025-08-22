<?php $__env->startSection('head_title', trans('words.login_text').' | '.getcong('site_name') ); ?>

<?php $__env->startSection('head_url', Request::url()); ?>

<?php $__env->startSection('content'); ?>


<?php if(getcong('recaptcha_on_login')): ?>
<script src='https://www.google.com/recaptcha/api.js'></script>
<script>
function submitForm() {
    var response = grecaptcha.getResponse();
    if(response.length == 0) {
        document.getElementById('g-recaptcha-error').innerHTML = '<span style="color:red;">This field is required.</span>';
        return false;
    }
   
    return true;
}
 
function verifyCaptcha() {
    document.getElementById('g-recaptcha-error').innerHTML = '';
}
</script>
<?php endif; ?>
   
 
  <!--Breadcrumb section starts-->
  <div class="breadcrumb-section bg-xs" style="background-image: url(<?php echo e(URL::asset('site_assets/images/breadcrumb-1.jpg')); ?>)">
    <div class="overlay op-2"></div>
    <div class="container">
      <div class="row">
        <div class="col-md-8 offset-md-2 text-center">
          <div class="breadcrumb-menu">
            <h2><?php echo e(trans('words.login_text')); ?></h2>
            <span><a href="<?php echo e(URL::to('/')); ?>" title="<?php echo e(trans('words.home')); ?>"><?php echo e(trans('words.home')); ?></a></span> <span><?php echo e(trans('words.login_text')); ?></span></div>
        </div>
      </div>
    </div>
  </div>
  <!--Breadcrumb section ends--> 
  
  <!--Login starts-->
  <div class="about-section pt-30 pb-20">
    <div class="container">
      <div class="row">
        <div class="col-lg-5 mx-auto">
           <div class="login-wrapper">
			  <div class="ui-dash">

        <?php echo e(html()->form('POST', url('/login'))
                     ->attributes(['class' => '', 'id' => 'loginform','role' => 'form','onsubmit' => 'return submitForm();'])->open()); ?>

				   
					<div class="text-left vid_title mb-25">
                        <h4 class="font-weight-semi-bold"><?php echo e(trans('words.login_to_your_account')); ?></h4>    
                    </div>
					<div class="form-group">
					  <input type="text" name="email" id="email" tabindex="1" class="form-control" placeholder="<?php echo e(trans('words.email')); ?>" value="">
					</div>
					<div class="form-group">
					  <input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="<?php echo e(trans('words.password')); ?>">
					</div>
          <?php if(getcong('recaptcha_on_login')): ?>
            <div class="form-group">
               <div class="g-recaptcha" data-sitekey="<?php echo e(getcong('recaptcha_site_key')); ?>" data-callback="verifyCaptcha"></div>
               <div id="g-recaptcha-error"></div>
            </div>     
          <?php endif; ?>
					<div class="row mt-20">
					  <div class="col-md-6 col-6 text-left">
						<div class="res-box">
						  <input id="check-l" type="checkbox" name="remember">
						  <label for="check-l"><?php echo e(trans('words.remember_me')); ?></label>
						</div>
					  </div>
					  <div class="col-md-6 col-6 text-right">
						<div class="res-box sm-left"><a href="<?php echo e(URL::to('password/email')); ?>" tabindex="5" class="forgot-password" title="<?php echo e(trans('words.forgot_password')); ?>"><?php echo e(trans('words.forgot_password')); ?></a></div>
					  </div>
					</div>
					<div class="res-box text-center mt-2">
					  <button type="submit" class="btn vfx8"><?php echo e(trans('words.login_text')); ?></button>
					</div>
          <?php if(getcong('google_login')): ?>
					<div class="socail-login-item mx-auto w-100 text-center mt-3">
						<span class="text-3 text-orange text-center w-100 mx-auto"><strong><?php echo e(trans('words.continue_with')); ?></strong></span>
						<label class="mt-3 mb-0">
						   <a href="<?php echo e(url('auth/google')); ?>" class="btn btn-lg btn-success btn-block btn-google-login" title="google login"><img src="<?php echo e(URL::asset('site_assets/images/ic-google.svg')); ?>" alt="ic-google" title="ic-google" class="mr-2"><?php echo e(trans('words.sign_up_with_google')); ?></a>
						</label>
					</div>
          <?php endif; ?>
					<p class="mt-2 mb-0 text-center"><?php echo e(trans('words.dont_have_account')); ?> <a href="<?php echo e(url('signup')); ?>" class="btn-link" title="<?php echo e(trans('words.sign_up')); ?>"><?php echo e(trans('words.sign_up')); ?></a></p>
				  <?php echo e(html()->form()->close()); ?>

			   </div>
			</div>
         </div>
      </div>
    </div>
  </div>
  <!--Login ends-->  


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
  
  <?php if(Session::has('login_flash_error')): ?> 
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
  <?php endif; ?>

  </script>

 
<?php $__env->stopSection(); ?>
<?php echo $__env->make('site_app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/dextragr/public_html/realestate.dextragroups.com/resources/views/pages/user/login.blade.php ENDPATH**/ ?>