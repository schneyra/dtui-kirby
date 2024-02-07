<?php if (isset($image) && isset($sizes)) : ?>
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
        '1000w'  => ['width' => 1000, 'format' => 'webp'],
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
      alt="<?= $customAlt ?? $image->alt()->esc() ?>"
      width="<?= $image->width() ?>"
      height="<?= $image->height() ?>"
      class="image"
      loading="lazy"
      decoding="async"
    >
  </picture>
<?php endif; ?>