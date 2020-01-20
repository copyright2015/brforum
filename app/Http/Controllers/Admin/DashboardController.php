<?php

namespace App\Http\Controllers\Admin;

use App\Ban;
use App\Board;
use App\Http\Controllers\Controller;
use App\Stat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    //

    public function show(Request $request)
    {
        $boards = Board::all();
        $stat = Stat::all();
        return view('Admin.dashboard',['boards' => $boards, 'stat' => $stat]);
    }
}
