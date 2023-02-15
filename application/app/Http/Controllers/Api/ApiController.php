<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Auth;
use Storage;
use App\User;
use App\Models\Send;
use App\Models\Currency;
use App\Models\Receive;
use App\Models\Transaction;
use App\Models\Country;
use App\Models\MainCurrency;
use Propaganistas\LaravelPhone\PhoneNumber;
use App\Models\Wallet;
use App\Models\Vcard;
use App\Models\ExchangeTransactions;
use App\Helpers\Money;
use App\Models\Transaction;

use Validator;
use Illuminate\Http\Request;
class ApiController extends Controller
{
    public function __construct()
    {
        $this->currency = "usd";
        $this->percentage = 1;
        $this->fee = 1;
        $this->cardtypemaster = "master";
    }
    public function index($user_id=null)
    {
        $user = User::where('id',$user_id)->first();
        if(!empty($user)) 
        {
            $currencies = Currency::get();
            return response()->json($currencies);
        }
        else
        {
            return response()->json('User Not exist');
        }
    }
    public function postRequest($user_id=null ,request $request)
    {
        echo "string";die();
        $login_user = User::where('id',$user_id)->first();
        if(!empty($login_user))
        {
            if ($request->amount <= 0)
            {
                return response()->json('Please insert an amount greater than 0');
            }
            $auth_wallet = $login_user->currentWallet();

            if ($request->amount > $auth_wallet->amount)
            {
                return response()->json('You have insufficient funds to send ').' <strong>'.$request->amount. ' '.  $auth_wallet->currency->code .  __(' to ').$request->email .'</strong>');
            }

            if (filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
              
                $this->validate($request, [
                    'amount'    =>  'required|numeric|between:0,'.$login_user->currentWallet()->amount,
                    'description'   =>  'required|string',
                    'email' =>  'required|email|exists:users,email',
                ]);

            }
            else
            {
               
                $this->validate($request, [
                    'amount'    =>  'required|numeric|between:0,'.$login_user->currentWallet()->amount,
                    'description'   =>  'required|string',
                    
                ]);

                $valid_user = User::where('name', $request->email)->first();

                if (is_null($valid_user))
                {
                    return response()->json('The Username '). $request->email .__(' is invalid'));
                }
            }

            $currency = Currency::find($auth_wallet->currency_id);

            // if ( $currency->is_crypto == 1 )
            // {
            //     $precision = 8 ;
            // }
            // else
            // {
            //     $precision = 2;
            // }

            // if((boolean)$currency == false )
            // {
            //   return response()->json('Wops, something went wrong... looks like we do not support this currency. please contact support if this error persists !');
            // }

            // if ( $login_user->account_status == 0 ) {
            //     return response()->json('Your account is under a withdrawal request review proccess. please wait for a few minutes and try again');
            // }


            // if ($request->email == $login_user->email) {
            //     return response()->json('You can\'t send money to the same account you are in');
            // } 

            // if ($request->amount > $auth_wallet->amount)
            // {
            //     return response()->json('You have insufficient funds to send').' <strong>'.$request->amount.__('to').$request->email .'</strong>',);
            // }

            // if (filter_var($request->email, FILTER_VALIDATE_EMAIL))
            // {
            //     $user = User::where('email', $request->email)->first();
            // }
            // else
            // {
            //     $user = $valid_user ;
            // }

            // if($user->id == $login_user->id )
            // {
            //     return response()->json('Not alowed to send or receive funds from your own account');
            // }

            // $user_wallet = $user->walletByCurrencyId($currency->id);

            // if($user_wallet == NULL)
            // {
            //     return response()->json('The user ' . $user->name." have not activated a wallet on his account yet !");
            // }
            
            // $send_fee = 0; //free to send money

            // if($currency->is_crypto == 1 )
            // {

            //     $receive_fee = bcmul(''.( setting('money-transfers.mt_percentage_fee')/100) , $request->amount , $precision ) ;

            // }
            // else if ($currency->is_crypto == 0 )
            // {

