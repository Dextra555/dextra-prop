<?php $__env->startSection('head_title', trans('words.type_text').' - '. getcong('site_name') ); ?>

<?php $__env->startSection('head_url', Request::url()); ?>

<?php $__env->startSection('content'); ?>

<script type="application/ld+json">
{
  "@context": "https://schema.org/",
  "@type": "ItemList",
  "itemListElement": [    
          <?php $i = 1; ?> 
          <?php $__currentLoopData = $type_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type_data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <?php
              $separator = ',';
              if($i == count($type_list)){
                $separator = '';
                }
            $i++;
          ?>              
            {
                "@type": "ListItem",
                "name": "<?php echo e($type_data->type_name); ?>",
                "position": <?php echo e($type_data->id); ?>,
                "url": "<?php echo e(URL::to('types/'.$type_data->type_slug.'/'.$type_data->id)); ?>"
                
            }<?php echo e($separator); ?>

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  ]
}
</script>
 
   
<!--Breadcrumb section starts-->
<div class="breadcrumb-section bg-xs" style="background-image: url(<?php echo e(URL::asset('site_assets/images/breadcrumb-1.jpg')); ?>)">
    <div class="overlay op-2"></div>
    <div class="container">
      <div class="row">
        <div class="col-md-8 offset-md-2 text-center">
          <div class="breadcrumb-menu">
            <h2><?php echo e(trans('words.type_text')); ?> </h2>
            <span><a href="<?php echo e(URL::to('/')); ?>" title="<?php echo e(trans('words.home')); ?>"><?php echo e(trans('words.home')); ?></a></span> <span><?php echo e(trans('words.type_text')); ?></span> 
		      </div>
        </div>
      </div>
    </div>
  </div>
  <!--Breadcrumb section ends--> 

  <!-- Add banner Section -->
  <?php if(get_web_banner('list_top')!=""): ?>      
      <div class="add_banner_section pb-0">
        <div class="container">
          <div class="row">
              <div class="col-md-12">
              <?php echo stripslashes(get_web_banner('list_top')); ?>

            </div>
          </div>  
        </div>
      </div>
  <?php endif; ?>   
  <!-- Add banner Section -->

  <!--Listing Filter starts-->
  <div class="filter-wrapper style1 pt-30 pb-20">
    <div class="container">
      <div class="row">
        <div class="col-xl-12 col-lg-12">
          <div class="vfx-agent-details-wrapper">
            <div class="item-wrapper">
              <div class="tab-content">
                <div id="grid-view" class="active">
                  <div class="row">
                    <?php $__currentLoopData = $type_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type_data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-xl-2 col-lg-3 col-md-3 col-sm-4 col-6">
                       <div class="vfx-single-team-member vfx-cat-item vfx2"> 
                          <a href="<?php echo e(URL::to('types/'.$type_data->type_slug.'/'.$type_data->id)); ?>" title="<?php echo e($type_data->type_name); ?>"><img src="<?php echo e(URL::to('/'.$type_data->type_image)); ?>" alt="<?php echo e($type_data->type_name); ?>" title="<?php echo e($type_data->type_name); ?>"></a>
                          <div class="vfx-single-team-info">
                          <h4><a href="<?php echo e(URL::to('types/'.$type_data->type_slug.'/'.$type_data->id)); ?>"><?php echo e($type_data->type_name); ?></a></h4>
                          </div>
					              </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  

                  </div>

                  <!--pagination starts-->
                  <div class="post-nav nav-res pt-10">
                      <div class="row">

                        <?php echo $__env->make('_particles.pagination', ['paginator' => $type_list], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> 

                      </div>
                    </div>
                    <!--pagination ends--> 

                </div>
              </div>
            </div>
          </div>
        </div>        
      </div>
    </div>
  </div>
  <!--Listing Filter ends--> 
  
  <?php if(get_web_banner('list_bottom')!=""): ?>      
    <div class="add_banner_section mb-10">
      <div class="container">
        <div class="row">
            <div class="col-md-12">
            <?php echo stripslashes(get_web_banner('list_bottom')); ?>

          </div>
        </div>  
      </div>
    </div>
<?php endif; ?>
 
<?php $__env->stopSection(); ?>
<?php echo $__env->make('site_app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\USER\Documents\Dextra Properties\realestate.dextragroups.com\realestate.dextragroups.com\resources\views/pages/types/list.blade.php ENDPATH**/ ?>