<?php $pagination = $articles->pagination() ?>

<?php if ($pagination->hasPrevPage() || $pagination->hasNextPage()) : ?>
  <nav aria-label="Seiten">
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
        <li <?= $pagination->page() !== $r ? ' class="pagination__item"' : '' ?>>
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
<?php endif ?>