            //      $receive_fee = bcadd( bcmul(''.( setting('money-transfers.mt_percentage_fee')/100) , $request->amount , $precision ) , setting('money-transfers.mt_fixed_fee') , $precision ) ;
            // }

            // if ( ($request->amount - (float) $receive_fee) < 0 )
            // {
            //     return response()->json('The minimum amount to send is').' <strong>'. bcsub($request->amount , $receive_fee, $precision ) .'</strong>');
            // }

            $receive = Receive::create([
                'user_id'   =>   $login_user->id,
                'from_id'        => $request->sender_id,
                'transaction_state_id'  =>  3, // waiting confirmation
                'gross'    =>  $request->amount,
                'currency_id' =>  $currency->id,
                'currency_symbol' =>  $currency->symbol,
                'fee'   =>  $receive_fee,
                'net'   =>  bcsub( $request->amount , $receive_fee, $precision ),
                'description'   =>  $request->description,
            ]);

            $send = Send::create([
                'user_id'   =>  $login_user->id,
                'to_id'        =>  $request->reciver_id,
                'transaction_state_id'  =>  3, // waiting confirmation 
                'gross'    =>  $request->amount,
                'currency_id' =>  $currency->id,
                'currency_symbol' =>  $currency->symbol,
                'fee'   =>  $send_fee,
                'net'   =>  bcsub( $request->amount , $send_fee, $precision ),
                'description'   =>  $request->description,
                'receive_id'    =>  $receive->id
            ]);

            $receive->send_id = $send->id;
            $receive->save();

            $user->RecentActivity()->save($receive->Transactions()->create([
                'user_id' => $receive->user_id,
                'entity_id'   =>  $receive->id,
                'entity_name' =>  $login_user->email,
                'transaction_state_id'  =>  3, // waiting confirmation
                'money_flow'    => '+',
                'currency_id' =>  $currency->id,
                'thumb' =>  $login_user->avatar,
                'currency_symbol' =>  $currency->symbol,
                'activity_title'    =>  'Money Received',
                'gross' =>  $receive->gross,
                'fee'   =>  $receive->fee,
                'net'   =>  $receive->net,
            ]));

