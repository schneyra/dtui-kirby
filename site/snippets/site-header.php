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

  <link rel="preload" href="<?= $site->url() ?>/assets/fonts/vollkorn-v21-latin-700.woff2" as="font" type="font/woff2" crossorigin="">

  <?php if ($kirby->option('options.local')) : ?>
    <?= css('assets/css/style.css') ?>
  <?php else: ?>
    <?= css('assets/css/style.min.css') ?>
  <?php endif; ?>

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