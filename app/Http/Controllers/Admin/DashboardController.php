<?php

namespace App\Http\Controllers\Admin;

use App\Ban;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    //

    public function show(Request $request)
    {
        $userIP = Hash::make($request->ip());
        dump(Ban::where('ip_hash',$userIP)->get()->first());
        return view('Admin.dashboard');
    }
}
