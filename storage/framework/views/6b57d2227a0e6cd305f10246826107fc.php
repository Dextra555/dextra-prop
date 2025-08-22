

<?php $__env->startSection("content"); ?>
 
  
  <div class="content-page">
      <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
              <div class="card-box table-responsive">

                <div class="row">
                 <div class="col-md-4 m-b-20 mt-2">
                      
                     <?php echo e(html()->form('GET', url('/admin/reports'))
                     ->attributes(['class' => 'app-search', 'id' => 'search'])->open()); ?>


                      <input type="text" name="s" placeholder="<?php echo e(trans('words.search_by_name')); ?>" class="form-control">
                      <button type="submit"><i class="fa fa-search"></i></button>
                      <?php echo e(html()->form()->close()); ?>

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
                      <th><?php echo e(trans('words.name')); ?></th>
                      <th><?php echo e(trans('words.email')); ?></th>
                      <th><?php echo e(trans('words.title')); ?></th>
                      <th><?php echo e(trans('words.message')); ?></th>
                      <th><?php echo e(trans('words.date')); ?></th>
                       <th><?php echo e(trans('words.action')); ?></th>
                    </tr>
                  </thead>
                  <tbody>
                   <?php $__currentLoopData = $list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr id="post_id_<?php echo e($data->id); ?>">
                       <td><?php echo e(\App\User::getUserFullname($data->user_id)); ?></td>
                       <td><?php echo e(\App\User::getUserInfo($data->user_id,'email')); ?></td>
                       <td>
 
                       <a href="<?php echo e(url('admin/property/edit/'.$data->post_id)); ?>"> 
                        <?php echo e(stripslashes(\App\Property::getPropertyInfo($data->post_id,'title'))); ?>

                        </a>  
                       
                      </td>
                       <td><?php echo e(stripslashes($data->message)); ?></td>
                       
                       <td><?php echo e(date('M d Y h:i a',$data->date)); ?></td>
                     
                       </td>
 
                      <td>                       
                      
                      <a href="#" class="btn btn-icon waves-effect waves-light btn-danger data_remove" data-toggle="tooltip" title="<?php echo e(trans('words.remove')); ?>" data-id="<?php echo e($data->id); ?>"> <i class="fa fa-remove"></i> </a> 
                      
                      </td>
                    </tr>
                   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                     
                     
                     
                  </tbody>
                </table>
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
//Single
$(".data_remove").on('click', function () {      
  'use strict';    
  var post_id = $(this).data("id");
  var action_name='report_delete';

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

                  var selector = "#post_id_"+post_id;
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
<?php echo $__env->make("admin.admin_app", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/dextragr/public_html/realestate.dextragroups.com/resources/views/admin/pages/reports/list.blade.php ENDPATH**/ ?>