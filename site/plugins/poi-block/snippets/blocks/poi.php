<?php
use Kirby\Cms\App;
use Kirby\Cms\Block;

/**
 * @var Block $block
 * @var App $kirby
 **/
?>

<?php
$align = $block->align()->or('none');
?>

<div class="poi-wrapper">
    <figure class="poi <?= 'align-' . $align ?>">
        <?php if ($block->title()) : ?>
            <h3 class="poi__title"><?= $block->title() ?> </h3>
        <?php endif; ?>

        <?php
        $url = "https://api.mapbox.com/styles/v1/mapbox/streets-v11/static/"
            . $block->lng()
            . "," . $block->lat()
            . "," . $block->zoom()
            . ",0/820x410@2x?access_token="
            . $kirby->option('options.secrets.mapboxToken');

        $imageName = getRemoteImage($url, $block->parent()->root(), 'map-' . Str::slug($block->title()));

        $mapImage = null;
        if ($imageName) {
            $mapImage = $block->parent()->images()->find($imageName);
        }
        ?>

        <?php if ($mapImage) : ?>
            <?php $sizes = "(min-width: 800px) 800px, 100vw"; ?>
            <picture>
                <source
                        srcset="<?= $mapImage->srcset([
                            '400w'  => ['width' => 400, 'format' => 'webp'],
                            '800w'  => ['width' => 800, 'format' => 'webp'],
                            '1200w' => ['width' => 1600, 'format' => 'webp']
                        ]) ?>"
                        sizes="<?= $sizes ?>">

                <source
                        srcset="<?= $mapImage->srcset([
                            '400w'  => ['width' => 400, 'format' => 'avif'],
                            '800w'  => ['width' => 800, 'format' => 'avif'],
                            '1200w' => ['width' => 1600, 'format' => 'avif']
                        ]) ?>"
                        sizes="<?= $sizes ?>">

                <img
                        src="<?= $mapImage->crop(800)->url() ?>"
                        alt="Eine Karte von <?= $block->title(); ?>"
                        width="<?= $mapImage->width() ?>"
                        height="<?= $mapImage->height() ?>"
                        loading="lazy"
                        decoding="async"
                >
            </picture>
        <?php endif; ?>

        <?php if (trim($block->description()) !== "") : ?>
            <p class="poi__description"><?= $block->description() ?> </p>
        <?php endif; ?>
    </figure>
</div>

