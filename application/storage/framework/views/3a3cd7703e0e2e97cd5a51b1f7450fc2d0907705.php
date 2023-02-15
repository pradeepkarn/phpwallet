
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
                <form enctype="multipart/form-data" action="<?php echo e(route('submitLoanRequest',app()->getLocale())); ?>" method="POST" id="submit_form">
                  <?php echo csrf_field(); ?>
                  <input type="hidden" value="1" name="edit">
                  <div class="card">
                    <h5 class="card-header"><?php echo app('translator')->getFromJson('Apply Loan'); ?></h5>
                    <div class="card-body">
                      <div class="row">
                        <div class="col-sm-2">
                          <div class="form-group">
                              <label>Amount</label>
                              <input type="number" class="form-control loan_amount" required="" name="loan_amount">
                          </div>
                        </div>
                        <div class="col-sm-2">
                          <div class="form-group">
                            <label>Loan tenure</label>
                            <select class="form-control loan_tenure" name="loan_tenure" required="">
                                <option value="">--select--</option>
                                <option value="1">1 Month</option>
                                <option value="2">2 Month</option>
                                <option value="3">3 Month</option>
                                <option value="4">4 Month</option>
                                <option value="5">5 Month</option>
                            </select>
                          </div>
                        </div>
                        <div class="col-sm-2">
                          <div class="form-group">
                            <label>Payback</label>
                            <select class="form-control payback" name="payback" required="">
                                <option value="">--select--</option>
                                <option value="daily">Daily</option>
                                <option value="weekly">Weekly</option>
                                <option value="monthly">Monthly</option>
                            </select>
                          </div>
                        </div>
                        <div class="col-sm-2">
                          <div class="form-group">
                            <label>Total Repay</label>
                            <input type="number" class="form-control repay_amount" readonly="" required="" name="repay_amount">
                          </div>
                        </div>
                        <div class="col-sm-2">
                          <div class="form-group">
                            <label>Repay every <span class="every_repay"></span></label>
                            <input type="number" class="form-control return_amount" readonly="" required="" name="return_amount">
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
                                <label>BVN</label>
                                <input type="text" class="form-control bvn" required="" value="<?php if(isset($customers_details->bvn)): ?><?php echo e($customers_details->bvn); ?><?php endif; ?>" name="bvn">
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-sm-12">
                              <div class="form-group">
                                <label>ID type and the number ( NIN and DRIVER'S LICENSE ONLY)</label>
                                <input type="text" class="form-control" value="<?php if(isset($customers_details->id_type_number)): ?><?php echo e($customers_details->id_type_number); ?><?php endif; ?>" required="" name="id_type_number">
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-sm-12">
                              <div class="form-group">
                                <label>Full Name</label>
                                <input type="text" class="form-control" value="<?php if(isset($customers_details->full_name)): ?><?php echo e($customers_details->full_name); ?><?php endif; ?>"  required="" name="full_name">
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-sm-12">
                              <div class="form-group">
                                <label>Residential address</label>
                                <input type="text" class="form-control" value="<?php if(isset($customers_details->residential_address)): ?><?php echo e($customers_details->residential_address); ?><?php endif; ?>" required="" name="residential_address">
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-sm-12">
                              <div class="form-group">
                                <label>Account Number</label>
                                <input type="text" class="form-control" value="<?php if(isset($customers_details->account_number)): ?><?php echo e($customers_details->account_number); ?><?php endif; ?>" required="" name="account_number">
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-sm-12">
                              <div class="form-group">
                                <label>Bank Name</label>
                                <input type="text" class="form-control" value="<?php if(isset($customers_details->bank_name)): ?><?php echo e($customers_details->bank_name); ?><?php endif; ?>" required="" name="bank_name">
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-sm-12">
                              <div class="form-group">
                                <label>Selfie or passport</label>
                                <input type="file" class="form-control" name="selfie_passport">
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-sm-12">
                              <div class="form-group">
                                  <label>Contact</label>
                                  <input type="text" class="form-control" value="<?php if(isset($customers_details->contact)): ?><?php echo e($customers_details->contact); ?><?php endif; ?>" required="" name="contact">
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-sm-12">
                              <div class="form-group">
                                <label>Home Address</label>
                                <input type="text" class="form-control" value="<?php if(isset($customers_details->home_address)): ?><?php echo e($customers_details->home_address); ?><?php endif; ?>" required="" name="home_address">
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="card">
                        <h5 class="card-header"><?php echo app('translator')->getFromJson('Guarantors'); ?> (Civil servant)</h5>
                        <div class="card-body">
                          <div class="row">
                            <div class="col-sm-12">
                              <div class="form-group">
                                <label>BVN</label>
                                <input type="text" value="<?php if(isset($guarantors->c_bvn)): ?><?php echo e($guarantors->c_bvn); ?><?php endif; ?>" class="form-control bvn" required="" name="c_bvn">
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-sm-12">
                              <div class="form-group">
                                <label>ID type and the number (voters card not acceptable)</label>
                                <input type="text" class="form-control" value="<?php if(isset($guarantors->c_id_type_number)): ?><?php echo e($guarantors->c_id_type_number); ?><?php endif; ?>" required="" name="c_id_type_number">
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-sm-12">
                              <div class="form-group">
                                <label>Full Name</label>
                                <input type="text" class="form-control" value="<?php if(isset($guarantors->c_full_name)): ?><?php echo e($guarantors->c_full_name); ?><?php endif; ?>" required="" name="c_full_name">
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-sm-12">
                              <div class="form-group">
                                <label>Residential address</label>
                                <input type="text" class="form-control" value="<?php if(isset($guarantors->c_residential_address)): ?><?php echo e($guarantors->c_residential_address); ?><?php endif; ?>" required="" name="c_residential_address">
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-sm-12">
                              <div class="form-group">
                                <label>Upload passport</label>
                                <input type="file" class="form-control" name="c_upload_passport">
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-sm-12">
                              <div class="form-group">
                                <label>Contact</label>
                                <input type="text" class="form-control" value="<?php if(isset($guarantors->c_contact)): ?><?php echo e($guarantors->c_contact); ?><?php endif; ?>" required="" name="c_contact">
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-sm-12">
                              <div class="form-group">
                                <label>Business address or place of work</label>
                                <input type="text" class="form-control" value="<?php if(isset($guarantors->c_business_address)): ?><?php echo e($guarantors->c_business_address); ?><?php endif; ?>" required="" name="c_business_address">
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="card">
                        <h5 class="card-header"><?php echo app('translator')->getFromJson('Guarantors'); ?> (Business man)</h5>
                        <div class="card-body">
                          <div class="row">
                            <div class="col-sm-12">
                              <div class="form-group">
                                <label>BVN</label>
                                <input type="text" class="form-control" value="<?php if(isset($guarantors->b_bvn)): ?><?php echo e($guarantors->b_bvn); ?><?php endif; ?>" required="" name="b_bvn">
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-sm-12">
                              <div class="form-group">
                                <label>ID type and the number (voters card not acceptable) </label>
                                <input type="text" class="form-control" value="<?php if(isset($guarantors->b_id_type_number)): ?><?php echo e($guarantors->b_id_type_number); ?><?php endif; ?>" required="" name="b_id_type_number">
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-sm-12">
                              <div class="form-group">
                                <label>Full Name</label>
                                <input type="text" class="form-control" value="<?php if(isset($guarantors->b_full_name)): ?><?php echo e($guarantors->b_full_name); ?><?php endif; ?>" required="" name="b_full_name">
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-sm-12">
                              <div class="form-group">
                                <label>Residential address</label>
                                <input type="text" class="form-control" value="<?php if(isset($guarantors->b_residential_address)): ?><?php echo e($guarantors->b_residential_address); ?><?php endif; ?>" required="" name="b_residential_address">
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-sm-12">
                              <div class="form-group">
                                <label>Upload passport</label>
                                <input type="file" class="form-control" name="b_upload_passport">
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-sm-12">
                              <div class="form-group">
                                <label>Contact</label>
                                <input type="text" class="form-control" value="<?php if(isset($guarantors->b_contact)): ?><?php echo e($guarantors->b_contact); ?><?php endif; ?>" required="" name="b_contact">
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-sm-12">
                              <div class="form-group">
                                <label>Business address or place of work</label>
                                <input type="text" class="form-control" value="<?php if(isset($guarantors->b_business_address)): ?><?php echo e($guarantors->b_business_address); ?><?php endif; ?>" required="" name="b_business_address">
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row" style="text-align:right;">
                    <div class="col-sm-12">
                        <!-- <button type="button" href="#" data-toggle="modal" data-target="#addMyModalQr" class="btn btn-info">Submit</button> -->
                        
                          <button type="submit" id="submit" class="btn btn-info">Submit</button> -
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php
  $language = app()->getLocale();
  $_url     = $language."/loan/user_loan_preview";
  $preview_url = url($_url);
?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
<script type="text/javascript">
    var preview_url = "<?php echo e($preview_url); ?>";
    document.addEventListener('DOMContentLoaded',function(){
      $('body').on('change','.loan_tenure',function(){
        calculations();
      });
      $('body').on('keyup','.loan_amount',function(){
        calculations();
      });
      $('body').on('change','.payback',function(){
        var body = $('body');
        var payback = $(this).find(':selected').val();
        payback = (payback) ? payback.trim():'';
        body.find('.every_repay').text(payback);
        calculations();
      });
      var calculations = function()
      {
        var body = $('body');
        var loan_interest = 10;
        var loan_tenure = body.find('.loan_tenure').find(':selected').val();
        var payback = body.find('.payback').find(':selected').val();
        var loan_amount = body.find('.loan_amount').val();
        loan_amount = (loan_amount > 0) ? loan_amount:0;
        if(loan_tenure)
        {
          var total_loan_interest = parseFloat(loan_tenure) * parseFloat(loan_interest);
          var total_loan_interest_amount = parseFloat(loan_amount)/100 * parseFloat(total_loan_interest);
          loan_amount = parseFloat(loan_amount) + parseFloat(total_loan_interest_amount);
          body.find('.repay_amount').val(loan_amount);
          var return_replay = 0;
          var total_days = parseFloat(loan_tenure) * 30;
          var total_weeks = parseFloat(total_days)/7;
          total_weeks = total_weeks.toFixed(0);
            if(payback == 'daily')
          {
            var return_replay = parseFloat(loan_amount)/total_days;
          }
          if(payback == 'weekly')
          {
            var return_replay = parseFloat(loan_amount)/total_weeks;
          }
          if(payback == 'monthly')
          {
            var return_replay = parseFloat(loan_amount)/loan_tenure;
          }
          return_replay = return_replay.toFixed(2);
          body.find('.return_amount').val(return_replay);
        }
      }
      $('body').on('submit','#submit_form',function(event){
        event.preventDefault();
        var action=$(this).attr('action');
        $('body').find('#submit').html('Please Wait...');
        $('body').find("#submit").attr("disabled", true);
        var form = $(this);
        var formData = new FormData(form[0]);
        $.ajax({
          url: action,
          type: "POST",
          data:formData,
          processData: false,
          contentType: false,
          cache:false,
          success: function( response ) {
            var result = jQuery.parseJSON(response);
            if(result.success == 1)
            {
              var loan_id = result.loan_id;
              $('body').find('.alert_message').show();
              $('body').find('.alert_message').addClass('alert-success');
              $('body').find('.alert_message').text(result.message);
              window.location.href= preview_url+"/"+loan_id;
            }
            else
            {
              $('body').find('.alert_message').show();
              $('body').find('.alert_message').addClass('alert-danger');
              $('body').find('.alert_message').text(result.message);
              $('body').find('#submit').html('Submit');
              $('body').find("#submit"). attr("disabled", false);
            }
          }
        });
      });
    },false);
</script>
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