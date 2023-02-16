<?php
/**
 * https://getkirby.com/docs/cookbook/content/filter-via-route
 */

return function ($page, $category) {
    $articles = $page->grandChildren()->children()->children();

    if ($category) {
        $articles = $articles->filterBy('categories', $category, ',');
    }

    return [
        'articles' => $articles,
        'archive' => $category
    ];
};
