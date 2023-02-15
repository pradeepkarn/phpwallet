<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class PagesController extends Controller
{
    public function faq(Request $request){
    	return view('pages.faq');
    }
    
    public function termsOfUse(Request $request){
    	return view('pages.terms_of_use');
    }

    public function tutorials (Request $request){
    	return view('pages.tutorials');
    }

    public function privacyPolicy (Request $request){
    	return view('pages.privacy_policy');
    }

    public function about (Request $request){
    	return view('pages.about');
    }

}
