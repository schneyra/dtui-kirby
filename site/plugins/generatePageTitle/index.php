<?php

/**
 * @param $site
 * @param $page
 * @return string
 */
function generatePageTitle($site, $page) {

    if ($page->isHomepage()) {
        return $site->title()  . " › Alltäglich belangloses";
    }

    return $page->title() . " › " . $site->title() . " › Alltäglich belangloses";
}
