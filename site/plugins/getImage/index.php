<?php

/**
 * @param $imgUrl
 * @param $articlePath
 * @param $newFilename
 * @return string|null
 */
function getRemoteImage($imgUrl, $articlePath, $newFilename){
    $urlArray = explode('/', $imgUrl);

    if ($newFilename) {
        $fileEnding = 'jpg';
        $filename = $newFilename . '.' . $fileEnding;
    } else {
        $filename = array_pop($urlArray);
    }

    $path = $articlePath . '/' . $filename;

    if (file_exists($path)) {
        return $filename;
    }

    if (file_put_contents($path, file_get_contents($imgUrl))) {
        return $filename;
    }

    return null;
}
