<?php $__env->startSection('head_title', trans('words.contact_us').' - '. getcong('site_name') ); ?>

<?php $__env->startSection('head_url', Request::url()); ?>

<?php $__env->startSection('content'); ?>


<?php if(getcong('recaptcha_on_contact_us')): ?>
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
            <h2><?php echo e(trans('words.contact_us')); ?></h2>
            <span><a href="<?php echo e(URL::to('/')); ?>"><?php echo e(trans('words.home')); ?></a></span> <span><?php echo e(trans('words.contact_us')); ?></span> 
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

 <!--Contact section starts-->
 <div class="container">
      <div class="row vfx1 pt-30 pb-30">
		  <div class="col-md-12 mb-20">
			  <div class="row">
				   <div class="col-lg-4 col-md-6">
						<div class="contact-info-item">
							<i class="fa fa-map-marker"></i>
							<h4><?php echo e(trans('words.address')); ?></h4>
							<p><?php echo e($page_info->page_contact_address); ?></p>
						</div>
					</div>
					<div class="col-lg-4 col-md-6">
						<div class="contact-info-item">
							<i class="fa fa-phone"></i>
							<h4><?php echo e(trans('words.contact_us')); ?></h4>
							<ul>
								<li><strong><?php echo e(trans('words.phone')); ?>: </strong> <a href="#"><?php echo e($page_info->page_contact_phone); ?></a></li>
								<li><strong><?php echo e(trans('words.email')); ?>: </strong> <a href="#"><?php echo e($page_info->page_contact_email); ?></a></li>
							</ul>
						</div>
					</div>
					<div class="col-lg-4 col-md-6">
						<div class="contact-info-item">
							<i class="fa fa-calendar"></i>
							<h4><?php echo e(trans('words.follow_us')); ?></h4>
							<ul class="vfx-social-button style2">
                <li><a href="<?php echo e(stripslashes(getcong('facebook_link'))); ?>" title="facebook"><i class="fa fa-facebook-f"></i></a></li>
                <li><a href="<?php echo e(stripslashes(getcong('twitter_link'))); ?>" title="twitter"><i class="fa fa-twitter"></i></a></li>
                <li><a href="<?php echo e(stripslashes(getcong('youtube_link'))); ?>" title="youtube"><i class="fa fa-youtube"></i></a></li>				 
                <li><a href="<?php echo e(stripslashes(getcong('instagram_link'))); ?>" title="instagram"><i class="fa fa-instagram"></i></a></li>
							</ul>
						</div>
					</div>
			  </div>  
		  </div>
		  <div class="col-md-6">
			<div class="section-title contact-itme-title vfx2">
				<h2><?php echo e(trans('words.get_in_touch')); ?></h2>
			</div>
      <?php echo e(html()->form('POST', url('/page/contact_send'))
                     ->attributes(['class' => 'contact_form_block', 'id' => 'contact_form', 'name' => 'contact_form', 'role' => 'form', 'enctype' => 'multipart/form-data','onsubmit' => 'return submitForm();'])->open()); ?>

             
             <div class="form-control-wrap">
				  <div class="row">
					  <div class="col-lg-6 col-md-6">	
						  <div class="form-group">
							<input type="text" class="form-control" id="name" placeholder="<?php echo e(trans('words.name')); ?>*" name="name">
						  </div>
					  </div>
					  <div class="col-lg-6 col-md-6">
						  <div class="form-group">
							<input type="email" class="form-control" id="email" placeholder="<?php echo e(trans('words.email')); ?>*" name="email">
						  </div>
					  </div>
				  </div>
				  <div class="row">
					  <div class="col-lg-6 col-md-6">	
						  <div class="form-group">
							<input type="text" class="form-control" id="phone" placeholder="<?php echo e(trans('words.phone')); ?>" name="phone">
						  </div>
					  </div>
					  <div class="col-lg-6 col-md-6">	
						  <div class="form-group">
							<input type="text" class="form-control" id="subject" placeholder="<?php echo e(trans('words.subject')); ?>*" name="subject">
						  </div>
					  </div>
				  </div>
				  <div class="row">
					  <div class="col-lg-12 col-md-12">
						  <div class="form-group">
							<textarea class="form-control" rows="4" name="message" id="message" placeholder="<?php echo e(trans('words.message')); ?>"></textarea>
						  </div>
					  </div>
				  </div>
          <?php if(getcong('recaptcha_on_contact_us')): ?>
            <div class="form-group">
               <div class="g-recaptcha" data-sitekey="<?php echo e(getcong('recaptcha_site_key')); ?>" data-callback="verifyCaptcha"></div>
               <div id="g-recaptcha-error"></div>
            </div>     
          <?php endif; ?>
				  <div class="row">
					  <div class="col-lg-12 col-md-12">
						  <div class="form-group">
							  <button type="submit" class="btn vfx7"><?php echo e(trans('words.send_message')); ?></button>
						  </div>
					  </div>
				  </div>
				</div>
        <?php echo e(html()->form()->close()); ?>

		 </div>
		 <div class="col-md-6">
			  <div class="contact-map">
				<?php echo stripslashes($page_info->page_contact_map); ?>

			  </div>
		 </div>
      </div>
  </div>
  <!--Contact section ends-->

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
<?php echo $__env->make('site_app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/dextragr/public_html/realestate.dextragroups.com/resources/views//pages/extra/contact.blade.php ENDPATH**/ ?>