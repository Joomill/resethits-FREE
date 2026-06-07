# Changelog

All notable changes to the Extension are documented in this file.

## 5.1.0
- Security: added CSRF token protection to all reset actions.
- Refactor: moved the reset handling out of the layout into the module Dispatcher.
- Improvement: reset queries now use the Joomla Input API and prepared statements (bound parameters).
- Improvement: helper methods return their markup instead of echoing it.
- Standards: consistent `\defined('_JEXEC')` guards, coding-style normalisation (tabs), GPL v3 headers throughout, and the manifest aligned to the Joomill standard.
- Compatibility: minimum required Joomla version raised to 5.0.

## TODO
- Addition: help buttons now link to the Joomill documentation page
- Addition: Support Plugin lazy loading for PHP >= 8.4: Added a possibility to load plugin class on demand (lazy loading) when the event dispatched. For servers with PHP version >= 8.4.
- Check other updates in the past: https://github.com/joomla/Manual/tree/main/updates
- Check bc for Joomla 7 release: https://github.com/joomla/Manual/blob/main/updates/64-70/removed-backward-incompatibility.md
