# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

> Dit bestand is identiek bedoeld in `ResetHits-FREE` en `ResetHits-PRO`. Pas je het aan, pas het dan in beide repos aan.

## Wat dit is

Reset Hits is een Joomla administrator-module (`mod_resethits`, positie `cpanel`) waarmee je vanuit het Control Panel tellers reset: artikel-hits, artikel-revisies, banner-impressions, banner-clicks, gebruikerswachtwoorden en redirect-hits (404). Joomla 5 en 6.

Twee edities, twee aparte git-repos, identieke mappenstructuur:
- **FREE** - `C:\laragon\www\dev\extensions\ResetHits-FREE` -> github `Joomill/resethits-FREE`
- **PRO** - `C:\laragon\www\dev\extensions\ResetHits-PRO` -> github `Joomill/resethits-PRO`

Doel: beide edities zo veel mogelijk uit een gedeelde codebase laten lopen. De repos zijn nu ~95% gelijk; de verschillen staan hieronder volledig opgesomd. Houd alle overige bestanden byte-voor-byte gelijk.

## PRO-only system-plugin (plg_system_resethits)

Naast de module bestaat er een losse Joomla system-plugin `plg_system_resethits` (namespace `Joomill\Plugin\System\Resethits`, groep `system`, element `resethits`) die "Reset Hits"-toolbarknoppen toevoegt aan de native admin-schermen (artikelen, banners, gebruikers, redirects) en de tellers reset voor geselecteerde records, de gefilterde lijst, of een enkel record vanuit het bewerkscherm. De plugin werkt direct op de native lijst-/bewerkschermen; de module blijft het losse `cpanel`-paneel.

Deze plugin staat **alleen in de PRO-repo**, onder `plugin/plg_system_resethits/`. Bewuste keuze (2026-06-19): de plugin wordt NIET naar FREE gesynchroniseerd; de FREE-repo bevat alleen de module. De "houd alles byte-identiek"-regel hieronder geldt dus voor de module-bestanden, niet voor de `plugin/`-map (die bestaat enkel in PRO). De plugin heeft zijn eigen `CHANGELOG.md`, manifest (`plugin/plg_system_resethits/resethits.xml`, `cat=6`) en 6 talen, en is verder onafhankelijk van de module.

## Architectuur

Moderne, namespaced Joomla-module (sinds v5.0.0), namespace `Joomill\Module\Resethits`:

- `services/provider.php` - DI-bootstrap, registreert de module via `ModuleDispatcherFactory` + `HelperFactory`.
- `src/Dispatcher/Dispatcher.php` - entrypoint en POST-handler. `getLayoutData()` roept `handleReset()` aan: die checkt de CSRF-token (`Session::checkToken('post')`), leest input via de Input API (`$this->input->post->getInt/getCmd`) en voert de reset-queries uit met prepared statements (`bind()` + `ParameterType`). `mod_resethits.php` is een dunne wrapper.
- `src/Helper/ResethitsHelper.php` - bouwt alle dropdown-/fancy-select-lijsten (artikelen, categorieen, taal, auteur, featured, state, banners + banner-cats/clients/language/pinned/state, users, usergroups). Functioneel identiek tussen FREE en PRO; FREE bevat alle methodes al, ook al gebruikt de FREE-UI ze niet.
- `tmpl/`:
  - `default.php` - pure presentatie: het formulier met de CSRF-token (`HTMLHelper::_('form.token')`) en de includes van de deellayouts. De reset-knoppen sturen `name="resethits"` met `value="com_content_hits"`, `com_banner_clicks`, etc.; de afhandeling zit in de Dispatcher, niet meer in deze template.
  - `default_items.php` - lijst met reset-knoppen per type.
  - `default_pro_article_options.php`, `default_pro_banner_options.php`, `default_pro_user_options.php` - uitklapbare filterpanelen.
- `language/` - 6 talen (de, en, es, fr, it, nl), elk `.ini` + `.sys.ini`.
- `script.php` - installer: preflight (min. PHP en Joomla 5.0), publiceert de module na install in `cpanel`, toont thank-you/uninstall-bericht. Class: `mod_resethitsInstallerScript`.
- `mod_resethits.xml` - manifest (root = installpakket-manifest).

