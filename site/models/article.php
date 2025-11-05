<?php

use Kirby\Cms\Page;

class ArticlePage extends Page
{
    /**
     * Gibt die URL des Beitrages ohne "blog" zurück
     *
     * @return string
     */
    public function articleUrl(): string
    {
        return url(str_replace('blog/', '', $this->uri()));
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
