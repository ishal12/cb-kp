<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class KaryawanLoginController extends Controller
{
	
	public function __construct()
	{
        $this->middleware('guest')->except('logout');
	}

    public function showLoginForm()
    {
    	return view('auth.login');
    }

    public function login(Request $request)
    {
    	$this->validate($request, [
    		'username'	=> 'required|max:32',
    		'password'	=> 'required|min:6',
    		]);

    	if (Auth::attempt(['username' => $request->username, 'password' => $request->password], $request->remember)) {

    		return redirect()->route('home');
    	}

    	return redirect()->back()->withInput($request->only('username', 'remember'));
    }
}
