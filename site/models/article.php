<?php

use Kirby\Cms\Page;

class ArticlePage extends Page
{
    /**
     * Entfernt 'blog' aus der Artikel-URL
     *
     * @param array|string|null $options
     * @return string
     */
    public function url($options = null): string
    {
        return url(str_replace('blog/', '', Page::url()));
    }

    /**
     * Gibt entweder das Beitragsbild oder das erste zum Beitrag hochgeladene Bild zurück
     *
     * @return string
     */
    public function articleImage(): string
    {
        if ($this->thumbnail()->toFile()) {
            return $this->thumbnail()->toFile()->url();
        }

        $images = $this->images();
        if ($images->isNotEmpty()) {
            return $images->first()->url();
        }

        return '';
    }
}
