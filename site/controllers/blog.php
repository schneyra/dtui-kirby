<?php
/**
 * https://getkirby.com/docs/cookbook/content/filter-via-route
 */

return function ($page, $category = null, $search = null) {
    $articles = $page->grandChildren()->children()->children();
    $template = 'article';

    if ($category) {
        $articles = $articles->filterBy('categories', $category, ',');
        $template = 'teaser';
    }

    if ($search) {
        $search = get('s');
        $articles = $articles->search($search);
        $template = 'teaser';
    }

    return [
        'articles' => $articles,
        'archive' => $category,
        'search' => $search,
        'template' => $template
    ];
};
