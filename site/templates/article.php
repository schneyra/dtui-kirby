<?php snippet('site-header', [
  'renderArticleMeta' => true
]) ?>

<?php
  snippet('article', [
    'article' => $page,
    'isSingle' => true,
  ]);
?>

<script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "BlogPosting",
    "headline": "<?= $page->title() ?>",
    "description": "<?= DtuiHelper::generateMetaDescription($page) ?>",
    "datePublished": "<?= date('c', $page->date()->toTimestamp()) ?>",
    "mainEntityOfPage": "true",
    "image": {
      "@type": "imageObject",
      "url": "<?= $page->articleUrl() ?>.png",
      "width": "1200",
      "height": "628"
    },
    "author": {
      "@type": "Person",
      "name": "Martin Schneider"
    }
  }
</script>

<?php snippet('site-footer') ?>
