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

use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Helper\ModuleHelper;
use Joomla\CMS\Router\Route;

$wa = $app->getDocument()->getWebAssetManager();

if ($params->get('custom_css')) {
    $wa->addInlineStyle($params->get('custom_css'));
}

?>

    <style>
        .resethits-options {
            padding-left: 30px;
            padding-right: 30px;
        }

        .resethits-options joomla-field-fancy-select {
            padding-bottom: 20px;
            display: block;
        }

        .resethits-options .choices.is-open .choices__list--dropdown {
            position: inherit;
        }
    </style>

    <form action="<?php echo Route::_('index.php'); ?>" id="resethits" name="resethits" method="post">
        <ul id="resethits-wrapper" class="list-group list-group-flush resethits">
            <?php require ModuleHelper::getLayoutPath('mod_resethits', $params->get('layout', 'default') . '_items'); ?>
        </ul>
        <?php require ModuleHelper::getLayoutPath('mod_resethits', $params->get('layout', 'default') . '_pro_article_options'); ?>
        <?php require ModuleHelper::getLayoutPath('mod_resethits', $params->get('layout', 'default') . '_pro_banner_options'); ?>
        <?php require ModuleHelper::getLayoutPath('mod_resethits', $params->get('layout', 'default') . '_pro_user_options'); ?>
        <?php echo HTMLHelper::_('form.token'); ?>
    </form>
