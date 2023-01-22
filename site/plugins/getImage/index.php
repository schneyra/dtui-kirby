<?php
function getimage($imgUrl, $articlePath, $newFilename){
    $urlArray = explode('/', $imgUrl);

    if ($newFilename) {
        $filenameArray = explode('.', array_pop($urlArray));
        $filename = $newFilename . '.' . array_pop($filenameArray);
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
