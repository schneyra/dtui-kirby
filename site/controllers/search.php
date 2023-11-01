<?php

return function () {
    $query   = get('s');
    $results = page('blog')->search($query, 'title|text|categories');
    $results = $results->paginate(10);

    return [
        'query'      => $query,
        'results'    => $results,
        'pagination' => $results->pagination()
    ];
};
