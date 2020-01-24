<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Facades\ACL;
use App\Http\Controllers\Controller;
use App\Message;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessagesController extends Controller
{
    //
    public function show(Request $request)
    {
        $messages = Message::where('user_id', Auth::user()->id)->get();
        $users = User::all();
        $admins = [];
        foreach ($users as $user){
            if (ACL::checkUser($user)){
                array_push($admins,$user);
            }
        }
        return view('Admin.messages' , ['messages' => $messages, 'admins' => $admins]);
    }

    public function showMessage(Request $request, $messageId)
    {
        $message = Message::where('id', $messageId)->get()->first();
        $message->is_readed = true;
        $message->save();
        return view('Admin.viewmessage', ['message' => $message]);
    }

    public function send(Request $request)
    {

        if($request->action == 'delete'){
            Message::where('id', $request->message_id)->delete();
        }

        if($request->action == 'send'){
            $message = new Message();
            $message->user_id = $request->user_id;
            $message->from = $request->from;
            $message->text = $request->text;
            $message->title = $request->title;
            $message->save();
        }
        return back();
    }
}
