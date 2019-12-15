<?php

namespace App\Http\Controllers;

use App\Globalset;
use Layout;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use App\Thread;
use App\Board;
use App\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Image;
use PhpParser\Node\Stmt\Foreach_;


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
//        dump($posts);
//        foreach ($posts as $post){
//            dump($post->img);
//        }
        dump(Layout::process(">>awdawdd
        
**sdfsdf**
asdaaawdawd 
>awdawd
awdaawdawdadddawdaawd
%%sfsefffw%%"));
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
        $current_board = Board::where('prefix',$board_prefix)->get()->first();

        $request->validate([
            'message' => 'required',
            'img' => 'nullable|file',
        ]);

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

        $imgs = [];
        $new_post->message = $request->message;
        $new_post->theme = $request->theme;

        if (count($request->file('imgs')) > $current_board->picture_limit){
            return back()->withErrors(['img'=>'Файлов больше чем '.$current_board->picture_limit]);
        }

        $filesSize = 0;
        if(count($request->file('imgs')) > 0) {
            foreach ($request->file('imgs') as $img){
               $filesSize = $filesSize + $img->getSize();
            }
        }

        if($filesSize / 1024  > $globalsets->file_size_limit){
            return back()->withErrors(['img'=>'Размер файлов больше чем '.$globalsets->file_size_limit . $filesSize]);
        }

        if(count($request->file('imgs')) > 0) {
            dump($request->img);
            $i = 0;
            foreach ($request->file('imgs') as $img) {
                $extension = $img->getClientOriginalExtension();
                $fileName = now()->timestamp.rand(100,999);
                $path = $img->storeAs('public/img', $fileName . '.' . $extension);
                $sPath = $img->storeAs('public/img', $fileName . 's' . '.' . $extension);
                Log::info(storage_path('app/' . $sPath));
                $img = Image::make(storage_path('app/' . $sPath))->resize(150, null, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $img->save(storage_path('app/' . $sPath));
//                $imgs['img'.$i] = $path;
                $imgs['img'.$i] = str_replace('public', 'storage', $path);
                $i++;
            }
        }

        $new_post->img = $imgs;
        $new_post->save();


        return back();
    }
}
