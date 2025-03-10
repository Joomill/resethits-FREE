<?php
/*
 *  package: Reset Hits module - FREE Version
 *  copyright: Copyright (c) 2025. Jeroen Moolenschot | Joomill
 *  license: GNU General Public License version 3 or later
 *  link: https://www.joomill-extensions.com
 */

// No direct access.
defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\Language\Text;

Factory::getApplication()->getDocument()->getWebAssetManager()
	->usePreset('choicesjs')
	->useScript('webcomponent.field-fancy-select');
?>

<div class="row">
    <div class="collapse resethits-options" id="pro-article-options" data-bs-parent="#resethits">
        <hr/>
        <joomla-alert type="danger" class="joomla-alert--show" role="alert">
            <div class="alert-heading"><span class="danger"></span><span class="visually-hidden">Error</span></div>
            <div class="alert-wrapper">
                <div class="alert-message"><?php echo Text::_('MOD_RESETHITS_PRO_ONLY'); ?></div>
            </div>
        </joomla-alert>
    </div>
</div>

