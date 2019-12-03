<?php

namespace App\Http\Controllers;

use App\Globalset;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use App\Thread;
use App\Board;
use App\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class ThreadContoller extends Controller
{
    /**
     * Отображение постов треда
     * @param Request $request
     * @param $board_prefix
     * @param $thread_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Request $request, $board_prefix, $thread_id)
    {
        $current_board = Board::where('prefix',$board_prefix)->get()->first();
        $current_thread = Thread::where('id',$thread_id)->get()->first();
        $posts = Post::where('thread_id',$current_thread->id)->get();
        return view('thread',['board'=>$current_board,'thread'=>$current_thread,'posts'=>$posts]);
    }



    /**
     * Отправка формы с данными поста
     * @param Request $request
     * @param $board_prefix
     * @param $thread_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function add(Request $request, $board_prefix, $thread_id)
    {
        Log::info('Пост метод сработал');

        $globalsets = Globalset::find(1);

        $request->validate([
            'message' => 'required',
        ]);

        dump($request);
        $new_post = new Post;
        $new_post->thread_id = $thread_id;
        if(Auth::check()){
            $user = Auth::user();
            $new_post->user_id = $user->id;
            $new_post->Ip_hash = 'Registered';
        }
        else{
            $new_post->Ip_hash = Hash::make($request->ip());
            $anon_role = Role::where('name', 'Anon')->get()->first();
            $anon_user = User::where('role_id',$anon_role->id)->get()->first();
            $new_post->user_id = $anon_user->id;
        }

        $new_post->message = $request->message;
        $new_post->theme = $request->theme;
        $path = $request->file('img')->store('img');
        $new_post->img = $path;

        $new_post->save();

        return back();
    }
}
