<?php

/**
right:
    width: 1/2
    sections:
        groupedPosts:
            type: groupedPosts
 */

Kirby::plugin('schneyra/groupedPosts', [
    'sections' => [
        'groupedPosts' => [
            'computed' => [
                'groupedPosts' => function () {
                    $callbackByYear = function ($p) {
                        return $p->date()->toDate('YYYY');
                    };

                    $callbackByMonth = function ($p) {
                        return $p->date()->toDate('MM');
                    };

                    $byYear = page('blog')->grandChildren()->children()->children()->group($callbackByYear);

                    $groupedPosts = [];
                    foreach ($byYear as $year => $posts) {
                        $groupedPosts[$year] = $posts->group($callbackByMonth);
                    }

                    return $groupedPosts;
                }
            ]
        ]
    ]
]);
