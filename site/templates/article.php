<?php snippet('site-header', [
  'renderArticleMeta' => true
]) ?>

<?php
  snippet('article', [
    'article' => $page,
    'isSingle' => true,
  ]);
?>

<?php
$articleBody = $page->text()->toBlocks();
$description = trim(implode(' ', array_slice(explode(' ', strip_tags($articleBody)), 0, 10)) . '...');

?>

<script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "BlogPosting",
    "headline": "<?= $page->title() ?>",
    "description": "<?= $description ?>",
    "datePublished": "<?= $page->date()->strtotime() ?>",
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
