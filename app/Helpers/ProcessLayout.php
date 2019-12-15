<?php


namespace App\Helpers;


use Illuminate\Support\Facades\Config;

class ProcessLayout
{
    public static function process($text)
    {
        $obj = new self;

        $text = $obj->replaceReply($text, 'layout.replay');

        $text = $obj->replaceGreenT($text, 'layout.green_text');
        $text = $obj->replace($text, 'layout.text_format');

        $text = str_replace("\n",'<br>',$text);

        return $text;
    }

    public function replace($text, $config)
    {
        $layouts = Config::get($config);
        foreach ($layouts as $layout) {
            $pattern = explode('@', $layout[0]);
            $replacement = explode('@', $layout[1]);
            $text = preg_replace('/' . $pattern[0] . '([^<]*)' . $pattern[1] . '/', $replacement[0] . '$1' . $replacement[1], $text);
        }
        return $text;
    }

    public function replaceGreenT($text, $config)
    {
        $layouts = Config::get($config);
        $exp_text = explode("\n", $text);
        $new_text = [];
        $replacement = explode('@', $layouts[0][1]);
        foreach ($exp_text as $txt) {
            dump($txt);
            if($txt[0]=='>'){
                array_push($new_text, $replacement[0] . $txt . $replacement[1]);
            }
            else{array_push($new_text, $txt);
            }
        }
        $text = implode("\n",$new_text);
        return $text;
    }

    public function replaceReply($text, $config)
    {
        $layouts = Config::get($config);
        $exp_text = explode("\n", $text);
        $new_text = [];
        $pattern = explode('@', $layouts[0][0]);
        $replacement = explode('@', $layouts[0][1]);
        foreach ($exp_text as $txt) {
            array_push($new_text ,preg_replace('/' . $pattern[0] . '([^<]*)' . $pattern[1] . '/', $replacement[0] . '$1' . $replacement[1] . '$1' . $replacement[2], $txt));
        }
        $text = implode("\n",$new_text);
        return $text;
    }
}
