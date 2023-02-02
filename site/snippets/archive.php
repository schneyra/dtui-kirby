<?php

switch ($page->template()->name()) {
  case 'year':
    $title = $page->title();
    $allArticles = $page->grandChildren()->children()->flip();
    $articles = $allArticles->paginate(10);
    break;
  case 'month':
    $title = $page->title()->toDate(new IntlDateFormatter(
        "de_DE",
        IntlDateFormatter::FULL,
        IntlDateFormatter::NONE,
        'Europe/Berlin',
        IntlDateFormatter::GREGORIAN,
        'MMMM')) . ' ' . $page->parent()->title();
    $allArticles = $page->grandChildren()->flip()->paginate(10);
    $articles = $allArticles->paginate(10);
    break;
  case 'day':
    $title = 'den ' . $page->title() . '. ' . $page->parent()->title()->toDate(new IntlDateFormatter(
        "de_DE",
        IntlDateFormatter::FULL,
        IntlDateFormatter::NONE,
        'Europe/Berlin',
        IntlDateFormatter::GREGORIAN,
        'MMMM')) . ' ' . $page->parent()->parent()->title();
    $allArticles = $page->children()->flip()->paginate(10);
    $articles = $allArticles->paginate(10);
    break;
}
?>

<div class="container">
  <h1>Archiv für <?= $title; ?></h1>

  <?php if (count ($allArticles) > 0) : ?>
    <p><?= count($allArticles) . " " . (count($allArticles)!=1 ? 'Beiträge' : "Beitrag") ?></p>

    <div class="archive-flow">
      <?php foreach ($articles as $article): ?>
        <?php
        snippet('teaser', [
          'article' => $article,
        ]);
        ?>
      <?php endforeach; ?>
    </div>

    <?php
    snippet('pagination', [
      'articles' => $articles,
    ]);
    ?>
  <?php else: ?>
    <p>Keine Artikel gefunden</p>
  <?php endif; ?>
</div>
