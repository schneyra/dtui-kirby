<?php
/**
 * https://getkirby.com/docs/cookbook/content/filter-via-route
 */
return function (object $page, string $category = null, string $search = null): array {
    $articles = $page->grandChildren()->listed();
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
