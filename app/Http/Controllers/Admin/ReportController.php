<?php

namespace App\Http\Controllers\Admin;

use App\Ban;
use App\Http\Controllers\Controller;
use App\Message;
use App\Post;
use App\Report;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function show()
    {
       $reports =  Report::all();

        return view('Admin.reports', ['reports' => $reports]);
    }

    public function showReport(Request $request, $reportId)
    {
        $report = Report::where('id', $reportId)->get()->first();
        $report->is_readed = true;
        $report->save();
        $report->load('post');
        return view('Admin.vievreport', ['report' => $report]);
    }

    public function ban(Request $request)
    {
        $post = Post::where('id', $request->post_id)->get()->first();
        $ban = new Ban();
        $ban->Ip_hash = $post->Ip_hash;
        $ban->is_404_ban = $request->ban404 == 'true' ? true : false;
        $ban->expire_time = now()->add($request->period);
        $ban->case = $request->case;
        $ban->save();

        $post->mod_notice = $request->sign;
        $post->save();
        return back()->with('success', 'Пользователь успешно забанен');
    }

    public function operate(Request $request)
    {
        if($request->action == 'delete'){
            Report::where('id', $request->report_id)->delete();
        }
        return back();
    }
}
