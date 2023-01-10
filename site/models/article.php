<?php
class ArticlePage extends Page {
    public function articleUrl():string {
        return url(str_replace('blog/', '', $this->uri()));
    }
}
