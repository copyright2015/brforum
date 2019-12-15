<?php


/*
 * Настроки разметки для сообщений.
 */

return[
    'text_format' => [
        ['\\*\\*@\\*\\*','<strong>@</strong>'],
        ['\\%\\%@\\%\\%', '<span class="spoiler">@</span>'],
        ['\\"\\"@\\"\\"', '<i>@</i>'],
        ['\\-\\-@\\-\\-', '<del>@</del>'],

    ],

    'green_text' => [
        ['\\>@', '<span class="greentext">@</span>'],
    ],

    'replay' => [
        ['\\>\\>@', '<a href = "#@">>>@</a>'],
    ]
];


