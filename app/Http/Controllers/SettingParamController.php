<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SettingParamController extends Controller
{
    public function index()
    {
        return view('settingparam.index');
    }
}
