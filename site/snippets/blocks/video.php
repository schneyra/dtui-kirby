<?php
use Kirby\Cms\Html;

/** @var \Kirby\Cms\Block $block */
?>
<?php if ($video = Html::video($block->url(), [], ['class' => 'js-video-iframe'])): ?>
  <?php $video = str_replace('src=', 'data-src=', $video); ?>

  <figure class="video-wrapper">
    <div class="video js-video">
      <?= $video ?>
      <?php #<img src="https://www.dertagundich.de/images/2500/0/0/youtube/G7KNmW9a75Y.jpg" class="js-video-cover"> ?>
      <button class="js-video-button">Video abspielen</button>
      <p class="video__disclaimer js-video-disclaimer">Nach dem Klick werden Daten von YouTube nachgeladen.</p>
    </div>

    <?php if ($block->caption()->isNotEmpty()): ?>
      <figcaption><?= $block->caption() ?></figcaption>
    <?php endif ?>
  </figure>
<?php endif ?>