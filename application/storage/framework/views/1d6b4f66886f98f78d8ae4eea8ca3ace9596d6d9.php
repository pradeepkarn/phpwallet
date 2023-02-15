
<?php $__env->startSection('content'); ?>

<div class="row">
    <?php echo $__env->make('partials.sidebar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <div class="col-md-9 " style="padding-right: 0">
        <?php echo $__env->make('flash', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <div class="card">
            <div class="header">
                <h2><strong><?php echo e(__('Add Fund to a virtual card')); ?></strong></h2>
            </div>
            <div class="body">
                <form method="POST" action="<?php echo e(url('/').'/'.app()->getLocale().'/vcard/postFund/'.$id); ?>">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="id" value="<?php if(isset($id)): ?><?php echo e($id); ?><?php endif; ?>">
                    <div class="row mb-2">
                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 <?php echo e($errors->has('amount') ? ' has-error' : ''); ?>">
                            <label for="name">
                                <?php echo e(__('Amount to fund')); ?>

                            </label>
                            <div class="input-group">
                                <span class="input-group-addon">$</span>
                                <input type="number" class="form-control" id="amount" name="amount" 
                                value="1" required="">
                            </div>
                            <?php if($errors->has('amount')): ?>
                                <span class="help-block text-danger">
                                    <strong><?php echo e($errors->first('amount')); ?></strong>
                                </span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <input type="submit" class="btn btn-primary float-right" value="<?php echo e(__('Add Fund')); ?>">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer'); ?>
  <?php echo $__env->make('partials.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>