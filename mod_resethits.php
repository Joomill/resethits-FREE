<?php

/**
 * Reset Hits
 *
 * @copyright   Copyright (c) 2026 Jeroen Moolenschot | Joomill
 * @license     GNU General Public License version 3 or later; see LICENSE
 * @link        https://www.joomill-extensions.com
 */

// No direct access.
\defined('_JEXEC') or die;

use Joomla\CMS\Helper\ModuleHelper;

// Get Joomla Layout
require ModuleHelper::getLayoutPath('mod_resethits', $params->get('layout', 'default'));
