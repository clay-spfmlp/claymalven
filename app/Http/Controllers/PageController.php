<?php

namespace claymalven\Http\Controllers;

use Illuminate\Http\Request;

use claymalven\Http\Requests;
use claymalven\Http\Controllers\Controller;
use Auth;

class PageController extends Controller
{
    public function index()
    {
    	Auth::loginUsingId(1);
    	return view('website-creation.index');
    }
}
