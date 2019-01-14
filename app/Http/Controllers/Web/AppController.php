<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Auth;

class AppController extends Controller
{
    public function getApp(){
        return view('app');
    }

	/**
	 * Logs out the user and redirects them home.
	 */
	public function getLogout(){
		Auth::logout();
		return redirect('/#/');
	}
}