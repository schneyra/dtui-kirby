<?php
 /**
   * Function to calculate the estimated reading time of the given text.
   * @see https://ourcodeworld.com/articles/read/1603/how-to-determine-the-estimated-reading-time-of-a-text-with-php
   *
   * @param string $text The text to calculate the reading time for.
   * @param string $wpm The rate of words per minute to use.
   * @return Array
   */
  function estimateReadingTime($text, $wpm = 200) {
    $totalWords = str_word_count(strip_tags($text));
    $minutes = floor($totalWords / $wpm);
    $seconds = floor($totalWords % $wpm / ($wpm / 60));

    return array(
      'minutes' => $minutes,
      'seconds' => $seconds
    );
  }

  $articleBody = $page->text()->toBlocks();
  $readingTime = estimateReadingTime($page->title() . ' ' .  $articleBody);

  if ($readingTime['seconds'] > 30) {
    $readingTime['minutes'] = $readingTime['minutes'] + 1;
  }

  $description = implode(' ', array_slice(explode(' ', strip_tags($articleBody)), 0, 10)) . '...';

  ?>

  <meta name="description" content="<?= $description ?>" />
  <link rel="canonical" href="<?= $page->articleUrl() ?>" />
  <meta property="og:locale" content="de_DE" />
  <meta property="og:type" content="article" />
  <meta property="og:title" content="<?= $page->title() ?>" />
  <meta property="og:description" content="<?= $description ?>" />
  <meta property="og:url" content="<?= $page->articleUrl() ?>" />
  <meta property="og:site_name" content="Martin Schneider" />
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
  <meta name="twitter:data2" content="<?= $readingTime['minutes'] ?> Minuten" />
