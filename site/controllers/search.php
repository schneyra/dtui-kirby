<?php

return function () {
    $query   = get('s');
    $results = page('blog')->search($query, 'title|body|categories')->sortBy('date', 'desc');
    $results = $results->paginate(10);

    return [
        'query'      => $query,
        'results'    => $results,
        'pagination' => $results->pagination()
    ];
};
