<?php
$notes = [];
$thisWeekInThePast = [];

if (in_array('allwoechentlich-belangloses', $page->categories()->toArray())) {
    $week = DtuiHelper::getWeekFromDate($page->date());
    $year = DtuiHelper::dateformat($page->date(), 'YYYY');

    if ($page->date()->toDate('Y') >= 2023) {
        $url = "https://weeknotes.cafe/w/$year/$week/json";

        $response = new Remote($url);

        if ($response->code() === 200) {
            $array = json_decode($response->content(), true);
            $notes = array_key_exists('items', $array) ? $array['items'] : [];
        }
    }

    $thisWeekInThePast = page('blog')
      ->grandChildren()->children()
      ->filter(function ($page) use ($week) {
          return in_array('allwoechentlich-belangloses', $page->categories()->toArray()) && DtuiHelper::getWeekFromDate($page->date()) == $week;
      });
} ?>

<?php if (count($notes) > 1 || count($thisWeekInThePast) > 0) : ?>
  <aside class="container highlight-box flow" aria-labelledby="weeknotes-<?= $week . "-" . $year ?>">
    <?php if (count($notes) > 1) : ?>

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
    <?php endif; ?>

    <?php if (count($thisWeekInThePast) > 0) : ?>
      <h2>Weeknotes aus Woche <?= $week ?></h2>

      <p>Wöchentliche Rückblicke schreibe ich schon eine ganze Weile. So verlief die Woche in vergangenen Jahren:</p>

      <ul class="article-list article-list--light">
        <?php
        $rand = rand(0, count($thisWeekInThePast));
        $i = 0;

        foreach ($thisWeekInThePast as $note) : ?>
          <?php $noteYear = DtuiHelper::dateformat($note->date(), 'YYYY'); ?>
          <?php if (!empty($note) && $noteYear !== $page->date()->toDate('Y')) : ?>
            <li class="article-list__item<?= $rand === $i ? ' article-list__item--active' : ''?>">
              <?= $noteYear ?>: <a href="<?= $note->articleUrl() ?>" class="article-list__link"><?= $note->title() ?></a>
            </li>
            <?php $i++; endif; ?>
        <?php endforeach; ?>
      </ul>
    <?php endif; ?>
  </aside>
<?php endif; ?>
