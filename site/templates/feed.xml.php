<?php
/**
 * @var App $kirby
 **/

/**
 * Thanks to Bruno Meilick (bnomei)
 * https://github.com/bnomei/kirby3-feed/blob/master/snippets/feed/rss.php
 *
 * Template modified to support blocks
 */

use Kirby\Toolkit\Xml;

$kirby->response()->type('application/xml');

$title = "der tag und ich";
$link = site()->url();
$feedurl = site()->url() . "/feed.xml";
$description = "Dies ist Martins Blog. Alltäglich belangloses und so. Seit 2003.";
$items = page('blog')->grandChildren()->children()->children()->flip()->limit(10);
$modified = date(DATE_RSS, $items->first()->date()->toTimestamp());

echo '<?xml version="1.0" encoding="utf-8"?>';
?><rss version="2.0" xmlns:content="http://purl.org/rss/1.0/modules/content/" xmlns:wfw="http://wellformedweb.org/CommentAPI/" xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:atom="http://www.w3.org/2005/Atom">
  <channel>
    <title><?= Xml::encode($title) ?></title>
    <link><?= Xml::encode($link) ?></link>
    <lastBuildDate><?= $modified ?></lastBuildDate>
    <atom:link href="<?= Xml::encode($feedurl) ?>" rel="self" type="application/rss+xml" />

    <?php if ($description && is_string($description) && strlen(trim($description)) > 0): ?>
      <description><?= Xml::encode($description) ?></description>
    <?php endif; ?>

    <?php foreach ($items as $item): ?>
      <item>
        <title><?= Xml::encode($item->title()) ?></title>
        <link><?= Xml::encode($item->url()) ?></link>
        <guid><?= Xml::encode($item->url()) ?></guid>
        <pubDate><?= date(DATE_RSS, $item->date()->toTimestamp()) ?></pubDate>
        <description><![CDATA[<?php foreach ($item->body()->toBlocks() as $block) {
            echo $block;
        } ?>]]></description>
      </item>
    <?php endforeach; ?>
  </channel>
</rss>
