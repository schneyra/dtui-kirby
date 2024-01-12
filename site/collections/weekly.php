<?php

return function ($site) {
    return $site->find('blog')->grandChildren()->children()->listed()->filterBy('categories', 'allwoechentlich-belangloses');
};