<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Log;
use App\Common\Lib\Tool;
use App\Models\Application;
use App\Models\AppAndroid as Android;
use App\Models\AppIos as Ios;
use QrCode;

class IndexController extends Controller
{
    public function index()
    {
        dd();
        // dd(version_compare('v4.0','v4'));
       // $img = QrCode::format('png')->size(500)->encoding('UTF-8')->errorCorrection('H')->margin(0);

        //$img->generate('http://web.190.gitzs.com/download/2', public_path() . '/imgs/qrcodes/qrcode3.png');

       /* $a=Tool::appIdToQrCode(2);
        dd($a);*/
        //return view('admin.index.test');
    }


}
