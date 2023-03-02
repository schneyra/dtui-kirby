<?php
/**
 * https://getkirby.com/docs/cookbook/content/filter-via-route
 */

return function ($page, $category = null, $search = null) {
    $articles = $page->grandChildren()->children()->children();

    if ($category) {
        $articles = $articles->filterBy('categories', $category, ',');
    }

    if ($search) {
        $search = get('s');
        $articles = $articles->search($search);
    }

    return [
        'articles' => $articles,
        'archive' => $category,
        'search' => $search
    ];
};
