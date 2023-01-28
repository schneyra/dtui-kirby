<?php

switch ($page->template()->name()) {
  case 'year':
    $title = $page->title();
    $articles = $page->grandChildren()->children()->flip()->paginate(10);
    break;
  case 'month':
    $title = $page->title()->toDate('MMMM') . ' ' . $page->parent()->title();
    $articles = $page->grandChildren()->flip()->paginate(10);
    break;
  case 'day':
    $title = $page->title() . '. ' . $page->parent()->title()->toDate('MMMM') . ' ' . $page->parent()->parent()->title();
    $articles = $page->children()->flip()->paginate(10);
    break;
}

?>

<h1>Archiv für <?= $title; ?></h1>

<?php foreach ($articles as $article): ?>
  <?php
  var_dump($article->title());
  ?>
<hr>
<?php endforeach; ?>

<?php
snippet('pagination', [
  'articles' => $articles,
]);
?>