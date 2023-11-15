<?php

/** @var \Kirby\Cms\Block $block */

$alt     = $block->alt();
$caption = $block->caption();
$crop    = $block->crop()->isTrue();
$link    = $block->link();
$ratio   = $block->ratio()->or('auto');
$align   = $block->align()->or('none');
$src     = null;

if ($block->location() == 'web') {
    $src = $block->src()->esc();
} elseif ($image = $block->image()->toFile()) {
    $alt = $alt ?? $image->alt();
    $src = $image->url();
}

/**
 * @todo Bilder bei alignleft oder alignright kleiner ausgeben
 */

$sizes = "(min-width: 1200px) 1200px, 100vw";

if ($align == 'left' || $align == 'right') {
    $sizes = "(min-width: 1200px) 600px, 100vw";
}

if ($align == 'full') {
    $sizes = "100vw";
}
?>

<?php if ($image): ?>
  <figure<?= Html::attr(['data-ratio' => $ratio, 'data-crop' => $crop], null, ' ') ?> class="image-wrapper <?= "align-" . $align ?>">
    <?php if ($link->isNotEmpty()): ?>
      <a href="<?= Str::esc($link->toUrl()) ?>">
    <?php endif ?>

    <?php
    snippet('picture', [
      'image' => $image,
      'sizes' => $sizes,
    ]);
    ?>

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