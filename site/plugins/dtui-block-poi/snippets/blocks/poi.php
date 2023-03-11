<?php
use Kirby\Cms\App;
use Kirby\Cms\Block;

/**
 * @var Block $block
 * @var App $kirby
 **/

$align = $block->align()->or('none');

$lnglat = $block->lng() . "," . $block->lat();
$url = "https://api.mapbox.com/styles/v1/mapbox/streets-v11/static/"
    . "pin-s-star+FE4A49(" . $lnglat . ")/"
    . $lnglat
    . "," . $block->zoom()
    . ",0/850x450@2x?access_token="
    . $kirby->option('options.secrets.mapboxToken');

$filename = "map-" . Str::slug($block->lng()) . "-" . Str::slug($block->lat()) . "-" . Str::slug($block->title());
$imageName = DtuiHelper::getRemoteImage($url, $block->parent()->root(), $filename);

$mapImage = null;

if ($imageName) {
    $mapImage = $block->parent()->images()->find($imageName);
}

$sizes = "(min-width: 800px) 850px, 100vw";

?>

<?php if ($mapImage) : ?>
    <div class="poi-wrapper <?= 'align-' . $align ?>">
        <figure class="poi">
            <?php if ($block->title()) : ?>
                <h3 class="poi__title"><?= $block->title() ?> </h3>
            <?php endif; ?>

                <picture>
                    <source srcset="<?= $mapImage->srcset([
                        '400w'  => ['width' => 400, 'format' => 'webp'],
                        '850w'  => ['width' => 850, 'format' => 'webp'],
                        '1700w' => ['width' => 1700, 'format' => 'webp']
                    ]) ?>"
                            sizes="<?= $sizes ?>">

                    <?php /*
                    <source srcset="<?= $mapImage->srcset([
                        '400w'  => ['width' => 400, 'format' => 'avif'],
                        '800w'  => ['width' => 850, 'format' => 'avif'],
                        '1200w' => ['width' => 1600, 'format' => 'avif']
                    ]) ?>"
                            sizes="<?= $sizes ?>">*/?>

                    <img src="<?= $mapImage->crop(800)->url() ?>"
                         alt="Eine Karte von <?= $block->title(); ?>"
                         width="<?= $mapImage->width() ?>"
                         height="<?= $mapImage->height() ?>"
                         loading="lazy"
                         decoding="async"
                    >
                </picture>

            <?php if (trim($block->description()) !== "") : ?>
                <p class="poi__description"><?= $block->description() ?> </p>
            <?php endif; ?>
        </figure>
    </div>
<?php endif; ?>

