<?php $__env->startSection("content"); ?>
 
 
  <div class="content-page">
      <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-lg-12">
              <div class="card-box">
                 <div class="row">
                 <div class="col-sm-6">
                      <a href="<?php echo e(URL::to('admin/pages')); ?>"><h4 class="header-title m-t-0 m-b-30 text-primary pull-left" style="font-size: 20px;"><i class="fa fa-arrow-left"></i> <?php echo e(trans('words.back')); ?></h4></a>
                 </div>
                 <?php if(isset($page_info->id)): ?>
                 <div class="col-sm-6">
                    <a href="<?php echo e(URL::to('page/'.$page_info->id.'/'.$page_info->page_slug)); ?>" target="_blank"><h4 class="header-title m-t-0 m-b-30 text-primary pull-right" style="font-size: 20px;"><?php echo e(trans('words.preview')); ?> <i class="fa fa-eye"></i></h4> </a>
                 </div>
                 <?php endif; ?>
               </div> 
                 
               <?php echo e(html()->form('POST', url('/admin/pages/contact_update'))
                     ->attributes(['class' => 'form-horizontal', 'id' => 'post_form', 'name' => 'post_form', 'role' => 'form', 'enctype' => 'multipart/form-data'])->open()); ?>

 
                  
                  <input type="hidden" name="id" value="<?php echo e(isset($page_info->id) ? $page_info->id : null); ?>">
  
                   
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label"><?php echo e(trans('words.title')); ?>*</label>
                    <div class="col-sm-8">
                      <input type="text" name="page_title" value="<?php echo e(isset($page_info->page_title) ? stripslashes($page_info->page_title) : null); ?>" class="form-control">
                    </div>
                  </div>
  
                  
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label"><?php echo e(trans('words.contact_address')); ?></label>
                    <div class="col-sm-8">
                      <textarea id="page_contact_address" name="page_contact_address" class="form-control"><?php echo e(isset($page_info->page_contact_address) ? stripslashes($page_info->page_contact_address) : null); ?></textarea>
                       
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label"><?php echo e(trans('words.contact_phone')); ?></label>
                    <div class="col-sm-8">
                      <input type="text" name="page_contact_phone" value="<?php echo e(isset($page_info->page_contact_phone) ? stripslashes($page_info->page_contact_phone) : null); ?>" class="form-control">
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label"><?php echo e(trans('words.contact_email')); ?></label>
                    <div class="col-sm-8">
                      <input type="text" name="page_contact_email" value="<?php echo e(isset($page_info->page_contact_email) ? stripslashes($page_info->page_contact_email) : null); ?>" class="form-control">
                    </div>
                  </div>
                  
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label"><?php echo e(trans('words.contact_map')); ?></label>
                    <div class="col-sm-8">
                      <textarea id="page_contact_map" name="page_contact_map" class="form-control"><?php echo e(isset($page_info->page_contact_map) ? stripslashes($page_info->page_contact_map) : null); ?></textarea>
                       
                    </div>
                  </div>
                   
 
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label"><?php echo e(trans('words.page_position')); ?></label>
                      <div class="col-sm-8">
                            <select class="form-control" name="page_position">                               
                                <option value="Top" <?php if(isset($page_info->page_position) AND $page_info->page_position=='Top'): ?> selected <?php endif; ?>>Top</option>
                                <option value="Bottom" <?php if(isset($page_info->page_position) AND $page_info->page_position=='Bottom'): ?> selected <?php endif; ?>>Bottom</option>                            
                            </select>
                      </div>
                  </div>
                  
                 
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label"><?php echo e(trans('words.page_order')); ?></label>
                    <div class="col-sm-8">
                      <input type="number" name="page_order" value="<?php echo e(isset($page_info->page_order) ? stripslashes($page_info->page_order) : null); ?>" class="form-control" min="0">
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label"><?php echo e(trans('words.status')); ?></label>
                      <div class="col-sm-8">
                            <select class="form-control" name="status">                               
                                <option value="1" <?php if(isset($page_info->status) AND $page_info->status==1): ?> selected <?php endif; ?>><?php echo e(trans('words.active')); ?></option>
                                <option value="0" <?php if(isset($page_info->status) AND $page_info->status==0): ?> selected <?php endif; ?>><?php echo e(trans('words.inactive')); ?></option>                            
                            </select>
                      </div>
                  </div>
                  <div class="form-group">
                    <div class="offset-sm-3 col-sm-9 pl-1">
                      <button type="submit" class="btn btn-primary waves-effect waves-light"> <?php echo e(trans('words.save')); ?></button>                      
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
    
     
// function to update the file selected by elfinder
function processSelectedFile(filePath, requestingField) {
   
  'use strict';    

    var elfinderUrl = "<?php echo e(URL::to('/')); ?>/";
     
      var target_preview = $('#'+requestingField+'_holder');
      target_preview.html('');
      target_preview.append(
              $('<img>').css('height', '5rem').attr('src', elfinderUrl + filePath.replace(/\\/g,"/"))
            );
      target_preview.trigger('change');
     
    $('#' + requestingField).val(filePath.replace(/\\/g,"/")).trigger('change');
 
}
 
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
<?php echo $__env->make("admin.admin_app", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/dextragr/public_html/realestate.dextragroups.com/resources/views/admin/pages/pages/contact.blade.php ENDPATH**/ ?>