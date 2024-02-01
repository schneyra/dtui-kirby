<?php /**
 * @var App $kirby
 * @var object $site
 * @var object $page
**/ ?>

<!DOCTYPE html>
<html lang="de">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="view-transition" content="same-origin">

  <title><?= DtuiHelper::generatePageTitle($site, $page, $archive ?? null, $dateArchive ?? null, $query ?? null); ?></title>

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
  <?php $logoTag = ($page->isHomepage() && !isset($archive)) ? 'h1' : 'div'; ?>

  <<?= $logoTag ?> class="site-header__content">
    <a href="<?= $site->url() ?>" class="site-header__title">der tag und ich</a>
  </<?= $logoTag ?>>
  <?php /*
  <nav class="site-header__navigation" aria-label="Hauptnavigation">
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