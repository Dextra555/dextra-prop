  <!--Hero section starts-->
  <div class="hero vfx2 section-padding" style="background-image: url(<?php echo e(URL::asset('site_assets/images/slider1.jpg')); ?>)">
    <div class="overlay"></div>
    <!--Listing filter starts-->
    <div class="container vfx-posabs">
      <div class="row">
        <div class="col-md-10 offset-md-1">
          <div class="header-text vfx1">
             <p class="text-uppercase mb-10"><?php echo e(trans('words.slider_text1')); ?></p>
             <h1><?php echo e(trans('words.slider_text2')); ?></h1>
             <p><?php echo e(trans('words.slider_text3')); ?></p>
          </div>
        </div>
        <div class="col-md-12">
         
        <?php echo e(html()->form('GET', url('/properties/search'))
                     ->attributes(['class' => 'vfx_hero_form_area vfx2 filter listing-filter bg-cb', 'id' => 'search', 'role' => 'form'])->open()); ?>

           
            <div class="row">
              <div class="col-xl-4 col-lg-3 col-sm-12 pr-lg-0">
                <div class="input-search">
                  <input type="text" name="search_text" id="search_text" placeholder="<?php echo e(trans('words.search_by_title')); ?>">
                </div>
              </div>
              <div class="col-xl-2 col-lg-3 col-sm-12 pr-lg-0">
                <select name="purpose" class="vfx_hero_form_area_input vfx-custom-select-area">
                    <option value=""><?php echo e(trans('words.purpose')); ?></option>
                     
                     <option value="<?php echo e(trans('words.sale')); ?>"><?php echo e(trans('words.sale')); ?></option>
                     <option value="<?php echo e(trans('words.rent')); ?>"><?php echo e(trans('words.rent')); ?></option>                  
                </select>
              </div>
              <div class="col-xl-2 col-lg-3 col-sm-12 pr-lg-0">
                <select name="type_id" class="vfx_hero_form_area_input vfx-custom-select-area">
                  <option value=""><?php echo e(trans('words.property_type')); ?></option>
                  <?php $__currentLoopData = \App\Type::where('status',1)->orderby('type_name')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type_data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($type_data->id); ?>"><?php echo e($type_data->type_name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
              </div>
              <div class="col-xl-2 col-lg-3 col-sm-12 pr-lg-0">
                <select name="location_id" class="vfx_hero_form_area_input vfx-custom-select-area">
                  <option value=""><?php echo e(trans('words.location')); ?></option>
                  <?php $__currentLoopData = \App\Location::where('status',1)->orderby('name')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $location_data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($location_data->id); ?>"><?php echo e($location_data->name); ?></option>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
              </div>
              <div class="col-xl-2 col-lg-3 col-sm-12">
                <div class="submit_btn">
                  <button class="btn vfx3" type="submit"><?php echo e(trans('words.search_property')); ?></button>
                </div>
              </div>              
            </div>
            <?php echo e(html()->form()->close()); ?>

        </div>
      </div>
    </div>
    <!--Listing filter ends--> 
  </div>
  <!--Hero section ends--> <?php /**PATH /home/dextragr/public_html/realestate.dextragroups.com/resources/views/pages/home/slider.blade.php ENDPATH**/ ?>