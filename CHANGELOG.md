# Changelog

All notable changes to the Extension are documented in this file.

## Unreleased
- Addition: Custom CSS field in the advanced options to add inline styling, output through the WebAssetManager
- Addition: the Help toolbar button on the module edit screen now links to the Joomill documentation page
- Refactor: converted ResethitsHelper from static methods to an instantiated helper resolved through the module HelperFactory, in line with Joomla 7's dependency-injection direction.
- Standards: rebuilt the installer script to the Joomill InstallerScriptInterface standard (typed signatures, install/update/uninstall, try/catch error logging and a language safety net).

## 5.1.2 - 08/07/2026
- Addition: Downloads from the Joomill update server now include diagnostic request headers with site and environment information

## 5.1.1
- Fix: banner clicks reset showed the impressions success message instead of the clicks success message.
- Update: expanded reset type descriptions across all 6 languages (de, en, es, fr, it, nl) to include a second sentence clarifying what is not affected by the reset.

## 5.1.0
- Security: added CSRF token protection to all reset actions.
- Refactor: moved the reset handling out of the layout into the module Dispatcher.
- Improvement: reset queries now use the Joomla Input API and prepared statements (bound parameters).
- Improvement: helper methods return their markup instead of echoing it.
- Standards: consistent `\defined('_JEXEC')` guards, coding-style normalisation (tabs), GPL v3 headers throughout, and the manifest aligned to the Joomill standard.
- Compatibility: minimum required Joomla version raised to 5.0.
- Update: restyled the FREE upgrade notice to a single inline success alert, shown in the dashboard and on the module options screen.
- Update: modernized the PRO upsell to a namespaced ProField that renders a PRO badge linking to the upgrade page.

## TODO