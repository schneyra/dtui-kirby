<?php

Kirby::plugin('schneyra/localvideo-block', [
    'blueprints' => [
        'blocks/localvideo' => __DIR__ . '/blueprints/blocks/localvideo.yml'
    ],
    'snippets' => [
        'blocks/localvideo' => __DIR__ . '/snippets/blocks/localvideo.php',
    ],
]);
