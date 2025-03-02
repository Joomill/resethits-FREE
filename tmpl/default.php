<?php
/*
 *  package: Reset Hits module - FREE Version
 *  copyright: Copyright (c) 2025. Jeroen Moolenschot | Joomill
 *  license: GNU General Public License version 2 or later
 *  link: https://www.joomill-extensions.com
 */

// No direct access.
defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\Helper\ModuleHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Router\Route;

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
    </form>

<?php
if ((isset($_POST['resethits'])) and ($_POST['resethits'] == 'com_content_hits')) {
    $db = Factory::getContainer()->get('DatabaseDriver');
    $query = $db->getQuery(true)
        ->update($db->quoteName('#__content'))
        ->set($db->quoteName('hits') . ' = 0');

    $db->setQuery($query)->execute();
    Factory::getApplication()->enqueueMessage(Text::_('MOD_RESETHITS_ARTICLE_HITS_SUCCESS'), 'success');
}

if ((isset($_POST['resethits'])) and ($_POST['resethits'] == 'com_content_revisions')) {
    $db = Factory::getContainer()->get('DatabaseDriver');
    $query = $db->getQuery(true)
        ->update($db->quoteName('#__content'))
        ->set($db->quoteName('version') . ' = 0');

    $db->setQuery($query)->execute();
    Factory::getApplication()->enqueueMessage(Text::_('MOD_RESETHITS_ARTICLE_REVISIONS_SUCCESS'), 'success');
}

if ((isset($_POST['resethits'])) and ($_POST['resethits'] == 'com_banner_impressions')) {
    $db = Factory::getContainer()->get('DatabaseDriver');
    $query = $db->getQuery(true)
        ->update($db->quoteName('#__banners'))
        ->set($db->quoteName('impmade') . ' = 0');

    $db->setQuery($query)->execute();
    Factory::getApplication()->enqueueMessage(Text::_('MOD_RESETHITS_BANNER_IMPRESSIONS_SUCCESS'), 'success');
}

if ((isset($_POST['resethits'])) and ($_POST['resethits'] == 'com_banner_clicks')) {
    $db = Factory::getContainer()->get('DatabaseDriver');
    $query = $db->getQuery(true)
        ->update($db->quoteName('#__banners'))
        ->set($db->quoteName('clicks') . ' = 0');

    $db->setQuery($query)->execute();
    Factory::getApplication()->enqueueMessage(Text::_('MOD_RESETHITS_BANNER_IMPRESSIONS_SUCCESS'), 'success');
}

if ((isset($_POST['resethits'])) and ($_POST['resethits'] == 'com_user_password')) {
    $db = Factory::getContainer()->get('DatabaseDriver');
    $query = $db->getQuery(true)
        ->update($db->quoteName('#__users'))
        ->set($db->quoteName('resetCount') . ' = 0');

    $db->setQuery($query)->execute();
    Factory::getApplication()->enqueueMessage(Text::_('MOD_RESETHITS_USER_PASSWORD_SUCCESS'), 'success');
}
?>