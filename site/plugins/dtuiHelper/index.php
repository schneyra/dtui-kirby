<?php

class DtuiHelper {
    /**
     * Generiert einen String für den Title-Tag im Head
     *
     * @param $site
     * @param $page
     * @param null $archive
     * @return string
     */
    public static function generatePageTitle($site, $page, $archive = null) {

        if ($archive) {
            return "Archiv " . self::getCategoryName($archive) . " › " . $site->title() . " › Alltäglich belangloses";
        }

        if ($page->isHomepage()) {
            return $site->title()  . " › Alltäglich belangloses";
        }

        return $page->title() . " › " . $site->title() . " › Alltäglich belangloses";
    }

    /**
     * Liest die Kategorien aus den Blogartikel-Blueprint und gibt einen davon zurück
     *
     * @param $slug
     * @return string
     */
    public static function getCategoryName($slug) {
        $props = Kirby\Cms\Blueprint::load('pages/article');
        $props['model'] = page();

        $bp = new Kirby\Cms\PageBlueprint($props);
        $categories = $bp->fields()['categories']['options'];

        return $categories[$slug];
    }

    /**
     * Lädt ein Bild von einer entfernten Quelle und speichert es im Dateisystem
     *
     * @param $imgUrl
     * @param $articlePath
     * @param $newFilename
     * @return string|null
     */
    public static function getRemoteImage($imgUrl, $articlePath, $newFilename){
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

    public static function generateMetaDescription($page) {
        $articleBody = $page->text()->toBlocks();
        return trim(implode(' ', array_slice(explode(' ', strip_tags($articleBody)), 0, 10)) . '...');
    }


    /**
     * Function to calculate the estimated reading time of the given text.
     * @see https://ourcodeworld.com/articles/read/1603/how-to-determine-the-estimated-reading-time-of-a-text-with-php
     *
     * @param string $text The text to calculate the reading time for.
     * @param string $wpm The rate of words per minute to use.
     * @return Array
     */
    private static function estimateReadingTime($text, $wpm = 200) {
        $totalWords = str_word_count(strip_tags($text));
        $minutes = floor($totalWords / $wpm);
        $seconds = floor($totalWords % $wpm / ($wpm / 60));

        return array(
            'minutes' => $minutes,
            'seconds' => $seconds
        );
    }

    public static function generateReadingTime($page) {
        $articleBody = $page->text()->toBlocks();
        $readingTime = self::estimateReadingTime($page->title() . ' ' .  $articleBody);

        if ($readingTime['seconds'] > 30) {
            $readingTime['minutes'] = $readingTime['minutes'] + 1;
        }

        return $readingTime;
    }

}
