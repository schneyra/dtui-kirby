<?php

/**
right:
width: 1/2
sections:
addPost:
type: addPost
 */

Kirby::plugin('schneyra/addPost', [
    'sections' => [
        'addPost' => [
            'props' => [
                'label' => function (string $label) {
                    return $label;
                },
            ],
        ]
    ],
]);
