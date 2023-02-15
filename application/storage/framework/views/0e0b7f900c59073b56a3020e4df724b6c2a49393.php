
<?php $__env->startSection('content'); ?>
<div class="row">
  <?php echo $__env->make('partials.sidebar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  <style>
    .thumb_img {
      border: 1px solid #ddd; /* Gray border */
      border-radius: 4px;  /* Rounded border */
      padding: 5px; /* Some padding */
      width: 150px; /* Set a small width */
    }

    /* Add a hover effect (blue shadow) */
    .thumb_img:hover {
      box-shadow: 0 0 2px 1px rgba(0, 140, 186, 0.5);
    }
  </style>
  <div class="col-lg-9 col-md-12">
    <div class="row">
      <div class="col"  id="#sendMoney">
        <?php echo $__env->make('flash', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <div class="card">
          <div class="header">
            <h2><strong><?php echo e(__('Apply Loan')); ?></strong></h2>
          </div>
          <div class="body">
            <div class="card">
              <div class="card-body">
                <div class="alert_message alert" style="display: none;"></div>
                  <div class="card">
                    <h5 class="card-header"><?php echo app('translator')->getFromJson('Apply Loan'); ?></h5>
                    <div class="card-body">
                      <div class="row">
                        <div class="col-sm-2">
                          <div class="form-group">
                            <label>Amount:</label>
                            <span>
                                <?php if(isset($model->loan_amount)): ?>
                                    <?php echo e($model->loan_amount); ?>

                                <?php endif; ?>
                            </span>
                          </div>
                        </div>
                        <div class="col-sm-2">
                          <div class="form-group">
                            <label>Loan tenure:</label>
                            <span>
                                <?php if(isset($model->loan_tenure)): ?>
                                    <?php echo e($model->loan_tenure); ?>

                                <?php endif; ?>
                                <?php if(isset($model->tenure_type)): ?>
                                    <?php echo e($model->tenure_type); ?>

                                <?php endif; ?>
                            </span>
                          </div>
                        </div>
                        <div class="col-sm-2">
                          <div class="form-group">
                            <label>Payback:</label>
                            <span>
                                <?php if(isset($model->payback)): ?>
                                    <?php echo e($model->payback); ?>

                                <?php endif; ?>
                            </span>
                          </div>
                        </div>
                        <div class="col-sm-2">
                          <div class="form-group">
                            <label>Total Repay:</label>
                            <span>
                                <?php if(isset($model->repay_amount)): ?>
                                    <?php echo e($model->repay_amount); ?>

                                <?php endif; ?>
                            </span>
                          </div>
                        </div>
                        <div class="col-sm-3">
                          <div class="form-group">
                            <label>Repay every <?php echo e($model->payback); ?>:</label>
                            <span>
                                <?php if(isset($model->return_amount)): ?>
                                    <?php echo e($model->return_amount); ?>

                                <?php endif; ?>
                            </span>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row" style="margin-top:10px">
                    <div class="col-sm-4">
                      <div class="card">
                        <h5 class="card-header"><?php echo app('translator')->getFromJson('Customer Detail'); ?></h5>
                        <div class="card-body">
                          <div class="row">
                            <div class="col-sm-12">
                              <div class="form-group">
                                <label>BVN:</label>
                                <span>
                                    <?php if(isset($model->bvn)): ?>
                                        <?php echo e($model->bvn); ?>

                                    <?php endif; ?>
                                </span>
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-sm-12">
                              <div class="form-group">
                                <label>ID type and the number ( NIN and DRIVER'S LICENSE ONLY):</label>
                                <span>
                                    <?php if(isset($model->id_type_number)): ?>
                                        <?php echo e($model->id_type_number); ?>

                                    <?php endif; ?>
                                </span>
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-sm-12">
                              <div class="form-group">
                                <label>Full Name:</label>
                                <span>
                                    <?php if(isset($model->full_name)): ?>
                                        <?php echo e($model->full_name); ?>

                                    <?php endif; ?>
                                </span>
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-sm-12">
                              <div class="form-group">
                                <label>Residential address:</label>
                                <span>
                                    <?php if(isset($model->residential_address)): ?>
                                        <?php echo e($model->residential_address); ?>

                                    <?php endif; ?>
                                </span>
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-sm-12">
                              <div class="form-group">
                                <label>Account Number:</label>
                                <span>
                                    <?php if(isset($model->account_number)): ?>
                                        <?php echo e($model->account_number); ?>

                                    <?php endif; ?>
                                </span>
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-sm-12">
                              <div class="form-group">
                                <label>Bank Name:</label>
                                <span>
                                    <?php if(isset($model->bank_name)): ?>
                                        <?php echo e($model->bank_name); ?>

                                    <?php endif; ?>
                                </span>
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-sm-12">
                              <div class="form-group">
                                <label>Contact:</label>
                                <span>
                                    <?php if(isset($model->contact)): ?>
                                        <?php echo e($model->contact); ?>

                                    <?php endif; ?>
                                </span>
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-sm-12">
                              <div class="form-group">
                                <label>Home address:</label>
                                <span>
                                    <?php if(isset($model->home_address)): ?>
                                        <?php echo e($model->home_address); ?>

                                    <?php endif; ?>
                                </span>
                              </div>
                            </div>
                          </div>
                          <?php if(isset($model->selfie_passport)): ?>
                            <div class="row">
                              <div class="col-sm-12">
                                <div class="form-group">
                                  <label>Selfie or passport:</label>
                                </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-sm-12">
                                <div class="form-group">
                                  <span>
                                    <a download="<?php echo e($model->selfie_passport); ?>" href="<?php echo e(url('assets/images/loan/'.$model->selfie_passport)); ?>">
                                      <img class="thumb_img" src="<?php echo e(url('assets/images/loan/'.$model->selfie_passport)); ?>" alt="image">
                                    </a>
                                  </span>
                                </div>
                              </div>
                            </div>
                          <?php endif; ?>
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="card">
                        <h5 class="card-header"><?php echo app('translator')->getFromJson('Guarantors'); ?> (First)</h5>
                        <div class="card-body">
                          <div class="row">
                            <div class="col-sm-12">
                              <div class="form-group">
                                <label>BVN:</label>
                                <span>
                                    <?php if(isset($model->c_bvn)): ?>
                                        <?php echo e($model->c_bvn); ?>

                                    <?php endif; ?>
                                </span>
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-sm-12">
                              <div class="form-group">
                                <label>ID type and the number (voters card not acceptable):</label>
                                <span>
                                    <?php if(isset($model->c_id_type_number)): ?>
                                        <?php echo e($model->c_id_type_number); ?>

                                    <?php endif; ?>
                                </span>
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-sm-12">
                              <div class="form-group">
                                <label>Full Name:</label>
                                <span>
                                    <?php if(isset($model->c_full_name)): ?>
                                        <?php echo e($model->c_full_name); ?>

                                    <?php endif; ?>
                                </span>
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-sm-12">
                              <div class="form-group">
                                <label>Residential address:</label>
                                <span>
                                    <?php if(isset($model->c_residential_address)): ?>
                                        <?php echo e($model->c_residential_address); ?>

                                    <?php endif; ?>
                                </span>
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-sm-12">
                              <div class="form-group">
                                <label>Contact:</label>
                                <span>
                                    <?php if(isset($model->c_contact)): ?>
                                        <?php echo e($model->c_contact); ?>

                                    <?php endif; ?>
                                </span>
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-sm-12">
                              <div class="form-group">
                                <label>Business address:</label>
                                <span>
                                    <?php if(isset($model->c_business_address)): ?>
                                        <?php echo e($model->c_business_address); ?>

                                    <?php endif; ?>
                                </span>
                              </div>
                            </div>
                          </div>
                          <?php if(isset($model->c_upload_passport)): ?>
                            <div class="row">
                              <div class="col-sm-12">
                                <div class="form-group">
                                  <label>Upload passport:</label>
                                </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-sm-12">
                                <div class="form-group">
                                  <span>
                                    <a download="<?php echo e($model->c_upload_passport); ?>" href="<?php echo e(url('assets/images/loan/'.$model->c_upload_passport)); ?>">
                                      <img class="thumb_img" src="<?php echo e(url('assets/images/loan/'.$model->c_upload_passport)); ?>" alt="image">
                                    </a>
                                  </span>
                                </div>
                              </div>
                            </div>
                          <?php endif; ?>
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="card">
                        <h5 class="card-header"><?php echo app('translator')->getFromJson('Guarantors'); ?> (Second)</h5>
                        <div class="card-body">
                          <div class="row">
                            <div class="col-sm-12">
                              <div class="form-group">
                                <label>BVN:</label>
                                <span>
                                    <?php if(isset($model->b_bvn)): ?>
                                        <?php echo e($model->b_bvn); ?>

                                    <?php endif; ?>
                                </span>
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-sm-12">
                              <div class="form-group">
                                <label>ID type and the number (voters card not acceptable):</label>
                                <span>
                                    <?php if(isset($model->b_id_type_number)): ?>
                                        <?php echo e($model->b_id_type_number); ?>

                                    <?php endif; ?>
                                </span>
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-sm-12">
                              <div class="form-group">
                                <label>Full Name:</label>
                                <span>
                                    <?php if(isset($model->b_full_name)): ?>
                                        <?php echo e($model->b_full_name); ?>

                                    <?php endif; ?>
                                </span>
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-sm-12">
                              <div class="form-group">
                                <label>Residential address:</label>
                                <span>
                                    <?php if(isset($model->b_residential_address)): ?>
                                        <?php echo e($model->b_residential_address); ?>

                                    <?php endif; ?>
                                </span>
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-sm-12">
                              <div class="form-group">
                                <label>Contact:</label>
                                <span>
                                    <?php if(isset($model->b_contact)): ?>
                                        <?php echo e($model->b_contact); ?>

                                    <?php endif; ?>
                                </span>
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-sm-12">
                              <div class="form-group">
                                <label>Business address:</label>
                                <span>
                                    <?php if(isset($model->b_business_address)): ?>
                                        <?php echo e($model->b_business_address); ?>

                                    <?php endif; ?>
                                </span>
                              </div>
                            </div>
                          </div>
                          <?php if(isset($model->b_upload_passport)): ?>
                            <div class="row">
                              <div class="col-sm-12">
                                <div class="form-group">
                                  <label>Upload passport:</label>
                                </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-sm-12">
                                <div class="form-group">
                                  <span>
                                    <a download="<?php echo e($model->b_upload_passport); ?>" href="<?php echo e(url('assets/images/loan/'.$model->b_upload_passport)); ?>">
                                      <img class="thumb_img" src="<?php echo e(url('assets/images/loan/'.$model->b_upload_passport)); ?>" alt="image">
                                    </a>
                                  </span>
                                </div>
                              </div>
                            </div>
                            <?php endif; ?>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row" style="text-align:right;">
                    <div class="col-sm-12">
                        <!-- <button type="button" href="#" data-toggle="modal" data-target="#addMyModalQr" class="btn btn-info">Submit</button> -->
                        
                        <a href="<?php echo e(route('loan.confirm',[app()->getLocale(),$model->id])); ?>" class="btn btn-info">Confirm</a>
                    </div>
                  </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
<script>
$( "#currency" )
  .change(function () {
    $( "#currency option:selected").each(function() {
      window.location.replace("<?php echo e(url('/')); ?>/<?php echo e(app()->getLocale()); ?>/wallet/"+$(this).val());
  });
})
</script>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('footer'); ?>
  <?php echo $__env->make('partials.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>