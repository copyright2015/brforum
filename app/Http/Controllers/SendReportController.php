<?php

namespace App\Http\Controllers;

use App\Ban;
use App\Report;
use Illuminate\Http\Request;

class SendReportController extends Controller
{
    //
    public function show(Request $request, $post_id)
    {
        $is_banned = false;
        $bans = Ban::where('ip_hash',$request->ip())->get();
        foreach ($bans as $ban){
            if($ban->expire_time > now()){
                $is_banned = true;
            }
        }
        return view('sendreport', ['is_banned' => $is_banned , 'bans' => $bans]);
    }

    public function send(Request $request, $post_id)
    {
        $newReport = new Report();
        $newReport->case = $request->case;
        $newReport->post_id = $post_id;
        $newReport->save();

        return back()->with('success', 'Жалоба отправлена успешно');
    }
}
