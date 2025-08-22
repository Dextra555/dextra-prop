

<?php $__env->startSection("content"); ?>
 
  <div class="content-page">
      <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-lg-12">
              <div class="card-box">
              <?php echo e(html()->form('POST', url('/admin/web_ads_settings'))
                     ->attributes(['class' => 'form-horizontal', 'id' => 'settings_form', 'name' => 'settings_form', 'role' => 'form', 'enctype' => 'multipart/form-data'])->open()); ?> 
                  
                  
                  <input type="hidden" name="id" value="<?php echo e(isset($settings->id) ? $settings->id : null); ?>">
   
                 <h5 class="mb-4" style="color:#f9f9f9"><i class="fa fa-buysellads pr-2"></i> <b>Banner Ads</b></h5>

                  <div class="alert alert-info"><b>Note:</b> Leave empty if not want to display</div>
 
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Home Top</label>
                    <div class="col-sm-8">                       
                      
                    <textarea name="home_top" class="form-control"><?php echo e(isset($settings->home_top) ? stripslashes($settings->home_top) : null); ?></textarea>

                    </div>
                  </div>                  
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Home Bottom</label>
                    <div class="col-sm-8">                       
                      
                    <textarea name="home_bottom" class="form-control"><?php echo e(isset($settings->home_bottom) ? stripslashes($settings->home_bottom) : null); ?></textarea>

                    </div>
                  </div>
                  <hr/> 

                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">List Top</label>
                    <div class="col-sm-8">                       
                      
                    <textarea name="list_top" class="form-control"><?php echo e(isset($settings->list_top) ? stripslashes($settings->list_top) : null); ?></textarea>

                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">List Bottom</label>
                    <div class="col-sm-8">                       
                      
                    <textarea name="list_bottom" class="form-control"><?php echo e(isset($settings->list_bottom) ? stripslashes($settings->list_bottom) : null); ?></textarea>

                    </div>
                  </div>
                  <hr/> 

                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Details Top</label>
                    <div class="col-sm-8">                       
                      
                    <textarea name="details_top" class="form-control"><?php echo e(isset($settings->details_top) ? stripslashes($settings->details_top) : null); ?></textarea>

                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Details Bottom</label>
                    <div class="col-sm-8">                       
                      
                    <textarea name="details_bottom" class="form-control"><?php echo e(isset($settings->details_bottom) ? stripslashes($settings->details_bottom) : null); ?></textarea>

                    </div>
                  </div>
                  <hr/> 

                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Other Pages Top</label>
                    <div class="col-sm-8">                       
                      
                    <textarea name="other_page_top" class="form-control"><?php echo e(isset($settings->other_page_top) ? stripslashes($settings->other_page_top) : null); ?></textarea>

                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Other Pages Bottom</label>
                    <div class="col-sm-8">                       
                      
                    <textarea name="other_page_bottom" class="form-control"><?php echo e(isset($settings->other_page_bottom) ? stripslashes($settings->other_page_bottom) : null); ?></textarea>

                    </div>
                  </div>
                  <hr/> 

                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Sidebar</label>
                    <div class="col-sm-8">                       
                      
                    <textarea name="sidebar" class="form-control"><?php echo e(isset($settings->sidebar) ? stripslashes($settings->sidebar) : null); ?></textarea>

                    </div>
                  </div>
 
                   
                  <div class="form-group">
                    <div class="offset-sm-3 col-sm-9 pl-1">
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
<?php echo $__env->make("admin.admin_app", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/dextragr/public_html/realestate.dextragroups.com/resources/views/admin/pages/settings/web_ads.blade.php ENDPATH**/ ?>