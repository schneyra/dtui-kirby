<?php
/**
 * https://getkirby.com/docs/cookbook/content/filter-via-route
 */
return function (object $page, string $category = null, string $search = null): array {
    $articles = $page->grandChildren()->children()->listed();
    $template = 'article';

    if ($category) {
        $articles = $articles->filterBy('categories', $category, ',');
        $template = 'teaser';
    }

    return [
        'articles' => $articles,
        'archive' => $category,
        'template' => $template
    ];
};
