<?php snippet('site-header') ?>

<?php $paginatedArticles = $articles->flip()->paginate(10); ?>

<?php if ($archive) : ?>
  <div class="container archive-header">
    <h1>Archiv für <em><?= DtuiHelper::getCategoryName($archive); ?></em></h1>
  </div>
<?php endif; ?>

<?php foreach ($paginatedArticles as $article): ?>
  <?php
  snippet('article', [
    'article' => $article,
  ]);
  ?>
<?php endforeach; ?>

<?php
snippet('pagination', [
  'articles' => $paginatedArticles,
]);
?>

<?php snippet('site-footer') ?>
