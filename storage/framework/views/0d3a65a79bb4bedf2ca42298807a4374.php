

<?php $__env->startSection("content"); ?>

  
  <div class="content-page">
      <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
              <div class="card-box table-responsive">
             
                <div class="row">             
                <div class="col-md-3">
                  <span data-toggle="modal" data-target="#add_model">
                    <a href="#" class="btn btn-success btn-md waves-effect waves-light m-b-20" data-toggle="tooltip" title="<?php echo e(trans('words.add_location')); ?>"><i class="fa fa-plus"></i> <?php echo e(trans('words.add_location')); ?></a>
                  </span>

                      <div id="add_model" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content pt-3 pb-3 pl-0 pr-0">
                                <div class="modal-header pl-3 pr-3">
                                    <h4 class="modal-title mt-0" id="myModalLabel"><?php echo e(trans('words.add_location')); ?></h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                </div>
                                <div class="modal-body pl-3 pr-3 pt-3 pb-0">
 

                                 <?php echo e(html()->form('POST', url('/admin/location/add_edit'))
                                  ->attributes(['class' => 'form-horizontal', 'id' => 'post_form', 'name' => 'post_form', 'role' => 'form', 'enctype' => 'multipart/form-data'])->open()); ?>

                                    
                                  <div class="form-group row">    
                                    <label class="col-sm-4 col-form-label"><?php echo e(trans('words.location_name')); ?></label>
                                    <div class="col-sm-8">
                                      <input type="text" name="name" value="" class="form-control">
                                    </div>
                                  </div>

                                  <div class="form-group row">    
                                    <label class="col-sm-4 col-form-label"><?php echo e(trans('words.status')); ?></label>
                                    <div class="col-sm-8">
                                    <select class="form-control" name="status">                               
                                        <option value="1"><?php echo e(trans('words.active')); ?></option>
                                        <option value="0"><?php echo e(trans('words.inactive')); ?></option>                            
                                     </select>
                                    </div>
                                  </div>                                   
                                     
                                </div>
                                <div class="modal-footer pl-3 pr-3">
                                    <button type="submit" class="btn btn-primary waves-effect waves-light"> <?php echo e(trans('words.save')); ?></button>                                     
                                </div>
                                <?php echo e(html()->form()->close()); ?>

 
                            </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
                    </div>
                 </div>
              </div>
 
              <div class="row">
                  <?php $__currentLoopData = $list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-6" id="card_box_id_<?php echo e($data->id); ?>">
                        <!-- Simple card -->
                        <div class="card m-b-20 p-3 lng_item_grid">
                            <div class="card-body p-0">
                                
								<div class="item_latter"><?php echo e(stripslashes($data->name)); ?></div>
                                <span data-toggle="modal" data-target="#edit_model<?php echo e($data->id); ?>">
                                    <a href="#" class="btn btn-icon waves-effect waves-light btn-success m-r-5" data-toggle="tooltip" title="<?php echo e(trans('words.edit')); ?>"><i class="fa fa-edit"></i></a>
                                </span>
                                <div id="edit_model<?php echo e($data->id); ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                  <div class="modal-dialog modal-dialog-centered">
                                      <div class="modal-content pt-3 pb-3 pl-0 pr-0">
                                          <div class="modal-header pl-3 pr-3">
                                              <h4 class="modal-title mt-0" id="myModalLabel"><?php echo e(trans('words.edit_location')); ?></h4>
                                              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                          </div>
                                          <div class="modal-body pl-3 pr-3 pt-3 pb-0">
 
                                          <?php echo e(html()->form('POST', url('/admin/location/add_edit'))
                                            ->attributes(['class' => 'form-horizontal', 'id' => 'post_form', 'name' => 'post_form', 'role' => 'form', 'enctype' => 'multipart/form-data'])->open()); ?>

                                            
                                          <input type="hidden" name="id" value="<?php echo e($data->id); ?>">
                                            <div class="form-group row">    
                                              <label class="col-sm-4 col-form-label"><?php echo e(trans('words.location_name')); ?></label>
                                              <div class="col-sm-8">
                                                <input type="text" name="name" value="<?php echo e(stripslashes($data->name)); ?>" class="form-control">
                                              </div>
                                            </div>

                                            <div class="form-group row">    
                                              <label class="col-sm-4 col-form-label"><?php echo e(trans('words.status')); ?></label>
                                              <div class="col-sm-8">
                                              <select class="form-control" name="status">                               
                                                  <option value="1" <?php if($data->status==1): ?> selected <?php endif; ?>><?php echo e(trans('words.active')); ?></option>
                                                  <option value="0" <?php if($data->status==0): ?> selected <?php endif; ?>><?php echo e(trans('words.inactive')); ?></option>                            
                                              </select>
                                              </div>
                                            </div>                                   
                                          </div>
                                          <div class="modal-footer pl-3 pr-3">
                                              <button type="submit" class="btn btn-primary waves-effect waves-light"> <?php echo e(trans('words.save')); ?></button>                                     
                                          </div>
                                          <?php echo e(html()->form()->close()); ?>

                                      </div><!-- /.modal-content -->
                                  </div><!-- /.modal-dialog -->
                                </div>
                                <a href="#" class="btn btn-icon waves-effect waves-light btn-danger data_remove" data-toggle="tooltip" title="<?php echo e(trans('words.remove')); ?>" data-id="<?php echo e($data->id); ?>"> <i class="fa fa-remove"></i></a>
                                <a href="Javascript:void(0);" class="ml-2 fl-right mt-1" data-toggle="tooltip" title="<?php if($data->status==1): ?><?php echo e(trans('words.active')); ?> <?php else: ?> <?php echo e(trans('words.inactive')); ?> <?php endif; ?>"><input type="checkbox" name="ads_on_off" id="ads_on_off" value="1" data-plugin="switchery" data-color="#28a745" data-size="small" class="enable_disable"  data-id="<?php echo e($data->id); ?>" <?php if($data->status==1): ?> <?php echo e('checked'); ?> <?php endif; ?>/></a>    
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

<script type="text/javascript">
    
    <?php if(Session::has('flash_message')): ?>     
 
      const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: false,
        /*didOpen: (toast) => {
          toast.addEventListener('mouseenter', Swal.stopTimer)
          toast.addEventListener('mouseleave', Swal.resumeTimer)
        }*/
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

<script type="text/javascript">
 
 $(".enable_disable").on("change",function(e){      
        
       var post_id = $(this).data("id");
       
       var status_set = $(this).prop("checked"); 
 
       var action_name='location_status';
       //alert($(this).is(":checked"));
       //alert(status_set);
 
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

$(".data_remove").click(function () {  
  
  var post_id = $(this).data("id");
  var action_name='location_delete';

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

  //alert(post_id);

  //alert(JSON.stringify(result));

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

</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make("admin.admin_app", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/dextragr/public_html/realestate.dextragroups.com/resources/views/admin/pages/location/list.blade.php ENDPATH**/ ?>