<?php

namespace App\Http\Controllers\Sys;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SysController extends Controller
{
    public function index()
    {
        return view('sys.index');
    }
}
