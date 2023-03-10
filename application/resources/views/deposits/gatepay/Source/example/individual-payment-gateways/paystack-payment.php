<?php
include 'individual-payment-header.php';
//config data
$configData = configItem();
?>
<!DOCTYPE html>
<html>

<head>
    <title>Pay Page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="../assets/js/jquery-3.3.1.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../assets/css/custom.css" type="text/css">
</head>

<body>
    <div class="d-flex justify-content-center">
        <div class="lw-page-loader lw-show-till-loading">
            <div class="spinner-border" role="status"></div>
        </div>
    </div>

    <div class="pt-4 mb-5 container" id="lwCheckoutForm">
        <div class="row">
            <div class="col-md-4 lw-logo-section mt-0">
                <!-- Payment page logo -->
                <div class="lw-logo-container">
                    <img class="lw-logo" src="../assets/imgs/logo-for-site.png">
                </div>
                <!-- /Payment page logo -->
                <!-- Payment Page Other Information -->
                <h5>PHP ready to use Payment Gateway Integrations</h5>
                <hr class="mb-4">
                <h6>Ready to use </h6>
                <h6>Easy Integration</h6>
                <h6>Many Gateways</h6>
                <h6>Well Documented</h6>
                <!-- Payment Page Other Information -->
                <hr class="mb-4">
                <a href="<?= getAppUrl() ?>" class="btn btn-secondary">Go Back</a>
            </div>
            <div class="col-lg-8">
                <form method="post" id="lwPaymentForm">
                    <div class="card bg-light">
                        <!-- Payment Page header -->
                        <div class="card-header">
                            <h3 class="text-center">Complete your payment</h3>
                        </div>
                        <!-- /Payment Page header -->
                        <div class="card-body">
                            <!-- Info Message -->
                            <div class="alert alert-info">
                                This is just an example, you can integrate these payment gateway easily using this example implementation.
                            </div>
                            <!-- Info Message -->
                            <!-- show validation message block -->
                            <div id="lwValidationMessage" class="lw-validation-message"></div>
                            <!-- / show validation message block -->

                            <?php
                            // Get config data
                            $configData = configItem();
$userDetails = [
    'amounts' => [ // at least one currency amount is required
        'USD'   => 100,
        'INR'   => 170,
        'NGN'   => 120,
        'TRY'   => 180,
        'EUR'   => 9.05
    ],
    'order_id'      => 'ORDS' . uniqid(), // required in instamojo, Iyzico, Paypal, Paytm gateways
    'customer_id'   => 'CUSTOMER' . uniqid(), // required in Iyzico, Paytm gateways
    'item_name'     => 'Sample Product', // required in Paypal gateways
    'item_id'       => 'ITEM' . uniqid(), // required in Iyzico, Paytm gateways
    'item_qty'      => 1,
    'payer_email'   => 'sample@domain.com', // required in instamojo, Iyzico, Stripe gateways
    'payer_name'    => 'John Doe', // required in instamojo, Iyzico gateways
    'description'   => 'Lorem ipsum dolor sit amet, constetur adipisicing', // Required for stripe
    'payer_mobile'  => '9999999999',
    'ip_address'    => getUserIpAddr(), // required only for iyzico
    'address'       => '3234 Godfrey Street Tigard, OR 97223', // required in Iyzico gateways
    'city'          => 'Tigard',  // required in Iyzico gateways
    'country'       => 'United States' // required in Iyzico gateways
];
?>
                            <ul class="list-group mb-4">
                                <li class="list-group-item">
                                    <h3>Customer Details</h3>
                                </li>
                                <li class="list-group-item">
                                    <strong>Name:</strong> <?= $userDetails['payer_name'] ?>
                                </li>
                                <li class="list-group-item">
                                    <strong>Email:</strong> <?= $userDetails['payer_email'] ?>
                                </li>
                                <li class="list-group-item">
                                    <strong>Address:</strong> <?= $userDetails['address'] ?>
                                </li>
                                <li class="list-group-item">
                                    <strong>City:</strong> <?= $userDetails['city'] ?>
                                </li>
                                <li class="list-group-item">
                                    <strong>Country:</strong> <?= $userDetails['country'] ?>
                                </li>
                                <li class="list-group-item">
                                    <strong>Additional info:</strong> <?= $userDetails['description'] ?>
                                </li>
                                <li class="list-group-item">
                                    <strong>Item Name:</strong> <?= $userDetails['item_name'] ?>
                                </li>
                            </ul>
                            <?php
if (!$configData) {
    echo '<div class="alert alert-warning text-center">Unable to load configuration.</div>';
} else {
    $configItem = $configData['payments']['gateway_configuration'];

    //show payment gateway radio button
    foreach ($configItem as $key => $value) {
        if ($value['enable'] and $key == 'paystack') { ?>
                                        <div class="form-check form-check-inline">
                                            <label class="form-check-label" for="paymentOption-<?= $key ?>">
                                                <fieldset class="lw-fieldset mr-3 mb-3">
                                                    <legend class="lw-fieldset-legend-font">
                                                        <input class="form-check-input" type="radio" required="true" id="paymentOption-<?= $key ?>" name="paymentOption" value="<?= $key ?>">
                                                        <img class="lw-payment-gateway-icon" src="../assets/imgs/payment-images/<?= $key ?>-small.png">
                                                    </legend>
                                                    <img class="lw-payment-gateway-icon" src="../assets/imgs/payment-images/<?= $key ?>-big.jpg">
                                                </fieldset>
                                            </label>
                                        </div>
                                <?php  }
    } ?>
                                <h3 id="lwPaymentAmount"></h3>
                                <!--  checkout form submit button -->
                                <button type="submit" value="Proceed to Pay" class="btn btn-lg btn-block btn-success">Proceed to Pay</button>
                                <!-- / checkout form submit button -->
                            <?php   } ?>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>

