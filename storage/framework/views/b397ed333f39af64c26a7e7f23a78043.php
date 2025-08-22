  <!-- Scroll to top starts--> 
  <span class="vfx-scroll-top-btn"><i class="lnr lnr-arrow-up"></i></span> 
  <!-- Scroll to top ends--> 
 

<!--Footer Starts-->
<div class="vfx-footer-wrapper vfx3">
  <div class="vfx-footer-top-area">
    <div class="container">
      <div class="row vfx-nav-folderized">
         
		  <div class="col-lg-4 col-md-4 sm-left">
          <div class="vfx-footer-content nav">
            <h2 class="title"><?php echo e(trans('words.quick_links')); ?></h2>
            <ul class="list res-list">

            <?php $__currentLoopData = \App\Pages::where('status','1')->where('page_position','Bottom')->orderBy('page_order')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page_data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><i class="fa fa-angle-right"></i> <a class="link-hov style2" href="<?php echo e(URL::to('page/'.$page_data->page_slug)); ?>" title="<?php echo e($page_data->page_title); ?>"><?php echo e($page_data->page_title); ?></a></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

				 
			      </ul>
          </div>
        </div>
        <div class="col-lg-4 col-md-4 sm-left">
          <div class="vfx-footer-content nav">
            <h2 class="title"><?php echo e(trans('words.contact_us')); ?></h2>
            <ul class="list vfx-footer-list mt-20">
                <?php if(getcong('contact_email')): ?>
                <li>
                  <div class="vfx-contact-info">
                    <div class="icon"> <i class="fa fa-envelope"></i> </div>
                    <div class="text"><a href="#" title="email"><?php echo e(stripslashes(getcong('contact_email'))); ?></a></div>
                  </div>
                </li>
                <?php endif; ?>
                <?php if(getcong('contact_phone')): ?>
                <li>
                  <div class="vfx-contact-info">
                    <div class="icon"> <i class="fa fa-phone"></i> </div>
                    <div class="text"><?php echo e(stripslashes(getcong('contact_phone'))); ?></div>
                  </div>
                </li>
                <?php endif; ?>
                <?php if(getcong('contact_address')): ?>
				        <li>
                  <div class="vfx-contact-info">
                    <div class="icon"> <i class="fa fa-map-marker"></i> </div>
                    <div class="text"><?php echo e(stripslashes(getcong('contact_address'))); ?></div>
                  </div>
                </li>
                <?php endif; ?>
              </ul>
          </div>
        </div>
        <div class="col-lg-4 col-md-4">
          <div class="vfx-footer-content">      
          <?php if(getcong('facebook_link') OR getcong('twitter_link') OR getcong('youtube_link') OR getcong('instagram_link')): ?>        
            <div class="vfx-footer-social-wrap">
              <h4 class="title"><?php echo e(trans('words.follow_us')); ?></h4>
              <ul class="vfx-social-button style2">
                <?php if(getcong('facebook_link')): ?>
                <li><a href="<?php echo e(stripslashes(getcong('facebook_link'))); ?>" title="facebook"><i class="fa fa-facebook-f"></i></a></li>
                <?php endif; ?>

                <?php if(getcong('twitter_link')): ?>
                <li><a href="<?php echo e(stripslashes(getcong('twitter_link'))); ?>" title="twitter"><i class="fa fa-twitter"></i></a></li>
                <?php endif; ?>

                <?php if(getcong('youtube_link')): ?>
                <li><a href="<?php echo e(stripslashes(getcong('youtube_link'))); ?>" title="youtube"><i class="fa fa-youtube"></i></a></li>				
                <?php endif; ?>
                
                <?php if(getcong('instagram_link')): ?>
                <li><a href="<?php echo e(stripslashes(getcong('instagram_link'))); ?>" title="instagram"><i class="fa fa-instagram"></i></a></li>
                <?php endif; ?>
              </ul>
            </div>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="vfx-footer-bottom-copyright-area">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-md-12">
          <p><?php echo e(stripslashes(getcong('site_copyright'))); ?></p>
        </div>
      </div>
    </div>
  </div>
</div>
<!--Footer ends--> 
 <?php /**PATH C:\Users\USER\Documents\Dextra Properties\realestate.dextragroups.com\realestate.dextragroups.com\resources\views/_particles/footer.blade.php ENDPATH**/ ?>