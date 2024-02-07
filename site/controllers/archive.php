<?php

return function (object $page): array {
    $articles = page('blog')->grandChildren()->children()->listed()->sortBy('date', 'asc');
    $articleCount = $articles->count();
    $firstArticleDate = $articles->first()->date();
    $lastArticleDate = $articles->last()->date();

    return [
        'lastArticleDate' => $lastArticleDate,
        'firstArticleDate' => $firstArticleDate,
        'articleCount' => $articleCount
    ];
};