## FREE vs PRO - de enige toegestane verschillen

Onderstaande lijst is het volledige verschil tussen de twee repos. Al het andere hoort identiek te zijn. Zet je een fix over van de ene naar de andere, kopieer dan 1-op-1 en respecteer alleen deze punten:

1. **Gefilterd resetten (de PRO-feature).** In `src/Dispatcher/Dispatcher.php` voegt PRO in de reset-methodes `->where(...)->bind(...)`-filters toe op basis van de Input (`id`, `catid`, `lang_code`, `created_by`, `featured`, `state` voor artikelen; equivalent voor banners/users). FREE reset altijd alles, zonder filter. Hierdoor is `Dispatcher.php` het enige PHP-bestand dat functioneel verschilt; `tmpl/default.php` is identiek.
2. **`tmpl/default_pro_*.php`.** FREE toont een `joomla-alert type="danger"` met `MOD_RESETHITS_PRO_ONLY` (upgrade-melding). PRO rendert de echte `joomla-field-fancy-select`-filters via `ResethitsHelper::get*()`.
3. **`tmpl/default_items.php`.** FREE heeft onderaan de upgrade-footer (`MOD_RESETHITS_FREE_VERSION` + link naar de PRO-pagina). PRO niet.
4. **`mod_resethits.xml`.** Versie `5.0.0 PRO` vs `5.0.0`; `changelogurl`/`updateservers` op `cat=6` (PRO) vs `cat=2` (FREE); PRO heeft `<dlid prefix="key=" suffix=""/>`, FREE niet.
5. **Header-comment.** `package: Reset Hits module - PRO Version` vs `- FREE Version` bovenaan elk bestand.

## Codeer-stijl (genormaliseerd 2026-06-07)

Beide repos volgen een gedeelde stijl, zodat een `diff` tussen FREE en PRO alleen de bedoelde verschillen toont. Houd je hieraan bij elke wijziging:

- Indentatie met tabs, geen spaties.
- Allman-accolades voor class en method, K&R (op dezelfde regel) voor control-structures (`if`, `foreach`).
- Geen trailing whitespace.
- GPL v3 in elke header (de `license:`-regel) en in het manifest (`<license>`).

De functioneel identieke bestanden (`mod_resethits.php`, `script.php`, `services/provider.php`, `src/Helper/ResethitsHelper.php`, `tmpl/default.php`) zijn byte-identiek tussen FREE en PRO, op de `package:`-headerregel na. Alleen `src/Dispatcher/Dispatcher.php` plus de template/manifest-punten hierboven verschillen functioneel. Zet je een wijziging in de ene repo, voer hem identiek door in de andere.

## Samentrekken naar een codebase

Witruimte en stijl zijn genormaliseerd; een `diff` toont nu alleen nog de echte verschillen. Volgende stap is een echte gedeelde kern: PRO is de superset, FREE een afgeleide. Bespreek de bouwstrategie (build-script dat PRO naar FREE stript, of gedeelde kern via git subtree/submodule) voordat je grootschalig herstructureert.

## Bouwen, testen, deployen

- **Geen testsuite of build-tooling.** Het is een Joomla-module; "build" = de repo-map zippen tot installeerbaar pakket (manifest `mod_resethits.xml` staat in de root). Geen composer/npm.
- **Lokaal testen:** installeren in een Joomla 5/6 site onder `C:\laragon\www\`. Deploy via PhpStorm naar de deploy-server (zie `.idea/deployment.xml`).
- **Releasen:** versie bumpen in `mod_resethits.xml` en `CHANGELOG.md`. Updates lopen live via de Joomla update-server (de `cat=2`/`cat=6`-endpoints op joomill-extensions.com).

## Conventies

- De extensienaam wordt nooit vertaald: de string `MOD_RESETHITS` is in alle taalbestanden identiek; overige strings wel vertalen en de 6 talen synchroon houden.
- `mod_resethits.xml` volgt de vaste Joomill manifest-standaard (element-volgorde, waarden, sectie-comments) uit `30-snippets/joomla-extension-manifest.md` in de Obsidian-vault.
- De FREE upgrade-notice volgt de Joomill-brede stijl voor gratis extensies (zie `30-snippets/_index.md` in de vault).
