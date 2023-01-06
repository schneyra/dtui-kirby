<?php
class ArticlePage extends Page {
    public function articleUrl():string {
        return str_replace('blog/', '', $this->uri());
    }
}
