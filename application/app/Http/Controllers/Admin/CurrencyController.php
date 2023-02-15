<?php

namespace App\Http\Controllers\Admin;

use \App\Models\Currency;
use \App\Models\TransferMethod;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CurrencyController extends Controller
{
    public function list (Request $request){
    	return view('notus.currencies.currencies')->with('currencies', Currency::paginate(10));
    }

    public function add(Request $request){
        return view('notus.currencies.add');
    }

    public function create (Request $request){
   
    	$this->validate($request,[
    		'name' => 'required',
    		'type'	=>	'required',
    		'code'	=> 'required',
    		'symbol'	=>	'required',
    	]);

        $currency = Currency::create([
            'name' => $request->name,
            'is_crypto' =>  $request->is_crypto,
            'code'  =>  $request->code,
            'symbol'    =>  $request->symbol
        ]);

        $transferMethod = TransferMethod::create([
            'currency_id' => $currency->id,
            'name' => 'System_'.$currency->name,
            'days_to_process_transfer',
            'is_active'  => 0,
            'is_hidden' => 1,
            'is_system' => 1
        ]);

    	return redirect(url('/').'/administrator/currencies');

    }
}
