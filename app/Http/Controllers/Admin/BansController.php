<?php

namespace App\Http\Controllers\Admin;

use App\Ban;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BansController extends Controller
{
    //
    public function show()
    {
        $bans =  Ban::all();

        return view('Admin.bans', ['bans' => $bans]);
    }

    public function unban(Request $request)
    {
        if($request->action == 'unban'){
            Ban::where('id', $request->ban_id)->delete();
        }

        return back();
    }
}
