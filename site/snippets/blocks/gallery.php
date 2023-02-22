<?php
/** @var \Kirby\Cms\Block $block */
$caption = $block->caption();
$crop    = $block->crop()->isTrue();
$ratio   = $block->ratio()->or('auto');
$columns = $block->columns()->toString();

$sizes = "(min-width: 800px) 800px, 100vw";

$galleryClasses = '';
if (
    count($block->images()->toFiles()) % 2 != 0
    && ($columns % 2 === 0)
) {
    $galleryClasses .= ' gallery--odd';
}

?>
<figure<?= Html::attr(['data-ratio' => $ratio, 'data-crop' => $crop], null, ' ') ?> class="gallery-wrapper">
  <ul class="gallery<?= $galleryClasses ?>" style="--columns:<?= $columns ?? 2 ?>">
    <?php foreach ($block->images()->toFiles() as $image): ?>
      <li>
        <picture class="image">
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

          <img
            src="<?= $image->crop(800)->url() ?>"
            alt="<?= $image->alt() ?>"
            width="<?= $image->width() ?>"
            height="<?= $image->height() ?>"
            loading="lazy"
            decoding="async"
          >
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
