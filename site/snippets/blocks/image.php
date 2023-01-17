<?php

/** @var \Kirby\Cms\Block $block */
$alt     = $block->alt();
$caption = $block->caption();
$crop    = $block->crop()->isTrue();
$link    = $block->link();
$ratio   = $block->ratio()->or('auto');
$src     = null;

if ($block->location() == 'web') {
  $src = $block->src()->esc();
} elseif ($image = $block->image()->toFile()) {
  $alt = $alt ?? $image->alt();
  $src = $image->url();
}

$sizes = "(min-width: 800px) 800px, 100vw";
?>

<?php if ($image): ?>
  <figure<?= Html::attr(['data-ratio' => $ratio, 'data-crop' => $crop], null, ' ') ?> class="image-wrapper">
    <?php if ($link->isNotEmpty()): ?>
      <a href="<?= Str::esc($link->toUrl()) ?>">
    <?php endif ?>

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

    <?php if ($link->isNotEmpty()): ?>
      </a>
    <?php endif ?>

    <?php if ($caption->isNotEmpty()): ?>
      <figcaption>
        <?= $caption ?>
      </figcaption>
    <?php endif ?>
  </figure>
<?php endif ?>