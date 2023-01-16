<?php

Kirby::plugin('schneyra/localvideo-block', [
    'blueprints' => [
        'blocks/vid' => __DIR__ . '/blueprints/blocks/localvideo.yml'
    ],
    'snippets' => [
        'blocks/vid' => __DIR__ . '/snippets/blocks/localvideo.php',
    ],
]);
