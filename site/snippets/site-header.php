<!DOCTYPE html>
<html lang="de">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <?php if ($page->title() === "Blog"): ?>
    <title><?= $site->title() ?> › Alltäglich belangloses </title>
  <?php else: ?>
    <title><?= $page->title() ?> › <?= $site->title() ?> › Alltäglich belangloses </title>
  <?php endif; ?>

  <?= css('assets/css/style.css') ?>
  <?= css('@auto') ?>

  <link rel="alternate" type="application/rss+xml" title="der tag und ich" href="<?= $site->url() ?>/feed.xml">

  <?php if (isset($renderArticleMeta) && $renderArticleMeta === true) : ?>
    <?php snippet('meta-article'); ?>
  <?php else: ?>
    <?php snippet('meta-common'); ?>
  <?php endif; ?>

</head>

<body>
<header class="site-header">
  <div class="site-header__content">
    <a href="<?= $site->url() ?>">der tag und ich</a>
  </div>
</header>

<main>