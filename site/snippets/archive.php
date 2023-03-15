<?php
$title = DtuiHelper::generateArchiveTitle($page);

$allArticles = DtuiHelper::getAllArticlesForArchive($page);
$articles = $allArticles->paginate(10);
?>

<div class="container">
  <h1>Archiv für <?= $title; ?></h1>

  <?php if (count($allArticles) > 0) : ?>
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
    <p>Keine Beiträge gefunden</p>
  <?php endif; ?>
</div>
