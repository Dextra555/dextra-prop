<?php $__env->startSection('head_title', trans('words.sign_up').' | '.getcong('site_name') ); ?>

<?php $__env->startSection('head_url', Request::url()); ?>

<?php $__env->startSection('content'); ?>

<?php if(getcong('recaptcha_on_signup')): ?>
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
            <h2><?php echo e(trans('words.sign_up')); ?></h2>
            <span><a href="<?php echo e(URL::to('/')); ?>" title="<?php echo e(trans('words.home')); ?>"><?php echo e(trans('words.home')); ?></a></span> <span><?php echo e(trans('words.sign_up')); ?></span></div>
        </div>
      </div>
    </div>
  </div>
  <!--Breadcrumb section ends--> 
  
  <!--Register starts-->
  <div class="about-section pt-30 pb-20">
    <div class="container">
      <div class="row">
        <div class="col-lg-5 mx-auto">
           <div class="login-wrapper">
			  <div class="ui-dash">
        <?php echo e(html()->form('POST', url('/signup'))
                     ->attributes(['class' => '', 'id' => 'signupform','role' => 'form','onsubmit' => 'return submitForm();'])->open()); ?>


          
					<div class="text-left vid_title mb-25">
                        <h4 class="font-weight-semi-bold"><?php echo e(trans('words.sign_up')); ?></h4>    
                    </div>
					<div class="form-group">
					  <input type="text" name="name" id="name" tabindex="1" class="form-control" placeholder="<?php echo e(trans('words.name')); ?>" value="<?php echo e(old('name')); ?>">
					</div>
					<div class="form-group">
					  <input type="email" name="email" id="email" tabindex="1" class="form-control" placeholder="<?php echo e(trans('words.email')); ?>" value="<?php echo e(old('email')); ?>">
					</div>
					<div class="form-group">
					  <input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="<?php echo e(trans('words.password')); ?> <?php echo e(trans('words.at_least_8_char')); ?>">
					</div>
					<div class="form-group">
					  <input type="password" name="password_confirmation" id="password_confirmation" tabindex="2" class="form-control" placeholder="<?php echo e(trans('words.confirm_password')); ?>">
					</div>
          <?php if(getcong('recaptcha_on_signup')): ?>
            <div class="form-group">
               <div class="g-recaptcha" data-sitekey="<?php echo e(getcong('recaptcha_site_key')); ?>" data-callback="verifyCaptcha"></div>
               <div id="g-recaptcha-error"></div>
            </div>     
          <?php endif; ?>

					<div class="res-box text-left">
					  <input type="checkbox" tabindex="3" class="" name="remember" id="remember" checked onclick="return false">
					  <label for="remember"><?php echo e(trans('words.by_signing_accept')); ?> <a href="<?php echo e(URL::to('page/'.\App\Pages::getPageInfo(3,'page_slug'))); ?>" class="btn-link" target="_blank" title="privacy"><?php echo e(\App\Pages::getPageInfo(3,'page_title')); ?></a></label>
					</div>
					<div class="res-box text-center mt-2">
					  <button type="submit" class="btn vfx8"><?php echo e(trans('words.sign_up')); ?></button>
					</div>
					<p class="mt-2 mb-0 text-center"><?php echo e(trans('words.already_have_account')); ?> <a href="<?php echo e(url('login')); ?>" class="btn-link"><?php echo e(trans('words.login_text')); ?></a></p>
				  <?php echo e(html()->form()->close()); ?>

			   </div>
			</div>
         </div>
      </div>
    </div>
  </div>
  <!--Register ends--> 
 
<script type="text/javascript">
    
    'use strict';

    <?php if(Session::has('signup_flash_message')): ?>     
 
      const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: false,         
      })

      Toast.fire({
        icon: 'success',
        title: '<?php echo e(Session::get('signup_flash_message')); ?>'
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
        icon: 'success',
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
<?php echo $__env->make('site_app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/dextragr/public_html/realestate.dextragroups.com/resources/views/pages/user/signup.blade.php ENDPATH**/ ?>