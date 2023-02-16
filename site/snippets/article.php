<article class="article">
  <?php if (isset($isSingle) && $isSingle === true) : ?>
    <h1 class="article__headline">
      <?= $article->title() ?>
    </h1>
  <?php else: ?>
    <h2 class="article__headline">
      <a href="<?= $article->articleUrl() ?>">
        <?= $article->title() ?>
      </a>
    </h2>
  <?php endif; ?>

  <?php /*
  {% if article.thumbnail.toFile() %}
      <img src="{{ article.thumbnail.toFile().url }}" width="200" alt="">
  {% endif %}
  #} */?>

  <?= $article->text()->toBlocks() ?>

  <footer class="article__footer">
    <time datetime="<?= $article->date()->strtotime() ?>">
      <a href="<?= $article->articleUrl() ?>"><?= DtuiHelper::getDateTimeForArticle($article) ?></a>
    </time>

    <?php foreach ($article->categories() as $category) : ?>
      &middot; <a href="<?= url('/kategorie/' . $category) ?>"><?= DtuiHelper::getCategoryName($category) ?></a>
    <?php endforeach; ?>

    <?php if ($kirby->user()) : ?>
      &middot; <a href="<?= $article->panel()->url() ?>">Bearbeiten</a>
    <?php endif; ?>
  </footer>
</article>
