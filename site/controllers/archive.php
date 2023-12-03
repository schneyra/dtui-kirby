<?php

return function (object $page): array {
    $articleCount = page('blog')->grandChildren()->children()->listed()->count();
    $firstArticleDate = page('blog')->grandChildren()->children()->listed()->first()->date();
    $lastArticleDate = page('blog')->grandChildren()->children()->listed()->last()->date();

    return [
        'lastArticleDate' => $lastArticleDate,
        'firstArticleDate' => $firstArticleDate,
        'articleCount' => $articleCount
    ];
};
