<article class="teaser">
  <h2 class="teaser__headline">
    <a href="<?= $article->articleUrl() ?>" class="teaser__link">
      <?= $article->title() ?>
    </a>
  </h2>

  <?php /*
  {% if article.thumbnail.toFile() %}
      <img src="{{ article.thumbnail.toFile().url }}" width="200" alt="">
  {% endif %}
  #} */?>

  <footer class="teaser__footer">
    <time datetime="<?= $article->date()->strtotime() ?>">
      <?= $article->date()->toDate(new IntlDateFormatter(
        "de_DE",
        IntlDateFormatter::LONG,
        IntlDateFormatter::NONE,
        'Europe/Berlin'))
      ?>
    </time>

    <?php foreach ($article->categories() as $category) : ?>
      &middot; <a href="<?= url('/kategorie/' . $category) ?>"><?= DtuiHelper::getCategoryName($category) ?></a>
    <?php endforeach; ?>

    <?php if ($kirby->user()) : ?>
      &middot; <a href="<?= $article->panel()->url() ?>" class="teaser__edit-link">Bearbeiten</a>
    <?php endif; ?>
  </footer>
</article>
