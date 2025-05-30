<?php

namespace App\Http\Controllers\Sys;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;

class SysController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $users = User::all();
        
        return view('sys.index', compact('user', 'users'));
    }
}
