<?php
/*
 *  package: Reset Hits module - FREE Version
 *  copyright: Copyright (c) 2025. Jeroen Moolenschot | Joomill
 *  license: GNU General Public License version 2 or later
 *  link: https://www.joomill-extensions.com
 */

// No direct access.
defined('_JEXEC') or die;

use Joomla\CMS\Helper\ModuleHelper;

// Get Joomla Layout
require ModuleHelper::getLayoutPath('mod_resethits', $params->get('layout', 'default'));