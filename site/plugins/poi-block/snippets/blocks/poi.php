<figure>
    <h3><?= $block->title() ?></h3>

    <?php $url = "https://api.mapbox.com/styles/v1/mapbox/streets-v11/static/"
            . $block->lng()
            . "," . $block->lat()
            . "," . $block->zoom()
            . ",0/300x200?access_token="
            . $kirby->option('options.secrets.mapboxToken') ?>


    <p><?= $block->description() ?> </p>

    <img src="<?= $url ?>" alt="Eine Karte von<?= $block->title() ?>">
</figure>
