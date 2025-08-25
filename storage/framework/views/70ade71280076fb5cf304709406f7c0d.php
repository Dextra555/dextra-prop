<!--Sidebar starts-->
<div class="sidebar-left sidebar">
  <div class="widget filter-widget search">
    <h3 class="widget-title"><?php echo e(trans('words.advance_search_filter')); ?></h3>
    <?php echo e(html()->form('GET', url('/properties/search'))
  ->attributes(['class' => 'vfx_hero_form_area vfx2 filter', 'id' => 'search', 'name' => 'search', 'role' => 'form'])->open()); ?>


    <div class="row">
      <div class="col-lg-12 col-md-12 mb-3">
        <input type="text" name="search_text" value="<?php if(isset($_GET['search_text'])): ?><?php echo e($_GET['search_text']); ?><?php endif; ?>"
          class="form-control" placeholder="<?php echo e(trans('words.search_by_title')); ?>" autocomplete="off">
      </div>

      <div class="col-lg-12 col-md-12 mb-3">
        <select name="purpose" class="vfx_hero_form_area_input vfx-custom-select-area">
          <option value=""><?php echo e(trans('words.purpose')); ?></option>

          <option value="Sale" <?php if(isset($_GET['purpose']) and $_GET['purpose'] == "Sale"): ?> selected <?php endif; ?>>
            <?php echo e(trans('words.sale')); ?></option>
          <option value="Rent" <?php if(isset($_GET['purpose']) and $_GET['purpose'] == "Rent"): ?> selected <?php endif; ?>>
            <?php echo e(trans('words.rent')); ?></option>

        </select>
      </div>

      <div class="col-lg-12 col-md-12 mb-3">
        <select name="type_id" class="vfx_hero_form_area_input vfx-custom-select-area">
          <option value=""><?php echo e(trans('words.type')); ?></option>

           <?php $__currentLoopData = \App\Type::where('status', 1)->orderby('type_name')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type_data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($type_data->id); ?>" <?php if(isset($_GET['type_id']) and $_GET['type_id'] == $type_data->id): ?> selected
            <?php endif; ?>><?php echo e($type_data->type_name); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </select>
      </div>

      <div class="col-lg-12 col-md-12 mb-3">
        <select name="location_id" class="vfx_hero_form_area_input vfx-custom-select-area">
          <option value=""><?php echo e(trans('words.location')); ?></option>

          <?php $__currentLoopData = \App\Location::where('status', 1)->orderby('name')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $location_data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($location_data->id); ?>" <?php if(isset($_GET['location_id']) and $_GET['location_id'] == $location_data->id): ?> selected
          <?php endif; ?>><?php echo e($location_data->name); ?></option>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </select>
      </div>

      <div class="col-lg-12 col-md-12 mb-3">
        <select name="bedrooms" class="vfx_hero_form_area_input vfx-custom-select-area">
          <option value=""><?php echo e(trans('words.bedrooms')); ?> : Any</option>
          <option value="1" <?php if(isset($_GET['bedrooms']) and $_GET['bedrooms'] == "1"): ?> selected <?php endif; ?>>1</option>
          <option value="2" <?php if(isset($_GET['bedrooms']) and $_GET['bedrooms'] == "2"): ?> selected <?php endif; ?>>2</option>
          <option value="3" <?php if(isset($_GET['bedrooms']) and $_GET['bedrooms'] == "3"): ?> selected <?php endif; ?>>3</option>
          <option value="4" <?php if(isset($_GET['bedrooms']) and $_GET['bedrooms'] == "4"): ?> selected <?php endif; ?>>4+</option>
        </select>
      </div>
      <div class="col-lg-12 col-md-12 mb-3">
        <select name="bathrooms" class="vfx_hero_form_area_input vfx-custom-select-area">
          <option value=""><?php echo e(trans('words.bathrooms')); ?> : Any</option>
          <option value="1" <?php if(isset($_GET['bathrooms']) and $_GET['bathrooms'] == "1"): ?> selected <?php endif; ?>>1</option>
          <option value="2" <?php if(isset($_GET['bathrooms']) and $_GET['bathrooms'] == "2"): ?> selected <?php endif; ?>>2</option>
          <option value="3" <?php if(isset($_GET['bathrooms']) and $_GET['bathrooms'] == "3"): ?> selected <?php endif; ?>>3</option>
          <option value="4" <?php if(isset($_GET['bathrooms']) and $_GET['bathrooms'] == "4"): ?> selected <?php endif; ?>>4+</option>
        </select>
      </div>
      <div class="col-lg-12 col-md-12 mb-3">
        <select name="furnishing" class="vfx_hero_form_area_input vfx-custom-select-area">

          <option value=""><?php echo e(trans('words.furnishing')); ?> : Any</option>
          <option value="Unfurnished" <?php if(isset($_GET['furnishing']) and $_GET['furnishing'] == "Unfurnished"): ?> selected
    <?php endif; ?>>Unfurnished</option>
          <option value="Semi-Furnished" <?php if(isset($_GET['furnishing']) and $_GET['furnishing'] == "Semi-Furnished"): ?>
    selected <?php endif; ?>>Semi-Furnished</option>
          <option value="Furnished" <?php if(isset($_GET['furnishing']) and $_GET['furnishing'] == "Furnished"): ?> selected
    <?php endif; ?>>Furnished</option>
        </select>
      </div>
      <div class="col-lg-12 col-md-12 mb-3">
        <select name="verified" class="vfx_hero_form_area_input vfx-custom-select-area">
          <option value=""><?php echo e(trans('words.verified_status')); ?></option>
          <option value="NO" <?php if(isset($_GET['verified']) and $_GET['verified'] == "NO"): ?> selected <?php endif; ?>>
            <?php echo e(trans('words.non_verified_properties')); ?></option>
          <option value="YES" <?php if(isset($_GET['verified']) and $_GET['verified'] == "YES"): ?> selected <?php endif; ?>>
            <?php echo e(trans('words.verified_properties')); ?></option>
        </select>
      </div>

      <div class="col-md-12">
        <div class="filter-sub-area style1">
          <div class="filter-title mb-20">
            <label for="amount_two"><?php echo e(trans('words.price_range')); ?>:</label> <span><input type="text" id="amount_two"
                name="price_range"></span>
          </div>
          <div id="price_range" class="price-range mb-30"> </div>
        </div>
      </div>


      <div class="col-xl-12 col-lg-12 col-sm-12 col-12">
        <button class="btn vfx8" type="submit"><?php echo e(trans('words.search_property')); ?></button>
      </div>

    </div>

    <?php echo e(html()->form()->close()); ?>

  </div>
  <div class="widget recent">
    <h3 class="widget-title"><?php echo e(trans('words.latest_property')); ?></h3>
    <?php $__currentLoopData = \App\Property::with(['types', 'locations', 'users'])->where('status', 1)->orderby('id', 'DESC')->limit(5)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $latest_data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="row recent-list">
      <div class="col-lg-5 col-4">
      <div class="entry-img">
      <a href="<?php echo e(URL::to('properties/' . $latest_data->slug . '/' . $latest_data->id)); ?>"
      title="stripslashes($latest_data->title)">
        <img src="<?php echo e(\URL::to('/' . $latest_data->image)); ?>" alt="<?php echo e(stripslashes($latest_data->title)); ?>" title="<?php echo e(stripslashes($latest_data->title)); ?>">
      </a>
        <?php if($latest_data->purpose == 'Rent'): ?>
      <span><?php echo e(trans('words.rent')); ?></span>
    <?php else: ?>
    <span><?php echo e(trans('words.sale')); ?></span>
  <?php endif; ?>
      </div>
      </div>
      <div class="col-lg-7 col-8 no-pad-left">
      <div class="entry-text">
        <p class="text-tlt"><?php echo e($latest_data->types->type_name); ?></p>
        <h4 class="entry-title"><a href="<?php echo e(URL::to('properties/' . $latest_data->slug . '/' . $latest_data->id)); ?>"
          title="stripslashes($latest_data->title)"><?php echo e(Str::limit(stripslashes($latest_data->title), 20)); ?></a></h4>
        <div class="vfx-property-location"> <i class="fa fa-map-marker"></i>
        <p>
        <?php if(isset($latest_data->locations->name) AND $latest_data->locations->name!=""): ?>
        <?php echo e($latest_data->locations->name); ?>

        <?php else: ?>
        <?php echo e(Str::limit(stripslashes($latest_data->address),20)); ?>

        <?php endif; ?>
        </p>
        </div>
        <div class="vfx-trend-open-price">
        <?php echo e(html_entity_decode(getCurrencySymbols(getcong('currency_code')))); ?><?php echo e(number_format($latest_data->price)); ?>

        </div>
      </div>
      </div>
    </div>
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


  </div>

  <?php if(get_web_banner('sidebar') != ""): ?>
    <div class="sidebar">
    <div class="add_banner_section">
      <div class="col-md-12">

      <?php echo stripslashes(get_web_banner('sidebar')); ?>


      </div>
    </div>
    </div>
  <?php endif; ?>  
</div>
<!--Sidebar ends--><?php /**PATH C:\Users\USER\Documents\Dextra Properties\realestate.dextragroups.com\realestate.dextragroups.com\resources\views/pages/sidebar_left.blade.php ENDPATH**/ ?>