<?php

return [
    'debug' => true,
    'locale' => 'de_DE.utf-8',
    'options' => [
        'secrets' => require_once 'config.secrets.php',
    ],
    'routes' => [
        [
            'pattern' => '(:any)',
            'action'  => function($uid) {
                $page = page($uid);
                if(!$page) $page = page('blog/' . $uid);
                if(!$page) $page = site()->errorPage();
                return site()->visit($page);
            }
        ],
        [
            'pattern' => 'blog/(:any)',
            'action'  => function($uid) {
                go($uid);
            }
        ],
        [
            'pattern' => 'kategorie/(:any)',
            'action'  => function($cagegory) {
                return var_dump($cagegory);
                //go($uid);
            }
        ]
    ]
];
