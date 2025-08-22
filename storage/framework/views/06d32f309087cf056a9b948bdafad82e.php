

<?php $__env->startSection("content"); ?>
 
  
  <div class="content-page">
      <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
              <div class="card-box table-responsive">
              <div class="row">   
                  <div class="wall-filter-block">  
                    <div class="row" style="align-items: center;justify-content: space-between;">             
                      <div class="col-sm-2">
						 <a href="<?php echo e(URL::to('admin/property/add')); ?>" class="btn btn-success btn-md waves-effect waves-light mb-2 mt-2" data-toggle="tooltip" title="<?php echo e(trans('words.add_property')); ?>"><?php echo e(trans('words.add_property')); ?></a>
                      </div>
					           <div class="col-sm-2">
                        <select class="form-control select2" name="type_id" id="type_id">
                          <option value="?type_id="><?php echo e(trans('words.type_text')); ?></option>
                            <?php $__currentLoopData = $type_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type_data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="?type_id=<?php echo e($type_data->id); ?>" <?php if(isset($_GET['type_id']) AND $_GET['type_id']==$type_data->id): ?> selected <?php endif; ?>><?php echo e($type_data->type_name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                      </div>
                      <div class="col-sm-2">
                        <select class="form-control select2" name="location_id" id="location_id">
                          <option value="?location_id="><?php echo e(trans('words.all_location')); ?></option>
                            <?php $__currentLoopData = $location_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $location_data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="?location_id=<?php echo e($location_data->id); ?>" <?php if(isset($_GET['location_id']) AND $_GET['location_id']==$location_data->id): ?> selected <?php endif; ?>><?php echo e($location_data->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                      </div>
                      <div class="col-md-3">
                           
                          <?php echo e(html()->form('GET', url('/admin/property'))
                     ->attributes(['class' => 'app-search', 'id' => 'search'])->open()); ?>   
                            <input type="text" name="s" placeholder="<?php echo e(trans('words.search_by_title')); ?>" class="form-control">
                            <button type="submit"><i class="fa fa-search"></i></button>
                            <?php echo e(html()->form()->close()); ?>

                      </div>
					  <div class="col-sm-3">
                        <div class="checkbox checkbox-success pull-right">
                            <input id="sellect_all" type="checkbox" name="sellect_all">
                            <label for="sellect_all"><?php echo e(trans('words.select_all')); ?></label>
                            &nbsp;&nbsp;
                            
                            <div class="btn-group">

                            <a href="javascript:void(0);" class="btn btn-info btn-md waves-effect waves-light mb-2 mt-2" data-toggle="tooltip" title="<?php echo e(trans('words.delete')); ?>" data-action="delete" id="data_remove_selected"><?php echo e(trans('words.delete')); ?></a>

                                 
                            </div>
                        </div>
                      </div>
                    </div> 
                  </div>                
                </div>

                <br/>

                <div class="row">
                  <?php $__currentLoopData = $list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-6" id="card_box_id_<?php echo e($data->id); ?>">

                        <!-- Simple card -->
                        <div class="card m-b-20">
                            <div class="wall-list-item">
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
                                <span class="by_user_lg">By <?php echo e($data->users->name); ?> </span>
                                <h4 class="card-title mb-3"><?php echo e(Str::limit(stripslashes($data->title),40)); ?></h4>
                                <a href="<?php echo e(url('admin/property/edit/'.$data->id)); ?>" class="btn btn-icon waves-effect waves-light btn-success m-r-5" data-toggle="tooltip" title="<?php echo e(trans('words.edit')); ?>"> <i class="fa fa-edit"></i> </a>
                                <a href="#" class="btn btn-icon waves-effect waves-light btn-danger data_remove" data-toggle="tooltip" title="<?php echo e(trans('words.remove')); ?>" data-id="<?php echo e($data->id); ?>"> <i class="fa fa-remove"></i> </a>
                                <a class="ml-2" href="Javascript:void(0);" data-toggle="tooltip" title="<?php if($data->status==1): ?><?php echo e(trans('words.active')); ?> <?php else: ?> <?php echo e(trans('words.inactive')); ?> <?php endif; ?>"><input type="checkbox" name="category_on_off" id="category_on_off" value="1" data-plugin="switchery" data-color="#28a745" data-size="small" class="enable_disable"  data-id="<?php echo e($data->id); ?>" <?php if($data->status==1): ?> <?php echo e('checked'); ?> <?php endif; ?>/></a>    
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

$(".enable_disable").on("change",function(e){      
       
      var post_id = $(this).data("id");
      
      var status_set = $(this).prop("checked"); 

      var action_name='property_status';
      

      $.ajax({
        type: 'post',
        url: "<?php echo e(URL::to('admin/ajax_status')); ?>",
        dataType: 'json',
        data: {"_token": "<?php echo e(csrf_token()); ?>",id: post_id, value: status_set, action_for: action_name},
        success: function(res) {

          if(res.status=='1')
          {
            Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: '<?php echo e(trans('words.status_changed')); ?>',
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
<script src="<?php echo e(URL::asset('admin_assets/js/jquery.min.js')); ?>"></script>
<script type="text/javascript">
  
  'use strict';

  $(".filter_checkbox").on("change", function(e) {

    var tempArray = [];

    $('input[name="filter_type[]"]:checked').each(function(){
      tempArray.push($(this).val());
    })
   
    var url="<?php echo e(URL::to('admin/news')); ?>?filter_type="+tempArray.toString();

    
    if (url) { // require a URL
            window.location = url; // redirect
      }
      return false;
     
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
 
<?php $__env->stopSection(); ?>


<?php echo $__env->make("admin.admin_app", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/dextragr/public_html/realestate.dextragroups.com/resources/views/admin/pages/property/list.blade.php ENDPATH**/ ?>