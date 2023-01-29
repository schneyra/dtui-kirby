<article class="article content-layout">
  <?php if (isset($isSingle) && $isSingle === true) : ?>
    <h1 class="article__headline"><?= $article->title() ?></h1>
  <?php else: ?>
    <h2 class="article__headline"><a href="<?= $article->articleUrl() ?>"><?= $article->title() ?></a></h2>
  <?php endif; ?>

  <?php /*
  {% if article.thumbnail.toFile() %}
      <img src="{{ article.thumbnail.toFile().url }}" width="200" alt="">
  {% endif %}
  #} */?>

  <?= $article->text()->toBlocks() ?>

  <footer class="article__footer">
    <time datetime="<?= $article->date()->strtotime() ?>"><a href="<?= $article->articleUrl() ?>"><?= $article->date()->toDate("dd. MMMM YYYY") ?></a> &mdash; <?= $article->date()->toDate("HH:mm") ?> Uhr</time>
    <?php /*{# &middot;
    {% for category in article.categories().split() %}
        <a href="{{ url('/kategorie/' ~ category) }}">{{ category }}</a>
    {% endfor %}
    #} */?>
    <?php if ($kirby->user()) : ?>
      &middot; <a href="<?= $article->panel()->url() ?>">Bearbeiten</a>
    <?php endif; ?>
  </footer>
</article>