            Auth::user()->RecentActivity()->save($send->Transactions()->create([
                'user_id' =>  $login_user->id,
                'entity_id'   =>  $send->id,
                'entity_name' =>  $user->email,
                'transaction_state_id'  =>  3, // waiting confirmation
                'money_flow'    => '-',
                'thumb' =>  $user->avatar,
                'currency_id' =>  $currency->id,
                'currency_symbol' =>  $currency->symbol,
                'activity_title'    =>  'Money Sent',
                'gross' =>  $send->gross,
                'fee'   =>  $send->fee,
                'net'   =>  $send->net
            ]));
        }
        else
        {
            return response()->json('User Not exist');
        }
    }
    public function getCountry()
    {
        $countries = Country::all();
        return response()->json($countries);
    }
    public function register(request $request)
    {
        $main_currency = MainCurrency::with('currency')->first();
        $currency = $main_currency->currency;
        $this->validate($request, [
            'email' => 'required',
            'name'  =>  'required|unique:users,name',
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'password'  =>  'required',
            'phone' =>  'required|phone:US,CA,AF,AL,DZ,AS,AD,AO,AI,AQ,AG,AR,AM,AW,AU,AT,AZ,BS,BH,BD,BB,BY,BE,BZ,BJ,BM,BT,BO,BA,BW,BV,BR,IO,BN,BG,BF,BI,KH,CM,CV,KY,CF,TD,CL,CN,CX,CC,CO,KM,CG,CK,CR,HR,CU,CY,CZ,CD,DK,DJ,DM,DO,TP,EC,EG,SV,GQ,ER,EE,ET,FK,FO,FJ,FI,FR,FX,GF,PF,TF,GA,GM,GE,DE,GH,GI,GR,GL,GD,GP,GU,GT,GN,GW,GY,HT,HM,HN,HK,HU,IS,IN,ID,IR,IQ,IE,IL,IT,CI,JM,JP,JO,KZ,KE,KI,KP,KR,KW,KG,LA,LV,LB,LS,LR,LY,LI,LT,LU,MO,MK,MG,MW,MY,MV,ML,MT,MH,MQ,MR,MU,TY,MX,FM,MD,MC,MN,MS,MA,MZ,MM,NA,NR,NP,NL,AN,NC,NZ,NI,NE,NG,NU,NF,MP,NO,OM,PK,PW,PA,PG,PY,PE,PH,PN,PL,PT,PR,QA,SS,RE,RO,RU,RW,KN,LC,VC,WS,SM,ST,SA,SN,RS,SC,SL,SG,SK,SI,SB,SO,ZA,GS,ES,LK,SH,PM,SD,SR,SJ,SZ,SE,CH,SY,TW,TJ,TZ,TH,TG,TK,TO,TT,TN,TR,TM,TC,TV,UG,UA,AE,GB,UM,UY,UZ,VU,VA,VE,VN,VG,VI,WF,EH,YE,YU,ZR,ZM,ZW,mobile|unique:users,phonenumber|min:6',
            'country_code'    =>  'required_with:phone|exists:countries,code'
        ]);
        $email = $request->email;
        $checkEmail = User::where('email',$email)->first();
        if(!empty($checkEmail))
        {
            return response()->json('This is email already exist try other one');
        }
        $number = (string) PhoneNumber::make($request->phone, $request->country_code); 

        $user = User::create([
            'name'  => $request->name,
            'first_name'  => $request->first_name,
            'last_name'  => $request->last_name,
            'email' =>  $email,
            'avatar'    => Storage::url('users/default.png'),
            'password'  =>  bcrypt($request->password),
            'currency_id'   =>   $currency->id,
            'whatsapp'  =>  $number,
            'phonenumber'   =>  $request->phone,
            'verification_token'  => str_random(40),
        ]);
      
        if ($user) {
            $newwallet = wallet::create([
                'is_crypto' =>  $currency->is_crypto,
                'user_id'   => $user->id,
                'amount'    =>  0,
                'currency_id'   => $currency->id,
                'accont_identifier_mechanism_value' => 'mimic adress',
                'transfer_method_id' => $transferMethod->id
            ]);

            $user->wallet_id = $newwallet->id;

            $newwallet->TransferMethods()->attach($transferMethod, ['user_id'=>$user->id,'adress' => 'mimic adress']);

            $saved = $user->save();
            if($saved) 
            {
                return response()->json('User Registered Successfully');
            }
            else
            {
                return response()->json('Error Please try again!');
            }
        }
    }
    public function exchange_currency($user_id=null ,request $request)
    {
        $user = User::where('id',$user_id)->first();
        if(!empty($user)) 
        {
            $amount = $request->amount;
            $total_amount = $request->total_amount;
            if($amount <= 0)
            {
              return response()->json("Invalid amount!");
            }
            $from_currency_id = $request->from_currency_id;
            $to_currency_id = $request->to_currency_id;
            $from_currency = Currency::where(['id'=>$from_currency_id])->first();
            $userWallet = Wallet::where(['user_id'=>$user->id,'currency_id'=>$from_currency_id])->first();
            if(empty($userWallet))
            {
              return response()->json("From currency does not existing!");
            }
            $to_currency = Currency::where(['id'=>$to_currency_id])->first();
            $to_userWallet = Wallet::where(['user_id'=>$user->id,'currency_id'=>$to_currency_id])->first();
            if(empty($to_userWallet))
            {
                return response()->json("To currency does not existing!");
            }
            if($userWallet->fiat < $amount)
            {
                return response()->json("Insufficient  Balance !!");

            }
            $total_discount = 0;
            $amount = ($amount - $total_discount);
            $userWallet->fiat = $userWallet->fiat - $amount;
            $userWallet->save();
            $fee = 0;
            // $user = auth()->user();
            $trx = Money::getTrx();
            $transaction = new Transaction();
            $transaction->user_id = $user->id;
            $transaction->request_id = $trx;
            $transaction->transactionable_id = $trx;
            $transaction->transactionable_type = '';
            $transaction->entity_id = $user->id;
            $transaction->entity_name = isset($user->name) ? $user->name:'';
            $transaction->transaction_state_id = 1;
            $transaction->money_flow = '-';
            $transaction->thumb = isset($user->avatar) ? $user->avatar:'';
            $transaction->currency_id = $from_currency->id;
            $transaction->currency = $from_currency->code;
            $transaction->currency_symbol = isset($from_currency->symbol) ? $from_currency->symbol:'';
            $transaction->activity_title = 'Currency Exchange';
            $transaction->gross = $amount;
            $transaction->fee = $fee;
            $transaction->net = ($amount + $fee);
            $transaction->balance = $userWallet->fiat;
            $transaction->save();

            $to_userWallet->fiat = '';
            $to_userWallet->save();
            $trx = Money::getTrx();
            $fee = 0;
            $to_transaction = new Transaction();
            $to_transaction->user_id = $user->id;
            $to_transaction->request_id = $trx;
            $to_transaction->transactionable_id = $trx;
            $to_transaction->transactionable_type = '';
            $to_transaction->entity_id = $user->id;
            $to_transaction->entity_name = isset($user->name) ? $user->name:'';
            $to_transaction->transaction_state_id = 1;
            $to_transaction->money_flow = '+';
            $to_transaction->thumb = isset($user->avatar) ? $user->avatar:'';
            $to_transaction->currency_id = $to_currency->id;
            $to_transaction->currency = $to_currency->code;
            $to_transaction->currency_symbol = isset($to_currency->symbol) ? $to_currency->symbol:'';
            $to_transaction->activity_title = 'Currency Exchange';
            $to_transaction->gross = $total_amount;
            $to_transaction->fee = $fee;
            $to_transaction->net = ($total_amount + $fee);
            $to_transaction->balance = $to_userWallet->fiat;
            $to_transaction->save();

            $currency_exchange = new ExchangeTransactions;
            $currency_exchange->user_id =$user->id;
            $currency_exchange->from_currency_id = $from_currency_id;
            $currency_exchange->to_currency_id = $to_currency_id;
            $currency_exchange->amount = $amount;
            $currency_exchange->exchange_rate = '';
            $currency_exchange->total_amount = '';
            $saved = $currency_exchange->save();
            if($saved)
            {
                return response()->json('saved successfully');
            }
            else
            {
                return response()->json('Error Please try again!');
            }
        }
        else
        {
            return response()->json('User Not exist ')
        }
    }
    public function virtual_card($user_id=null ,request $request)
    {
        $user = User::where('id',$user_id)->first();
        if(!empty($user))
        {
            $currency_detail = Currency::where(['code'=>strtoupper($this->currency)])->first();
            $currency_id = isset($currency_detail->id) ? $currency_detail->id:'';
            $userWallet = Wallet::where(['user_id'=>$user->id,'currency_id'=>$currency_id])->first();

            $currency_id  = $userWallet->currency_id;
            $currency = Currency::find($currency_id);
            $amount = $request->amount;
            $fee_amount = ($amount/100) * $this->percentage;
            $total_in_amount = ($fee_amount + $this->fee);
            $minBalance = $userWallet->fiat - $total_in_amount;
            $this->validate($request,[
                'amount'=>'bail|required|gte:5|lte:'.$minBalance,
                'holder'=>'bail|required'
            ]);
            if($userWallet->fiat < ($amount + $total_in_amount))
            {
               return response()->json('Insufficient wallet balance');
            }
            $post_data = array(
                "public_key"=> $this->public_key,
                "card_type" => $this->cardtypemaster,
                "name_on_card" => $request->holder,
                "amount" => $amount,
            );
            /*** USE THIS IN PRODUCTION:****/
            $curl = curl_init();
                curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://sandbox.strowallet.com/api/create-card',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => $post_data
            ));
            $response = curl_exec($curl);
            curl_close($curl);
            $resp = json_decode($response, true);
            if(isset($resp['success']) && ($resp['success'] == false || $resp['success'] == 0))
            {
                return response()->json($resp['message']);
            }
            if(isset($resp['success']) && ($resp['success'] == true) || $resp['success'] == 1)
            {
                $userWallet->fiat = $userWallet->fiat - $total_in_amount - $amount;
                $userWallet->save();
                $updated_at = str_replace('T',' ',$resp['data']['updated_at']);
                $created_at = str_replace('T',' ',$resp['data']['created_at']);
                $trx = $resp['data']['trx'];
                $vcard = new Vcard();
                $vcard->rave_id=$resp['data']['card_id'];
                $vcard->user_id=Auth::user()->id;
                $vcard->cardpan=$resp['data']['card_number'];
                $vcard->maskedpan=$resp['data']['card_number'];
                $vcard->expiration=$resp['data']['expiry_month'].'/'.$resp['data']['expiry_year'];
                $vcard->type=$resp['data']['card_type'];
                $vcard->is_active=($resp['data']['status'] == 'active') ? 1:0;
                $vcard->created_at=date('Y-m-d H:i:s',strtotime($created_at));
                $vcard->updated_at=date('Y-m-d H:i:s',strtotime($updated_at));
                $vcard->trx=$trx;
                $vcard->save();
                
                $transaction = new Transaction();
                $transaction->user_id = $user->id;
                $transaction->request_id = $trx;
                $transaction->transactionable_id = $vcard->rave_id;
                $transaction->transactionable_type = '';
                $transaction->entity_id = $vcard->rave_id;
                $transaction->entity_name = isset($user->name) ? $user->name:'';
                $transaction->transaction_state_id = 1;
                $transaction->money_flow = '-';
                $transaction->thumb = isset($user->avatar) ? $user->avatar:'';
                $transaction->currency_id = $currency->id;
                $transaction->currency = $currency->code;
                $transaction->currency_symbol = isset($currency->symbol) ? $currency->symbol:'';
                $transaction->activity_title = 'Vcard created successfully';
                $transaction->gross = $amount;
                $transaction->fee = $total_in_amount;
                $transaction->net = ($total_in_amount + $amount);
                $transaction->balance = $userWallet->fiat;
                $transaction->save();
                if($saved)
                {
                    return response()->json($resp['message']);
                }
                else
                {
                    return response()->json('Error Please try again!');
                }
            }
        }
        else
        {
            return response()->json('User not Exist');
        }
    }
    public function request_money($user_id=null,request $request)
    {
        $auth_user = User::where('id',$user_id)->first();
        if(!empty($auth_user))
        {
           
            if ($request->amount <= 0)
            {
                return response()->json('Please insert an amount greater than 0');
            }
            $checkEmail = User::where('email',$request->email)->first();
            if(!empty($checkEmail))
            {
                $this->validate($request, [
                    'amount'    =>  'required|numeric|min:2',
                    'description'   =>  'required|string',
                    'email' =>  'required|email|exists:users,email',
                ]);
            }
            else
            {
                $this->validate($request, [
                    'amount'    =>  'required|numeric|between:0,'.$auth_user->currentWallet()->amount,
                    'description'   =>  'required|string',
                ]);

                $valid_user = User::where('name', $request->email)->first();
                if (is_null($valid_user))
                {
                    return response()->json('The Username '. $request->email .__(' is invalid'));
                }
            }

            // if (filter_var($request->email, FILTER_VALIDATE_EMAIL))
            // {
            //     $user = User::where('email', $request->email)->first();
            // }
            // else
            // {
            //     $user = $valid_user ;
            // }

            // if($user->id == $auth_user->id )
            // {
            //     reurn response()->json('Not alowed to send or receive funds from your own account');
            // }

            // $currency = Currency::find($auth_user->currency_id);

            // if ( $currency->is_crypto == 1 )
            // {
            //     $precision = 8 ;
            // }
            // else
            // {
            //     $precision = 2;
            // }

            // $auth_wallet = $user->walletByCurrencyId($currency->id);
            // if($auth_wallet == NULL)
            // {
            //     return response()->json('The user ' . $user->name." have not activated a wallet on his account yet !");
            // }
            
            // if((boolean)$currency == false )
            // {
            //   return response()->json('Wops, something went wrong... looks like we do not support this currency. please contact support if this error persists !');
            // }

            // if ($auth_user->account_status == 0 )
            // {
            //     return response()->json(' account is under a withdrawal request review proccess. please wait for a few minutes and try again');
            // }

            // if($request->email == $auth_user->email)
            // {
            //     return response()->json('You can\'t request money to the same account you are in');
            // } 

            // if ($request->amount > $auth_wallet->amount)
            // {
            //     return response()->json( $user->name . __(' has insufficient funds to send').' <strong>'.$request->amount.__('to'). __('you') .'</strong>');
            // }

            
            // $send_fee = 0; //free to send money
             
            // if($currency->is_crypto == 1 )
            // {

            //     $receive_fee = bcmul(''.( setting('money-transfers.mt_percentage_fee')/100) , $request->amount , $precision ) ;

            // }
            // else if ($currency->is_crypto == 0 )
            // {
            //     $receive_fee = bcadd( bcmul(''.( setting('money-transfers.mt_percentage_fee')/100) , $request->amount , $precision ) , setting('money-transfers.mt_fixed_fee') , $precision ) ;
            // }

            // if ( ($request->amount - $receive_fee) < 0 )
            // {
            //     return response()->json( ('The minimum amount to send is').' <strong>'.bcsub ( $request->amount , $receive_fee , $precision ) .'</strong>', 'danger');
            // }

            $receive = Receive::create([
                'user_id'   =>   $auth_user->id,
                'from_id'        => '',
                'transaction_state_id'  =>  3, // waiting confirmation
                'gross'    =>  $request->amount,
                'currency_id' =>  $currency->id,
                'currency_symbol' =>  $currency->symbol,
                'fee'   =>  $receive_fee,
                'net'   => bcsub( $request->amount , $receive_fee, $precision ),
                'description'   =>  $request->description,
            ]);

            $send = Send::create([
                'user_id'   =>  $user->id,
                'to_id'        =>  '',
                'transaction_state_id'  =>  3, // waiting confirmation 
                'gross'    =>  $request->amount,
                'currency_id' =>  $currency->id,
                'currency_symbol' =>  $currency->symbol,
                'fee'   =>  $send_fee,
                'net'   =>  bcsub ( $request->amount , $send_fee, $precision ),
                'description'   =>  $request->description,
                'receive_id'    =>  $receive->id
            ]);

            $receive->send_id = $send->id;
            $receive->save();

            $auth_user->RecentActivity()->save($receive->Transactions()->create([
                'user_id' => $receive->user_id,
                'entity_id'   =>  $receive->id,
                'entity_name' =>  $auth_user->name,
                'transaction_state_id'  =>  3, // waiting confirmation
                'money_flow'    => '+',
                'currency_id' =>  $currency->id,
                'thumb' =>  $auth_user->avatar,
                'currency_symbol' =>  $currency->symbol,
                'activity_title'    =>  'Money Received',
                'gross' =>  $receive->gross,
                'fee'   =>  $receive->fee,
                'net'   =>  $receive->net,
            ]));

            $user->RecentActivity()->save($send->Transactions()->create([
                'user_id' =>  $auth_user->id,
                'entity_id'   =>  $send->id,
                'entity_name' =>  $user->name,
                'transaction_state_id'  =>  3, // waiting confirmation
                'money_flow'    => '-',
                'thumb' =>  $user->avatar,
                'currency_id' =>  $currency->id,
                'currency_symbol' =>  $currency->symbol,
                'activity_title'    =>  'Money Sent',
                'gross' =>  $send->gross,
                'fee'   =>  $send->fee,
                'net'   =>  $send->net
            ]));
        }
        else
        {
            return response()->json('User not Exist');
        }
    }

}
