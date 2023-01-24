<?php snippet('site-header') ?>

  <?php $articles = page('blog')->grandChildren()->children()->children()->flip()->paginate(10); ?>

  <?php foreach ($articles as $article): ?>
    <?php
    snippet('article', [
      'article' => $article,
      'hasHeadlineLink' => true
    ]);
    ?>
  <?php endforeach; ?>


<?php $pagination = $articles->pagination() ?>
<nav>
  <ul class="pagination">
    <?php if ($pagination->hasPrevPage()): ?>
      <li>
        <a href="<?= $pagination->prevPageURL() ?>">‹</a>
      </li>
    <?php else: ?>
      <li>
        <span>‹</span>
      </li>
    <?php endif ?>

    <?php foreach ($pagination->range(10) as $r): ?>
      <li>
        <a<?= $pagination->page() === $r ? ' aria-current="page"' : '' ?> href="<?= $pagination->pageURL($r) ?>">
          <?= $r ?>
        </a>
      </li>
    <?php endforeach ?>

    <?php if ($pagination->hasNextPage()): ?>
      <li>
        <a href="<?= $pagination->nextPageURL() ?>">›</a>
      </li>
    <?php else: ?>
      <li>
        <span>›</span>
      </li>
    <?php endif ?>
  </ul>
</nav>


<?php snippet('site-footer') ?>
