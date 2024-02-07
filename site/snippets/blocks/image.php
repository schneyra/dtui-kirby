<?php

/** @var \Kirby\Cms\Block $block */

$caption = $block->caption();
$crop    = $block->crop()->isTrue();
$link    = $block->link();
$ratio   = $block->ratio()->or('auto');
$align   = $block->align()->or('none');
$src     = null;
$image = $block->image()->toFile();

/**
@todo Bilder aus Fremdquellen ermöglichen
 if ($block->location() == 'web') {
    $src = $block->src()->esc();
} elseif () {
    $src = $image->url();
} */

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

$customAlt = null;
if ($block->alt()->isNotEmpty()) {
  $customAlt = $block->alt()->esc();
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
      'customAlt' => $customAlt,
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