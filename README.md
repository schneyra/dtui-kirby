# dtui-kirby

[der tag und ich](https://www.dertagundich.de) goes [Kirby](https://getkirby.com).

## Entwicklung
### Entwicklungsumgebung
- `docker compose up`
- http://localhost:2909

### Linting und Tests
- `docker compose exec dtui "npm" run stylelint` (WIP)
- `docker compose exec dtui "phpunit" tests/phpunit/urlTest.php` (WIP)
- `docker compose exec dtui "php-cs-fixer" check`

### CSS-Build
CSS wird nur für Prod gebaut in der Github-Action gebaut.
Zum lokalen Test: `docker compose exec dtui "npm" run postcss`.
