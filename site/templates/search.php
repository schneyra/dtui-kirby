<?php snippet('site-header') ?>

<?php $totalPages = ceil($pagination->total()/$pagination->limit()) ?>

<div class="container archive-header flow">
  <?php if (isset($query)) : ?>
    <h1><?= $pagination->total(); ?> Suchergebnisse für <em><?= esc($query) ?></em></h1>

    <?php if ($totalPages > 1) : ?>
      <p>Seite <?= $pagination->page(); ?> von <?= $totalPages ?>.</p>
    <?php endif; ?>
  <?php else : ?>
    <h1>Suche</h1>
  <?php endif; ?>

  <form method="GET" action="<?= url('suche') ?>" class="site-footer-searchform">
    <input type="search" name="s" aria-label="Suchbegriff" value="<?= !empty($query) ? esc($query) : ''; ?>">
    <button type="submit">Suchen</button>
  </form>
</div>

<div class="container archive-flow">
  <?php if (count($results)) : ?>
    <?php foreach ($results as $result): ?>
      <?php
      snippet('teaser', [
        'article' => $result,
      ]);
      ?>
    <?php endforeach; ?>

  <?php else : ?>
    <?php if (isset($query)) : ?>
      <p>Keine Beiträge gefunden.</p>
    <?php endif; ?>
  <?php endif; ?>

  <?php
    snippet('pagination', ['articles' => $results]);
  ?>
</div>

<?php snippet('site-footer') ?>
