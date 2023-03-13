<?php
/**
 * @var object $site
 **/

$articlesOnThisDay = DtuiHelper::onThisDay()->flip();
$rand = rand(0, count($articlesOnThisDay)-1);
?>

</main>

<footer class="site-footer">
  <div class="site-footer-content container-wide">
    <div class="flow">
      <h2 class="site-footer-content__headline">der tag und ich</h2>
      <?php $image = asset('assets/images/avatar.jpg') ?>
      <picture class="site-footer-content__image">
        <source
          srcset="<?= $image->srcset([
            '200w'  => ['width' => 200, 'format' => 'webp'],
            '400w'  => ['width' => 400, 'format' => 'webp'],
          ]) ?>"
          type="image/webp"
          sizes="200px">

        <img src="<?= $image->resize(200, 200)->url() ?>"
             width="<?= $image->width() ?>"
             height="<?= $image->height() ?>"
             alt="Martin schaut in die Kamera."
             loading="lazy"
             decoding="async">
      </picture>

      <p>Hallo! 👋 Ich bin Martin und dies ist mein Blog. Hier geht es um Bücher, Filme & Serien, Fotografie, unser Haus, Ausflüge, Musik, Reisen
        und alle möglichen anderen alltäglichen Belanglosigkeiten. Seit 2003 schreibe ich einigermaßen regelmäßig auf was mir so widerfährt.
        Ganz vielleicht gibt es bald auch wieder ein ordentliches Archiv.
      </p>
      <p>Um auf dem Laufenden zu bleiben empfehle ich meinen <a href="https://dertagundich.de/feed/">RSS-Feed</a> zu abonnieren oder mir auf <a href="https://mastodon.social/@schneyra" rel="me">Mastodon</a> zu folgen.</p>
    </div>
    <div class="flow">
      <h2 class="site-footer-content__headline">Suche</h2>
      <form method="GET" action="<?= url('suche') ?>" class="site-footer-searchform">
        <input type="search" name="s" aria-label="Suchbegriff">
        <button type="submit">Suchen</button>
      </form>

      <h2 class="site-footer-content__headline">Sonst so am <?= DtuiHelper::dateformat(date('Y-m-d'), 'dd. MMMM') ?></h2>
      <?php if (count($articlesOnThisDay)) : ?>
        <ul class="article-list">
        <?php $i = 0;
          foreach ($articlesOnThisDay as $article) : ?>
          <li class="article-list__item<?= $rand === $i ? ' article-list__item--active' : ''?>">
            <a href="<?= $article->articleUrl() ?>" class="article-list__link"><?= $article->title() ?></a>
            <span class="article-list__date">(<?= $article->date()->toDate('Y') ?>)</span>
          </li>
        <?php $i++;
          endforeach; ?>
        </ul>
      <?php else : ?>
        <p>An diesem Datum habe ich scheinbar noch nie einen Beitrag geschrieben. Das ist schon ein bisschen überraschend.</p>
      <?php endif; ?>
    </div>
  </div>

  <nav aria-label="Footer-Navigation" class="footer-navigation-wrapper container">
    <ul class="footer-navigation">
      <li class="footer-navigation__item">
        <a href="<?= $site->url() ?>/impressum/" class="footer-navigation__link">Impressum</a>
      </li>
      <li class="footer-navigation__item">
        <a href="<?= $site->url() ?>/datenschutzerklaerung/" class="footer-navigation__link">Datenschutzerklärung</a>
      </li>
      <li class="footer-navigation__item">
        <a href="https://creativecommons.org/licenses/by-sa/3.0/de/" class="footer-navigation__link">CC-BY-SA</a>
      </li>
    </ul>
    <ul class="footer-navigation">
      <li class="footer-navigation__item">
        <a class="footer-navigation__link" href="https://martinschneider.me" rel="me">martinschneider.me</a>
      </li>
      <li class="footer-navigation__item">
        <a class="footer-navigation__link" href="https://mastodon.social/@schneyra" rel="me">Mastodon</a>
      </li>
    </ul>
  </nav>
</footer>

<?= js('assets/js/video.js') ?>

<script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "Person",
    "email": "mailto:hallo@martinschneider.me",
    "image": "<?= $site->url() ?>/images/avatar.jpg",
    "jobTitle": "Frontend-Developer, Diplom Informatiker (FH)",
    "name": "Martin Schneider",
    "url": "https://martinschneider.me",
    "sameAs": [
      "https://www.dertagundich.de/",
      "https://github.com/schneyra/",
      "https://mastodon.social/@schneyra",
      "https://www.linkedin.com/in/martin-schneider-b941bb5b/",
      "https://www.xing.com/profile/Martin_Schneider68/cv"
    ]
  }
</script>

<script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "WebSite",
    "url": "<?= $site->url() ?>"
  }
</script>
</body>
</html>
