<?php $__env->startSection('head_title', trans('words.property_text').' - '.getcong('site_name') ); ?>

<?php $__env->startSection('head_url', Request::url()); ?>

<?php $__env->startSection('content'); ?>


<script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "ItemList",
        "name": "<?php echo e(trans('words.property_text')); ?>",
        "description": "",
        "itemListElement": [
          <?php $i = 1; ?> 
          <?php $__currentLoopData = $property_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $property_data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>            
            <?php
              $separator = ',';
              if($i == count($property_list)){
                $separator = '';
                }
            $i++;
          ?>

              {
                  "@type": "ListItem",                  
                  "name": "<?php echo e(stripslashes($property_data->title)); ?>",
                  "image": "<?php echo e(\URL::to('/'.$property_data->image)); ?>",
                  "position": "<?php echo e($i); ?>",                  
                  "url": "<?php echo e(URL::to('properties/'.$property_data->slug.'/'.$property_data->id)); ?>",
                  "telephone": "",
                  "priceCurrency": "<?php echo e(getcong('currency_code')); ?>",
                  "price": "<?php echo e($property_data->price); ?>",
                  "address": {
                    "@type": "PostalAddress",
                    "streetAddress": "<?php echo e(stripslashes($property_data->address)); ?>",
                    "addressLocality": "<?php echo e(isset($property_data->locations->name)?$property_data->locations->name:''); ?>",
                    "postalCode": "",
                    "addressCountry": ""
                  }  
                   
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
            <h2><?php echo e(trans('words.property_text')); ?> </h2>
            <span><a href="<?php echo e(URL::to('/')); ?>" title="<?php echo e(trans('words.home')); ?>"><?php echo e(trans('words.home')); ?></a></span> <span><?php echo e(trans('words.property_text')); ?></span> 
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
 
  <!--Map section starts (moved from home page) -->
  <div class="bg-cb pb-20 pt-10">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="section-title vid-item-section mb-15">
            <h2>Explore on Map</h2>
          </div>
        </div>
        <div class="col-md-12">
          <div id="homeMap" style="width:100%;height:480px;border-radius:12px;overflow:hidden;box-shadow:0 10px 30px rgba(0,0,0,.08);"></div>
        </div>
      </div>
    </div>
  </div>
  <!--Map section ends-->

 <!--Listing Filter starts-->
 <div class="filter-wrapper style1 pt-30 pb-30">
    <div class="container">
      <div class="row">
        <div class="col-xl-4 col-lg-4"> 
        
            <?php echo $__env->make("pages.sidebar_left", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
        <div class="col-xl-8 col-lg-8">
          <div class="sidebar-content-right">
            <div class="showing-listing-block">
			 <div class="row align-items-center">
				<div class="col-lg-6 col-sm-6 col-12">
				  <div class="item-element res-box text-left sm-left">
					<p><?php echo e(trans('words.showing')); ?> <span><?php echo e($property_list->firstItem()); ?>-<?php echo e($property_list->lastItem()); ?></span> <?php echo e(trans('words.of')); ?> <span><?php echo e($property_list->total()); ?></span> <?php echo e(trans('words.property_text')); ?></p>
				  </div>
				</div>
				<div class="col-lg-4 col-sm-4 col-12">
					<select class="vfx_hero_form_area_input form-control vfx-custom-select-area" id="sort_by">
						<option value="?sort_by=New" <?php if(isset($_GET['sort_by']) && $_GET['sort_by']=='New' ): ?> selected <?php endif; ?>><?php echo e(trans('words.sort_by_new')); ?></option>
						<option value="?sort_by=Old" <?php if(isset($_GET['sort_by']) && $_GET['sort_by']=='Old' ): ?> selected <?php endif; ?>><?php echo e(trans('words.sort_by_old')); ?></option>						 
						<option value="?sort_by=High" <?php if(isset($_GET['sort_by']) && $_GET['sort_by']=='High' ): ?> selected <?php endif; ?>><?php echo e(trans('words.sort_by_price_high_low')); ?></option>
						<option value="?sort_by=Low" <?php if(isset($_GET['sort_by']) && $_GET['sort_by']=='Low' ): ?> selected <?php endif; ?>><?php echo e(trans('words.sort_by_price_low_high')); ?></option>
					</select>
				</div>
				<div class="col-lg-2 col-sm-2 col-12">
				  <div class="item-view-mode res-box"> 
					<ul class="nav item-filter-list" role="tablist">
					  <li><a class="active" data-toggle="tab" href="#grid-view" title="view"><i class="fa fa-th"></i></a></li>
					  <li><a data-toggle="tab" href="#list-view" title="view"><i class="fa fa-list"></i></a></li>
					</ul>
				  </div>
				</div>
			  </div>
            </div>
            <div class="item-wrapper pt-20">
              <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active property-grid" id="grid-view">
                  <div class="row">

                  
                  <?php $__currentLoopData = $property_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $property_data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <div class="col-md-6 col-sm-12">
                      <div class="vfx-single-property-box-area">
                        <div class="vfx-property-item"> <a class="vfx-property-img" href="<?php echo e(URL::to('properties/'.$property_data->slug.'/'.$property_data->id)); ?>" title="<?php echo e(stripslashes($property_data->title)); ?>"><img src="<?php echo e(\URL::to('/'.$property_data->image)); ?>" alt="#" title="<?php echo e(stripslashes($property_data->title)); ?>"> </a>
                          <ul class="vfx-feature-text">
                          <?php if($property_data->purpose=='Rent'): ?>
                          <li class="feature_cb"><span><?php echo e(trans('words.rent')); ?></span></li>
                          <?php else: ?>
                          <li class="feature_or"><span><?php echo e(trans('words.sale')); ?></span></li>
                          <?php endif; ?>	 
                          <?php if($property_data->verified=='YES'): ?>
                          <li class="feature_cb verified_item"><i class="fa fa-check 1" data-toggle="tooltip" data-placement="top" title="" data-original-title="<?php echo e(trans('words.verified')); ?>"></i></li>
                          <?php endif; ?>
                          </ul>
                          <div class="vfx-property-author-wrap"> 
                          <p class="text-tlt"><?php echo e($property_data->types->type_name); ?></p>
                          <ul class="vfx-save-btn">

                          <?php if(check_favourite("Property",$property_data->id,isset(Auth::user()->id)?Auth::user()->id:"")): ?> 
                            <li data-toggle="tooltip" data-placement="top" title="" data-original-title="Favourite" class="favourite_property favourite_title_id<?php echo e($property_data->id); ?>" data-id="<?php echo e($property_data->id); ?>">
                              
                              <a href="Javascript:void(0);" title="fav"><i class="fa fa-heart favourite_icon_id<?php echo e($property_data->id); ?>"></i></a>
                              
                            </li>
                          <?php else: ?>
                            <li data-toggle="tooltip" data-placement="top" title="" data-original-title="Set Favourite" class="favourite_property favourite_title_id<?php echo e($property_data->id); ?>" data-id="<?php echo e($property_data->id); ?>">
                               
                              <a href="Javascript:void(0);" title="fav"><i class="fa fa-heart-o favourite_icon_id<?php echo e($property_data->id); ?>"></i></a>
                               
                            </li>                          
                          <?php endif; ?>
                          </ul>
                        </div>
                        </div>
                        <div class="vfx-property-title-box-area">
                          <h4><a href="<?php echo e(URL::to('properties/'.$property_data->slug.'/'.$property_data->id)); ?>" title="<?php echo e(stripslashes($property_data->title)); ?>"><?php echo e(Str::limit(stripslashes($property_data->title),30)); ?></a></h4>
                          <div class="vfx-property-location"> <i class="fa fa-map-marker"></i>
                            <p>
                            <?php if(isset($property_data->locations->name) AND $property_data->locations->name!=""): ?>
                              <?php echo e($property_data->locations->name); ?>

                            <?php else: ?>
                              <?php echo e(Str::limit(stripslashes($property_data->address),40)); ?>

                            <?php endif; ?>
                            </p>
                          </div>
                          <div class="trending-bottom">
                            <div class="trend-left float-left">
                              <div class="vfx-property-author-wrap"> <a href="<?php echo e(URL::to('properties/owner/'.$property_data->user_id)); ?>" class="property-author" title="<?php echo e(stripslashes($property_data->title)); ?>"> 
                                  
                              <?php if($property_data->users->user_image): ?>
                                <img src="<?php echo e(\URL::to('upload/'.$property_data->users->user_image)); ?>" alt="user_image" title="<?php echo e(stripslashes($property_data->title)); ?>"> 
                              <?php else: ?>
                              <img src="<?php echo e(\URL::to('site_assets/images/user-default.jpg')); ?>" alt="user_image" title="<?php echo e(stripslashes($property_data->title)); ?>">
                              <?php endif; ?>

                              <span><?php echo e($property_data->users->name); ?></span> </a></div>
                            </div>
                            <a href="<?php echo e(URL::to('properties/'.$property_data->slug.'/'.$property_data->id)); ?>" class="vfx-trend-right float-right">
                              <div class="vfx-trend-open-price"><?php echo e(html_entity_decode(getCurrencySymbols(getcong('currency_code')))); ?><?php echo e(number_format($property_data->price)); ?></div>
                            </a> 
                            </div>
                        </div>
                      </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                     
                    
                  </div>
                </div>

 
				
                <div class="tab-pane fade property-list" id="list-view">

                <?php $__currentLoopData = $property_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $property_data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <div class="vfx-single-property-box-area">
                    <div class="row">
                      <div class="col-md-6 col-sm-12">
                        <div class="vfx-property-item"> <a class="vfx-property-img" href="<?php echo e(URL::to('properties/'.$property_data->slug.'/'.$property_data->id)); ?>" title="<?php echo e(stripslashes($property_data->title)); ?>"><img src="<?php echo e(\URL::to('/'.$property_data->image)); ?>" alt="image" title="<?php echo e(stripslashes($property_data->title)); ?>"> </a>
                          <ul class="vfx-feature-text">
                          <?php if($property_data->purpose=='Rent'): ?>
                          <li class="feature_cb"><span>Rent</span></li>
                          <?php else: ?>
                          <li class="feature_or"><span>Sale</span></li>
                          <?php endif; ?>
                          
                          <?php if($property_data->verified=='YES'): ?>
                          <li class="feature_cb verified_item" data-toggle="tooltip" data-placement="top" title="" data-original-title="<?php echo e(trans('words.verified')); ?>"><i class="fa fa-check"></i></li>
                          <?php endif; ?>
                                    
                          </ul>
                    <div class="vfx-property-author-wrap"> 
                        <ul class="vfx-save-btn">
                           
                          <li data-toggle="tooltip" data-placement="top" title="" data-original-title="Set Favourite" class="favourite_property favourite_title_id<?php echo e($property_data->id); ?>" data-id="<?php echo e($property_data->id); ?>">
                            <?php if(check_favourite("Property",$property_data->id,isset(Auth::user()->id)?Auth::user()->id:"")): ?>
                            <a href="Javascript:void(0);"><i class="fa fa-heart favourite_icon_id<?php echo e($property_data->id); ?>"></i></a>
                            <?php else: ?>
                            <a href="Javascript:void(0);"><i class="fa fa-heart-o favourite_icon_id<?php echo e($property_data->id); ?>"></i></a>
                            <?php endif; ?>
                          </li>
                        </ul>
						        </div>
                        </div>
                      </div>
                      <div class="col-md-6 col-sm-12">
                        <div class="vfx-property-title-box-area">
						              <p class="text-tlt"><?php echo e($property_data->types->type_name); ?></p>
                          <h4><a href="<?php echo e(URL::to('properties/'.$property_data->slug.'/'.$property_data->id)); ?>" title="<?php echo e(stripslashes($property_data->title)); ?>"><?php echo e(Str::limit(stripslashes($property_data->title),30)); ?></a></h4>
                          <div class="vfx-property-location"> <i class="fa fa-map-marker"></i>
                            <p>
                            <?php if(isset($property_data->locations->name) AND $property_data->locations->name!=""): ?>
                              <?php echo e($property_data->locations->name); ?>

                            <?php else: ?>
                            <?php echo e(Str::limit(stripslashes($property_data->address),40)); ?>

                            <?php endif; ?>
                            </p>
                          </div>
                          <div class="trending-bottom">
							<div class="trend-left float-left">
							  <div class="vfx-property-author-wrap"> <a href="<?php echo e(URL::to('properties/owner/'.$property_data->user_id)); ?>" class="property-author" title="user"> 
                          <?php if($property_data->users->user_image): ?>
                            <img src="<?php echo e(\URL::to('upload/'.$property_data->users->user_image)); ?>" alt="user" title="user"> 
                          <?php else: ?>
                          <img src="<?php echo e(\URL::to('site_assets/images/user-default.jpg')); ?>" alt="user" title="user">
                          <?php endif; ?>  
                <span><?php echo e($property_data->users->name); ?></span> </a></div>
							</div>
							<a href="<?php echo e(URL::to('properties/'.$property_data->slug.'/'.$property_data->id)); ?>" class="vfx-trend-right float-right" title="<?php echo e(stripslashes($property_data->title)); ?>">
								<div class="vfx-trend-open-price"><?php echo e(html_entity_decode(getCurrencySymbols(getcong('currency_code')))); ?><?php echo e(number_format($property_data->price)); ?></div>
							</a> 
						  </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
 
                  
                </div>
                <!--pagination starts-->
                <div class="post-nav nav-res pt-20">
                  <div class="row">
                  
                      <?php echo $__env->make('_particles.pagination', ['paginator' => $property_list], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> 

                  </div>
                </div>
                <!--pagination ends-->

                <?php if(get_web_banner('list_bottom')!=""): ?>      
                    <div class="add_banner_section pb-0">
                      <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                            <?php echo stripslashes(get_web_banner('list_bottom')); ?>

                          </div>
                        </div>  
                      </div>
                    </div>
                <?php endif; ?>

				 
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--Listing Filter ends--> 
   
   
<?php $__env->stopSection(); ?>
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
  <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.5.3/dist/MarkerCluster.css"/>
  <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.5.3/dist/MarkerCluster.Default.css"/>
  <link rel="stylesheet" href="https://unpkg.com/leaflet.fullscreen@2.4.0/Control.FullScreen.css"/>
  <link rel="stylesheet" href="https://unpkg.com/leaflet-draw@1.0.4/dist/leaflet.draw.css"/>
  <style>
    /* Distinct current location pulsing marker */
    .current-loc-icon { width:16px; height:16px; position:relative; display:block; }
    .current-loc-icon .pulse {
      position:absolute; left:0; top:0; width:16px; height:16px; border-radius:50%;
      background:#2e7d32; box-shadow:0 0 0 rgba(46,125,50, 0.7);
      animation:pulse-green 2s infinite;
      border:2px solid #fff;
    }
    @keyframes pulse-green {
      0% { box-shadow: 0 0 0 0 rgba(46,125,50, 0.5); }
      70% { box-shadow: 0 0 0 12px rgba(46,125,50, 0); }
      100% { box-shadow: 0 0 0 0 rgba(46,125,50, 0); }
    }

    /* Property markers by purpose (modern pill badges) */
    :root {
      --sale:#e53935;      /* red */
      --rent:#1e88e5;      /* blue */
      --other:#757575;     /* gray */
      --badge-shadow:0 6px 12px rgba(0,0,0,.18);
      --glass-bg: rgba(255,255,255,.86);
      --glass-border: rgba(0,0,0,.06);
    }
    .prop-marker { position:relative; transform: translate(-50%, -100%); }
    .prop-badge {
      display:inline-block; padding:6px 10px; border-radius:999px; color:#fff;
      font-size:12.5px; font-weight:700; box-shadow:var(--badge-shadow);
      white-space:nowrap; line-height:1; outline:1px solid rgba(255,255,255,.9);
      -webkit-font-smoothing:antialiased; letter-spacing:.2px;
      transition:transform .12s ease;
      text-shadow:0 1px 1px rgba(0,0,0,.25);
      backdrop-filter:saturate(1.2);
    }
    .prop-marker:hover .prop-badge { transform:translateY(-1px) scale(1.03); }
    .prop-pin { position:absolute; left:50%; top:100%; transform:translateX(-50%); width:0; height:0; border-left:7px solid transparent; border-right:7px solid transparent; }
    .prop-badge.sale { background: var(--sale); }
    .prop-badge.rent { background: var(--rent); }
    .prop-badge.other { background:#666; }
    .prop-pin.sale { border-top:9px solid var(--sale); }
    .prop-pin.rent { border-top:9px solid var(--rent); }
    .prop-pin.other { border-top:9px solid var(--other); }

    /* Legend */
    .map-legend {
      background:#fff; padding:8px 10px; border-radius:6px; box-shadow:0 1px 4px rgba(0,0,0,.2);
      font-size:12px; color:#333; line-height:1.4;
    }
    .map-legend .row { display:flex; align-items:center; gap:8px; margin:3px 0; }
    .legend-dot { display:inline-block; width:12px; height:12px; border-radius:50%; border:2px solid #fff; box-shadow:0 0 2px rgba(0,0,0,.35); }
    .legend-sale { background:#d32f2f; }
    .legend-rent { background:#1976d2; }
    .legend-other { background:#6d6d6d; }
    .legend-current { background:#2e7d32; box-shadow:0 0 0 6px rgba(46,125,50,0.15); }

    /* Floating toolbar (search, filters, actions) */
    .map-toolbar {
      background: var(--glass-bg);
      border:1px solid var(--glass-border);
      backdrop-filter: blur(8px) saturate(1.2);
      border-radius: 12px;
      box-shadow: 0 6px 24px rgba(0,0,0,.12);
      padding: 8px;
      display: flex; gap:8px; align-items:center;
      z-index: 1001;
    }
    /* Place toolbar with sensible spacing */
    .leaflet-top.leaflet-right .map-toolbar { margin: 12px; }
    .map-toolbar input[type="text"] {
      border: 1px solid #e6e6e6; border-radius: 10px; padding:8px 10px; width: 200px;
      outline: none; font-size: 13px; background: #fff;
    }
    .map-chip { cursor:pointer; user-select:none; padding:7px 10px; border-radius:999px; font-size:12px; font-weight:600; border:1px solid #e9e9e9; background:#fff; color:#333; }
    .map-chip.active { color:#fff; border-color: transparent; box-shadow:0 6px 12px rgba(0,0,0,.12); }
    .chip-sale.active { background: var(--sale); }
    .chip-rent.active { background: var(--rent); }
    .chip-all.active { background: #111; }
    .icon-btn { width:34px; height:34px; display:grid; place-items:center; border-radius:10px; border:1px solid #e9e9e9; background:#fff; cursor:pointer; }
    .icon-btn:hover { background:#f7f7f7; }

    /* Bottom-right floating locate button */
    .map-locate-floating { background:#111; color:#fff; border-radius:999px; padding:10px 14px; font-weight:700; font-size:12px; box-shadow:0 8px 20px rgba(0,0,0,.18); cursor:pointer; display:flex; align-items:center; gap:8px; }
    .map-locate-floating:hover { background:#000; }
    .leaflet-bottom.leaflet-right .map-locate-floating { margin: 12px; }

    /* Custom cluster style */
    .marker-cluster-custom { background: transparent; border-radius:999px; }
    .cluster-circle { width:38px; height:38px; border-radius:999px; display:grid; place-items:center; font-weight:700; color:#fff; box-shadow:0 6px 18px rgba(0,0,0,.22); }
    .cluster-circle.sale { background: linear-gradient(135deg, #ff6b6b, var(--sale)); }
    .cluster-circle.rent { background: linear-gradient(135deg, #64b5f6, var(--rent)); }
    .cluster-circle.mix { background: linear-gradient(135deg, #8e8e8e, #4e4e4e); }

    /* Loading shimmer over map */
    #homeMap.loading::after {
      content:""; position:absolute; inset:0; background: linear-gradient(100deg, rgba(255,255,255,.0) 40%, rgba(255,255,255,.45) 50%, rgba(255,255,255,.0) 60%);
      animation: shimmer 1.2s infinite; pointer-events:none;
    }
    @keyframes shimmer { 0% { background-position:-200% 0; } 100% { background-position:200% 0; } }
    /* Popup card modern UI */
    .leaflet-popup-content-wrapper { border-radius:14px; box-shadow:0 18px 50px rgba(0,0,0,.18); }
    .leaflet-popup-content { margin: 10px 12px; }
    .popup-card { width: 320px; }
    .popup-top { display:flex; gap:12px; }
    .popup-img { width:112px; height:84px; border-radius:10px; object-fit:cover; box-shadow:0 6px 18px rgba(0,0,0,.16); }
    .popup-title { font-weight:800; font-size:14px; line-height:1.25; margin-bottom:6px; }
    .popup-sub { font-size:12px; color:#666; display:flex; align-items:center; gap:6px; flex-wrap:wrap; }
    .badge-purpose { padding:4px 8px; border-radius:999px; font-weight:700; font-size:11px; color:#fff; }
    .badge-sale { background: var(--sale); }
    .badge-rent { background: var(--rent); }
    .badge-other { background:#666; }
    .price { font-weight:800; color:#111; }
    .popup-feats { margin-top:8px; display:flex; gap:6px; flex-wrap:wrap; }
    .feat-chip { font-size:11px; padding:5px 8px; border-radius:999px; border:1px solid #eee; background:#fafafa; color:#333; }
    .popup-meta { margin-top:10px; font-size:12px; color:#333; display:flex; align-items:center; gap:10px; flex-wrap:wrap; }
    .popup-actions { margin-top:12px; display:flex; gap:8px; }
    .btn-ghost { border:1px solid #e5e5e5; padding:8px 10px; border-radius:10px; background:#fff; font-weight:700; font-size:12px; color:#333; text-decoration:none; display:inline-flex; align-items:center; gap:6px; }
    .btn-primary { background:#111; color:#fff; border:1px solid #111; }
    .btn-ghost:hover { background:#f7f7f7; }
  </style>
  <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
  <script src="https://unpkg.com/leaflet.markercluster@1.5.3/dist/leaflet.markercluster.js"></script>
  <script src="https://unpkg.com/leaflet.fullscreen@2.4.0/Control.FullScreen.js"></script>
  <script src="https://unpkg.com/leaflet-draw@1.0.4/dist/leaflet.draw.js"></script>
  <script src="https://unpkg.com/leaflet.heat/dist/leaflet-heat.js"></script>
  <script>
  (function(){
    function initHomeMap(){
      var el = document.getElementById('homeMap');
      if(!el || el.getAttribute('data-map-initialized')) return;
      el.setAttribute('data-map-initialized','1');
      el.classList.add('loading');

      // Default center; will try current position, then fit bounds from data
      var light = L.tileLayer('https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}{r}.png', { maxZoom: 20, attribution: '&copy; OpenStreetMap & CARTO' });
      var dark  = L.tileLayer('https://{s}.basemaps.cartocdn.com/dark_all/{z}/{x}/{y}{r}.png',  { maxZoom: 20, attribution: '&copy; OpenStreetMap & CARTO' });
      var map = L.map('homeMap', { zoomAnimation: true, worldCopyJump:true, layers:[light] }).setView([20.5937, 78.9629], 4);
      var baseLayers = { 'Light': light, 'Dark': dark };

      // Utils
      function debounce(fn, wait){
        var t; return function(){ var ctx=this, args=arguments; clearTimeout(t); t=setTimeout(function(){ fn.apply(ctx,args); }, wait); };
      }
      function parseQuery(){ try { return Object.fromEntries(new URLSearchParams(location.search)); } catch(e){ return {}; } }
      function updateQuery(kv){ try {
        var params = new URLSearchParams(location.search);
        Object.keys(kv||{}).forEach(function(k){ if(kv[k]===null){ params.delete(k); } else { params.set(k, kv[k]); } });
        var url = location.pathname + '?' + params.toString() + location.hash;
        history.replaceState(null, '', url);
      } catch(e){}
      }

      // Custom cluster icons that adapt to composition
      var markers = L.markerClusterGroup({
        spiderfyOnEveryZoom: true,
        spiderfyDistanceMultiplier: 1.2,
        disableClusteringAtZoom: 16,
        maxClusterRadius: 52,
        iconCreateFunction: function (cluster) {
          var children = cluster.getAllChildMarkers();
          var hasSale=false, hasRent=false;
          children.forEach(function(c){ var t=(c.options && c.options._cls)||''; if(t==='sale') hasSale=true; if(t==='rent') hasRent=true; });
          var cls = hasSale && hasRent ? 'mix' : (hasSale ? 'sale' : (hasRent ? 'rent' : 'mix'));
          var count = cluster.getChildCount();
          var html = '<div class="cluster-circle '+cls+'">'+count+'</div>';
          return L.divIcon({ html: html, className:'marker-cluster-custom', iconSize:[38,38] });
        }
      });

      // Ensure proper sizing on load and resize
      function refreshSize(){ try { map.invalidateSize(false); } catch(e){} }
      window.addEventListener('resize', refreshSize);
      setTimeout(refreshSize, 50);

      var userPos = null; // [lat,lng]
      var currentMarker = null; // marker for current location
      var showProps = false; // default: show only current location
      // Try to center on user's current location (use distinct icon)
      if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(pos){
          var lat = pos.coords.latitude, lng = pos.coords.longitude;
          userPos = [lat, lng];
          map.setView([lat, lng], 13);
          // Visual cue of current location
          L.circle([lat, lng], {radius: 200, color: '#2e7d32', fillColor:'#66bb6a', fillOpacity:0.2}).addTo(map);
          var currentIcon = L.divIcon({className:'current-loc-icon', html:'<span class="pulse"></span>', iconSize:[16,16], iconAnchor:[8,8]});
          currentMarker = L.marker([lat, lng], {title: 'You are here', icon: currentIcon, zIndexOffset:1000}).addTo(map);
        }, function(){ /* ignore errors, keep default */ }, { enableHighAccuracy:true, maximumAge:60000, timeout:8000 });
      }

      // Legend
      var legend = L.control({position:'bottomleft'});
      legend.onAdd = function(){
        var div = L.DomUtil.create('div', 'map-legend');
        div.innerHTML = ''+
          '<div class="row"><span class="legend-dot legend-sale"></span><span>For Sale (price badge)</span></div>'+
          '<div class="row"><span class="legend-dot legend-rent"></span><span>For Rent (price badge)</span></div>'+
          '<div class="row"><span class="legend-dot legend-other"></span><span>Other</span></div>'+
          '<div class="row"><span class="legend-dot legend-current"></span><span>Your Location</span></div>';
        return div;
      };
      legend.addTo(map);

      // Basemap switcher (simple)
      L.control.layers(baseLayers, null, { position:'topleft' }).addTo(map);

      // Helpers: short price and currency symbol
      function shortNumber(n){
        if(n === null || n === undefined || isNaN(n)) return '';
        n = Number(n);
        var abs = Math.abs(n);
        if(abs >= 1e9) return (n/1e9).toFixed(1).replace(/\.0$/, '')+'B';
        if(abs >= 1e6) return (n/1e6).toFixed(1).replace(/\.0$/, '')+'M';
        if(abs >= 1e3) return (n/1e3).toFixed(1).replace(/\.0$/, '')+'K';
        return n.toLocaleString();
      }
      var CURRENCY = "<?php echo e(html_entity_decode(getCurrencySymbols(getcong('currency_code')))); ?>";
      function formatBadgePrice(price, purpose){
        if(price === undefined || price === null || price === '') return '';
        var short = shortNumber(price);
        var isRent = (purpose||'').toString().toLowerCase().includes('rent') || (purpose||'').toString().toLowerCase().includes('lease');
        return CURRENCY + short + (isRent ? '/mo' : '');
      }
      function formatFullPrice(price, purpose){
        if(price === undefined || price === null || price === '') return '';
        var full = Number(price).toLocaleString();
        var isRent = (purpose||'').toString().toLowerCase().includes('rent') || (purpose||'').toString().toLowerCase().includes('lease');
        return CURRENCY + full + (isRent ? ' per month' : '');
      }

      var allData = [];
      var allMarkers = [];
      var activeFilter = 'all'; // all|sale|rent
      var q = '';
      var drawnGroup = L.featureGroup(); // for drawn shapes
      var activeShape = null; // last drawn polygon/circle
      var heatLayer = null;
      // define placeholder; will be reassigned later after definition
      var syncListWithMapBounds = function(){};

      function pointInPolygon(point, vs){ // ray-casting algorithm
        var x = point[1], y = point[0];
        var inside = false;
        for (var i=0, j=vs.length-1; i<vs.length; j=i++) {
          var xi = vs[i][1], yi = vs[i][0];
          var xj = vs[j][1], yj = vs[j][0];
          var intersect = ((yi>y)!=(yj>y)) && (x < (xj - xi) * (y - yi) / ((yj - yi) || 1e-12) + xi);
          if (intersect) inside = !inside;
        }
        return inside;
      }

      function applyFilters() {
        markers.clearLayers();
        var filtered = allMarkers.filter(function(m){
          var okType = (activeFilter==='all') || (m.options._cls===activeFilter);
          var okSearch = true;
          if(q){
            var hay = (m.options._title||'') + ' ' + (m.options._purpose||'');
            okSearch = hay.toLowerCase().includes(q);
          }
          var okShape = true;
          if(activeShape){
            try {
              var ll = m.getLatLng();
              if(activeShape instanceof L.Circle){
                okShape = activeShape.getLatLng().distanceTo(ll) <= activeShape.getRadius();
              } else if(activeShape instanceof L.Polygon){
                var latlngs = activeShape.getLatLngs();
                var ring = Array.isArray(latlngs) ? (Array.isArray(latlngs[0])? latlngs[0] : latlngs) : [];
                var poly = ring.map(function(p){ return [p.lat, p.lng]; });
                okShape = pointInPolygon([ll.lat, ll.lng], poly);
              }
            } catch(e){ okShape = true; }
          }
          return okType && okSearch && okShape;
        });
        if(filtered.length){ markers.addLayers(filtered); }
        syncListWithMapBounds();
        // update URL state
        try {
          var b = map.getBounds();
          updateQuery({
            q: (q||'') ? q : null,
            f: activeFilter==='all'? null : activeFilter,
            z: map.getZoom(),
            bbox: [b.getSouth(), b.getWest(), b.getNorth(), b.getEast()].map(function(n){ return n.toFixed(6); }).join(',')
          });
        } catch(e){}
        // persist
        try { localStorage.setItem('map_q', q||''); localStorage.setItem('map_f', activeFilter||'all'); } catch(e){}
      }

      fetch("<?php echo e(url('properties/map-data')); ?>")
        .then(function(r){ return r.ok ? r.json() : Promise.reject(new Error('Network response was not ok')); })
        .then(function(json){
          var data = (json && json.data) ? json.data : [];
          if(!data.length){
            return; // no markers
          }

          var bounds = L.latLngBounds();

          allData = data;
          data.forEach(function(p){
            var lat = (typeof p.lat === 'string') ? parseFloat(p.lat) : p.lat;
            var lng = (typeof p.lng === 'string') ? parseFloat(p.lng) : p.lng;
            if(isNaN(lat) || isNaN(lng)) return;

            function getBadgeIcon(purpose, price){
              var key = (purpose || '').toString().toLowerCase();
              var cls = 'other';
              if(key === 'sale' || key.includes('sale') || key === 'sell') cls = 'sale';
              else if(key === 'rent' || key.includes('rent') || key.includes('lease')) cls = 'rent';
              var amount = formatBadgePrice(price, purpose);
              var title = formatFullPrice(price, purpose);
              var html = '<div class="prop-marker">'
                + '<span class="prop-badge '+cls+'" title="'+title+'">'+ (amount || '') +'</span>'
                + '<span class="prop-pin '+cls+'"></span>'
                + '</div>';
              return L.divIcon({ className: '', html: html, iconSize: [1,1], iconAnchor: [0,0] });
            }

            var clsKey = (function(){ var key=(p.purpose||'').toString().toLowerCase(); if(key.includes('sale')||key==='sale'||key==='sell') return 'sale'; if(key.includes('rent')||key.includes('lease')) return 'rent'; return 'other'; })();
            var m = L.marker([lat, lng], { icon: getBadgeIcon(p.purpose, p.price), _cls:clsKey, _title:(p.title||''), _purpose:(p.purpose||'') });
            // Expose cls for cluster iconCreateFunction
            m.options._cls = clsKey; m.options._title = (p.title||''); m.options._purpose=(p.purpose||''); m.options._url=(p.url||'');
            var price = (p.price || p.price === 0) ? new Intl.NumberFormat().format(p.price) : '';
            var purpose = p.purpose ? p.purpose : '';
            var addr = p.address ? String(p.address) : '';
            var beds = (p.bedrooms||p.beds)? (p.bedrooms||p.beds) : null;
            var baths = (p.bathrooms||p.baths)? (p.bathrooms||p.baths) : null;
            var area = (p.area||p.size)? (p.area||p.size) : null;
            var prposeKey = (p.purpose||'').toString().toLowerCase();
            var badgeCls = prposeKey.includes('sale')||prposeKey==='sale'||prposeKey==='sell' ? 'badge-sale' : (prposeKey.includes('rent')||prposeKey.includes('lease') ? 'badge-rent' : 'badge-other');
            var popup = ''
              + '<div class="popup-card" data-lat="'+lat+'" data-lng="'+lng+'" data-url="'+(p.url||'#')+'">'
              +   '<div class="popup-top">'
              +     '<div style="position:relative">'
              +       '<img class="popup-img" src="'+(p.image||"<?php echo e(URL::asset('site_assets/images/no-image.png')); ?>")+'" alt="img">'
              +       '<div style="position:absolute;left:6px;bottom:6px;display:flex;gap:6px;align-items:center;">'
              +         '<span class="badge-purpose '+badgeCls+'">'+(purpose||'')+'</span>'
              +         (price?('<span class="price" style="background:#fff;border-radius:8px;padding:2px 6px;box-shadow:0 2px 6px rgba(0,0,0,.12)">'+price+'</span>'):'')
              +       '</div>'
              +     '</div>'
              +     '<div>'
              +       '<div class="popup-title">'+(p.title||'')+'</div>'
              +       '<div class="popup-sub">'
              +         (addr?('<span style="color:#666">'+addr+'</span>'):'')
              +       '</div>'
              +       '<div class="popup-feats">'
              +         (beds?('<span class="feat-chip">🛏 '+beds+' Beds</span>'):'')
              +         (baths?('<span class="feat-chip">🛁 '+baths+' Baths</span>'):'')
              +         (area?('<span class="feat-chip">📐 '+area+'</span>'):'')
              +       '</div>'
              +     '</div>'
              +   '</div>'
              +   '<div class="popup-meta">'
              +     '<span class="dist-line" style="display:none"><span class="dist-val"></span></span>'
              +   '</div>'
              +   '<div class="popup-actions">'
              +     '<a class="btn-ghost dir-link" href="#" target="_blank" rel="noopener">🧭 Directions</a>'
              +     '<a class="btn-ghost copy-link" href="#">🔗 Copy Link</a>'
              +     '<a class="btn-ghost share-link" href="#">📤 Share</a>'
              +     '<a href="'+(p.url||'#')+'" class="btn-ghost btn-primary">View Details</a>'
              +   '</div>'
              + '</div>';
            m.bindPopup(popup);
            m.on('popupopen', function(){
              try {
                if(userPos){
                  var d = map.distance(L.latLng(userPos[0], userPos[1]), m.getLatLng());
                  var txt = d >= 1000 ? (d/1000).toFixed(1)+' km' : Math.max(50, Math.round(d/10)*10)+' m';
                  var popEl = m.getPopup().getElement();
                  if(popEl){
                    var line = popEl.querySelector('.dist-line');
                    var val = popEl.querySelector('.dist-val');
                    if(line && val){ line.style.display='inline-block'; val.textContent = ' · '+txt+' away'; }
                  }
                }
                // Hook actions
                var el = m.getPopup().getElement();
                if(el){
                  var card = el.querySelector('.popup-card');
                  var latA = parseFloat(card?.getAttribute('data-lat'));
                  var lngA = parseFloat(card?.getAttribute('data-lng'));
                  var urlA = card?.getAttribute('data-url') || (p.url||'#');
                  // Directions
                  var dir = el.querySelector('.dir-link');
                  if(dir){
                    var dest = latA+','+lngA;
                    var g = 'https://www.google.com/maps/dir/?api=1&destination='+encodeURIComponent(dest);
                    if(userPos){ g += '&origin='+encodeURIComponent(userPos[0]+','+userPos[1]); }
                    dir.setAttribute('href', g);
                  }
                  // Copy Link
                  var cp = el.querySelector('.copy-link');
                  if(cp){
                    cp.addEventListener('click', function(ev){ ev.preventDefault(); try { navigator.clipboard.writeText(urlA); cp.textContent = '✅ Copied'; setTimeout(function(){ cp.textContent='🔗 Copy Link'; }, 1500);} catch(e){ window.prompt('Copy link:', urlA); } });
                  }
                  // Share
                  var sh = el.querySelector('.share-link');
                  if(sh){
                    sh.addEventListener('click', function(ev){ ev.preventDefault(); if(navigator.share){ navigator.share({ title:(p.title||'Property'), text:(p.title||''), url:urlA }).catch(function(){}); } else { try { navigator.clipboard.writeText(urlA); sh.textContent='✅ Copied'; setTimeout(function(){ sh.textContent='📤 Share'; }, 1500);} catch(e){ window.prompt('Share link:', urlA); } } });
                  }
                }
              } catch(e){}
            });
            allMarkers.push(m);
            bounds.extend([lat, lng]);
          });

          applyFilters();
          if(showProps){ map.addLayer(markers); }
          if(bounds.isValid()){
            map.fitBounds(bounds, { padding:[30,30], animate:false });
            setTimeout(refreshSize, 100);
          }
          el.classList.remove('loading');

          // Heatmap build (off by default)
          try {
            var pts = data.map(function(p){ var lat = parseFloat(p.lat), lng = parseFloat(p.lng); if(!isNaN(lat)&&!isNaN(lng)) return [lat,lng, 0.6]; }).filter(Boolean);
            heatLayer = L.heatLayer(pts, { radius: 22, blur: 16, maxZoom: 17, minOpacity: 0.25 });
          } catch(e){}
        })
        .catch(function(err){ /* keep initial view on error */ });

      // Toolbar UI as Leaflet control
      var Toolbar = L.Control.extend({ position: 'topright', onAdd: function(){
        var div = L.DomUtil.create('div', 'map-toolbar');
        div.innerHTML = ''+
          '<input type="text" id="mapSearch" placeholder="Search properties..." />'+
          '<span class="map-chip chip-all active" data-val="all">All</span>'+
          '<span class="map-chip chip-sale" data-val="sale">Sale</span>'+
          '<span class="map-chip chip-rent" data-val="rent">Rent</span>'+
          '<button class="icon-btn" id="btnLocate" title="Locate me" aria-label="Locate"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12 2v2M12 20v2M4.93 4.93l1.41 1.41M17.66 17.66l1.41 1.41M2 12h2M20 12h2M4.93 19.07l1.41-1.41M17.66 6.34l1.41-1.41" stroke="#111" stroke-width="2" stroke-linecap="round"/><circle cx="12" cy="12" r="3" stroke="#111" stroke-width="2"/></svg></button>'+
          '<button class="icon-btn" id="btnFit" title="Fit to results" aria-label="Fit"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M3 9V3h6" stroke="#111" stroke-width="2" stroke-linecap="round"/><path d="M21 15v6h-6" stroke="#111" stroke-width="2" stroke-linecap="round"/><path d="M21 9V3h-6" stroke="#111" stroke-width="2" stroke-linecap="round"/><path d="M3 15v6h6" stroke="#111" stroke-width="2" stroke-linecap="round"/></svg></button>'+
          '<button class="icon-btn" id="btnFull" title="Fullscreen" aria-label="Fullscreen"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M9 3H3v6M15 21h6v-6M21 9V3h-6M3 15v6h6" stroke="#111" stroke-width="2" stroke-linecap="round"/></svg></button>'+
          '<button class="icon-btn" id="btnHeat" title="Toggle heatmap" aria-label="Heat"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12 2C8 6 16 8 12 14s-4 6 0 8" stroke="#111" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg></button>'+
          '<button class="icon-btn" id="btnToggleProps" title="Show properties" aria-label="Show properties"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M3 12h18" stroke="#111" stroke-width="2" stroke-linecap="round"/><path d="M6 7h12" stroke="#111" stroke-width="2" stroke-linecap="round"/><path d="M6 17h12" stroke="#111" stroke-width="2" stroke-linecap="round"/></svg></button>'+
          '<button class="icon-btn" id="btnClearArea" title="Clear drawn area" aria-label="Clear area"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M18 6L6 18M6 6l12 12" stroke="#111" stroke-width="2" stroke-linecap="round"/></svg></button>';
        L.DomEvent.disableClickPropagation(div);
        return div;
      }});
      map.addControl(new Toolbar());

      // Toolbar interactions
      var searchEl = document.getElementById('mapSearch');
      if(searchEl){
        var onSearch = debounce(function(){ q = (searchEl.value||'').trim().toLowerCase(); applyFilters(); }, 250);
        searchEl.addEventListener('input', onSearch);
      }
      function setActiveChip(val){
        activeFilter = val; applyFilters();
        var chips = document.querySelectorAll('.map-chip');
        chips.forEach(function(c){ c.classList.remove('active'); });
        var elc = document.querySelector('.map-chip.chip-'+val);
        if(elc) elc.classList.add('active');
        if(val==='all'){ var allEl=document.querySelector('.map-chip.chip-all'); if(allEl) allEl.classList.add('active'); }
      }
      document.querySelectorAll('.map-chip').forEach(function(ch){ ch.addEventListener('click', function(){ setActiveChip(this.getAttribute('data-val')); }); });
      var btnLocate = document.getElementById('btnLocate');
      if(btnLocate){ btnLocate.addEventListener('click', function(){
        if (!navigator.geolocation) {
          alert('Geolocation is not supported by your browser.');
          return;
        }
        navigator.geolocation.getCurrentPosition(function(pos){
          var lat = pos.coords.latitude, lng = pos.coords.longitude;
          map.setView([lat, lng], 14);
        }, function(err){
          var msg = 'Unable to access your location.';
          if (location.protocol !== 'https:') {
            msg += '\nTip: Geolocation requires HTTPS in most browsers.';
          }
          alert(msg);
        }, { enableHighAccuracy:true, maximumAge:60000, timeout:8000 });
      }); }
      var btnFit = document.getElementById('btnFit');
      if(btnFit){ btnFit.addEventListener('click', function(){
        try{
          var b = map.getBounds();
          markers.eachLayer(function(m){ if(m.getLatLng) b.extend(m.getLatLng()); });
          if(b.isValid()) map.fitBounds(b, { padding:[30,30] });
        } catch(e){}
      }); }
      var btnFull = document.getElementById('btnFull');
      if(btnFull){ btnFull.addEventListener('click', function(){
        var cont = map.getContainer();
        if (!document.fullscreenElement) { cont.requestFullscreen && cont.requestFullscreen(); }
        else { document.exitFullscreen && document.exitFullscreen(); }
      }); }

      // Heat toggle
      var btnHeat = document.getElementById('btnHeat');
      if(btnHeat){ btnHeat.addEventListener('click', function(){ try { if(heatLayer){ if(map.hasLayer(heatLayer)){ map.removeLayer(heatLayer); } else { heatLayer.addTo(map); } } } catch(e){} }); }

      // Draw controls (circle & polygon)
      try {
        drawnGroup.addTo(map);
        var drawCtl = new L.Control.Draw({
          position:'topleft',
          draw: {
            polygon: { allowIntersection:false, showArea:true },
            rectangle: false,
            polyline: false,
            marker: false,
            circlemarker: false,
            circle: { showRadius: true }
          },
          edit: { featureGroup: drawnGroup, edit: true, remove: true }
        });
        map.addControl(drawCtl);
        map.on(L.Draw.Event.CREATED, function (e) {
          drawnGroup.clearLayers();
          activeShape = e.layer; drawnGroup.addLayer(activeShape); applyFilters();
        });
        map.on(L.Draw.Event.EDITED, function(){ activeShape = null; drawnGroup.eachLayer(function(l){ activeShape = l; }); applyFilters(); });
        map.on(L.Draw.Event.DELETED, function(){ drawnGroup.clearLayers(); activeShape=null; applyFilters(); });
      } catch(e){}

      var btnClearArea = document.getElementById('btnClearArea');
      if(btnClearArea){ btnClearArea.addEventListener('click', function(){ try { drawnGroup.clearLayers(); activeShape=null; applyFilters(); } catch(e){} }); }

      // Add bottom-right floating Locate button for better visibility
      var LocateCtl = L.Control.extend({ position: 'bottomright', onAdd: function(){
        var d = L.DomUtil.create('div', 'map-locate-floating');
        d.id = 'btnLocateFloating';
        d.innerHTML = '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12 2v2M12 20v2M4.93 4.93l1.41 1.41M17.66 17.66l1.41 1.41M2 12h2M20 12h2M4.93 19.07l1.41-1.41M17.66 6.34l1.41-1.41" stroke="#fff" stroke-width="2" stroke-linecap="round"/><circle cx="12" cy="12" r="3" stroke="#fff" stroke-width="2"/></svg><span>Locate</span>';
        L.DomEvent.disableClickPropagation(d);
        return d;
      }});
      map.addControl(new LocateCtl());

      var btnLocateFloating = document.getElementById('btnLocateFloating');
      function doLocate(){
        if (!navigator.geolocation) { alert('Geolocation is not supported by your browser.'); return; }
        navigator.geolocation.getCurrentPosition(function(pos){
          var lat = pos.coords.latitude, lng = pos.coords.longitude;
          userPos = [lat, lng];
          map.setView([lat, lng], 14);
          try {
            if(currentMarker){ map.removeLayer(currentMarker); }
            var currentIcon = L.divIcon({className:'current-loc-icon', html:'<span class="pulse"></span>', iconSize:[16,16], iconAnchor:[8,8]});
            currentMarker = L.marker([lat, lng], {title: 'You are here', icon: currentIcon, zIndexOffset: 1000}).addTo(map);
            L.circle([lat, lng], {radius: 200, color: '#2e7d32', fillColor:'#66bb6a', fillOpacity:0.2}).addTo(map);
          } catch(e){}
        }, function(){
          var msg = 'Unable to access your location.';
          if (location.protocol !== 'https:') msg += '\nTip: Geolocation requires HTTPS in most browsers.';
          alert(msg);
        }, { enableHighAccuracy:true, maximumAge:60000, timeout:8000 });
      }
      if(btnLocateFloating){ btnLocateFloating.addEventListener('click', doLocate); }
      if(btnLocate){ btnLocate.addEventListener('click', doLocate); }
      var btnToggleProps = null;
      map.whenReady(function(){ try { btnToggleProps = document.getElementById('btnToggleProps'); if(btnToggleProps){ btnToggleProps.classList.toggle('active', showProps); btnToggleProps.addEventListener('click', function(){ showProps = !showProps; btnToggleProps.classList.toggle('active', showProps); if(showProps){ if(!map.hasLayer(markers)) map.addLayer(markers); } else { if(map.hasLayer(markers)) map.removeLayer(markers); } }); } } catch(e){} });

      // Map -> List syncing (filter cards by map bounds and highlight)
      var syncListWithMapBounds = debounce(function(){
        try {
          var b = map.getBounds();
          var visibleUrls = new Set();
          markers.eachLayer(function(m){
            if(m.getLatLng && b.contains(m.getLatLng())){ if(m.options && m.options._url){ visibleUrls.add(m.options._url); } }
          });
          // Build URL map if not yet
          if(!allMarkers.length){ return; }
          var cards = document.querySelectorAll('.vfx-single-property-box-area');
          cards.forEach(function(card){
            try {
              var a = card.querySelector('.vfx-property-item a.vfx-property-img, .vfx-property-title-box-area a[href*="properties/"]');
              var href = a ? a.getAttribute('href') : '';
              if(href){ card.style.display = visibleUrls.size ? (visibleUrls.has(href) ? '' : 'none') : ''; }
            } catch(e){}
          });
        } catch(e){}
      }, 200);
      map.on('moveend', syncListWithMapBounds);

      // Initialize state from URL/localStorage
      try {
        var qp = parseQuery();
        var qInit = (qp.q ? decodeURIComponent(qp.q) : (localStorage.getItem('map_q')||''));
        var fInit = (qp.f || localStorage.getItem('map_f') || 'all');
        if(searchEl && qInit){ searchEl.value = qInit; }
        q = (qInit||'').toLowerCase();
        if(['all','sale','rent'].indexOf(fInit) >= 0){ setActiveChip(fInit); } else { setActiveChip('all'); }
        if(qp.z){ var z = parseInt(qp.z,10); if(!isNaN(z)) map.setZoom(z); }
        if(qp.bbox){ var parts = (qp.bbox+'').split(',').map(parseFloat); if(parts.length===4 && parts.every(function(n){return !isNaN(n);})){ var bb = L.latLngBounds([parts[0],parts[1]],[parts[2],parts[3]]); if(bb.isValid()) map.fitBounds(bb); }
        }
      } catch(e){}

    }
    if(document.readyState === 'complete'){
      initHomeMap();
    } else {
      window.addEventListener('load', initHomeMap);
    }
  })();
  </script>
<?php echo $__env->make('site_app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\USER\Documents\Dextra Properties\realestate.dextragroups.com\realestate.dextragroups.com\resources\views/pages/property/list.blade.php ENDPATH**/ ?>