<?php snippet('site-header', [
  'renderArticleMeta' => true
]) ?>

<?php
  snippet('article', [
    'article' => $page,
    'isSingle' => true,
  ]);
?>

<?php snippet('site-footer') ?>
