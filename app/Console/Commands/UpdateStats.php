<?php

namespace App\Console\Commands;

use App\Board;
use App\Stat;
use App\Thread;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use PhpParser\Node\Stmt\If_;

class UpdateStats extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:stats';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Обновляет статистику по доскам для главной страницы';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $stats = Stat::all();
        foreach ($stats as $stat){
            $board = Board::where('prefix',$stat->board_prefix)->get()->first();
//            $threads = Thread::where('board_id', $board->id)->get();
            $threads = $board->load('threads');
            //получаем количество постов в час
            if ($threads != null) {
//                $new_posts_count = 0;
                $new_posts_per_hour = 0;
                $new_posters = [];
                foreach ($threads as $thread) {
                    $thread->load('posts');
//                    $new_posts_count = $new_posts_count + count($thread->posts);
                    //получаем количество постов за час и активных пользователей
                    foreach ($thread->posts as $post){
                        if($post->created_at->between(now()->sub('1 hour'), now())){
                            $new_posts_per_hour = $new_posts_per_hour + 1;
                            $new_posters[$post->user_id . $post->ip_hash ] = $post->ip_hash;
                        }
                    }
                }
//                $stat->total_posts = $new_posts_count;
                $stat->posts_per_hour = $new_posts_per_hour;
                if (!empty($new_posters)) {
                    $stat->posters = count($new_posters);
                }
            }

            $stat->save();
        }
        Log::info('Статистика обновлена');
    }
}
