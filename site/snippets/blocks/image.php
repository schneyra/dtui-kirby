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

      <picture>
        <?php /*
        <source
          srcset="<?= $image->srcset([
            '400w'  => ['width' => 400, 'format' => 'avif'],
            '800w'  => ['width' => 800, 'format' => 'avif'],
            '1200w' => ['width' => 1200, 'format' => 'avif'],
            '1600w' => ['width' => 1600, 'format' => 'avif'],
            '2400w' => ['width' => 2400, 'format' => 'avif'],
            '3200w' => ['width' => 3200, 'format' => 'avif'],
            '4000w' => ['width' => 4000, 'format' => 'avif'],
          ]) ?>"
          type="image/avif"
          sizes="<?= $sizes ?>">
        */ ?>
        <source
          srcset="<?= $image->srcset([
          '400w'  => ['width' => 400, 'format' => 'webp'],
          '800w'  => ['width' => 800, 'format' => 'webp'],
          '1000w'  => ['width' => 800, 'format' => 'webp'],
          '1200w' => ['width' => 1200, 'format' => 'webp'],
          '1600w' => ['width' => 1600, 'format' => 'webp'],
          '2400w' => ['width' => 2400, 'format' => 'webp'],
          '3200w' => ['width' => 3200, 'format' => 'webp'],
          '4000w' => ['width' => 4000, 'format' => 'webp'],
        ]) ?>"
          type="image/webp"
          sizes="<?= $sizes ?>">

        <img
          src="<?= $image->crop(800)->url() ?>"
          alt="<?= $image->alt()->esc() ?>"
          width="<?= $image->width() ?>"
          height="<?= $image->height() ?>"
          class="image"
          loading="lazy"
          decoding="async"
        >
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