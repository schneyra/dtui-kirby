<?php

Kirby::plugin('schneyra/vid-block', [
    'blueprints' => [
        'blocks/vid' => __DIR__ . '/blueprints/blocks/vid.yml'
    ],
    'snippets' => [
        'blocks/vid' => __DIR__ . '/snippets/blocks/vid.php',
    ],
]);
