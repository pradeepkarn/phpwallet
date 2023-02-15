<?php
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Artisan::call('storage:link');
Route::any('/stro_webhook', 'StrovirtualaccountController@stro_webhook')->name('stro_webhook');
Route::get('loan/return_loan', 'LoanController@return_loan')->name('loan.return_loan');
Route::redirect('/', '/en');
Route::get('/migrate/artisan', function(){
	$result = Artisan::call('migrate');
	dd($result);
});

// Route::get('/lang/{lang}', function ($locale){
// 	Session::put('locale', $locale);
//        return redirect('/');
// });

Route::group(['prefix' => 'admin/dashboard'], function () {
    Voyager::routes();
});

// define('STRO_WALLET_API_URL','https://strowallet.com');
// define('STRO_PUBLIC_KEY','Y9V');
Route::get('en/login', 'Auth\LoginController@showLoginForm')->name('enlogin');

Route::group(['prefix' => '{language}', 'middleware' => ['setLanguage']],function(){

		// Route::group(['prefix' => 'ticketadmin', 'middleware' => 'ticketadmin'], function() {
		Route::group(['prefix' => 'ticketadmin'], function() {
		    Route::get('tickets', 'TicketsController@index')->name('support');
		    Route::post('close/{ticket_id}', 'TicketsController@close')->name('close');
		});

		Route::get('/', function () {
		    return view('welcome');
		});

		//Auth::routes();

		// Authentication Routes...
		Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
		Route::post('login', 'Auth\LoginController@login');
		Route::post('logout', 'Auth\LoginController@logout')->name('logout');

		// Registration Routes...
		Route::get('register', 'SignUpController@showRegistrationForm')->name('register');
		Route::post('register', 'SignUpController@register');

		// Password Reset Routes...
		Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
		// Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
		Route::get('password/reset/{token}/{email}', 'AccountsController@showResetForm')->name('password.reset');
		//Route::post('password/reset', 'Auth\ResetPasswordController@reset');


		Route::post('reset_password_without_token', 'AccountsController@validatePasswordRequest')->name('reset_password_without_token');
		Route::post('reset_password', 'AccountsController@resetPassword')->name('reset_password');


		//Account Activation Routes...
		Route::get('register/{email}/{token}', 'SignUpController@verifyEmail');
		Route::get('resend/activationlink', 'SignUpController@resendActivactionLink')->middleware('auth');
		Route::get('otp', 'SignUpController@OTP')->middleware('auth');
		Route::get('otp/resend', 'SignUpController@OTPresend')->middleware('auth')->name('resend_otp');
		Route::post('otp', 'SignUpController@postOtp')->middleware('auth');

		Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');

		// -------------------------------------------------------------------------------

	
		Route::get('/wallet/{id}','HomeController@wallet')->middleware('auth')->name('wallet.id');    
		 
		Route::get('/mail', 'SignUpController@TestMail');
		Route::get('/paysi', 'SignUpController@paysy');

		Route::get('/account_status/{User}', 'HomeController@accountStatus')->middleware('auth');



		//Impersonation routes
		Route::get('impersonate/user/{user_id}', 'ProfileController@impersonateUser')->middleware('auth')->name('impersonateUser');
		Route::impersonate();


		// SEND MONEY ROUTES
		Route::get('/sendmoney', 'MoneyTransferController@sendMoneyForm')->name('sendMoneyForm')->middleware('auth');
		Route::post('/sendmoney', 'MoneyTransferController@sendMoney')->name('sendMoney')->middleware('auth');

		Route::post('/sendMoneyConfirm', 'MoneyTransferController@sendMoneyConfirm')->name('sendMoneyConfirm')->middleware('auth');
		Route::post('/sendMoneyDelete', 'MoneyTransferController@sendMoneyCancel')->name('sendMoneyDelete')->middleware('auth');
		
			// Exchange Currency
		Route::get('/exchange_currency', 'ExchangeCurrencyController@exchangeCurrencyForm')->name('exchangeCurrencyForm')->middleware('auth');
		Route::get('/currencyExchange', 'ExchangeCurrencyController@currencyExchange')->name('currencyExchange')->middleware('auth');
		Route::post('/save/currencyExchange', 'ExchangeCurrencyController@saveDetail')->name('save.currencyExchange')->middleware('auth');
		Route::get('/exchange_currency/list', 'ExchangeCurrencyController@exchange_currency_list')->name('exchange_currency.list')->middleware('auth');

         /* VIRTUAL CARDS ROUTES */
        Route::get('/vcard','VCardController@index')->name('vcard')->middleware('auth');
        Route::get('/vcard/create','VCardController@create')->name('vcard.create')->middleware('auth');
        Route::post('/vcard/store','VCardController@store')->name('vcard.store')->middleware('auth');
        Route::get('/vcard/details/{id}','VCardController@details')->name('vcard.details')->middleware('auth');
        Route::get('/vcard/fund/{id}','VCardController@fund')->name('vcard.fund')->middleware('auth');
        Route::post('/vcard/postFund/{id}','VCardController@postFund')->name('vcard.postFund')->middleware('auth');
        Route::get('/vcard/error','VCardController@error')->name('vcard.error')->middleware('auth');
        Route::get('/vcard/confirm_delete/{id}','VCardController@confirmDelete')->name('vcard.confirmDelete')->middleware('auth');
        Route::get('/vcard/delete/{id}','VCardController@delete')->name('vcard.delete')->middleware('auth');
        
         // epin
		Route::get('generatePDF/{id}', 'EpinController@generatePDF')->name('generatePDF')->middleware('auth');
		Route::get('buyEpin', 'EpinController@buyEpin')->name('buyEpin')->middleware('auth');
		// Route::post('/user/buyepin', 'EpinController@buyEpin')->name('buyepin')->middleware('auth');
		Route::post('buyEpinAction', 'EpinController@buyEpinAction')->name('buyEpinAction')->middleware('auth');

		//REQUEST MONEY ROUTES
		Route::get('/requestmoney', 'MoneyTransferController@requestMoneyForm')->name('requestMoneyForm')->middleware('auth');
		Route::post('/requestmoney', 'MoneyTransferController@requestMoney')->name('requestMoney')->middleware('auth');
		// Route::post('/requestMoneyConfirm', 'MoneyTransferController@requestMoneyConfirm')->name('requestMoneyConfirm')->middleware('auth');
		// Route::post('/requestMoneyDelete', 'MoneyTransferController@requestMoneyCancel')->name('requestMoneyDelete')->middleware('auth');


		//WALLET ROUTES
		Route::get('transfer/{currency_id}/methods', 'WalletController@showTransferMethods')->middleware('auth')->name('show.transfermethods');
		Route::get('currencies/methods', 'WalletController@showCurrencies')->middleware('auth')->name('show.currencies');
		Route::get('wallet/create/{currency_id}', 'WalletController@createWallet')->middleware('auth')->name('show.createwalletform');
		Route::get('method/create/{currency_id}', 'WalletController@showCreateMethodForm')->middleware('auth');
		Route::post('method/create', 'WalletController@createMethod')->middleware('auth')->name('add.method.wallet');


		/*	MERCHANT ROUTES	*/

		Route::get('/merchant/storefront/{ref}', 'MerchantController@getStoreFront')->name('storefront');
		Route::get('/merchant/{merchant}/docs', 'MerchantController@integration')->middleware('auth')->name('merchantIntegration');
		Route::get('/mymerchants', 'MerchantController@index')->name('mymerchants')->middleware('auth');

		Route::get('/merchant/new', 'MerchantController@new')->name('merchant.new')->middleware('auth');
		Route::post('/merchant/add','MerchantController@add')->name('merchant.add')->middleware('auth');


		/*	IPN ROUTES	*/
		Route::post('/purchase/link', 'RequestController@storeRequest')->name('purchase_link');
		Route::post('/request/status', 'RequestController@requestStatus')->name('purchase_status');
		Route::post('/purchase/confirm', 'IPNController@purchaseConfirmation')->name('purchaseConfirm')->middleware('auth');
		Route::post('/purchase/delete', 'IPNController@purchaseCancelation')->name('purchaseDelete')->middleware('auth');
		Route::post('/ipn/payment', 'IPNController@pay')->name('pay')->middleware('auth');
		Route::post('/ipn/payment/guest', 'IPNController@logandpay')->name('logandpay');

		/*	ADD CREDIT ROUTES	*/
		Route::get('/addcredit/{method_id?}', 'AddCreditController@addCreditForm')->name('add.credit')->middleware(['auth','activeUser']);
		Route::get('/deposit', 'AddCreditController@depositMethods')->name('deposit.credit')->middleware('auth');
		Route::get('/deposit/{wallet_id}', 'AddCreditController@depositTransferMethods')->name('deposit.transfer.form')->middleware('auth');
		// Route::get('/deposit/{wallet_id}', 'AddCreditController@depositByWallet')->name('deposit.transfer.form')->middleware('auth');

		Route::get('/deposit/m/{method_id}', 'AddCreditController@depositByTransferMethod')->name('deposit.transfer.form')->middleware('auth');

		Route::post('/addcredit', 'AddCreditController@depositRequest')->name('post.credit')->middleware('auth');
		
		Route::post('/flutteraddcredit', 'AddCreditController@flutteraddcredit')->name('post.flutteraddcredit')->middleware('auth');

		Route::get('/flutteraddredirect', 'AddCreditController@handleFlutterWavePayment')->name('get.flutteraddredirect')->middleware('auth');

		/*	DEPOSITS ROUTES	*/
		Route::get('/mydeposits','DepositController@myDeposits')->name('mydeposits')->middleware('auth');
		Route::put('/confirm/deposit','DepositController@confirmDeposit')->name('confirm.deposit')->middleware('auth');

		/* WITHDRAWAL ROUTES */

		// route::get('/withdrawal/request/{method_id?}', 'WithdrawalController@getWithdrawalRequestForm')->name('withdrawal.form')->middleware(['auth','activeUser']);
		route::get('/payout/{wallet_id}', 'WithdrawalController@payoutMethod')->name('payout.methods')->middleware(['auth','activeUser']);
		route::get('/payout/request/{pivot_id}', 'WithdrawalController@payoutForm')->name('payout.form')->middleware(['auth','activeUser']);
		route::post('/withdrawal/request', 'WithdrawalController@makeRequest')->name('post.withdrawal')->middleware('auth');
		route::get('/withdrawals', 'WithdrawalController@index')->name('withdrawal.index')->middleware('auth');

		Route::put('/confirm/withdrawal','WithdrawalController@confirmWithdrawal')->name('confirm.withdrawal')->middleware('auth');

		/* EXCHANGE ROUTES */
		route::get('/exchange/first/{first_id?}/second/{second_id?}', 'ExchangeController@getExchangeRequestForm')->name('exchange.form')->middleware('auth');
		route::post('/exchange/', 'ExchangeController@exchange')->name('post.exchange')->middleware('auth');

		route::post('/update_rates','ExchangeController@updateRate')->middleware('auth');
		route::get('/update_rates','ExchangeController@updateRateForm')->middleware('auth');

		route::get('new_ticket', 'TicketsController@create')->name('support');
		route::post('post_new_ticket', 'TicketsController@store')->name('post_new_ticket');
		route::get('my_tickets', 'TicketsController@userTickets')->name('my_tickets');
		Route::get('ticket_detail/{ticket_id}', 'TicketsController@show')->name('ticket_detail');
		Route::post('comment', 'TicketCommentsController@postTicketComment')->name('comment');


		route::get('profile/info', 'ProfileController@personalInfo')->name('profile.info')->middleware('auth');
		route::post('profile/info', 'ProfileController@storePersonalInfo')->name('profile.info.store')->middleware('auth');
		route::get('profile/identity', 'ProfileController@profileIdentity')->name('profile.identity')->middleware('auth');
		route::post('profile/identity', 'ProfileController@storeProfileIdentity')->name('profile.identity.store')->middleware('auth');
		route::get('profile/newpassword', 'ProfileController@newpasswordInfo')->name('profile.newpassword')->middleware('auth');
		route::post('profile/newpassword', 'ProfileController@storeNewpasswordInfo')->name('profile.newpassword.store')->middleware('auth');


		//VOUCHERS ROUTES
		route::get('my_vouchers', 'VoucherController@getVouchers')->name('my_vouchers')->middleware('auth');
		route::post('my_vouchers', 'VoucherController@createVoucher')->name('create_my_voucher')->middleware('auth');
		route::post('load_my_voucher', 'VoucherController@loadVoucher')->name('load_my_voucher')->middleware('auth');
		route::post('load_voucher_to_user', 'VoucherController@loadVoucherToUser')->name('load_voucher_to_user')->middleware('auth');
		route::get('makevouchers', 'VoucherController@generateVoucher')->name('makeVouchers')->middleware('auth');
		route::post('generateVoucher', 'VoucherController@postGenerateVoucher')->name('generateVoucher')->middleware('auth');
		route::get('buyvoucher', 'VoucherController@buyvouchermethod')->middleware('auth');

		//PAYPAL VOUCHER ROUTES
		route::get('buyvoucher/paypal', 'PayPalController@buyvoucher')->middleware('auth');
		route::post('buyvoucher/paypal', 'PayPalController@sendRequestToPaypal')->middleware('auth');
		route::get('pay/voucher/paypal/success', 'PayPalController@paySuccess')->middleware('auth');
		Route::post('/merchant/storefront/paypal/{ref}', 'PayPalController@postStoreFront')->name('paypalstorefront');
		Route::get('/merchant/storefront/paypal/success', 'PayPalController@postStoreFrontSuccess');
		Route::get('/merchant/storefront/paypal/cancel', 'PayPalController@postStoreFrontCancel');

		//PAYSTACK VOUCHER ROUTES
		route::get('buyvoucher/paystack', 'PaystackController@buyvoucher')->middleware('auth');
		route::post('buyvoucher/paystack', 'PaystackController@sendRequestToPayStack')->middleware('auth');
		route::get('pay/voucher/paystack/success', 'PaystackController@payVoucherPayStackSuccess')->middleware('auth');
		Route::post('/merchant/storefront/paystack/{ref}', 'PaystackController@postStoreFront')->name('paystackstorefront');
		Route::get('/merchant/storefront/paystack/success', 'PaystackController@postStoreFrontSuccess');

		//STRIPE VOUCHER ROUTES
		route::get('buyvoucher/stripe', 'StripeController@buyvoucher')->middleware('auth');
		route::post('buyvoucher/stripe', 'StripeController@sendRequestToStripe')->middleware('auth');
		//route::get('pay/voucher/paystack/success', 'PaystackController@payVoucherPayStackSuccess')->middleware('auth');

		//2CHECKOUT VOUCHER ROUTES
		route::get('buyvoucher/2checkout', 'TwoCheckoutController@buyvoucher')->middleware('auth');
		route::post('buyvoucher/2checkout', 'TwoCheckoutController@sendRequestToStripe')->middleware('auth');
		//route::get('pay/voucher/paystack/success', 'PaystackController@payVoucherPayStackSuccess')->middleware('auth');

		//TUTORIAL ROUTES


		// route::get('blog', 'BlogController@index' )->name('blog');
		// route::get('blog/{post_excerpt}/{post_id}', 'BlogController@singlePost' )->name('post');

		//TRANSACTIOINS ROUTES
		route::post('transaction/remove', 'TransactionController@deleteMapper')->middleware('auth');

		//ESCROW ROUTES

		route::get('escrow', 'EscrowController@sendForm')->name('escrow')->middleware('auth');
		route::post('escrow', 'EscrowController@store')->middleware('auth');
		route::post('/escrow/refund','EscrowController@refund')->middleware('auth');
		route::post('/escrow/release','EscrowController@release')->middleware('auth');
		route::get('/escrow/{eid}', 'EscrowController@agreement')->middleware('auth');

		//INVESTMENT

		route::get('investment/plans', 'InvestmentController@plans')->name('investmentplans');
		route::get('investment/plan/{plan_id}', 'InvestmentController@investForm')->name('investmentform')->middleware('auth');
		route::post('investment/store', 'InvestmentController@store')->middleware('auth');
		route::get('myinvestments', 'InvestmentController@myInvestments')->name('myinvestments')->middleware('auth');
		route::post('investment/take_profit', 'InvestmentController@takeProfit')->name('takeProfit')->middleware('auth');

		//VIRTUAL CARDS ROUTES
		route::get('cards/all', 'VirtualCardController@list')->name('cards')->middleware('auth');
		route::post('virtualcard', 'VirtualCardController@requestVc')->name('requestVirtualCard')->middleware('auth');

		//Sto Virtual Account
		Route::any('/stro_webhook', 'StrovirtualaccountController@stro_webhook')->name('stro_webhook');
        route::get('/strovirtual_account', 'StrovirtualaccountController@index')->name('strovirtual_account')->middleware('auth');
        route::get('/stro_account', 'StrovirtualaccountController@stro_account')->name('stro_account')->middleware('auth');

        //Stro Bank Transfer
        Route::get('/stro_bank_transfer', 'StroBankTransferController@index')->name('stro_bank_transfer');
        Route::post('/stroBankPostRequest', 'StroBankTransferController@stroBankPostRequest')->name('stroBankPostRequest');
        Route::get('/stroPreview', 'StroBankTransferController@stroPreview')->name('stroPreview');
        Route::get('/stroBankTransfer', 'StroBankTransferController@stroBankTransfer')->name('stroBankTransfer');

        //StroAirtime
        Route::get('/stroAirtime', 'StroAirtimeController@index')->name('stroAirtime');
        Route::post('/stroairtimeRequest', 'StroAirtimeController@stroairtimeRequest')->name('stroairtimeRequest');
        

        //StroData
        Route::get('/stroData', 'StroDataController@index')->name('stroData');
        Route::post('/buyStroDataRequest', 'StroDataController@buyStroDataRequest')->name('buyStroDataRequest');
        Route::get('/stro_get_data_bundles/{service_name}', 'StroDataController@stro_get_data_bundles')->name('stro_get_data_bundles');

        //StroCable
        Route::get('/strotvSubscription', 'StroCableController@index')->name('strotvSubscription');
        Route::get('/strogetCablePlan/{service_id}', 'StroCableController@strogetCablePlan')->name('strogetCablePlan');
        Route::post('/cable_merchant_verify', 'StroCableController@cable_merchant_verify')->name('cable_merchant_verify');
        Route::get('/cablePreview', 'StroCableController@cablePreview')->name('cablePreview');
        Route::get('/postCableRequest', 'StroCableController@postCableRequest')->name('postCableRequest');

        //StroElectricity
        Route::get('/stroElectricity', 'StroElectricityController@index')->name('stroElectricity');
        Route::get('/stroElectricityPreview', 'StroElectricityController@stroElectricityPreview')->name('stroElectricityPreview');
        Route::get('/stroPostElectricity', 'StroElectricityController@stroPostElectricity')->name('stroPostElectricity');
        Route::post('/stro_electricity_merchant_verify', 'StroElectricityController@stro_electricity_merchant_verify')->name('stro_electricity_merchant_verify');

        //StroFundTransfer
        Route::get('/strofundTransfer', 'StroFundTransferController@index')->name('strofundTransfer');

        //StroEducationController
        Route::get('/stroEducation', 'StroEducationController@index')->name('stroEducation');
        Route::post('/stroPostEducational', 'StroEducationController@stroPostEducational')->name('stroPostEducational');

        //Loan Routes
        Route::get('/loan', 'LoanController@index')->name('loan');
        Route::post('/submitLoanRequest', 'LoanController@submitLoanRequest')->name('submitLoanRequest');
        Route::get('/loan/edit_detail', 'LoanController@edit_detail')->name('loan.edit_detail');
        Route::get('/loan/detail/{id}', 'LoanController@detail')->name('loan.detail');
        Route::get('/loan/user_loan_preview/{id}', 'LoanController@user_loan_preview')->name('loan.user_loan_preview');
        Route::get('/loan/confirm/{id}', 'LoanController@confirm')->name('loan.confirm');
        Route::get('/loan/user_payment_detail/{id}', 'LoanController@user_payment_detail')->name('loan.user_payment_detail');
        Route::get('/loan/list', 'LoanController@list')->name('loan.list');
        Route::get('/loan/pending', 'LoanController@pending')->name('loan.pending');
        Route::get('/loan/approved', 'LoanController@approved')->name('loan.approved');
        Route::get('/loan/rejected', 'LoanController@rejected')->name('loan.rejected');
        Route::get('/loan/accepted', 'LoanController@accepted')->name('loan.accepted');
        Route::get('/loan/declined', 'LoanController@declined')->name('loan.declined');
        Route::post('/loan/accept_loan', 'LoanController@accept_loan')->name('loan.accept_loan');
        Route::post('/loan/decline_loan', 'LoanController@decline_loan')->name('loan.decline_loan');
        Route::post('/loan/repay_now', 'LoanController@repay_now')->name('loan.repay_now');

		//PAYMENTLINKS ROUTES
		route::get('paymentlinks/all', 'PaymentLinkController@list')->name('paymentlinks')->middleware('auth');
		route::post('paymentlink', 'PaymentLinkController@createPaymentLink')->name('createPaymentLink')->middleware('auth');
		route::get('web/payment/{payment_id}', 'PaymentLinkController@paymentStoreFront')->name('paymentLinkStoreFront');
		route::post('web/payment/link/process',  'PaymentLinkController@payWithWalletBalance');
		route::post('web/payment/link/process/card',  'PaymentLinkController@payWithCard');

		//PAYPAGE ROUTES
		route::get('paypage', 'PayPageController@index')->name('paypage')->middleware('auth');

		
		//TRADES
		route::get('trades/mybook', 'TradeController@myBook')->name('mybook')->middleware('auth');
		route::get('trades/myclosed', 'TradeController@myClosed')->name('myclosed')->middleware('auth');
		route::get('trades/book', 'TradeController@offerbook')->name('offerbook')->middleware('auth');
		route::get('trades/liquid/{trade_id}', 'TradeController@liquidateForm')->name('liquidatef')->middleware('auth');
		route::post('trades/open', 'TradeController@openPosition')->name('openposition')->middleware('auth');
		route::post('/trade/liquid', 'TradeController@liquidate')->name('liquid')->middleware('auth');
		// route::get('investment/plan/{plan_id}', 'InvestmentController@investForm')->name('investmentform')->middleware('auth');
		// route::post('investment/store', 'InvestmentController@store')->middleware('auth');
		// route::get('myinvestments', 'InvestmentController@myInvestments')->name('myinvestments')->middleware('auth');
		// route::post('investment/take_profit', 'InvestmentController@takeProfit')->name('takeProfit')->middleware('auth');


		//ADMINISTRATION ROUTES
		Route::get('loan/approved_loan','Admin\AdminLoansController@approved_loan')->name('loan.approved_loan');
        Route::get('loan/pending_loan','Admin\AdminLoansController@pending_loan')->name('loan.pending_loan');
        Route::get('loan/rejected_loan','Admin\AdminLoansController@rejected_loan')->name('loan.rejected_loan');
        Route::get('loan/accepted_loan','Admin\AdminLoansController@accepted_loan')->name('loan.accepted_loan');
        Route::get('loan/declined_loan','Admin\AdminLoansController@declined_loan')->name('loan.declined_loan');

        Route::get('loan/preview/{id}','Admin\AdminLoansController@details')->name('loan.preview');
        Route::get('loan/payment_detail/{id}','Admin\AdminLoansController@payment_detail')->name('loan.payment_detail');
        Route::post('loan/approve','Admin\AdminLoansController@approve')->name('loan.approve');
        Route::post('loan/reject','Admin\AdminLoansController@reject')->name('loan.reject');

		route::get('users/all', 'ProfileController@getUsers')->middleware('auth');
		route::get('users/whatsapp', 'ProfileController@getUsersWhatsApps')->middleware('auth');

		//BuyVouchersRoutes
		route::get('order/vouchers', 'VoucherController@orderForm')->name('show.ordervouchers')->middleware('auth');
		route::post('order/vouchers/check', 'VoucherController@checkOrder')->name('check.ordervouchers')->middleware('auth');
		route::post('order/vouchers/process', 'VoucherController@processOrder')->name('processVoucherOrder')->middleware('auth');

		//DEMO ROUTES

		route::get('demo/index', 'DemoController@index');
		route::get('demo/user', 'DemoController@user')->name('demouser');
		route::get('demo/admin', 'DemoController@admin')->name('demoadmin');

		route::get('/me/{user_name}', 'ProfileController@me');


		
		route::get('faq', "PagesController@faq");
		route::get('terms-of-use', "PagesController@termsOfUse");
		route::get('tutorials', "PagesController@tutorials");
		route::get('privacy-policy', "PagesController@privacyPolicy");
		route::get('about', "PagesController@about");
		
		// Airitime
		route::get('/airtime', 'AirtimeController@airtime')->name('airtime')->middleware('auth');
		route::post('/buyAirtimeRequest', 'AirtimeController@buyAirtimeRequest')->name('buyAirtimeRequest');
		route::get('/getOperatores/{country_code}/{currency_code}', 'AirtimeController@getOperatores')->name('getOperatores');

});

require __DIR__.'/notus.php';

