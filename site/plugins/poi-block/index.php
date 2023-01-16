<?php

Kirby::plugin('schneyra/poi-block', [
    'blueprints' => [
        'blocks/poi' => __DIR__ . '/blueprints/blocks/poi.yml'
    ],
    'snippets' => [
        'blocks/poi' => __DIR__ . '/snippets/blocks/poi.php',
    ],
]);
