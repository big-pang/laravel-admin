<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Log;
use App\Models\Application;
use App\Models\AppAndroid as Android;
use App\Models\AppIos as Ios;
use QrCode;

class IndexController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        dd('后台首页，当前用户名：'.auth('admin')->user()->name);
    }


}
