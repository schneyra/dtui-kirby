<?php
/** @var \Kirby\Cms\Block $block */
$caption = $block->caption();
$crop    = $block->crop()->isTrue();
$ratio   = $block->ratio()->or('auto');

$sizes = "(min-width: 800px) 800px, 100vw";

?>
<figure<?= Html::attr(['data-ratio' => $ratio, 'data-crop' => $crop], null, ' ') ?>>
  <ul>
    <?php foreach ($block->images()->toFiles() as $image): ?>
      <li>
        <picture>
          <source
            srcset="<?= $image->srcset([
              '400w'  => ['width' => 400, 'format' => 'webp'],
              '800w'  => ['width' => 800, 'format' => 'webp'],
              '1200w' => ['width' => 1600, 'format' => 'webp']
            ]) ?>"
            sizes="<?= $sizes ?>">

          <source
            srcset="<?= $image->srcset([
              '400w'  => ['width' => 400, 'format' => 'avif'],
              '800w'  => ['width' => 800, 'format' => 'avif'],
              '1200w' => ['width' => 1600, 'format' => 'avif']
            ]) ?>"
            sizes="<?= $sizes ?>">

          <?= $image->crop(800) ?>
        </picture>
      </li>
    <?php endforeach ?>
  </ul>
  <?php if ($caption->isNotEmpty()): ?>
    <figcaption>
      <?= $caption ?>
    </figcaption>
  <?php endif ?>
</figure>