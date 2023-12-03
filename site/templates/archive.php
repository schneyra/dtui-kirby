<?php snippet('site-header') ?>

<div class="site-archive">
  <div class="container flow">
    <h1>Archiv</h1>
    <p>Aktuell sind <?= $articleCount ?> Artikel veröffentlicht. Der erste Beitrag wurde am <?= DtuiHelper::dateformat($firstArticleDate, 'dd. MMMM YYYY')?> geschrieben, der aktuellste am <?= DtuiHelper::dateformat($lastArticleDate, 'dd. MMMM YYYY')?>.</p>
  </div>

  <div class="container-wide flow">
    <div class="container flow">
      <h2 id="kategorien">Kategorien</h2>
      <p>Die Beiträge sind in <?= count(DtuiHelper::getCategories()) ?> Kategorien abgelegt.</p>
    </div>

    <ul class="category-cloud">
      <?php foreach (DtuiHelper::getCategories() as $slug => $name): ?>
        <li><a href="<?= url('kategorie/' . $slug) ?>"><?= $name ?></a></li>
      <?php endforeach; ?>
    </ul>
  </div>

  <div class="container flow">
    <h2 id="artikel">Alle Artikel</h2>

    <?php foreach (page('blog')->children()->flip() as $year) : ?>
      <details>
        <summary>
          <h2><?= $year->title() ?></h2>
        </summary>

        <p>In diesem Jahr wurden <?= $year->grandChildren()->listed()->count() ?> Artikel veröffentlicht.</p>

        <?php foreach ($year->children()->flip() as $month) : ?>
          <?php $articles = $month->children()->listed()->flip(); ?>

          <?php if (count($articles)) : ?>
            <h3><?= dtuiHelper::dateformat($year->title()->toString() . '-'. $month->title()->toString(), 'MMMM YYYY') ?></h3>

            <ul>
              <?php foreach ($articles as $article) : ?>
                <li>
                  <h4><a href="<?= $article->articleUrl() ?>"><?= $article->title() ?></a></h4>
                  <time datetime="<?= $article->date()->strtotime() ?>" class="site-archive__date">
                    (<?= DtuiHelper::dateformat($article->date(), 'dd. MMMM YYYY')?>)
                  </time>
                </li>
              <?php endforeach; ?>
            </ul>
            <?php endif; ?>
        <?php endforeach; ?>
      </details>
    <?php endforeach; ?>
  </div>
</div>

<?php snippet('site-footer') ?>
