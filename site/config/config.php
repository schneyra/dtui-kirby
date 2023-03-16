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
        // OG-Image
        [
            'pattern' => '(:num)/(:num)/(:any).png',
            'action'  => function ($year, $month, $slug) {
                $page = page($year . '/' . $month . '/' . $slug);
                if (!$page) {
                    $page = page('blog/' . $year . '/' . $month . '/' . $slug);
                }
                if (!$page) {
                    $page = site()->errorPage();
                }
                return $page->render([], 'png');
            },
        ],
        // Blogpost
        [
            'pattern' => '(:num)/(:num)/(:any)',
            'action'  => function ($year, $month, $slug) {
                $page = page($year . '/' . $month . '/' . $slug);
                if (!$page) {
                    $page = page('blog/' . $year . '/' . $month . '/' . $slug);
                }
                if (!$page) {
                    $page = site()->errorPage();
                }
                return site()->visit($page);
            },
            'method' => 'GET|HEAD'
        ],
        // Blogpost: Fallback für alte Routen
        [
            'pattern' => '(:num)/(:num)/(:num)/(:any)',
            'action'  => function ($year, $month, $day, $slug) {
                go($year . '/' . $month . '/' . $slug, 301);
            },
        ],
        // 'blog'-Ordner abfangen
        [
            'pattern' => 'blog/(:num)/(:any)',
            'action'  => function ($year, $slug) {
                go($year . '/' . $slug, 301);
            }
        ],
        // Kategorien
        [
            'pattern' => 'kategorie/(:any)',
            'action'  => function ($category) {
                if (!DtuiHelper::isCategory($category)) {
                    $page = site()->errorPage();
                    return site()->visit($page);
                }

                return page('blog')->render([
                    'category' => $category
                ]);
            }
        ],
        // Suche
        [
            'pattern' => 'suche',
            'action'  => function () {
                return page('blog')->render([
                    'search' => true
                ]);
            }
        ],
        // Archive für Jahr und Monat
        [
            'pattern' => '(:num)/(:num)',
            'action'  => function ($year, $month) {
                $page = page('blog/' . $year . '/' . $month);
                if (!$page) {
                    $page = site()->errorPage();
                }
                return site()->visit($page);
            }
        ],
        [
            'pattern' => '(:num)',
            'action'  => function ($year) {
                $page = page('blog/' . $year);
                if (!$page) {
                    $page = site()->errorPage();
                }
                return site()->visit($page);
            }
        ],
        // RSS-Feed
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
        // Blogpost: Fallback für ganz alte Routen
        [
            'pattern' => '(:any)',
            'action'  => function ($slug) {
                $page = page($slug);

                if (!$page) {
                    $page = page('blog')->index()->findBy('slug', $slug);

                    if ($page) {
                        $page = str_replace('blog/', '', $page);
                        go($page, 301);
                    } else {
                        $page = site()->errorPage();
                    }
                }

                return site()->visit($page);
            },
        ],
    ],
    'cache' => [
        'pages' => [
            'active' => true,
            'type'   => 'file'
        ]
    ]
];
