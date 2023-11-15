<?php
/**
 * @var App $kirby
 **/

$showHero = $article->thumbnail()->toFile() && (isset($isSingle) && $isSingle === true);
?>

<article class="article <?php if ($showHero) : ?>article--has-hero<?php endif; ?>">
  <?php if ($showHero) : ?>
    <div class="article__hero">

      <?php
      snippet('picture', [
        'image' => $article->thumbnail()->toFile(),
        'sizes' => "100vw",
      ]);
      ?>
    </div>
  <?php endif; ?>

  <?php if (isset($isSingle) && $isSingle === true) : ?>
    <h1 class="article__headline <?php if ($showHero) : ?>article__headline--hero<?php endif; ?>">
      <?= $article->title() ?>
    </h1>
  <?php else: ?>
    <h2 class="article__headline">
      <a href="<?= $article->articleUrl() ?>">
        <?= $article->title() ?>
      </a>
    </h2>
  <?php endif; ?>

  <?= $article->body()->toBlocks() ?>

  <?php
    snippet('weeknotes', [
      'page' => $article
    ]);
  ?>

  <footer class="article__footer">
    <time datetime="<?= $article->date()->strtotime() ?>">
      <a href="<?= $article->articleUrl() ?>"><?= DtuiHelper::dateformat($article->date(), 'dd. MMMM YYYY')?></a>
    </time>

    <?php foreach ($article->categories()->split() as $category) : ?>
      &middot; <a href="<?= url('/kategorie/' . $category) ?>"><?= DtuiHelper::getCategoryName($category) ?></a>
    <?php endforeach; ?>

    <?php if ($kirby->user()) : ?>
      &middot; <a href="<?= $article->panel()->url() ?>">Bearbeiten</a>
    <?php endif; ?>
  </footer>
</article>
