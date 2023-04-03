<?php snippet('site-header') ?>

<div class="site-archive container flow">
  <h1>Archiv</h1>

  <p>Aktuell sind <?= $articleCount ?> Artikel veröffentlicht.</p>

  <?php foreach (page('blog')->children()->flip() as $year) : ?>
    <details>
      <summary>
        <h2><?= $year->title() ?></h2>
      </summary>

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

<?php snippet('site-footer') ?>
