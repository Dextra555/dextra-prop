<?php $__env->startSection('head_title', trans('words.favourite_properties').' | '.getcong('site_name') ); ?>

<?php $__env->startSection('head_url', Request::url()); ?>

<?php $__env->startSection('content'); ?>
 

  <!--Breadcrumb section starts-->
  <div class="breadcrumb-section bg-xs" style="background-image: url(<?php echo e(URL::asset('site_assets/images/breadcrumb-1.jpg')); ?>)">
    <div class="overlay op-2"></div>
    <div class="container">
      <div class="row">
        <div class="col-md-12 text-center">
          <div class="breadcrumb-menu">
            <h2><?php echo e(trans('words.favourite_properties')); ?></h2>
            <span><a href="<?php echo e(URL::to('/')); ?>"><?php echo e(trans('words.home')); ?></a></span> <span><?php echo e(trans('words.favourite_properties')); ?></span></div>
        </div>
      </div>
    </div>
  </div>
  <!--Breadcrumb section ends--> 

  <!--Favourite Property section starts-->
  <div class="about-section pt-30 pb-20">
    <div class="container">
      <div class="row">
         <div class="col-lg-12 col-md-12">
			<div class="vfx-recent-activity my-listing">                                
				<div class="vfx-viewd-item-wrap">
					<div class="row">
            <?php $__currentLoopData = $favourites_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $favourites): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

            <?php 
                $post_id=$favourites->post_id;

                $property_info= \App\Property::find($post_id);
            ?>
						<div class="col-lg-6 col-md-12" id="post_id_<?php echo e($post_id); ?>">
							<div class="vfx-most-viewed-item">
								<div class="vfx-most-viewed-img">
									<a href="<?php echo e(URL::to('properties/'.$property_info->slug.'/'.$property_info->id)); ?>" title="<?php echo e(stripslashes($property_info->title)); ?>"><img src="<?php echo e(\URL::to('/'.$property_info->image)); ?>" alt="image" title="image"></a>
									<ul class="vfx-feature-text">
                          <?php if($property_info->purpose=='Rent'): ?>
                          <li class="feature_cb"><span><?php echo e(trans('words.rent')); ?></span></li>
                          <?php else: ?>
                          <li class="feature_or"><span><?php echo e(trans('words.sale')); ?></span></li>
                          <?php endif; ?>
									</ul>
								</div>
								<div class="vfx-most-view-detail">
									<p class="text-tlt"><?php echo e($property_info->types->type_name); ?></p>
									<h3><a href="<?php echo e(URL::to('properties/'.$property_info->slug.'/'.$property_info->id)); ?>"><?php echo e(stripslashes($property_info->title)); ?></a></h3>
									<p class="vfx-list-address"><i class="fa fa-map-marker"></i>
                      <?php if(isset($property_info->locations->name) AND $property_info->locations->name!=""): ?>
                        <?php echo e($property_info->locations->name); ?>

                      <?php else: ?>
                      <?php echo e(Str::limit(stripslashes($property_info->address),40)); ?>

                      <?php endif; ?>  
                  </p>
									<div class="vfx-trend-open-price"><?php echo e(html_entity_decode(getCurrencySymbols(getcong('currency_code')))); ?><?php echo e(number_format($property_info->price)); ?></div>                                            
								</div>
								<div class="vfx-listing-button">
									<a href="#" data-id="<?php echo e($property_info->id); ?>" class="btn vfx4 fav_data_remove" data-toggle="tooltip" title="Delete"><i class="ion-android-delete"></i></a>
								</div>
							</div>
						</div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>					 
						 
					</div>
				</div>
			</div>	
         </div>
      </div>
    </div>
  </div>
  <!--Favourite Property section ends--> 
  
  <!-- Scroll to top starts--> 
  <span class="vfx-scroll-top-btn"><i class="lnr lnr-arrow-up"></i></span> 
  <!-- Scroll to top ends--> 

<script src="<?php echo e(URL::asset('site_assets/js/jquery.min.js')); ?>"></script>

<script type="text/javascript">
//Single
$(".data_remove").on('click', function () {      

  'use strict';
  
  var post_id = $(this).data("id");
  var action_name='property_delete';

  Swal.fire({
  title: '<?php echo e(trans('words.dlt_warning')); ?>',
  text: "<?php echo e(trans('words.dlt_warning_text')); ?>",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: '<?php echo e(trans('words.dlt_confirm')); ?>',
  cancelButtonText: "<?php echo e(trans('words.btn_cancel')); ?>",
  background:"#1a2234",
  color:"#fff"

}).then((result) => {
 

    if(result.isConfirmed) { 

        $.ajax({
            type: 'post',
            url: "<?php echo e(URL::to('ajax_actions')); ?>",
            dataType: 'json',
            data: {"_token": "<?php echo e(csrf_token()); ?>",id: post_id, action_for: action_name},
            success: function(res) {

              if(res.status=='1')
              {  

                  var selector = "#property_id_"+post_id;
                    $(selector ).fadeOut(1000);
                    setTimeout(function(){
                            $(selector ).remove()
                        }, 1000);

                  Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: '<?php echo e(trans('words.deleted')); ?>!',
                    showConfirmButton: true,
                    confirmButtonColor: '#10c469',
                    background:"#1a2234",
                    color:"#fff"
                  })
                
              } 
              else
              { 
                Swal.fire({
                        position: 'center',
                        icon: 'error',
                        title: 'Something went wrong!',
                        showConfirmButton: true,
                        confirmButtonColor: '#10c469',
                        background:"#1a2234",
                        color:"#fff"
                       })
              }
              
            }
        });
    }
 
})

});
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('site_app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/dextragr/public_html/realestate.dextragroups.com/resources/views/pages/user/favourites_list.blade.php ENDPATH**/ ?>