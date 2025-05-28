<?php

namespace App\Http\Controllers\Sys;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class SysController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('sys.index', compact('user'));
    }
}
