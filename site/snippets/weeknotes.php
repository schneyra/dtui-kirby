<?php
$notes = [];

if (in_array('allwoechentlich-belangloses', $page->categories()->toArray())) {
    if ($page->date()->toDate('Y') >= 2023) {
        $weekday = DtuiHelper::dateformat($page->date(), 'ee');

        if ($weekday === '07') {
            $week = DtuiHelper::dateformat($page->date(), 'ww');
        } else {
            $week = date('W', strtotime("last sunday " . $page->date()));
        }

        $year = DtuiHelper::dateformat($page->date(), 'YYYY');
        $url = "https://weeknotes.cafe/w/$year/$week/feed";

        $response = new Remote($url);

        if ($response->code() === 200) {
            $xml = simplexml_load_string($response->content(), "SimpleXMLElement", LIBXML_NOCDATA);

            if ($xml) {
                $json = json_encode($xml);
                $array = json_decode($json, true);
                $notes = array_key_exists('item', $array['channel']) ? $array['channel']['item'] : [];
            }
        }
    }
}

if (count($notes) > 1) : ?>
<aside class="container highlight-box flow" aria-labelledby="weeknotes-<?= $week . "-" . $year ?>">
  <h2 id="weeknotes-<?= $week . "-" . $year ?>">Weeknotes <?= $week . "/" . $year ?></h2>

  <p>Zum Glück muss ich nicht alleine jede Woche daran denken einen kleinen Rückblick zu schreiben. Hier sind die Beiträge meiner Freunde für diese Woche:</p>

  <ul class="article-list article-list--light">
    <?php
    $rand = rand(0, count($notes)-2);
    $i = 0;
    
    foreach ($notes as $note) : ?>
      <?php if (!empty($note) && !str_starts_with($note['title'], 'martin')) : ?>
        <li class="article-list__item<?= $rand === $i ? ' article-list__item--active' : ''?>">
          <a href="<?= $note['link'] ?>" class="article-list__link"><?= $note['title'] ?></a>
        </li>
      <?php $i++; endif; ?>
      <?php endforeach; ?>
  </ul>
  <p>Alle Beiträge findest du auf der <a href="https://weeknotes.cafe/">Übersichtsseite weeknotes.cafe</a> aufgelistet.</p>
</aside>
<?php endif; ?>
