<?php

return function (object $page): array {
    $articleCount = page('blog')->grandChildren()->children()->listed()->count();

    return [
        'articleCount' => $articleCount
    ];
};
