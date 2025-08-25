<?php $__env->startSection("content"); ?>
 
<style>
  /* Modern card styling */
  .property-card {
    border: 1px solid #eef0f2;
    border-radius: 14px;
    overflow: hidden;
    box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    transition: box-shadow .2s ease, transform .2s ease;
    background: #fff;
  }
  .property-card:hover { box-shadow: 0 8px 24px rgba(0,0,0,0.08); transform: translateY(-2px); }
  .property-media { position: relative; }
  .property-card .card-img-top {
    height: 180px;
    width: 100%;
    object-fit: cover;
  }
  .property-media .wall_check { position: absolute; left: 10px; top: 10px; z-index: 2; }
  .property-media .view_item_block { position: absolute; right: 10px; top: 10px; z-index: 2; }
  .property-media .wall_sub_text { position: absolute; left: 10px; bottom: 10px; z-index: 2; margin: 0; padding: 6px 10px; border-radius: 999px; background: rgba(0,0,0,0.6); color: #fff; font-size: 12px; }
  .property-card .card-body { padding: 14px; }
  .by_user_lg { font-size: 12px; color: #6c757d; }
  .status-chip { font-size: 11px; padding: 4px 10px; border-radius: 999px; text-transform: uppercase; letter-spacing: .4px; }
  .status-chip.badge-success, .status-chip.approved { background: #e8f7ef; color: #198754; }
  .status-chip.badge-danger, .status-chip.rejected { background: #fdecef; color: #dc3545; }
  .status-chip.badge-warning, .status-chip.pending { background: #fff7e6; color: #f0a500; }
  .icon-btn { display: inline-flex; align-items: center; justify-content: center; width: 36px; height: 36px; border-radius: 10px; border: 1px solid #e9ecef; color: #6c757d; background: #fff; transition: all .15s ease; }
  .icon-btn:hover { color: #0d6efd; border-color: #cfe2ff; background: #f8fbff; }
  .icon-btn.danger:hover { color: #dc3545; border-color: #f8d7da; background: #fff5f6; }
  .action-row { display: grid; grid-template-columns: 1fr 1fr; gap: 10px; margin-top: 8px; }
  .approve-btn { background: linear-gradient(180deg,#22c55e,#16a34a); border: none; color: #fff; padding: 8px 12px; border-radius: 10px; font-weight: 600; }
  .approve-btn:hover { filter: brightness(0.95); }
  .reject-btn { background: #f8f9fa; border: 1px solid #e9ecef; color: #dc3545; padding: 8px 12px; border-radius: 10px; font-weight: 600; }
  .reject-btn:hover { background: #fff5f6; border-color: #f8d7da; }
  .card-title { font-size: 16px; line-height: 1.3; color: #212529; }
  
  /* Dark theme overrides scoped to this page */
  .dark-theme {
    background: #0b1220;
  }
  .dark-theme .card-box { background: transparent; border: 0; }
  .dark-theme .property-card { background: #0f172a; border-color: #1f2937; box-shadow: 0 2px 10px rgba(0,0,0,.4); }
  .dark-theme .property-card:hover { box-shadow: 0 12px 30px rgba(0,0,0,.5); }
  .dark-theme .card-title { color: #e5e7eb; }
  .dark-theme .by_user_lg { color: #9ca3af; }
  .dark-theme .icon-btn { background: #0b1220; border-color: #243041; color: #93a4b3; }
  .dark-theme .icon-btn:hover { background: #111a2b; border-color: #375075; color: #cfe2ff; }
  .dark-theme .icon-btn.danger:hover { color: #fda4af; border-color: #7f1d1d; background: #1f0f12; }
  .dark-theme .status-chip.approved { background: rgba(34,197,94,.15); color: #34d399; }
  .dark-theme .status-chip.rejected { background: rgba(239,68,68,.15); color: #f87171; }
  .dark-theme .status-chip.pending { background: rgba(245,158,11,.15); color: #fbbf24; }
  /* Action buttons (Approve / Reject) - clean + consistent */
  .dark-theme .action-btn { 
    border: 0; border-radius: 10px; padding: 8px 12px; font-weight: 600; font-size: 12px; 
    display:inline-flex; align-items:center; gap:8px; line-height: 1; box-shadow: 0 2px 6px rgba(0,0,0,.25);
  }
  .dark-theme .action-btn i { font-size: 12px; }
  .dark-theme .approve-btn { background: linear-gradient(180deg,#22c55e,#16a34a); color:#ffffff; }
  .dark-theme .approve-btn:hover { filter: brightness(.95); }
  .dark-theme .reject-btn { background: linear-gradient(180deg,#ef4444,#dc2626); color:#ffffff; }
  .dark-theme .reject-btn:hover { filter: brightness(.95); }
  .dark-theme .property-media .wall_sub_text { background: rgba(0,0,0,.55); color: #e5e7eb; }
  .dark-theme .select2-container--default .select2-selection--single { background: #0f172a; border-color: #243041; color: #e5e7eb; }
  .dark-theme .form-control { background: #0f172a; border-color: #243041; color: #e5e7eb; }
  .dark-theme .btn.btn-info, .dark-theme .btn.btn-success { border: 0; }

  /* Modern pill switch (clean + aligned) */
  .modern-switch{ display:inline-flex; align-items:center; gap:6px; }
  .modern-switch .custom-control-input{ position:absolute; left:-9999px; }
  .modern-switch .custom-control-label{
    cursor:pointer; position:relative; user-select:none; margin:0; white-space:nowrap;
    padding-left:56px; line-height:26px; font-size:12px; font-weight:600; color:#9ca3af;
  }
  .modern-switch .custom-control-label::before{
    content:''; position:absolute; left:0; top:50%; width:48px; height:26px; transform:translateY(-50%);
    background:#223049; border-radius:999px; box-shadow:inset 0 1px 4px rgba(0,0,0,.35), 0 0 0 1px rgba(255,255,255,.03);
    transition:all .2s ease;
  }
  .modern-switch .custom-control-label::after{
    content:''; position:absolute; left:3px; top:10%; width:20px; height:20px;
    background:#fff; border-radius:50%; box-shadow:0 2px 8px rgba(0,0,0,.25); transition:all .2s ease;
  }
  .modern-switch .custom-control-input:focus ~ .custom-control-label::before{ box-shadow:0 0 0 2px rgba(59,130,246,.35), inset 0 1px 4px rgba(0,0,0,.35); }
  .modern-switch .custom-control-input:checked ~ .custom-control-label::before{ background:linear-gradient(180deg,#22c55e,#16a34a); }
  .modern-switch .custom-control-input:checked ~ .custom-control-label::after{ left:14px; }
  .modern-switch .custom-control-input:checked ~ .custom-control-label{ color:#34d399; }
  .modern-switch .custom-control-input:not(:checked) ~ .custom-control-label{ color:#9ca3af; }
  .modern-switch .custom-control-input:disabled ~ .custom-control-label{ opacity:.7; }
  /* Filters toolbar - ultra minimal */
  .filters-toolbar { margin-bottom: 12px; padding-bottom: 8px; border-bottom:1px solid #e5e7eb; }
  .dark-theme .filters-toolbar { border-bottom-color:#2d3543; }
  .filters-card { background: transparent; border: 0; padding: 0; box-shadow: none; }
  .filters-inline { display:flex; flex-wrap:wrap; align-items:center; gap:8px; }
  .filters-inline .grow { flex: 1 1 auto; min-width: 220px; }
  .filters-card .form-control, .filters-card .select2 { height: 36px; }
  .filters-actions { display:flex; align-items:center; gap:10px; margin-left:auto; }
  .btn-ghost { background:transparent; border:1px solid #e5e7eb; color:#374151; }
  .btn-ghost:hover { background:#f9fafb; }
  .dark-theme .btn-ghost { border-color:#2d3543; color:#e5e7eb; }
  .dark-theme .btn-ghost:hover { background:#0f172a; }
  /* Select2 compact alignment */
  .filters-card .select2-container .select2-selection--single { height:36px; border-color:#e5e7eb; }
  .filters-card .select2-container--default .select2-selection--single .select2-selection__rendered { line-height:36px; }
  .filters-card .select2-container--default .select2-selection--single .select2-selection__arrow { height:36px; }
  .dark-theme .select2-container .select2-selection--single { border-color:#2d3543; }
  /* Search field style */
  .search-field { position: relative; }
  .search-field .fa-search { position:absolute; left:10px; top:50%; transform:translateY(-50%); color:#9ca3af; font-size:13px; }
  .search-field input { padding-left:32px; }
 </style>
 
  <div class="content-page dark-theme">
      <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
              <div class="card-box table-responsive">
                <div class="filters-toolbar">
                  <div class="filters-card">
                    <div class="filters-inline">
                      <a href="<?php echo e(URL::to('admin/property/add')); ?>" class="btn btn-success btn-md" data-toggle="tooltip" title="<?php echo e(trans('words.add_property')); ?>">
                        <i class="fa fa-plus mr-1"></i> <?php echo e(trans('words.add_property')); ?>

                      </a>
                      <form method="GET" action="<?php echo e(url('/admin/property')); ?>" id="filterForm" class="filters-inline w-100">
                        <div class="grow">
                          <select class="form-control select2" name="type_id" id="type_id">
                            <option value=""><?php echo e(trans('words.type_text')); ?></option>
                            <?php $__currentLoopData = $type_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type_data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                              <option value="<?php echo e($type_data->id); ?>" <?php if(request('type_id')==$type_data->id): ?> selected <?php endif; ?>><?php echo e($type_data->type_name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                          </select>
                        </div>
                        <div class="grow">
                          <select class="form-control select2" name="location_id" id="location_id">
                            <option value=""><?php echo e(trans('words.all_location')); ?></option>
                            <?php $__currentLoopData = $location_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $location_data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                              <option value="<?php echo e($location_data->id); ?>" <?php if(request('location_id')==$location_data->id): ?> selected <?php endif; ?>><?php echo e($location_data->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                          </select>
                        </div>
                        <div class="grow">
                          <select class="form-control select2" name="user_id" id="user_id">
                            <option value="">All Users</option>
                            <?php $__currentLoopData = ($users ?? []); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $u): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                              <option value="<?php echo e($u->id); ?>" <?php if(request('user_id')==$u->id): ?> selected <?php endif; ?>><?php echo e($u->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                          </select>
                        </div>
                        <div class="grow search-field">
                          <i class="fa fa-search"></i>
                          <input type="text" name="s" value="<?php echo e(request('s')); ?>" placeholder="<?php echo e(trans('words.search_by_title')); ?>" class="form-control">
                        </div>
                        <div class="filters-actions">
                          <button type="submit" class="btn btn-primary"><i class="fa fa-filter mr-1"></i> Filter</button>
                          <a href="<?php echo e(url('/admin/property')); ?>" class="btn btn-ghost">Reset</a>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
                <br/>
                <div class="row">
                  <?php $__currentLoopData = $list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-6" id="card_box_id_<?php echo e($data->id); ?>">
                        <!-- Modern card -->
                        <div class="card m-b-20 property-card">
                            <div class="wall-list-item property-media">
                              <div class="checkbox checkbox-success wall_check">
                                <input type="checkbox" name="post_ids[]" id="checkbox<?php echo $i; ?>" value="<?php echo $data->id; ?>" class="post_ids">
                                <label for="checkbox<?php echo $i; ?>"></label>
                              </div>
                              <div class="d-flex wall_preview_item view_item_block">
                                  <ul>
                                    <li><a href="javascript:void(0)" data-toggle="tooltip" title="<?php echo e(post_views_count($data->id,"Property")); ?> <?php echo e(trans('words.views')); ?>"><i class="fa fa-eye"></i></a></li>
                                  </ul>
                              </div>
                              <p class="wall_sub_text"><?php echo e($data->types->type_name); ?></p>
                              <div class="d-flex position-absolute" style="top: 4px;right: 15px;"></div>
                              <?php if(isset($data->image)): ?> <img class="card-img-top thumb-lg img-fluid" src="<?php echo e(URL::to('/'.$data->image)); ?>" alt=""> <?php endif; ?>
                            </div>
                            <div class="card-body p-3">
                                <div class="d-flex align-items-center justify-content-between mb-2">
                                  <span class="by_user_lg">By <?php echo e($data->users->name); ?></span>
                                  <?php $appr = $data->approval_status ?? 'pending'; ?>
                                  <span class="status-chip ml-2 text-uppercase <?php echo e($appr==='approved' ? 'approved' : ($appr==='rejected' ? 'rejected' : 'pending')); ?>"><?php echo e($appr); ?></span>
                                </div>
                                <!-- Active/Inactive toggle -->
                                <div class="d-flex align-items-center justify-content-between mb-2">
                                  <span class="by_user_lg">Status:</span>
                                  <div class="custom-control custom-switch modern-switch">
                                    <input type="checkbox" class="custom-control-input enable_disable" id="switch_status_<?php echo e($data->id); ?>" data-id="<?php echo e($data->id); ?>" <?php if($data->status==1): ?> checked <?php endif; ?>>
                                    <label class="custom-control-label" for="switch_status_<?php echo e($data->id); ?>"><?php if($data->status==1): ?> Active <?php else: ?> Inactive <?php endif; ?></label>
                                  </div>
                                </div>
                                <h5 class="card-title mb-2"><?php echo e(Str::limit(stripslashes($data->title),40)); ?></h5>
                                <div class="mb-2">
                                  <a href="<?php echo e(url('admin/property/edit/'.$data->id)); ?>" class="btn btn-icon waves-effect waves-light btn-success m-r-5" data-toggle="tooltip" title="<?php echo e(trans('words.edit')); ?>"> <i class="fa fa-edit"></i> </a>
                                  <a href="#" class="btn btn-icon waves-effect waves-light btn-danger data_remove" data-toggle="tooltip" title="<?php echo e(trans('words.remove')); ?>" data-id="<?php echo e($data->id); ?>"> <i class="fa fa-remove"></i> </a>
                                </div>
                                <div class="action-row">
                                  <?php if(($data->approval_status ?? 'pending') !== 'approved'): ?>
                                    <button type="button" class="btn action-btn approve-btn btn-approve" data-id="<?php echo e($data->id); ?>"><i class="fa fa-check"></i> Approve</button>
                                  <?php endif; ?>
                                  <button type="button" class="btn action-btn reject-btn btn-reject" data-id="<?php echo e($data->id); ?>"><i class="fa fa-times"></i> Reject</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>      
                </div>
                <nav class="paging_simple_numbers">
                <?php echo $__env->make('admin.pagination', ['paginator' => $list], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> 
                </nav>
              </div>
            </div>
          </div>
        </div>
      </div>
    <?php echo $__env->make("admin.copyright", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> 
  </div>    

  <script src="<?php echo e(URL::asset('admin_assets/js/jquery.min.js')); ?>"></script>
  <!-- SweetAlert2 -->
  <script src="<?php echo e(URL::asset('admin_assets/js/sweetalert2@11.js')); ?>"></script>
  <script type="text/javascript">
    'use strict';

    // Confirm before deactivating, immediate when activating
    $(document).on("change", ".enable_disable", function(e){
      var $cb = $(this);
      var post_id = $cb.data("id");
      var newState = $cb.is(":checked");
      var action_name = 'property_status';

      var sendRequest = function(state){
        $cb.prop('disabled', true);
        $.ajax({
          type: 'post',
          url: "<?php echo e(URL::to('admin/ajax_status')); ?>",
          dataType: 'json',
          data: {"_token": "<?php echo e(csrf_token()); ?>", id: post_id, value: state, action_for: action_name},
          success: function(res){
            if(res.status=='1'){
              Swal.fire({
                position: 'center',
                icon: 'success',
                title: '<?php echo e(trans('words.status_changed')); ?>',
                showConfirmButton: true,
                confirmButtonColor: '#10c469',
                background:"#1a2234",
                color:"#fff"
              })
              // Update label text to reflect current state
              var label = $("label[for='switch_status_"+post_id+"']");
              if(state){
                label.text('Active');
              }else{
                label.text('Inactive');
              }
            }else{
              // revert on failure
              $cb.prop('checked', !state);
              Swal.fire({
                position: 'center',
                icon: 'error',
                title: res.message || 'Something went wrong!',
                showConfirmButton: true,
                confirmButtonColor: '#10c469',
                background:"#1a2234",
                color:"#fff"
              })
            }
          },
          error: function(){
            $cb.prop('checked', !state);
            Swal.fire({
              position: 'center',
              icon: 'error',
              title: 'Network error',
              showConfirmButton: true,
              confirmButtonColor: '#10c469',
              background:"#1a2234",
              color:"#fff"
            })
          },
          complete: function(){
            $cb.prop('disabled', false);
          }
        });
      };

      if(!newState){
        // Deactivation confirmation
        Swal.fire({
          title: 'Deactivate this property?',
          text: 'It will be hidden from the website until reactivated.',
          icon: 'warning',
          showCancelButton: true,
          confirmButtonText: 'Yes, deactivate',
          cancelButtonText: 'Cancel',
          confirmButtonColor: '#dc3545',
          background:'#1a2234',
          color:'#fff'
        }).then((result)=>{
          if(result.isConfirmed){
            sendRequest(false);
          }else{
            // revert back to checked
            $cb.prop('checked', true);
          }
        });
      } else {
        // Activate without confirmation
        sendRequest(true);
      }
    }); 

  </script>
  <script type="text/javascript">
    'use strict';
    //Single
    $(".data_remove").on('click', function () {      
      
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
                url: "<?php echo e(URL::to('admin/ajax_delete')); ?>",
                dataType: 'json',
                data: {"_token": "<?php echo e(csrf_token()); ?>",id: post_id, action_for: action_name},
                success: function(res) {

                  if(res.status=='1')
                  {  

                      var selector = "#card_box_id_"+post_id;
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

    //Multiple
    $("#data_remove_selected").on('click', function () {      
      'use strict';    
      var post_ids = $.map($('.post_ids:checked'), function(c) {
          return c.value;
        });    
        
        if(post_ids.length==0)
        {
            const Toast = Swal.mixin({
              toast: true,
              position: 'top-end',
              showConfirmButton: false,
              timer: 3000,
              timerProgressBar: false,         
            })

            Toast.fire({
              icon: 'error',
              title: '<?php echo e(trans('words.you_didnt_select')); ?>'
            })
        }
        else
        { 

              var action_name='property_delete_selected';

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
                        url: "<?php echo e(URL::to('admin/ajax_delete')); ?>",
                        dataType: 'json',
                        data: {"_token": "<?php echo e(csrf_token()); ?>",id: post_ids, action_for: action_name},
                        success: function(res) {

                          if(res.status=='1')
                          {  
                              $.map($('.post_ids:checked'), function(c) {
                                
                                var post_id= c.value;
                                
                                var selector = "#card_box_id_"+post_id;
                                  $(selector ).fadeOut(1000);
                                  setTimeout(function(){
                                          $(selector ).remove()
                                      }, 1000);

                                return c.value;
                              });

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

        }
      

    });
  </script> 
  <script type="text/javascript">
    
    'use strict';
   // Ensure no auto-submit or auto-redirect on filter changes on this page
   $(function(){
     var selectors = '#type_id, #location_id, #user_id';
     // Remove any existing change handlers possibly added globally (e.g., in custom.js)
     $(selectors).off('change');
     $(document).off('change', selectors);
     // Prevent select2 events from bubbling into global logic
     $(selectors).on('select2:select select2:clear', function(e){ e.stopPropagation(); });
     // Optional no-op change handler to make intent explicit
     $(selectors).on('change', function(e){ /* no auto submit here */ });
   });

   var totalItems = 0;
    $(document).on("click", "#sellect_all", function() {
        
      totalItems = 0;

      $("input[name='post_ids[]']").not(this).prop('checked', this.checked);
      $.each($("input[name='post_ids[]']:checked"), function() {
        totalItems = totalItems + 1;       
      });

      const Toast = Swal.mixin({
          toast: true,
          position: 'top-end',
          showConfirmButton: false,
          timer: 3000,
          timerProgressBar: false,
          
        })

      
      if ($("input[name='post_ids[]']").prop("checked") == true) {
          
        Toast.fire({
        icon: 'success',
        title: totalItems + ' <?php echo e(trans('words.item_checked')); ?>'
      })

      } else if ($("input[name='post_ids[]']").prop("checked") == false) {
        totalItems = 0;
        
        Toast.fire({
        icon: 'success',
        title: totalItems + ' <?php echo e(trans('words.item_checked')); ?>'
      })
        
      }
  
    });

    $(document).on("click", ".post_ids", function(e) {

    'use strict';      
  
    if ($(this).prop("checked") == true) {
      totalItems = totalItems + 1;
    } else if ($(this).prop("checked") == false) {
      totalItems = totalItems - 1;
    }

      const Toast = Swal.mixin({
          toast: true,
          position: 'top-end',
          showConfirmButton: false,
          timer: 3000,
          timerProgressBar: false,
          
        })

      if (totalItems == 0) {
        Toast.fire({
          icon: 'success',
          title: totalItems + ' <?php echo e(trans('words.item_checked')); ?>'
        })

        return true;
      }
  
      Toast.fire({
        icon: 'success',
        title: totalItems + ' <?php echo e(trans('words.item_checked')); ?>'
      })

  
    });

  </script> 
  <script type="text/javascript">
    'use strict';

    // Approve
    $(document).on('click', '.btn-approve', function(){
      var post_id = $(this).data('id');
      $.ajax({
        type: 'post',
        url: "<?php echo e(url('admin/property')); ?>/"+post_id+"/approve",
        dataType: 'json',
        data: {"_token": "<?php echo e(csrf_token()); ?>"},
        success: function(res){
          if(res.status=='1'){
            Swal.fire({icon:'success', title:'Approved', background:'#1a2234', color:'#fff'}).then(()=>{ location.reload(); });
          }else{
            Swal.fire({icon:'error', title: res.message || 'Error', background:'#1a2234', color:'#fff'});
          }
        }
      });
    });

    // Reject with reason
    $(document).on('click', '.btn-reject', function(){
      var post_id = $(this).data('id');
      Swal.fire({
      title: 'Rejection Reason',
      input: 'textarea',
      inputLabel: 'Please provide a reason',
      inputPlaceholder: 'Enter reason...',
      inputAttributes: { 'aria-label': 'Rejection reason' },
      showCancelButton: true,
      confirmButtonText: 'Reject',
      background:'#1a2234',
      color:'#fff'
      }).then((result)=>{
        if(result.isConfirmed && result.value){
          $.ajax({
            type: 'post',
            url: "<?php echo e(url('admin/property')); ?>/"+post_id+"/reject",
            dataType: 'json',
            data: {"_token": "<?php echo e(csrf_token()); ?>", reason: result.value},
            success: function(res){
              if(res.status=='1'){
                Swal.fire({icon:'success', title:'Rejected', background:'#1a2234', color:'#fff'}).then(()=>{ location.reload(); });
              }else{
                Swal.fire({icon:'error', title: res.message || 'Error', background:'#1a2234', color:'#fff'});
              }
            }
          });
        }
      });
    });
  </script>

<?php $__env->stopSection(); ?>

 

<?php echo $__env->make("admin.admin_app", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\USER\Documents\Dextra Properties\realestate.dextragroups.com\realestate.dextragroups.com\resources\views/admin/pages/property/list.blade.php ENDPATH**/ ?>