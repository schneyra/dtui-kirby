<?php $description = "„der tag und ich“ ist das private Blog von Martin Schneider aus Bonn. Hier geht es um alltägliche Belanglosigkeiten, Fotografie, Musik, Reisen, Webentwicklung und was mir sonst so einfällt." ?>

<meta name="description" content="<?= $description ?>" />
<link rel="canonical" href="<?= $page->url() ?>" />

<meta property="og:locale" content="de_DE" />
<meta property="og:type" content="article" />
<meta property="og:title" content="<?= generatePageTitle($site, $page) ?>" />
<meta property="og:description" content="" />
<meta property="og:url" content="<?= $page->url() ?>" />
<meta property="og:site_name" content="Martin Schneider" />

<meta name="author" content="Martin Schneider" />
<meta name="twitter:card" content="summary" />
<meta name="twitter:creator" content="@schneyra" />
<meta name="twitter:site" content="@schneyra" />
