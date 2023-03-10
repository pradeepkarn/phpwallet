

<?php $__env->startSection('content'); ?>

  <div class="row">
        <?php echo $__env->make('partials.sidebar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		
		<div class="col-md-9 " style="padding-right: 0">
     <?php echo $__env->make('partials.flash', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  	 <?php if($withdrawals->total()>0): ?>
     <div class="card">
        <div class="header">
            <h2><strong><?php echo e(__('My withdrawals')); ?></strong></h2>
            
        </div>
        <div class="body">
            <div class="table-responsive">
              <table class="table table-striped"  style="margin-bottom: 0;">
                  <thead>
                    <tr>
                      <th><?php echo e(__('Date')); ?></th>
                      <th><?php echo e(__('Method')); ?></th>
                      <th><?php echo e(__('Platform ID')); ?> ( <?php echo e(__('your Id on choosen Method platform')); ?> )</th>
                      <th><?php echo e(__('Gross')); ?></th>
                      <th><?php echo e(__('Fee')); ?></th>
                      <th><?php echo e(__('Net')); ?></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $withdrawals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $withdrawal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                      <tr>
                        <td><?php echo e($withdrawal->created_at->format('d M Y')); ?> <br> <?php echo $__env->make('withdrawals.partials.status', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?></td>
                        <td><?php echo e($withdrawal->transferMethod->name); ?></td>
                          <td><?php echo e($withdrawal->platform_id); ?></td>
                        <td><?php echo e($withdrawal->gross()); ?></td>
                        <td><?php echo e($withdrawal->fee()); ?></td>
                        <td><?php echo e($withdrawal->net()); ?></td>
                      </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <?php endif; ?>
                </tbody>
                </table>
            </div>  
        </div>
         <?php if($withdrawals->LastPage() != 1): ?>
              <div class="footer">
                  <?php echo e($withdrawals->links()); ?>

              </div>
            <?php else: ?>
            <?php endif; ?>
    </div>
      <?php endif; ?>


      <?php if($withdrawals->total() == 0): ?>
        <div class="container">
          <div class="card bg-light">
            <div class="header">
              <h2><strong class=""><i class="zmdi zmdi-alert-circle-o "></i></strong> Info</h2>
                <ul class="header-dropdown">  
                    <li class="remove">
                        <a role="button" class="boxs-close "><i class="zmdi zmdi-close "></i></a>
                    </li>
                </ul>
            </div>
            <div class="body block-header">
                <div class="row">
                    <div class="col">
                        <p class=""><strong> <?php echo e(__('Your account is Fresh and New !')); ?> </strong> <br><?php echo e(__('Get some money into your wallet and request cash withdraws !')); ?></p>
                    </div>   
                </div>
                
            </div>
          </div>
        </div>
      <?php endif; ?>

    </div>

  </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('footer'); ?>
  <?php echo $__env->make('partials.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>