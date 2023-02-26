<?php
/**
 * @var App $kirby
 **/
?>

<?php snippet('site-header', [
  'renderArticleMeta' => true
]) ?>

<article class="article">
  <h1 class="article__headline">
    <?= $page->title() ?>
  </h1>

  <?= $page->body()->toBlocks() ?>

  <?php if ($kirby->user()) : ?>
    <footer class="article__footer">
      <a href="<?= $page->panel()->url() ?>">Bearbeiten</a>
    </footer>
  <?php endif; ?>
</article>

<?php snippet('site-footer') ?>
