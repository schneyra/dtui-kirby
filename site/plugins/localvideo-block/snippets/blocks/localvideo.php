<figure>
    <?php if ($block->title() != ""): ?>
        <h3><?= $block->title() ?></h3>
    <?php endif; ?>

    <video autoplay muted loop>
        <source src="<?= $block->video()->toFile()->url() ?>">
    </video>

    <?php if ($block->description() != ""): ?>
        <p><?= $block->description() ?> </p>
    <?php endif; ?>

</figure>
