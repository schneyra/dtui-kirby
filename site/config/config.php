<?php
return [
    'debug'  => true,
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
        ]
    ]
];
