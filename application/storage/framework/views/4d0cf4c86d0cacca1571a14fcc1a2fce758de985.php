
<?php $__env->startSection('content'); ?>
<div class="row">
  <?php echo $__env->make('partials.sidebar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  <div class="col-lg-9 col-md-12">
    <div class="row">
      <div class="col"  id="#sendMoney">
        <?php echo $__env->make('flash', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <div class="card">
          <div class="header">
            <h2><strong><?php echo e(__('Loan List')); ?></strong></h2>
          </div>
          <div class="body">
            <div class="card">
              <div class="card-body">
                <div class="row">
                  <div class="col-sm-2">
                      <a href="<?php echo e(route('loan',app()->getLocale())); ?>" class="btn btn-primary btn-xs">Apply for loan</a>
                  </div>
                  <div class="col-sm-2">
                      <a href="<?php echo e(route('loan.pending',app()->getLocale())); ?>" class="btn btn-primary btn-xs">Pending loan</a>
                  </div>
                  <div class="col-sm-2">
                      <a href="<?php echo e(route('loan.approved',app()->getLocale())); ?>" class="btn btn-primary btn-xs">Approved loan</a>
                  </div>
                  <div class="col-sm-2">
                      <a href="<?php echo e(route('loan.rejected',app()->getLocale())); ?>" class="btn btn-primary btn-xs">Rejected loan</a>
                  </div>
                  <div class="col-sm-2">
                      <a href="<?php echo e(route('loan.accepted',app()->getLocale())); ?>" class="btn btn-primary btn-xs">Accepted loan</a>
                  </div>
                  <div class="col-sm-2">
                      <a href="<?php echo e(route('loan.declined',app()->getLocale())); ?>" class="btn btn-primary btn-xs">Declined loan</a>
                  </div>
                </div>
                <h5 class="card-header"><?php if(isset($title)): ?><?php echo e($title); ?><?php endif; ?></h5>
                <div class="table-responsive">
                  <table class="table mb-0">
                    <thead>
                      <tr>
                        <th><?php echo app('translator')->getFromJson('Sr.No'); ?></th>
                        <th><?php echo app('translator')->getFromJson('Loan Amount'); ?></th>
                        <th><?php echo app('translator')->getFromJson('Loan Tenuer'); ?></th>
                        <th><?php echo app('translator')->getFromJson('Payback'); ?></th>
                        <th><?php echo app('translator')->getFromJson('Date'); ?></th>
                        <th><?php echo app('translator')->getFromJson('Action'); ?></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $__empty_1 = true; $__currentLoopData = $loans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                      <tr>
                          <td><?php echo e($key+1); ?></td>
                          <td>
                              <?php if(isset($data->loan_amount)): ?><?php echo e($data->loan_amount); ?><?php endif; ?>
                          </td>
                          <td>
                              <?php if(isset($data->loan_tenure)): ?><?php echo e($data->loan_tenure); ?><?php endif; ?>
                              <?php if(isset($data->tenure_type)): ?><?php echo e($data->tenure_type); ?><?php endif; ?>
                          </td>
                          <td> 
                              <?php if(isset($data->payback)): ?><?php echo e(ucfirst($data->payback)); ?><?php endif; ?>
                          </td>
                          <td> 
                              <?php if(isset($data->created_at)): ?><?php echo e(date('M d,Y',strtotime($data->created_at))); ?><?php endif; ?>
                          </td>
                          <td>
                             <a href="<?php echo e(route('loan.detail',[app()->getLocale(),$data->id])); ?>" class="btn btn-primary btn-xs"><i class="fa fa-eye"></i>Detail</a>
                             <?php if(isset($data->status) && $data->status == 3): ?>
                                <a href="<?php echo e(route('loan.user_payment_detail',[app()->getLocale(),$data->id])); ?>" class="btn btn-primary btn-xs">
                                    Payment Detail
                                </a>
                             <?php endif; ?>
                          </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                          <tr>
                              <td class="text-muted text-center" colspan="100%"><?php echo e(__($empty_message)); ?></td>
                          </tr>
                        <?php endif; ?>
                    </tbody>
                  </table>
                </div>
                <?php if($loans->LastPage() != 1): ?>
                  <div class="card-footer py-4">
                      <?php echo e($loans->links()); ?>

                  </div>
                <?php endif; ?>
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