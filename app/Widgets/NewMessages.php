<?php

namespace App\Widgets;

use App\Message;
use Arrilot\Widgets\AbstractWidget;
use Illuminate\Support\Facades\Auth;

class NewMessages extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        //
        $messages = Message::where('user_id', Auth::user()->id)->where('is_readed', false)->get();
        return view('widgets.new_messages', [
            'config' => $this->config,
            'messages' => $messages,
        ]);
    }
}
