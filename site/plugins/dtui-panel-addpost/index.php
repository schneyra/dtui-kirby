<?php

/** @var Page $page */

use Kirby\Cms\App as Kirby;
use Kirby\Cms\Page;

Kirby::plugin('schneyra/add-post', [
    'areas' => [
        'add-post' => function () {
            return [
                'buttons' => [
                    'add-post' => function ($kirby) {
                        return [
                            'icon' => 'plus',
                            'theme' => 'green-500',
                            'text' => 'Neuer Beitrag',
                            'link' => $kirby->url() . '/add-post/',
                        ];
                    },
                ],
            ];
        },
    ],
    'routes' => [
        [
            'pattern' => 'add-post',
            'action' => function () {
                $page = page('blog');
                $newSlug = "neu_" . date("d-m-Y-H-i-s");
                $currentYear = date('Y');
                $currentMonth = date('m');

                $year = $page->findPageOrDraft("blog/{$currentYear}");
                if (!$year) {
                    $year = Page::create([
                        'parent' => page($page->id()),
                        'slug' => $currentYear,
                        'draft' => false,
                        'template' => 'year',
                    ]);
                }
                $month = $year->findPageOrDraft($currentMonth);
                if (!$month) {
                    $month = Page::create([
                        'parent' => page($year->id()),
                        'slug' => $currentMonth,
                        'draft' => false,
                        'template' => 'month',
                    ]);
                }

                $newArticle = $year->findPageOrDraft($newSlug);
                if (!$newArticle) {
                    $newArticle = Page::create([
                        'parent' => page($month->id()),
                        'slug' => $newSlug,
                        'draft' => true,
                        'template' => 'article',
                    ]);
                }

                go($newArticle->panel()->url());
            }
        ]
    ]
]);
