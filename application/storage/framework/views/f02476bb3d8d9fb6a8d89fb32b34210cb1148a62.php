

<?php $__env->startSection('content'); ?>

    <div class="row">
        <?php echo $__env->make('partials.sidebar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		 <div class="col-lg-9 col-md-12">
        <div class="row">
      		<div class="col">
              
      	        <?php if($deposits->total()>0): ?>
                <div class="card">
                  <div class="header">
                      <h2><strong><?php echo e(__('My Deposits')); ?></strong></h2>
                      
                  </div>
                  <div class="body">
                    <div class="table-responsive">
                      <table class="table table-striped"  style="margin-bottom: 0;">
                        <thead>
                          <tr>
                            <th><?php echo e(__('Receipt')); ?></th>
                            <th><?php echo e(__('Date')); ?></th>
                            <th><?php echo e(__('Method')); ?></th>
                            <th><?php echo e(__('Gross')); ?></th>
                            <th><?php echo e(__('Fee')); ?></th>
                            <th><?php echo e(__('Net')); ?></th>
                            <th><?php echo e(__('Unique transaction id')); ?></th>
                            
                          </tr>
                        </thead>
                        <tbody>
                          <?php $__empty_1 = true; $__currentLoopData = $deposits; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $deposit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                              <td><a href="<?php echo e($deposit->transaction_receipt); ?>" target="blank"><img src="<?php echo e($deposit->transaction_receipt); ?>" alt="" class="rounded" loading="lazy" style="width: 50px"></a></td>
                              <td><?php echo e($deposit->created_at->format('d M Y')); ?> <br> <?php echo $__env->make('deposits.partials.status', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?></td>
                              <td><?php echo e($deposit->transferMethod->name); ?></td>
                              <td><?php echo e($deposit->gross()); ?></td>
                              <td><?php echo e($deposit->fee()); ?></td>
                              <td><?php echo e($deposit->net()); ?></td>
                               <td><?php echo e($deposit->unique_transaction_id); ?></td>
                            </tr>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                          
                          <?php endif; ?>
                        </tbody>
                      </table>                          
                    </div> 
                  </div>
                  <?php if($deposits->LastPage() != 1): ?>
                    <div class="footer">
                        <?php echo e($deposits->links()); ?>

                    </div>
                  <?php else: ?>
                  <?php endif; ?>
              </div>
                <?php endif; ?>

                <?php if($deposits->total() == 0): ?>
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
                                  <p class=""><strong> <?php echo e(__('Your account is Fresh and New !')); ?> </strong> <br><?php echo e(__('Start by adding credit to your wallet to spend online with friends and family.')); ?></p>
                              </div>   
                          </div>
                          <div class="col">
                            <a class="btn btn-primary btn-round bg-blue mb-3" href="<?php echo e(url('/')); ?>/<?php echo e(app()->getLocale()); ?>/deposit/<?php echo e(Auth::user()->currentWallet()->id); ?>"><?php echo e(__('Choose your prefered deposit method')); ?></a>
                          </div>
                      </div>
                    </div>
                  </div>
                <?php endif; ?>

          	</div>
          </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer'); ?>
  <?php echo $__env->make('partials.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>