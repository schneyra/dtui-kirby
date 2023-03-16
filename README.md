# dtui-kirby

[der tag und ich](https://www.dertagundich.de) goes [Kirby](https://getkirby.com).

## Entwicklung
### Entwicklungsumgebung
- `ddev start`

### Linting und Tests
- `ddev npm run stylelint` (WIP)
- `ddev exec phpunit tests/phpunit/urlTest.php` (WIP)

### CSS-Build
CSS wird nur für Prod gebaut in der Github-Action gebaut.
Zum lokalen Test: `ddev npm run postcss`.
