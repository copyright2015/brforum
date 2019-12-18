<?php

use Illuminate\Database\Seeder;
use App\Board;

class FirstBoardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $new_board = Board::create(
            [
                'name'=>'Бред',
                'prefix' => 'b',
                'description' => 'Доска обо всем',
                'is_visible' => true,
                'for_regs' => false,
                'bumplimit' => 500,
                'only_tor' => false,
                'thread_limit_per_hour' => 0,
                'picture_limit' => 4,
                'default_user_name' => 'Anonymous',
                'slogan'=>'Гриб, грибок - мой дружок',
            ]
        );
        $new_board->save();

        $new_board = Board::create(
            [
                'name'=>'Мод',
                'prefix' => 'mod',
                'description' => 'Обсуждение модерации',
                'is_visible' => true,
                'for_regs' => false,
                'bumplimit' => 500,
                'only_tor' => false,
                'thread_limit_per_hour' => 0,
                'picture_limit' => 4,
                'default_user_name' => 'Anonymous',
                'slogan'=>'Великая влясть - великая ответственность',
            ]
        );
        $new_board->save();
    }
}
