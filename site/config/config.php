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
            'pattern' => '(:num)/(:any).png',
            'action'  => function ($year, $slug) {
                $page = page($year . '/' . $slug);
                if (!$page) {
                    $page = page('blog/' . $year . '/' . $slug);
                }
                if (!$page) {
                    $page = site()->errorPage();
                }
                return $page->render([], 'png');
            },
        ],
        // Blogpost
        [
            'pattern' => '(:num)/(:any)',
            'action'  => function ($year, $slug) {
                $page = page($year . '/' . $slug);
                if (!$page) {
                    $page = page('blog/' . $year . '/' . $slug);
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
                go($year . '/' . $slug, 301);
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
    ],
    'cache' => [
        'pages' => [
            'active' => true,
            'type'   => 'file'
        ]
    ]
];
