<?php
/** @var Kirby\Cms\Page $page */

snippet('site-header', ['dateArchive' => $page]) ?>

<?php
snippet('archive', [
  'article' => $page,
]);
?>

<?php snippet('site-footer') ?>
