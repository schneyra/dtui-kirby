<?php

switch ($page->template()->name()) {
  case 'year':
    $title = $page->title();
    $articles = $page->grandChildren()->children()->flip()->paginate(10);
    break;
  case 'month':
    $title = $page->title()->toDate(new IntlDateFormatter(
        "de_DE",
        IntlDateFormatter::FULL,
        IntlDateFormatter::NONE,
        'Europe/Berlin',
        IntlDateFormatter::GREGORIAN,
        'MMMM')) . ' ' . $page->parent()->title();
    $articles = $page->grandChildren()->flip()->paginate(10);
    break;
  case 'day':
    $title = 'den ' . $page->title() . '. ' . $page->parent()->title()->toDate(new IntlDateFormatter(
        "de_DE",
        IntlDateFormatter::FULL,
        IntlDateFormatter::NONE,
        'Europe/Berlin',
        IntlDateFormatter::GREGORIAN,
        'MMMM')) . ' ' . $page->parent()->parent()->title();
    $articles = $page->children()->flip()->paginate(10);
    break;
}

?>

<div class="container">
  <h1>Archiv für <?= $title; ?></h1>

  <?php foreach ($articles as $article): ?>
    <?php
    snippet('teaser', [
      'article' => $article,
    ]);
    ?>
  <?php endforeach; ?>

  <?php
  snippet('pagination', [
    'articles' => $articles,
  ]);
  ?>
</div>
