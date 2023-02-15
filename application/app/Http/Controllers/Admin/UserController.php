<?php

namespace App\Http\Controllers\Admin;

use Auth;
use \App\User;
use \Illuminate\Http\Request;
use \App\Http\Controllers\Controller;

class UserController extends Controller
{
	public function list(Request $request){
		return view('notus.users.users')->with('users', User::paginate(10));
	}
}