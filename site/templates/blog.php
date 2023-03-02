<?php snippet('site-header') ?>

<?php
$paginatedArticles = $articles->flip()->paginate(10);
?>

<?php if ($archive) : ?>
  <div class="container archive-header">
    <h1>Archiv für <em><?= DtuiHelper::getCategoryName($archive); ?></em></h1>
  </div>
<?php endif; ?>

<?php if ($search) : ?>
  <div class="container archive-header">
    <h1>Suchergebnisse für <em><?= esc($search) ?></em></h1>
  </div>
<?php endif; ?>

<?php if ($archive || $search) : ?>
  <div class="container archive-flow">
<?php endif; ?>

<?php if (count($articles)) : ?>
  <?php foreach ($paginatedArticles as $article): ?>
    <?php
    snippet($template, [
      'article' => $article,
    ]);
      ?>
  <?php endforeach; ?>

<?php else : ?>
  <p class="container">Keine Beiträge gefunden.</p>
<?php endif; ?>

<?php if ($archive || $search) : ?>
  </div>
<?php endif; ?>

<?php
  snippet('pagination', ['articles' => $paginatedArticles]);
?>

<?php snippet('site-footer') ?>
