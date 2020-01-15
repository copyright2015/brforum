<?php

namespace App\Http\Controllers;

use App\Ban;
use App\Globalset;
use App\Post;
use Layout;
use Illuminate\Http\Request;
use App\User;
use App\Thread;
use App\Board;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Image;

class BoardContoller extends Controller
{
    /**
     * Отображение тредов доски
     * @param Request $request
     * @param $board_prefix
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Request $request, $board_prefix)
    {
        $is_banned = false;
        $current_board = Board::where('prefix',$board_prefix)->get()->first();
        $threads = Thread::where('board_id',$current_board->id)->get();
        $threads->load('posts');
        $bans = Ban::where('ip_hash',$request->ip())->get();
        //узнаем, забанен ли пользователь
        foreach ($bans as $ban){
            if($ban->expire_time > now()){
                $is_banned = true;
            }
        }

        foreach ($threads as $thread) {
            $thread->posts = $thread->posts->
            sortBy('created_at')->
            slice(-3)->all();
        }

        //Сортируем посты по времени бампа.
        $sorted_threads = $threads->sortByDesc('bumped_at');

        //Выводим закрепленные посты наверх.
        if($sorted_threads != null) {
            for ($i = 0; $i < count($sorted_threads); $i++) {
                if ($sorted_threads[$i]->is_pinned_up) {
                    $temp_thread = $sorted_threads->pull($i);
                    $sorted_threads->prepend($temp_thread);
                }
            }
        }
        return view('board',['board'=>$current_board,'threads'=>$sorted_threads,'is_banned' => $is_banned]);
    }


    /**Создание треда
     * @param Request $request
     * @param $board_prefix
     * @return \Illuminate\Http\RedirectResponse
     */
    public function add(Request $request,$board_prefix)
    {
        Log::info('Пост метод сработал');

        //если юзер забанен не даем ему отправить данные.
        $bans = Ban::where('ip_hash',$request->ip())->get();
        foreach ($bans as $ban){
            if($ban->expire_time > now()){
                abort(403);
            }
        }

        $globalsets = Globalset::find(1);
        $current_board = Board::where('prefix',$board_prefix)->get()->first();

        $request->validate([
            'message' => 'required',
            'img' => 'nullable|file|mimes:jpeg,bmp,png,webm,mp4',
        ]);
        //создаем новый пост
        $new_thread = new Thread;
        $new_thread->board_id = $current_board->id;
        if(Auth::check()){
            $user = Auth::user();
            $new_thread->user_id = $user->id;
            $new_thread->Ip_hash = $request->ip();
        }
        else{
            $new_thread->Ip_hash = $request->ip();
            $anon_user = Auth::check() ? Auth::user() : User::where('name', 'Anon')->get()->first();
            $new_thread->user_id = $anon_user->id;
        }
        $imgs = [];
        $new_thread->message = Layout::process($request->message);
        $new_thread->theme = $request->theme;
        //проверяем наличие картинок
        if ($request->imgs != null) {
            //проверяем количество фалов

            if (count($request->file('imgs')) > $current_board->picture_limit) {
                return back()->withErrors(['img' => 'Файлов больше чем ' . $current_board->picture_limit]);
            }
            //проверяем объем фалов
            $filesSize = 0;
            if (count($request->file('imgs')) > 0) {
                foreach ($request->file('imgs') as $img) {
                    $filesSize = $filesSize + $img->getSize();
                }
            }
            if ($filesSize / 1024 > $globalsets->file_size_limit) {
                return back()->withErrors(['img' => 'Размер файлов больше чем ' . $globalsets->file_size_limit . $filesSize]);
            }
            //Загружаем картинку и делаем срумбнился.

            if (count($request->file('imgs')) > 0) {

                $i = 0;
                foreach ($request->file('imgs') as $img) {
                    $extension = $img->getClientOriginalExtension();
                    $fileName = now()->timestamp . rand(100, 999);
                    $path = $img->storeAs('public/img', $fileName . '.' . $extension);
                    $sPath = $img->storeAs('public/img', $fileName . 's' . '.' . $extension);
                    Log::info(storage_path('app/' . $sPath));
                    $img = Image::make(storage_path('app/' . $sPath))->resize(150, null, function ($constraint) {
                        $constraint->aspectRatio();
                    });
                    $img->save(storage_path('app/' . $sPath));
//               $imgs['img'.$i] = $path;
                    $imgs['img' . $i] = str_replace('public', 'storage', $path);
                    $i++;
                }
            }

        }
        $new_thread->img = $imgs;
        $new_thread->bumped_at = now();
        $new_thread->save();


        return back();
    }
}