<!-- get configuration data -->
<?php
$paymentPagePath    = getAppUrl('', 'individual-payment-gateways/');
$paystackConfigData = configItemData('payments.gateway_configuration.paystack');
$paystackCallbackUrl = getAppUrl($paystackConfigData['callbackUrl']);
$currency = $paystackConfigData['currency'];
$currencySymbol = $paystackConfigData['currencySymbol'];
$paystackTestingPublicKey = $paystackConfigData['paystackTestingPublicKey'];
$paystackLivePublicKey = $paystackConfigData['paystackLivePublicKey'];
$testMode = $paystackConfigData['testMode'];
?>
<!-- / get configuration data -->

<script type="text/javascript">
    var userDetails = <?= json_encode($userDetails) ?>;
    $('input[name=paymentOption]').change(function() {
        var gatewayCurrency = "<?= $currency ?>",
            currencySymbol = "<?= $currencySymbol ?>",
            formattedAmount = '<hr>' + currencySymbol + ' ' + userDetails['amounts'][gatewayCurrency] + ' ' + gatewayCurrency + '<hr>';
        $('#lwPaymentAmount').html(formattedAmount);
    });
</script>

<!-- Jquery Form submit in script tag -->
<script type="text/javascript">
    $(document).ready(function() {
        //submit checkout form
        $('#lwPaymentForm').on('submit', function(e) {

            e.preventDefault();
            var paymentOption = $('input[name=paymentOption]:checked').val();

            if (paymentOption == 'paystack') {

                var paystackCallbackUrl = <?php echo json_encode($paystackCallbackUrl); ?>,
                    paymentPagePath = <?php echo json_encode($paymentPagePath); ?>,
                    userDetails = <?php echo json_encode($userDetails); ?>,
                    testMode = "<?= $testMode ?>",
                    currency = "<?= $currency ?>";

                const amount = userDetails['amounts'][currency];

                var paystackPublicKey = '';

                //check paystack test or production mode
                if (testMode) {
                    paystackPublicKey = "<?= $paystackTestingPublicKey ?>";
                } else {
                    paystackPublicKey = "<?= $paystackLivePublicKey ?>";
                }

                var paystackAmount = amount.toFixed(2) * 100,
                    handler = PaystackPop.setup({
                        key: paystackPublicKey, // add paystack public key
                        email: userDetails['payer_email'], // add customer email
                        amount: paystackAmount, // add order amount
                        currency: currency, // add currency
                        callback: function(response) {
                            // after successful paid amount return paystack refrence Id
                            var paystackReferenceId = response.reference;

                            //show loader before ajax request
                            $(".lw-show-till-loading").show();

                            var paystackData = {
                                'paystackReferenceId': paystackReferenceId,
                                'paystackAmount': paystackAmount
                            };

                            var paystackData = $('#lwPaymentForm').serialize() + '&' + $.param(userDetails) + '&' + $.param(paystackData);

                            $.ajax({
                                type: 'post', //form method
                                context: this,
                                url: '../payment-process.php', // post data url
                                dataType: "JSON",
                                data: paystackData, // form serialize data
                                error: function(err) {
                                    var error = err.responseText
                                    string = '';

                                    //on error show alert message
                                    string += '<div class="alert alert-danger" role="alert">' + err.responseText + '</div>';

                                    $('#lwValidationMessage').html(string);
                                    //alert("AJAX error in request: " + JSON.stringify(err.responseText, null, 2));

                                    //hide loader after ajax request complete
                                    $(".lw-show-till-loading").hide();
                                },
                                success: function(response) {
                                    if (response.status == true) {
                                        $('body').html("<form action='" + paystackCallbackUrl + "' method='post'><input type='hidden' name='response' value='" + JSON.stringify(response) + "'><input type='hidden' name='paymentOption' value='paystack'></form>");
                                        $('body form').submit();
                                    }
                                }
                            });
                        },
                        onClose: function() {
                            //on close paystack inline widget then load back to checkout form page
                            // window.location.href = paymentPagePath+'<?= basename($_SERVER['PHP_SELF']); ?>';
                        }
                    });

                //open paystack inline widen using iframe
                handler.openIframe();
            }
            // Paystack script for send ajax request to server side end
        });
    });
</script>
<!-- /  Jquery Form submit in script tag -->

<?php
if ($paystackConfigData['enable']) { ?>
    <!-- load paystack inline widget script -->
    <script src="https://js.paystack.co/v1/inline.js"></script>
    <!-- / load Paystack inline widget script -->
<?php } ?>