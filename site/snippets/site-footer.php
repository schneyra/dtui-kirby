</main>

<footer class="site-footer">
  <nav aria-label="Footer-Navigation" class="footer-navigation-wrapper">
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
