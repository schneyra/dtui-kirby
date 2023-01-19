<?php

return [
    'locale' => 'de_DE.utf-8',
    'home' => 'blog',
    'options' => [
        'secrets' => require_once 'config.secrets.php',
    ],
    'routes' => [
        [
            'pattern' => '(:num)/(:num)/(:num)/(:any)',
            'action'  => function($year, $month, $day, $slug) {
                $page = page($year . '/' . $month . '/' . $day  . '/' . $slug);
                if(!$page) $page = page('blog/' . $year . '/' . $month . '/' . $day  . '/' . $slug);
                if(!$page) $page = site()->errorPage();
                return site()->visit($page);
            },
        ],
        [
            'pattern' => 'blog/(:num)/(:num)/(:num)/(:any)',
            'action'  => function($year, $month, $day, $slug) {
                go($year . '/' . $month . '/' . $day  . '/' . $slug);
            }
        ],
        [
            'pattern' => 'kategorie/(:any)',
            'action'  => function($cagegory) {
                return var_dump($cagegory);
                //go($uid);
            }
        ],
        [
            'pattern' => 'feed.xml',
            'action'  => function () {
                return Page::factory([
                    'slug' => 'feed.xml',
                    'template' => 'feed.xml',
                    'model' => 'virtual'
                ]);
            }
        ],
    ],
    'amteich.twig.env.functions' => [
        'site' => function () { return site(); },
        'page' => function () { return page(); },
        'user' => function () { return user(); },
    ]
];
