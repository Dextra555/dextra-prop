

<?php $__env->startSection("content"); ?>

  

<div class="content-page">
      <div class="content">
        <div class="container-fluid">

         
          <?php if(Auth::User()->usertype=="Admin"): ?>  
                <div class="row">
                     
                    <div class="col-xl-3 col-md-4 col-6">
                        <a href="<?php echo e(URL::to('admin/type')); ?>">
                        <div class="card-box widget-user">
                            <div class="text-center">
                                <h2 class="text-custom" data-plugin="counterup"><?php echo e($type); ?></h2>
                                <h5 style="color: #f9f9f9;"><?php echo e(trans('words.type_text')); ?></h5>
                            </div>
                        </div>
                        </a>
                    </div>

                    <div class="col-xl-3 col-md-4 col-6">
                        <a href="<?php echo e(URL::to('admin/property')); ?>">
                        <div class="card-box widget-user">
                            <div class="text-center">
                                <h2 class="text-success" data-plugin="counterup"><?php echo e($property); ?></h2>
                                <h5 style="color: #f9f9f9;"><?php echo e(trans('words.property_text')); ?></h5>
                            </div>
                        </div>
                        </a>
                    </div>
  

                    <div class="col-xl-3 col-md-4 col-6">
                        <a href="<?php echo e(URL::to('admin/users')); ?>">
                        <div class="card-box widget-user">
                            <div class="text-center">
                                <h2 class="text-info" data-plugin="counterup"><?php echo e($users); ?></h2>
                                <h5 style="color: #f9f9f9;"><?php echo e(trans('words.users')); ?></h5>
                            </div>
                        </div>
                        </a>
                    </div>
                     

                    <div class="col-xl-3 col-md-4 col-6">
                        <a href="<?php echo e(URL::to('admin/reports')); ?>">
                        <div class="card-box widget-user">
                            <div class="text-center">
                                <h2 class="text-dark" data-plugin="counterup"><?php echo e($reports); ?></h2>
                                <h5 style="color: #f9f9f9;"><?php echo e(trans('words.reports')); ?></h5>
                            </div>
                        </div>
                        </a>
                    </div>
                     
                </div> 

                <div class="row">    

                    <div class="col-xl-3 col-md-6">
                        <div class="card-box widget-user">
                            <div class="text-center">
                                <h2 class="text-custom" data-plugin="counterup"><?php echo e(number_format($daily_amount,2)); ?></h2>
                                <h5 style="color: #f9f9f9;"><?php echo e(trans('words.daily_revenue')); ?></h5>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6">
                        <div class="card-box widget-user">
                            <div class="text-center">
                                <h2 class="text-pink" data-plugin="counterup"><?php echo e(number_format($weekly_amount,2)); ?></h2>
                                <h5 style="color: #f9f9f9;"><?php echo e(trans('words.weekly_revenue')); ?></h5>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6">
                        <div class="card-box widget-user">
                            <div class="text-center">
                                <h2 class="text-warning" data-plugin="counterup"><?php echo e(number_format($monthly_amount,2)); ?></h2>
                                <h5 style="color: #f9f9f9;"><?php echo e(trans('words.monthly_revenue')); ?></h5>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6">
                        <div class="card-box widget-user">
                            <div class="text-center">
                                <h2 class="text-success" data-plugin="counterup"><?php echo e(number_format($yearly_amount,2)); ?></h2>
                                <h5 style="color: #f9f9f9;"><?php echo e(trans('words.yearly_revenue')); ?></h5>
                            </div>
                        </div>
                    </div>


                    </div>

                  
                <div class="row">
                <div class="col-xl-4 col-md-6">
                        <div class="card-box">
                            

                            <h4 class="header-title mt-0 m-b-5"><?php echo e(trans('words.latest_property')); ?></h4>
                            <p class="text-muted m-b-20"><?php echo e(trans('words.latest_10_property')); ?></p>

                            <div class="inbox-widget nicescroll" style="height: 315px; overflow: hidden; outline: none;" tabindex="5000">
                                
                            <?php $__currentLoopData = $latest_property; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $latest_data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                 
                                <a href="Javascript::void(0);" class="text-inverse">
                                
                                <p class="font-600 m-b-5">  
                                    <?php echo e(Str::limit(stripslashes($latest_data->title), 25)); ?> 
                                     
                                    <span class="badge badge-danger pull-right"><?php echo e(number_format_short(post_views_count($latest_data->id,"Property"))); ?> <?php echo e(trans('words.views')); ?>  </span>
                                </p>

                                </a>

                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                 
                            </div>
                        </div>
                </div>

                <div class="col-xl-4 col-md-6">
                        <div class="card-box">
                            

                            <h4 class="header-title mt-0 m-b-5"><?php echo e(trans('words.trending_now')); ?></h4>
                            <p class="text-muted m-b-20"><?php echo e(trans('words.based_on_30_days')); ?></p>

                            <div class="inbox-widget nicescroll" style="height: 315px; overflow: hidden; outline: none;" tabindex="5000">
                                
                            <?php $__currentLoopData = $trending_now; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $trending_data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                 
                                <a href="Javascript::void(0);" class="text-inverse">
                                
                                <p class="font-600 m-b-5">  
                                    <?php echo e(Str::limit(stripslashes(\App\Property::getPropertyInfo($trending_data->post_id,'title')), 25)); ?> 
                                     
                                    <span class="badge badge-danger pull-right"><?php echo e(number_format_short($trending_data->total_views)); ?> <?php echo e(trans('words.views')); ?>  </span>
                                </p>

                                </a>

                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                 
                            </div>
                        </div>
                </div>
                 

                <div class="col-xl-4 col-md-6">
                    <div class="card-box">
                        

                        <h4 class="header-title mt-0 m-b-5"><?php echo e(trans('words.latest_transactions')); ?></h4>
                        <p class="text-muted m-b-20"><?php echo e(trans('words.latest_5_transactions')); ?></p>

                        
                      
                        <div class="inbox-widget nicescroll" style="height: 315px; overflow: hidden; outline: none;" tabindex="5000">

                            <?php $__currentLoopData = $latest_transactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $transaction_data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                 <div class="inbox-item">
                                    <div class="inbox-item-img"><img src="<?php echo e(URL::asset('admin_assets/images/user-default.png')); ?>" class="rounded-circle" alt=""></div>
                                    <p class="inbox-item-author text-white"><?php echo e(\App\User::getUserFullname($transaction_data->user_id)); ?></p>
                                    <p class="inbox-item-text">
                                    <?php echo e($transaction_data->gateway); ?> -      
                                    <?php echo e($transaction_data->payment_id); ?></p>
                                    <p class="inbox-item-date">
                                    <b class="text-success"><?php echo e(html_entity_decode(getCurrencySymbols(getcong('currency_code')))); ?> <?php echo e($transaction_data->payment_amount); ?></b> - <?php echo e(date('M d Y',$transaction_data->date)); ?></p>
                                </div>

                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
       
                             
                        </div>
                    </div>
                </div>

                  

                <div class="col-xl-8 col-md-6">
                <div class="card-box">
                         
                         <h4 class="header-title mt-0 m-b-30"><?php echo e(trans('words.latest_reports')); ?></h4>

                         <div class="table-responsive">
                                        <table class="table mb-0">
                                            <thead>
                                            <tr>
                                                <th style="width: 15%;">&nbsp;</th>
                                                <th style="width: 15%;"><?php echo e(trans('words.name')); ?></th>
                                                <th style="width: 40%;"><?php echo e(trans('words.message')); ?></th>
                                                <th style="text-align: center">Date</th>
                                                <th>&nbsp;</th> 
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php $__currentLoopData = $reports_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $reports_data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>    
                                             
                                            <tr>
                                                    <td>
                                                    <div class="inbox-item-img">
                                                    <?php if(isset(\App\User::getUserInfo($reports_data->user_id)->user_image)): ?>
                                                    <img src="<?php echo e(URL::to('upload/'.\App\User::getUserInfo($reports_data->user_id)->user_image)); ?>" class="rounded-circle" alt="" width="50">
                                                    <?php else: ?>
                                                    <img src="<?php echo e(URL::to('admin_assets/images/user-default.png')); ?>" class="rounded-circle" alt="" width="50">
                                                    <?php endif; ?>                                         
                                                    </div>
                                                    </td>
                                                    <td>
                                                    <p class="inbox-item-author" style="color:#fff;"><?php echo e(\App\User::getUserFullname($reports_data->user_id)); ?></p>
                                                    </td>
                                                    <td>
                                                        <p class="inbox-item-text"><?php echo e(Str::limit($reports_data->message,70)); ?></p>
                                                    </td>
                                                     <td style="text-align: center">
                                                        <span class="badge badge-success"><?php echo e(date('m-d-Y h:i a',$reports_data->date)); ?></span>
                                                    </td>
                                                    <td>
                                                    <a href="<?php echo e(URL::to('admin/reports')); ?>" class="btn btn-icon waves-effect waves-light btn-purple"> <i class="fa fa-info"></i> </a>
                                                    </td>
                                                 </tr>
                                                 
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>       
                                        

                                            </tbody>
                                        </table>
                                    </div>
 
                          
                     </div>
                </div><!-- end col-->
 
                       
          </div>
          
          <?php else: ?>

                <div class="row">
                     
                <div class="col-xl-3 col-md-4 col-6">
                        <a href="<?php echo e(URL::to('admin/type')); ?>">
                        <div class="card-box widget-user">
                            <div class="text-center">
                                <h2 class="text-custom" data-plugin="counterup"><?php echo e($type); ?></h2>
                                <h5 style="color: #f9f9f9;"><?php echo e(trans('words.type_text')); ?></h5>
                            </div>
                        </div>
                        </a>
                    </div>

                    <div class="col-xl-3 col-md-4 col-6">
                        <a href="<?php echo e(URL::to('admin/property')); ?>">
                        <div class="card-box widget-user">
                            <div class="text-center">
                                <h2 class="text-success" data-plugin="counterup"><?php echo e($property); ?></h2>
                                <h5 style="color: #f9f9f9;"><?php echo e(trans('words.property_text')); ?></h5>
                            </div>
                        </div>
                        </a>
                    </div>
  

                    <div class="col-xl-3 col-md-4 col-6">
                        <a href="<?php echo e(URL::to('admin/users')); ?>">
                        <div class="card-box widget-user">
                            <div class="text-center">
                                <h2 class="text-info" data-plugin="counterup"><?php echo e($users); ?></h2>
                                <h5 style="color: #f9f9f9;"><?php echo e(trans('words.users')); ?></h5>
                            </div>
                        </div>
                        </a>
                    </div>
                     

                    <div class="col-xl-3 col-md-4 col-6">
                        <a href="<?php echo e(URL::to('admin/reports')); ?>">
                        <div class="card-box widget-user">
                            <div class="text-center">
                                <h2 class="text-dark" data-plugin="counterup"><?php echo e($reports); ?></h2>
                                <h5 style="color: #f9f9f9;"><?php echo e(trans('words.reports')); ?></h5>
                            </div>
                        </div>
                        </a>
                    </div>
                    
                    
                </div> 


          <?php endif; ?> 
        
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
 
  </script>
  
 
<?php $__env->stopSection(); ?>
<?php echo $__env->make("admin.admin_app", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/dextragr/public_html/realestate.dextragroups.com/resources/views/admin/pages/dashboard.blade.php ENDPATH**/ ?>