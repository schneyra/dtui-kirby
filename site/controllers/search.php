<?php

return function () {
    $query   = get('s');
    $results = page('blog')->search($query, 'title|body|categories');
    $results = $results->paginate(10);

    return [
        'query'      => $query,
        'results'    => $results,
        'pagination' => $results->pagination()
    ];
};
