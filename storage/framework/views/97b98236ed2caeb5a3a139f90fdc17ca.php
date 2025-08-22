

<?php $__env->startSection("content"); ?>

  
  <div class="content-page">
      <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
              <div class="card-box table-responsive">

                <div class="row">
                  <div class="col-sm-3">
                     <select class="form-control" name="gateway_select" id="gateway_select">
                        <option value=""><?php echo e(trans('words.filter_by_gateway')); ?></option>

                        <?php $__currentLoopData = $gateway_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gateway_data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <?php $gateway_name=$gateway_data->gateway_name;?>
                          <option value="?gateway=<?php echo e($gateway_name); ?>" <?php if(isset($_GET['gateway']) && $_GET['gateway']==$gateway_name ): ?> selected <?php endif; ?>><?php echo e($gateway_data->gateway_name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                             
                        
                    </select>
                  </div>  
                  <div class="col-md-4">
                  <?php echo e(html()->form('GET', url('/admin/transactions'))
                     ->attributes(['class' => 'app-search', 'id' => 'search'])->open()); ?>

                      
                      <input type="text" name="s" placeholder="<?php echo e(trans('words.search_by_payment_id_email')); ?>" class="form-control">
                      <button type="submit"><i class="fa fa-search"></i></button>
                      <?php echo e(html()->form()->close()); ?>

                  </div>
                  <div class="col-md-2">
                  <?php echo e(html()->form('GET', url('/admin/transactions'))
                     ->attributes(['class' => 'app-search', 'id' => 'search'])->open()); ?>

                         
                      <input type="text" name="date" placeholder="mm/dd/yyyy" class="form-control" id="datepicker-autoclose" autocomplete="off">
                      <button type="submit"><i class="fa fa-search"></i></button>
                      <?php echo e(html()->form()->close()); ?>

                  </div>
 
                          
                  <div class="col-md-3">
                  

                  <a href="#" data-toggle="modal" data-target="#export_model" title="<?php echo e(trans('words.export_transactions')); ?>" class="btn btn-info btn-md waves-effect waves-light m-b-20 mt-2 pull-right"><i class="fa fa-file-excel-o"></i> <?php echo e(trans('words.export_transactions')); ?></a>

                  <div id="export_model" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="myModalLabel">Export Transactions</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                </div>
                                <div class="modal-body">

                                 <?php if(Auth::User()->usertype!="Admin"): ?>      

                                    <p style="text-align: center;font-size: 16px;font-weight: 500;color: red;">Access denied!</p>

                                 <?php else: ?>

                                 <?php echo e(html()->form('POST', url('/admin/transactions/export'))
                     ->attributes(['class' => 'form-horizontal', 'id' => 'post_form', 'name' => 'post_form', 'role' => 'form', 'enctype' => 'multipart/form-data'])->open()); ?>

 
                                    
                                  <div class="form-group row">    
                                    <label class="col-sm-3 col-form-label"><?php echo e(trans('words.start_date')); ?></label>
                                    <div class="col-sm-9">
                                     <input type="text" name="start_date" placeholder="<?php echo e(trans('words.start_date')); ?>" class="form-control datepicker_trans" id="datepicker_trans1" autocomplete="off" required>
                                    </div>
                                  </div>
                                  <div class="form-group row mb-0">    
                                    <label class="col-sm-3 col-form-label"><?php echo e(trans('words.end_date')); ?></label>
                                    <div class="col-sm-9">
                                     <input type="text" name="end_date" placeholder="<?php echo e(trans('words.end_date')); ?>" class="form-control datepicker_trans" id="datepicker_trans2" autocomplete="off" required>
                                    </div>
                                  </div>
                                     
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary waves-effect waves-light"> Submit</button>                                     
                                </div>
                                <?php echo e(html()->form()->close()); ?>


                                 <?php endif; ?> 

                            </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
                    </div>
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
                      <th><?php echo e(trans('words.plan')); ?></th>
                      <th><?php echo e(trans('words.amount')); ?></th>
                      <th><?php echo e(trans('words.payment_gateway')); ?></th>
                      <th><?php echo e(trans('words.payment_id')); ?></th>
                      <th><?php echo e(trans('words.payment_date')); ?></th>                      
                       
                    </tr>
                  </thead>
                  <tbody>
                   <?php $__currentLoopData = $transactions_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $transaction_data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                      <td><a href="<?php echo e(url('admin/users/history/'.$transaction_data->user_id)); ?>" data-toggle="tooltip" title="User History"><?php echo e(\App\User::getUserFullname($transaction_data->user_id)); ?></a></td>
                      <td><?php echo e($transaction_data->email); ?></td>
                      <td><?php echo e(\App\SubscriptionPlan::getSubscriptionPlanInfo($transaction_data->plan_id,'plan_name')); ?></td>
                      <td><?php echo e(html_entity_decode(getCurrencySymbols(getcong('currency_code')))); ?> <?php echo e($transaction_data->payment_amount); ?> </td>
                      <td><?php echo e($transaction_data->gateway); ?></td>
                      <td><?php echo e($transaction_data->payment_id); ?></td>
                      <td><?php echo e(date('M d Y h:i A',$transaction_data->date)); ?></td>                                              
                       
                    </tr>
                   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                     
                     
                     
                  </tbody>
                 </table>
                </div>
                <nav class="paging_simple_numbers">
                <?php echo $__env->make('admin.pagination', ['paginator' => $transactions_list], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> 
                </nav>
           
              </div>
            </div>
          </div>
        </div>
      </div>
      <?php echo $__env->make("admin.copyright", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> 
    </div>

    

<?php $__env->stopSection(); ?>
<?php echo $__env->make("admin.admin_app", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/dextragr/public_html/realestate.dextragroups.com/resources/views/admin/pages/transactions/list.blade.php ENDPATH**/ ?>