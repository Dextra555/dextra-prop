

<?php $__env->startSection("content"); ?>

  
  <div class="content-page">
      <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
              <div class="card-box table-responsive">

                <div class="row">
                          
                <div class="col-md-12">
                  <a href="<?php echo e(URL::to('admin/subscription_plan/add')); ?>" class="btn btn-success btn-md waves-effect waves-light m-b-20 pull-right" data-toggle="tooltip" title="<?php echo e(trans('words.add_plan')); ?>"><i class="fa fa-plus"></i> <?php echo e(trans('words.add_plan')); ?></a>
                </div>
              </div>

                <?php if(Session::has('flash_message')): ?>
                    <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span></button>
                        <?php echo e(Session::get('flash_message')); ?>

                    </div>
                <?php endif; ?>
                <div class="table-responsive">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th><?php echo e(trans('words.plan_name')); ?></th>
                      <th><?php echo e(trans('words.duration')); ?></th>
                      <th><?php echo e(trans('words.price')); ?></th>
                      <th><?php echo e(trans('words.property_limit')); ?></th>
                      <th><?php echo e(trans('words.status')); ?></th>                       
                      <th><?php echo e(trans('words.action')); ?></th>
                    </tr>
                  </thead>
                  <tbody>
                   <?php $__currentLoopData = $plan_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $plan_data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr id="card_box_id_<?php echo e($plan_data->id); ?>">
                      <td><?php echo e($plan_data->plan_name); ?></td>
                      <td><?php echo e(App\SubscriptionPlan::getPlanDuration($plan_data->id)); ?></td>
                      <td><?php echo e(html_entity_decode(getCurrencySymbols(getcong('currency_code')))); ?> <?php echo e($plan_data->plan_price); ?></td>
                      <td><?php echo e($plan_data->plan_property_limit); ?></td>
                      <td><?php if($plan_data->status==1): ?><span class="badge badge-success"><?php echo e(trans('words.active')); ?></span> <?php else: ?><span class="badge badge-danger"><?php echo e(trans('words.inactive')); ?></span><?php endif; ?></td>                       
                      <td>
                      <a href="<?php echo e(url('admin/subscription_plan/edit/'.$plan_data->id)); ?>" class="btn btn-icon waves-effect waves-light btn-success m-r-5" data-toggle="tooltip" title="<?php echo e(trans('words.edit')); ?>"> <i class="fa fa-edit"></i> </a>
                      
                      <a href="#" class="btn btn-icon waves-effect waves-light btn-danger data_remove" data-toggle="tooltip" title="<?php echo e(trans('words.remove')); ?>" data-id="<?php echo e($plan_data->id); ?>"> <i class="fa fa-remove"></i> </a>             
                      </td>
                    </tr>
                   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                     
                     
                     
                  </tbody>
                </table>
              </div>
                <nav class="paging_simple_numbers">
                <?php echo $__env->make('admin.pagination', ['paginator' => $plan_list], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> 
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
 
 $(".data_remove").on('click', function () {      
   
  'use strict';    

   var post_id = $(this).data("id");
   var action_name='plan_delete';
 
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
 
 </script>    

<?php $__env->stopSection(); ?>
<?php echo $__env->make("admin.admin_app", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/dextragr/public_html/realestate.dextragroups.com/resources/views/admin/pages/plan/list.blade.php ENDPATH**/ ?>