<?php snippet('site-header') ?>

<?php $articles = page('blog')->grandChildren()->children()->children()->flip()->paginate(10); ?>

<?php foreach ($articles as $article): ?>
  <?php
  snippet('article', [
    'article' => $article,
  ]);
  ?>
<?php endforeach; ?>

<?php
snippet('pagination', [
  'articles' => $articles,
]);
?>

<?php snippet('site-footer') ?>
