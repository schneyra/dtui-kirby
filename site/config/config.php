<?php

return [
    'locale' => 'de_DE.utf-8',
    'home' => 'blog',
    'options' => [
        'local' => false,
        'secrets' => require_once 'config.secrets.php',
    ],
    'date'  => [
        'handler' => 'intl'
    ],
    'routes' => [
        [
            'pattern' => '(:num)/(:num)/(:num)/(:any).png',
            'action'  => function($year, $month, $day, $slug) {
                $page = page($year . '/' . $month . '/' . $day  . '/' . $slug);
                if (!$page) $page = page('blog/' . $year . '/' . $month . '/' . $day  . '/' . $slug);
                if (!$page) $page = site()->errorPage();
                return $page->render([], 'png');
            },
        ],
        [
            'pattern' => '(:num)/(:num)/(:num)/(:any)',
            'action'  => function($year, $month, $day, $slug) {
                $page = page($year . '/' . $month . '/' . $day  . '/' . $slug);
                if (!$page) $page = page('blog/' . $year . '/' . $month . '/' . $day  . '/' . $slug);
                if (!$page) $page = site()->errorPage();
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
            'pattern' => '(:num)/(:num)/(:num)',
            'action'  => function($year, $month, $day) {
                $page = page('blog/' . $year . '/' . $month . '/' . $day);
                if (!$page) $page = site()->errorPage();
                return site()->visit($page);
            }
        ],
        [
            'pattern' => '(:num)/(:num)',
            'action'  => function($year, $month) {
                $page = page('blog/' . $year . '/' . $month);
                if (!$page) $page = site()->errorPage();
                return site()->visit($page);
            }
        ],
        [
            'pattern' => '(:num)',
            'action'  => function($year) {
                $page = page('blog/' . $year);
                if (!$page) $page = site()->errorPage();
                return site()->visit($page);
            }
        ],
        [
            'pattern' => ['feed.xml', 'feed'],
            'action'  => function () {
                return Page::factory([
                    'slug' => 'feed.xml',
                    'template' => 'feed.xml',
                    'model' => 'virtual'
                ]);
            }
        ],
    ],
];
