

<?php $__env->startSection("content"); ?>
 
 
  <div class="content-page">
      <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-lg-12">
              <div class="card-box">
                
               
                <div class="row">

                 <div class="col-md-6"> 

                 <?php echo e(html()->form('POST', url('/admin/general_settings'))
                     ->attributes(['class' => 'form-horizontal', 'id' => 'settings_form', 'name' => 'settings_form', 'role' => 'form', 'enctype' => 'multipart/form-data'])->open()); ?>

  
                  
                  <input type="hidden" name="id" value="<?php echo e(isset($settings->id) ? $settings->id : null); ?>">
                  
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label"><?php echo e(trans('words.site_name')); ?>*</label>
                    <div class="col-sm-8">
                      <input type="text" name="site_name" value="<?php echo e(isset($settings->site_name) ? stripslashes($settings->site_name) : null); ?>" class="form-control">
                    </div>
                  </div>
 
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label"><?php echo e(trans('words.site_logo')); ?>*</label>
                    <div class="col-sm-8">
                      <div class="input-group">
                        <input type="text" name="site_logo" id="site_logo" value="<?php echo e(isset($settings->site_logo) ? $settings->site_logo : null); ?>" class="form-control" readonly>
                        <div class="input-group-append">                           
                          <button type="button" class="btn btn-dark waves-effect waves-light popup_selector" data-input="site_logo" data-preview="holder_logo" data-inputid="site_logo">Select</button>                        
                        </div>
                      </div>
                      <small id="emailHelp" class="form-text text-muted">(<?php echo e(trans('words.recommended_resolution')); ?> : 150x150)</small>
                      <div id="site_logo_holder" style="margin-top:5px;max-height:100px;"></div>                     
                    </div>
                  </div>                 

                  <?php if(isset($settings->site_logo)): ?> 
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">&nbsp;</label>
                    <div class="col-sm-8">                                                                         
                      <img src="<?php echo e(URL::to('/'.$settings->site_logo)); ?>" alt="video image" class="img-thumbnail" width="120">                                               
                    </div>
                  </div>
                  <?php endif; ?>
                   
                  
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label"><?php echo e(trans('words.site_favicon')); ?>*</label>
                    <div class="col-sm-8">
                      <div class="input-group">
                        <input type="text" name="site_favicon" id="site_favicon" value="<?php echo e(isset($settings->site_favicon) ? $settings->site_favicon : null); ?>" class="form-control" readonly>
                        <div class="input-group-append">                           
                            <button type="button" class="btn btn-dark waves-effect waves-light popup_selector" data-input="site_favicon" data-preview="holder_favicon" data-inputid="site_favicon">Select</button>                        
                        </div>
                      </div>
                      <small id="emailHelp" class="form-text text-muted">(<?php echo e(trans('words.recommended_resolution')); ?> : 16x16, 32X32)</small>
                      <div id="site_favicon_holder" style="margin-top:5px;max-height:100px;"></div>                     
                    </div>
                  </div>

                  <?php if(isset($settings->site_favicon)): ?> 
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">&nbsp;</label>
                    <div class="col-sm-8">                                                                         
                      <img src="<?php echo e(URL::to('/'.$settings->site_favicon)); ?>" alt="video image" class="img-thumbnail" width="32">                                               
                    </div>
                  </div>
                  <?php endif; ?>
                  
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label"><?php echo e(trans('words.email')); ?>*</label>
                    <div class="col-sm-8">
                      <input type="text" name="site_email" value="<?php echo e(isset($settings->site_email) ? $settings->site_email : null); ?>" class="form-control">
                    </div>
                  </div>
                  
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label"><?php echo e(trans('words.description')); ?></label>
                    <div class="col-sm-8">
                      <textarea name="site_description" class="form-control"><?php echo e(isset($settings->site_description) ? stripslashes($settings->site_description) : null); ?></textarea>
                       
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label"><?php echo e(trans('words.site_keywords')); ?></label>
                    <div class="col-sm-8">
                      <textarea name="site_keywords" class="form-control"><?php echo e(isset($settings->site_keywords) ? stripslashes($settings->site_keywords) : null); ?></textarea>
                       
                    </div>
                  </div>

                  <div class="form-group row">
                     
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Header Code</label>
                    <div class="col-sm-8">
                      <textarea name="site_header_code" class="form-control" placeholder="Custom CSS OR JS script"><?php echo e(isset($settings->site_header_code) ? stripslashes($settings->site_header_code) : null); ?></textarea>
                       
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Footer Code</label>
                    <div class="col-sm-8">
                      <textarea name="site_footer_code" class="form-control" placeholder="Custom CSS OR JS script"><?php echo e(isset($settings->site_footer_code) ? stripslashes($settings->site_footer_code) : null); ?></textarea>
                       
                    </div>
                  </div>
                  
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label"><?php echo e(trans('words.site_copyright_text')); ?></label>
                    <div class="col-sm-8">
                      <textarea name="site_copyright" class="form-control"><?php echo e(isset($settings->site_copyright) ? stripslashes($settings->site_copyright) : null); ?></textarea>                      
                    </div>
                  </div>
                   
                  
                 

                </div>
                  <div class="col-md-6"> 

                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label"><?php echo e(trans('words.admin_logo')); ?>*</label>
                    <div class="col-sm-8">
                      <div class="input-group">
                        <input type="text" name="admin_logo" id="admin_logo" value="<?php echo e(isset($settings->admin_logo) ? $settings->admin_logo : null); ?>" class="form-control" readonly>
                        <div class="input-group-append">                           
                          <button type="button" class="btn btn-dark waves-effect waves-light popup_selector" data-input="admin_logo" data-preview="holder_logo" data-inputid="admin_logo">Select</button>                        
                        </div>
                      </div>
                      <small id="emailHelp" class="form-text text-muted">(<?php echo e(trans('words.recommended_resolution')); ?> : 190x50)</small>
                      <div id="admin_logo_holder" style="margin-top:5px;max-height:100px;"></div>                     
                    </div>
                  </div>                 

                  <?php if(isset($settings->admin_logo)): ?> 
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">&nbsp;</label>
                    <div class="col-sm-8">                                                                         
                      <img src="<?php echo e(URL::to('/'.$settings->admin_logo)); ?>" alt="video image" class="img-thumbnail" width="120">                                               
                    </div>
                  </div>
                  <?php endif; ?>  

                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label"><?php echo e(trans('words.site_style')); ?></label>
                      <div class="col-sm-8">
                            <select class="form-control" name="styling">                               
                                 
                                <option value="stylesheet_one" <?php if($settings->styling=="stylesheet_one"): ?> selected <?php endif; ?>>Style 1</option>
                                <option value="stylesheet_two" <?php if($settings->styling=="stylesheet_two"): ?> selected <?php endif; ?>>Style 2</option>
                                <option value="stylesheet_three" <?php if($settings->styling=="stylesheet_three"): ?> selected <?php endif; ?>>Style 3</option>                                 
                                  
                            </select>
                      </div>
                  </div>
 
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label"><?php echo e(trans('words.default_timezone')); ?></label>
                      <div class="col-sm-8">
                            <select class="form-control select2" name="time_zone">                               
                                <?php $__currentLoopData = generate_timezone_list(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$tz_data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($key); ?>" <?php if($settings->time_zone==$key): ?> selected <?php endif; ?>><?php echo e($tz_data); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                            
                            </select>
                      </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label"><?php echo e(trans('words.currency_code')); ?>* </label>
                    <div class="col-sm-8">                       
                      <select name="currency_code" id="currency_code" class="form-control select2">
                        <?php $__currentLoopData = getCurrencyList(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $currency_list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($index); ?>" <?php if($settings->currency_code==$index): ?> selected <?php endif; ?>><?php echo e($index); ?> - <?php echo e($currency_list); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                          
                      </select>

                    </div>
                  </div> 

                  <hr/>
                  <h4 class="m-t-0 header-title">Contact Us</h4>
                  <small id="emailHelp" class="form-text text-muted">(Leave empty if don't want to display on front-end footer area.)</small>
                  <br/>
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Email</label>
                    <div class="col-sm-8">
                      <input type="text" name="contact_email" value="<?php echo e(isset($settings->contact_email) ? stripslashes($settings->contact_email) : null); ?>" class="form-control">
                    </div>
                  </div>

                  <br/>
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Phone</label>
                    <div class="col-sm-8">
                      <input type="text" name="contact_phone" value="<?php echo e(isset($settings->contact_phone) ? stripslashes($settings->contact_phone) : null); ?>" class="form-control">
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Address</label>
                    <div class="col-sm-8">
                      <textarea name="contact_address" class="form-control"><?php echo e(isset($settings->contact_address) ? stripslashes($settings->contact_address) : null); ?></textarea>
                       
                    </div>
                  </div>

                    
                  <hr/>
                  <h4 class="m-t-0 header-title"><?php echo e(trans('words.social_links')); ?></h4>

                  <br/>
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Facebook URL</label>
                    <div class="col-sm-8">
                      <input type="text" name="facebook_link" value="<?php echo e(isset($settings->facebook_link) ? stripslashes($settings->facebook_link) : null); ?>" class="form-control">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">X (Twitter) URL</label>
                    <div class="col-sm-8">
                      <input type="text" name="twitter_link" value="<?php echo e(isset($settings->twitter_link) ? stripslashes($settings->twitter_link) : null); ?>" class="form-control">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Instagram URL</label>
                    <div class="col-sm-8">
                      <input type="text" name="instagram_link" value="<?php echo e(isset($settings->instagram_link) ? stripslashes($settings->instagram_link) : null); ?>" class="form-control">
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">YouTube URL</label>
                    <div class="col-sm-8">
                      <input type="text" name="youtube_link" value="<?php echo e(isset($settings->youtube_link) ? stripslashes($settings->youtube_link) : null); ?>" class="form-control">
                    </div>
                  </div>
 

                  </div>

              </div>      


                  <hr/>
                  <h4 class="m-t-0 mb-4 header-title"><?php echo e(trans('words.gdpr_cookie_consent')); ?></h4>

                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label"><?php echo e(trans('words.gdpr_cookie_consent')); ?> </label>
                      <div class="col-sm-8">
                            <select class="form-control select2" name="gdpr_cookie_on_off">                               
                                 
                                <option value="1" <?php if($settings->gdpr_cookie_on_off=="1"): ?> selected <?php endif; ?>><?php echo e(trans('words.active')); ?></option>
                                <option value="0" <?php if($settings->gdpr_cookie_on_off=="0"): ?> selected <?php endif; ?>><?php echo e(trans('words.inactive')); ?></option>
                                 
                            </select>
                      </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label"><?php echo e(trans('words.gdpr_cookie_title')); ?></label>
                    <div class="col-sm-8">
                      <input type="text" name="gdpr_cookie_title" value="<?php echo e(isset($settings->gdpr_cookie_title) ? stripslashes($settings->gdpr_cookie_title) : null); ?>" class="form-control">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label"><?php echo e(trans('words.gdpr_cookie_text')); ?></label>
                    <div class="col-sm-8">
                      <input type="text" name="gdpr_cookie_text" value="<?php echo e(isset($settings->gdpr_cookie_text) ? stripslashes($settings->gdpr_cookie_text) : null); ?>" class="form-control">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label"><?php echo e(trans('words.gdpr_cookie_url')); ?></label>
                    <div class="col-sm-8">
                      <input type="text" name="gdpr_cookie_url" value="<?php echo e(isset($settings->gdpr_cookie_url) ? stripslashes($settings->gdpr_cookie_url) : null); ?>" class="form-control">
                    </div>
                  </div>

                  <hr/>
                  <h4 class="m-t-0 mb-4 header-title">Envato Buyer Details</h4>

                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Envato Username</label>
                    <div class="col-sm-8">
                      <input type="text" name="envato_buyer_name" value="<?php echo e(isset($settings->envato_buyer_name) ? stripslashes($settings->envato_buyer_name) : null); ?>" class="form-control" readonly>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Buyer Purchase Code</label>
                    <div class="col-sm-8">
                      <input type="text" name="envato_purchase_code" value="<?php echo e(isset($settings->envato_purchase_code) ? stripslashes($settings->envato_purchase_code) : null); ?>" class="form-control" readonly>
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
     
     
// function to update the file selected by elfinder
function processSelectedFile(filePath, requestingField) {
    'use strict';    
    var elfinderUrl = "<?php echo e(URL::to('/')); ?>/";

    if(requestingField=="site_logo")
    {
      var target_preview = $('#site_logo_holder');
      target_preview.html('');
      target_preview.append(
              $('<img>').css('height', '5rem').attr('src', elfinderUrl + filePath.replace(/\\/g,"/"))
            );
      target_preview.trigger('change');
    }

    if(requestingField=="admin_logo")
    {
      var target_preview = $('#admin_logo_holder');
      target_preview.html('');
      target_preview.append(
              $('<img>').css('height', '3rem').attr('src', elfinderUrl + filePath.replace(/\\/g,"/"))
            );
      target_preview.trigger('change');
    }
  
   
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
<?php echo $__env->make("admin.admin_app", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/dextragr/public_html/realestate.dextragroups.com/resources/views/admin/pages/settings/general_settings.blade.php ENDPATH**/ ?>