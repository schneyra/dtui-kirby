<?php
  $description = DtuiHelper::generateMetaDescription($page);
  $readingTime =DtuiHelper::generateReadingTime($page);
  ?>

<meta name="description" content="<?= $description ?>" />
<link rel="canonical" href="<?= $page->articleUrl() ?>" />
<meta property="og:locale" content="de_DE" />
<meta property="og:type" content="article" />
<meta property="og:title" content="<?= $page->title() ?>" />
<meta property="og:description" content="<?= $description ?>" />
<meta property="og:url" content="<?= $page->articleUrl() ?>" />
<meta property="og:site_name" content="Martin Schneider" />
<meta property="og:image" content="<?= e($page->template()->name() === 'article', $page->url() . '.png', $site->url() . '/default-og.png') ?>">
<meta property="article:publisher" content="schneyra" />
<meta property="article:author" content="schneyra" />
<meta property="article:published_time" content="<?= $page->date()->strtotime() ?>" />
<meta property="article:modified_time" content="<?= $page->modified('YYYY-MM-dd HH:mm:ss') ?>" />
<meta name="author" content="Martin Schneider" />
<meta name="twitter:card" content="summary" />
<meta name="twitter:creator" content="@schneyra" />
<meta name="twitter:site" content="@schneyra" />
<meta name="twitter:label1" content="Autor" />
<meta name="twitter:data1" content="Martin Schneider" />
<meta name="twitter:label2" content="Lesezeit" />
<meta name="twitter:data2" content="<?= $readingTime['minutes'] . " " . ($readingTime['minutes'] == 1 ? "Minute" : "Minuten") ?>" />
