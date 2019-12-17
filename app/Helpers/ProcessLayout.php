<?php


namespace App\Helpers;


use Illuminate\Support\Facades\Config;

class ProcessLayout
{
    /**
     * Основной метод который последовательно произдодит замену бордовой разметки на html теги
     * @param $text
     * @return mixed|string|string[]|null
     */
    public static function process($text)
    {
        $obj = new self;
        //вызываем методы замены разметки на html код
        $text = $obj->replaceReply($text, 'layout.replay');
        $text = $obj->replaceGreenT($text, 'layout.green_text');
        $text = $obj->replace($text, 'layout.text_format');
        //заменяем все концы строк на br
        $text = str_replace("\n",'<br>',$text);

        return $text;
    }

    /**
     * Оборачиваем в якорную ссылку ссылки на другие посты
     * @param $text
     * @param $config
     * @return string|string[]|null
     */
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

    /**
     * Оборачиваем в теги гринтекста все строки начинающиеся с '>'
     * @param $text
     * @param $config
     * @return string
     */
    public function replaceGreenT($text, $config)
    {
        $layouts = Config::get($config);
        $exp_text = explode("\n", $text);
        $new_text = [];
        $replacement = explode('@', $layouts[0][1]);
        foreach ($exp_text as $txt) {
            if($txt[0]=='>'){
                array_push($new_text, $replacement[0] . $txt . $replacement[1]);
            }
            else{array_push($new_text, $txt);
            }
        }
        $text = implode("\n",$new_text);
        return $text;
    }

    /**
     * Заменяем обозначения форматирования текста на теги hml
     * @param $text
     * @param $config
     * @return string
     */
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
