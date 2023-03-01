<?php

class DtuiHelper
{
    /**
     * Generiert einen String für den Title-Tag im Head
     *
     * @param $site
     * @param $page
     * @param null $archive
     * @param null $dateArchive
     * @return string
     * @throws Exception
     */
    public static function generatePageTitle($site, $page, $archive = null, $dateArchive = null): string
    {
        if ($dateArchive) {
            return "Archiv für " . self::generateArchiveTitle($page) . " › " . $site->title() . " › Alltäglich belangloses";
        }

        if ($archive) {
            return "Archiv " . self::getCategoryName($archive) . " › " . $site->title() . " › Alltäglich belangloses";
        }

        if ($page->isHomepage()) {
            return $site->title()  . " › Alltäglich belangloses";
        }

        return $page->title() . " › " . $site->title() . " › Alltäglich belangloses";
    }

    /**
     * @return array
     */
    private static function getCategories()
    {
        $props = Kirby\Cms\Blueprint::load('pages/article');
        $props['model'] = page();

        $bp = new Kirby\Cms\PageBlueprint($props);
        return $bp->fields()['categories']['options'];
    }

    /**
     * Liest die Kategorien aus den Blogartikel-Blueprint und gibt einen davon zurück
     *
     * @param $slug
     * @return string
     */
    public static function getCategoryName($slug): string
    {
        $categories = self::getCategories();

        return $categories[$slug] ?? $slug;
    }

    /**
     * Überprüft ob es eine Kategorie gibt
     *
     * @param $slug
     * @return bool
     */
    public static function isCategory($slug): bool
    {
        $categories = self::getCategories();

        return array_key_exists($slug, $categories);
    }

    /**
     * Lädt ein Bild von einer entfernten Quelle und speichert es im Dateisystem
     *
     * @param $imgUrl
     * @param $articlePath
     * @param $newFilename
     * @return string|null
     */
    public static function getRemoteImage($imgUrl, $articlePath, $newFilename): ?string
    {
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

    /**
     * Gibt den Anfang des Inhaltes eines Artikels zurück
     *
     * @param $page
     * @return string
     */
    public static function generateMetaDescription($page)
    {
        $articleBody = trim(strip_tags($page->body()->toBlocks()));
        return esc(implode(' ', array_slice(explode(' ', $articleBody), 0, 10)) . '...');
    }

    /**
     * Function to calculate the estimated reading time of the given text.
     * @see https://ourcodeworld.com/articles/read/1603/how-to-determine-the-estimated-reading-time-of-a-text-with-php
     *
     * @param string $text The text to calculate the reading time for.
     * @param string $wpm The rate of words per minute to use.
     * @return Array
     */
    private static function estimateReadingTime($text, $wpm = 200)
    {
        $totalWords = str_word_count(strip_tags($text));
        $minutes = floor($totalWords / $wpm);
        $seconds = floor($totalWords % $wpm / ($wpm / 60));

        return array(
            'minutes' => $minutes,
            'seconds' => $seconds
        );
    }

    /**
     * Errechnet die geschätzte Lesezeit eines Beitrags
     *
     * @param $page
     * @return array
     */
    public static function generateReadingTime($page)
    {
        $articleBody = strip_tags($page->body()->toBlocks());
        $readingTime = self::estimateReadingTime($page->title() . ' ' .  $articleBody);

        if ($readingTime['seconds'] > 30) {
            $readingTime['minutes'] = $readingTime['minutes'] + 1;
        }

        return $readingTime;
    }

    /**
     * Formatiert Datumsangaben
     *
     * @param $date
     * @param $pattern
     * @return bool|string
     * @throws Exception
     */
    public static function dateformat($date, $pattern = null): bool|string
    {
        $dateFormatter = new IntlDateFormatter(
            "de_DE",
            IntlDateFormatter::FULL,
            IntlDateFormatter::NONE,
            'Europe/Berlin',
            IntlDateFormatter::GREGORIAN,
            $pattern
        );

        return $dateFormatter->format(new DateTime($date));
    }

    /**
     * Generiert die Datum/Uhrzeit-Ausgabe eines Artikels
     *
     * @param $article
     * @return string
     */
    public static function getDateTimeForArticle($article)
    {
        return $article->date()->toDate(new IntlDateFormatter(
            "de_DE",
            IntlDateFormatter::LONG,
            IntlDateFormatter::SHORT,
            'Europe/Berlin'
        )) . " Uhr";
    }

    /**
     * Gibt das passend formatierte Datum für das aktuellen Archivs zurück
     *
     * @param $page
     * @return string
     * @throws Exception
     */
    public static function generateArchiveTitle($page)
    {
        $title = '';

        switch ($page->template()->name()) {
            case 'year':
                $title = $page->title();
                break;
            case 'month':
                $title = self::dateformat($page->parent()->title() . "-" . $page->title(), 'MMMM YYYY');
                break;
            case 'day':
                $title = 'den ' . self::dateformat($page->parent()->parent()->title() . "-" . $page->parent()->title() . "-" . $page->title(), 'dd. MMMM YYYY');
                break;
        }

        return $title;
    }

    /**
     * Je nach Archiv muss eine andere Ebene an Content abgegriffen werden
     *
     * @param $page
     * @return mixed|null
     */
    public static function getAllArticlesForArchive($page)
    {
        $allArticles = null;

        switch ($page->template()->name()) {
            case 'year':
                $allArticles = $page->grandChildren()->children()->flip();
                break;
            case 'month':
                $allArticles = $page->grandChildren()->flip();
                break;
            case 'day':
                $allArticles = $page->children()->flip();
                break;
        }

        return $allArticles;
    }

    /**
     * Gibt Beiträge von gleichen Datum aus anderen Jahren zurück.
     * Wenn kein Page-Object übergeben wird, ist das Referenzdatum "heute".
     *
     * @param null $page
     * @return Kirby\Cms\Pages Object
     */
    public static function onThisDay($page = null)
    {
        if (!$page) {
            $date = date('m-d');
            $today = null;
        } else {
            $date = $page->date()->toDate('MM-dd');
            $today = $page->date()->toDate('YYYY-MM-dd');
        }

        return page('blog')
            ->grandChildren()->children()->children()
            ->filter(function ($page) use ($date, $today) {
                return $page->date()->toDate('MM-dd') === $date && $page->date()->toDate('YYYY-MM-dd') !== $today;
            });
    }
}
