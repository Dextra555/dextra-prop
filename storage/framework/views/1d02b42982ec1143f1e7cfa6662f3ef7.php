

<?php $__env->startSection("content"); ?>
 
 
  <div class="content-page">
      <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-lg-12">
              <div class="card-box">

              <div class="form-group row">
                <label class="col-sm-2 col-form-label">&nbsp;</label>
                    <div class="col-sm-8">
                    <a href="#" class="btn btn-info btn-md waves-effect waves-light m-b-20 mt-2 pull-right" title="<?php echo e(trans('words.test_smtp')); ?>" data-toggle="modal" data-target="#smtp_test_model"><i class="fa fa-send"></i> <?php echo e(trans('words.test_smtp')); ?></a> 
                    </div>

                    <div id="smtp_test_model" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="myModalLabel"><?php echo e(trans('words.test_smtp')); ?></h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                </div>
                                <div class="modal-body">
 
                                  <div class="form-group row">    
                                    <label class="col-sm-3 col-form-label"><?php echo e(trans('words.test_email')); ?></label>
                                    <div class="col-sm-9">
                                     <input type="email" name="test_email" placeholder="<?php echo e(trans('words.email')); ?>" class="form-control" id="test_email" autocomplete="off" required>
                                    </div>
                                  </div>
                                   
                                     
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" id="test_email_sent_btn" class="btn btn-primary waves-effect waves-light"> <?php echo e(trans('words.send')); ?></button>                                     
                                </div>
                                
                            </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
                    </div>
                   
                </div>
                
                <?php echo e(html()->form('POST', url('/admin/email_settings'))
                     ->attributes(['class' => 'form-horizontal', 'id' => 'settings_form', 'name' => 'settings_form', 'role' => 'form', 'enctype' => 'multipart/form-data'])->open()); ?>

 
                  
                  <input type="hidden" name="id" value="<?php echo e(isset($settings->id) ? $settings->id : null); ?>">
  
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label"><?php echo e(trans('words.host')); ?> *</label>
                    <div class="col-sm-8">
                      <input type="text" name="smtp_host" value="<?php echo e(isset($settings->smtp_host) ? $settings->smtp_host : null); ?>" class="form-control" placeholder="mail.example.com">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label"><?php echo e(trans('words.port')); ?> *</label>
                    <div class="col-sm-8">
                      <input type="text" name="smtp_port" value="<?php echo e(isset($settings->smtp_port) ? $settings->smtp_port : null); ?>" class="form-control" placeholder="587">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label"><?php echo e(trans('words.email')); ?> *</label>
                    <div class="col-sm-8">
                      <input type="text" name="smtp_email" value="<?php echo e(isset($settings->smtp_email) ? $settings->smtp_email : null); ?>" class="form-control" placeholder="info@example.com">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label"><?php echo e(trans('words.password')); ?> *</label>
                    <div class="col-sm-8">
                      <input type="password" name="smtp_password" value="<?php echo e(isset($settings->smtp_password) ? $settings->smtp_password : null); ?>" class="form-control" placeholder="****">
                    </div>
                  </div>   
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label"><?php echo e(trans('words.encryption')); ?></label>
                      <div class="col-sm-8">
                        <select class="form-control" name="smtp_encryption">                                                                
                            <option value="TLS" <?php if($settings->smtp_encryption=="TLS"): ?> selected <?php endif; ?>>TLS</option>
                            <option value="SSL" <?php if($settings->smtp_encryption=="SSL"): ?> selected <?php endif; ?>>SSL</option>                                  
                        </select>
                      </div>
                  </div>                    
                  <div class="form-group">
                    <div class="offset-sm-2 col-sm-9 pl-1">
                      <button type="submit" class="btn btn-primary waves-effect waves-light"> <?php echo e(trans('words.save_settings')); ?> </button>                      
                    </div>
                  </div>
                  <?php echo e(html()->form()->close()); ?>

              </div>
            </div>            
          </div>              
        </div>
      </div>
      <?php echo $__env->make("admin.copyright", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> 
    </div> 

<script src="<?php echo e(URL::asset('admin_assets/js/jquery.min.js')); ?>"></script>

<script type="text/javascript">
     jQuery(document).ready(function(){
    
      'use strict';    

    $(document).on('click', '#test_email_sent_btn', function() {
         
        var test_email = $("#test_email").val();

         
         if (test_email != '') {
            $.ajax({
                type: 'GET',
                url: "<?php echo e(URL::to('admin/test_smtp_settings')); ?>",
                data: "test_email=" + encodeURIComponent(test_email),
                dataType: 'json',
                beforeSend: function() {
                    $("#test_email_sent_btn").html('sending...');
                },
                success: function(response) {

                  var resp_status     = response.resp_status;
                  var resp_msg     = response.resp_msg;
                    
                  if (resp_status == 'success') {

                        const Toast = Swal.mixin({
                          toast: true,
                          position: 'top-end',
                          showConfirmButton: false,
                          timer: 3000,
                          timerProgressBar: false,                          
                        })

                        Toast.fire({
                          icon: 'success',
                          title: resp_msg
                        })
                        
                        $('#test_email').val('');
                       
                        $('#test_email_sent_btn').html('<?php echo e(trans('words.send')); ?>');                                      

                    } else {

                      const Toast = Swal.mixin({
                          toast: true,
                          position: 'top-end',
                          showConfirmButton: false,
                          timer: 3000,
                          timerProgressBar: false,                           
                        })

                        Toast.fire({
                          icon: 'error',
                          title: resp_msg
                        })
                         
                        $('#test_email_sent_btn').html('<?php echo e(trans('words.send')); ?>');
                         
                    }
                }
            });
        } 
        else {
            alert('Please enter email');
        }
    });
});
</script>

<script type="text/javascript">
    
    'use strict';    

    <?php if(Session::has('flash_message')): ?>     
 
      const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: false,         
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
 
 


<?php $__env->stopSection(); ?>
<?php echo $__env->make("admin.admin_app", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/dextragr/public_html/realestate.dextragroups.com/resources/views/admin/pages/settings/email_settings.blade.php ENDPATH**/ ?>