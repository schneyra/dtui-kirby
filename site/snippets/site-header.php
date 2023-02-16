<?php /**
 * @var App $kirby
**/ ?>

<!DOCTYPE html>
<html lang="de">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>
    <?php
      $archive = isset($archive) ? $archive : null;
      echo DtuiHelper::generatePageTitle($site, $page, $archive);
    ?>
  </title>

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
  
  <link rel="icon" href="/favicon.ico" sizes="any">
  <link rel="apple-touch-icon" href="/apple-touch-icon.png">
  <link rel="manifest" href="/manifest.json" crossorigin="use-credentials">
</head>

<body>
<header class="site-header">
  <div class="site-header__content">
    <a href="<?= $site->url() ?>" class="site-header__title">der tag und ich</a>
  </div>
  <?php /*
  <nav class="site-header__navigation">
    <ul class="site-navigation">
      <li class="site-navigation__item">
        <a href="https://www.dertagundich.de/kategorie/reisen/" class="site-navigation__link">Reisen</a>
      </li>
      <li class="site-navigation__item">
        <a href="https://www.dertagundich.de/archiv/" class="site-navigation__link">Archiv</a>
      </li>
    </ul>
  </nav>*/ ?>
</header>

<main>