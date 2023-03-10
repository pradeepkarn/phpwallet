

<?php $__env->startSection('content'); ?>

    <div class="row">
        <?php echo $__env->make('partials.sidebar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
         <div class="col-lg-9 col-md-12">
          <div class="row">
            <div class="col" style="padding-right: 0" id="#sendMoney">

              <?php echo $__env->make('flash', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
               <div class="card bg-light" >
                <div class="header">
                    <h2><strong> <?php echo e(__('What is Escrow ?')); ?> </strong>  <?php echo e(__('How does  it work ?')); ?></h2>
                    
                </div>
                <div class="body">
                  <div class="clearfix"></div>
                    <div class="row mb-5">
                      <div class="col-lg-12 ">
                          <label for=""></label>
                          <div  class="bg-white alert alert-secondary" role="alert" style="color: #383d41">
                              <?php echo setting('escrows.explainer_to_users'); ?>

                          </div>
                      </div>
                    </div>
                </div>
              </div>
              <div class="card">
                <div class="header">
                    <h2><strong><?php echo e(__("Transfer")); ?></strong> <?php echo e(__('Money')); ?> <?php echo e(__('in escrow mode')); ?> </h2>
                    
                </div>
                <div class="body">
                  <form action="<?php echo e(url('/')); ?>/<?php echo e(app()->getLocale()); ?>/escrow" method="post" enctype="multipart/form-data">
                        <?php echo e(csrf_field()); ?>

                        <div class="row">
                          <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                            <div class="form-group <?php echo e($errors->has('merchant_site_url') ? ' has-error' : ''); ?>">
                              <div class="form-group">
                                <label for="deposit_method"><?php echo e(__('Currency')); ?> [ <span class="text-primary"><?php echo e(Auth::user()->currentCurrency()->code); ?></span> ]</label>
                                <select class="form-control" id="currency" name="currency">
                                  <option value="<?php echo e(Auth::user()->currentCurrency()->id); ?>" data-value="<?php echo e(Auth::user()->currentCurrency()->id); ?>" selected><?php echo e(Auth::user()->currentCurrency()->name); ?> </option>
                                  
                                </select>
                                <?php if($errors->has('currency')): ?>
                                  <span class="help-block">
                                      <strong><?php echo e($errors->first('currency')); ?></strong>
                                  </span>
                              <?php endif; ?>
                              </div>
                            </div>
                          </div>
                          <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                            <div class="form-group <?php echo e($errors->has('amount') ? ' has-danger' : ''); ?>">
                              <label for="amount"><?php echo e(__('Amount')); ?></label>
                              <input type="number" class="form-control" id="amount" name="amount" value="<?php echo e(old('amount')); ?>" required placeholder="5.00" pattern="[0-9]+([\.,][0-9]+)?" 
                              step="0.01" >
                               <?php if($errors->has('amount')): ?>
                                    <div class="form-control-feedback">
                                        <strong><?php echo e($errors->first('amount')); ?></strong>
                                    </div>
                                <?php endif; ?>
                            </div>
                          </div>
                          <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                            <label for="email"><?php echo e(__('User email')); ?></label>
                            <div class="input-group <?php echo e($errors->has('email') ? ' has-danger' : ''); ?>">
                                <span class="input-group-addon"><i class="zmdi zmdi-email"></i></span>
                                <input type="text" class="form-control email" id="email" name="email" placeholder="Ex: example@example.com" required >
                                 <?php if($errors->has('email')): ?>
                                    <div class="form-control-feedback">
                                        <strong><?php echo e($errors->first('email')); ?></strong>
                                    </div>
                                <?php endif; ?>
                            </div>
                          </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="row">
                          <div class="col">
                            <div class="form-group <?php echo e($errors->has('description') ? ' has-danger' : ''); ?>">
                              <label for="description"><?php echo e(__('Note for Recepient')); ?> | <?php echo e(__('Your Deal Agreement')); ?> </label>
                              <textarea class="form-control" rows="5" id="description" name="description" placeholder="<?php echo e(__('Write a note...')); ?>" required></textarea>
                               <?php if($errors->has('description')): ?>
                                    <div class="form-control-feedback">
                                        <strong><?php echo e($errors->first('description')); ?></strong>
                                    </div>
                                <?php endif; ?>
                            </div>
                          </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="row">
                          <div class="col">
                            <input type="submit" class="btn btn-primary float-right" value="<?php echo e(__('Start Escrow')); ?>">
                          </div>
                        </div>
                        <div class="clearfix"></div>
                      </form>                        
                    
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
    $( "#currency option:selected" ).each(function() {
      window.location.replace("<?php echo e(url('/')); ?>/<?php echo e(app()->getLocale()); ?>/wallet/"+$(this).val());
  });
})
</script>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('footer'); ?>
  <?php echo $__env->make('partials.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>