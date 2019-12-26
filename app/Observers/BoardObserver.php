<?php

namespace App\Observers;

use App\Board;
use App\Stat;

class BoardObserver
{
    public function created(Board $board)
    {
        $newStat = new Stat();
        $newStat->board_prefix = $board->prefix;
        $newStat->board_name = $board->name;
        $newStat->board_description = $board->description;
        $newStat->save();
    }
}
