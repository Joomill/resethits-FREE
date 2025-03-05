<?php
/*
 *  package: Reset Hits module - FREE Version
 *  copyright: Copyright (c) 2025. Jeroen Moolenschot | Joomill
 *  license: GNU General Public License version 3 or later
 *  link: https://www.joomill-extensions.com
 */

namespace Joomill\Module\Resethits\Administrator\Helper;

// No direct access.
\defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;

class ResethitsHelper
{
    public static function getLanguage()
    {
        $Language = '';
        $db = Factory::getContainer()->get('DatabaseDriver');
        $query = $db->getQuery(true)
            ->select('lang_code,title')
            ->from('#__languages');
        $db->setQuery((string)$query);
        $result = $db->loadObjectList();
        $languages[] = HTMLHelper::_('select.option', '', Text::_('MOD_RESETHITS_SELECT_LANGUAGE'));
        foreach ($result as $row) {
            $languages[] = HTMLHelper::_('select.option', $row->lang_code, $row->title);
        }
        $languagelist = HTMLHelper::_('select.genericlist', $languages, 'lang_code', 'class="inputbox"', 'value', 'text', $Language);
        echo $languagelist;
    }

    // Content Helpers
    public static function getContentArticles()
    {
        $ContentArticle = '';
        $db = Factory::getContainer()->get('DatabaseDriver');
        $query = $db->getQuery(true)
            ->select('id,title')
            ->from($db->quoteName('#__content'));
        $db->setQuery((string)$query);
        $result = $db->loadObjectList();
        $articles[] = HTMLHelper::_('select.option', '', Text::_('MOD_RESETHITS_SELECT_ARTICLE'));
        foreach ($result as $row) {
            $articles[] = HTMLHelper::_('select.option', $row->id, $row->title);
        }
        $articlelist = HTMLHelper::_('select.genericlist', $articles, 'id', 'class="inputbox"', 'value', 'text', $ContentArticle);
        echo $articlelist;
    }

    public static function getContentCategories()
    {
        $ContentCategory = '';
        $db = Factory::getContainer()->get('DatabaseDriver');
        $query = $db->getQuery(true)
            ->select('id,title')
            ->from($db->quoteName('#__categories'))
            ->where($db->quoteName('extension') . ' = ' . $db->quote('com_content'));
        $db->setQuery((string)$query);
        $result = $db->loadObjectList();
        $categories[] = HTMLHelper::_('select.option', '', Text::_('MOD_RESETHITS_SELECT_CATEGORY'));
        foreach ($result as $row) {
            $categories[] = HTMLHelper::_('select.option', $row->id, $row->title);
        }
        $categorylist = HTMLHelper::_('select.genericlist', $categories, 'catid', 'class="inputbox"', 'value', 'text', $ContentCategory);
        echo $categorylist;
    }

    public static function getContentAuthor()
    {
        $ContentAuthor = '';
        $db = Factory::getContainer()->get('DatabaseDriver');
        $query = $db->getQuery(true)
            ->select('id,name')
            ->from('#__users');
        $db->setQuery((string)$query);
        $result = $db->loadObjectList();
        $users[] = HTMLHelper::_('select.option', '', Text::_('MOD_RESETHITS_SELECT_AUTHOR'));
        foreach ($result as $row) {
            $users[] = HTMLHelper::_('select.option', $row->id, $row->name);
        }
        $userlist = HTMLHelper::_('select.genericlist', $users, 'created_by', 'class="inputbox"', 'value', 'text', $ContentAuthor);
        echo $userlist;
    }

    public static function getContentFeatured()
    {
        $ContentFeatured = '';
        $articlefeatured[] = HTMLHelper::_('select.option', '', Text::_('MOD_RESETHITS_SELECT_FEATURED'));
        $articlefeatured[] = HTMLHelper::_('select.option', '1', Text::_('MOD_RESETHITS_SELECT_FEATURED_YES'));
        $articlefeatured[] = HTMLHelper::_('select.option', '0', Text::_('MOD_RESETHITS_SELECT_FEATURED_NO'));
        $articlefeaturedlist = HTMLHelper::_('select.genericlist', $articlefeatured, 'featured', 'class="inputbox"', 'value', 'text', $ContentFeatured);
        echo $articlefeaturedlist;
    }

    public static function getContentState()
    {
        $ContentState = '';
        $articlestate[] = HTMLHelper::_('select.option', '', Text::_('MOD_RESETHITS_SELECT_STATE'));
        $articlestate[] = HTMLHelper::_('select.option', '1', Text::_('JPUBLISHED'));
        $articlestate[] = HTMLHelper::_('select.option', '0', Text::_('JUNPUBLISHED'));
        $articlestate[] = HTMLHelper::_('select.option', '2', Text::_('JARCHIVED'));
        $articlestate[] = HTMLHelper::_('select.option', '-2', Text::_('JTRASHED'));
        $articlestatelist = HTMLHelper::_('select.genericlist', $articlestate, 'state', 'class="inputbox"', 'value', 'text', $ContentState);
        echo $articlestatelist;
    }

    // Banner Helpers
    public static function getBanners()
    {
        $Banners = '';
        $db = Factory::getContainer()->get('DatabaseDriver');
        $query = $db->getQuery(true)
            ->select('id,name')
            ->from('#__banners');
        $db->setQuery((string)$query);
        $result = $db->loadObjectList();
        $banner[] = HTMLHelper::_('select.option', '', Text::_('MOD_RESETHITS_SELECT_BANNER'));
        foreach ($result as $row) {
            $banner[] = HTMLHelper::_('select.option', $row->id, $row->name);
        }
        $bannerlist = HTMLHelper::_('select.genericlist', $banner, 'bannerid', 'class="inputbox"', 'value', 'text', $Banners);
        echo $bannerlist;
    }

    public static function getBannerCategories()
    {
        $BannerCategory = '';
        $db = Factory::getContainer()->get('DatabaseDriver');
        $query = $db->getQuery(true)
            ->select('id,title')
            ->from($db->quoteName('#__categories'))
            ->where($db->quoteName('extension') . ' = ' . $db->quote('com_banners'));
        $db->setQuery((string)$query);
        $result = $db->loadObjectList();
        $categories[] = HTMLHelper::_('select.option', '', Text::_('MOD_RESETHITS_SELECT_CATEGORY'));
        foreach ($result as $row) {
            $categories[] = HTMLHelper::_('select.option', $row->id, $row->title);
        }
        $bannercategorylist = HTMLHelper::_('select.genericlist', $categories, 'bannercatid', 'class="inputbox"', 'value', 'text', $BannerCategory);
        echo $bannercategorylist;
    }

    public static function getBannerClients()
    {
        $BannerClients = '';
        $db = Factory::getContainer()->get('DatabaseDriver');
        $query = $db->getQuery(true)
            ->select('id,name')
            ->from('#__banner_clients');
        $db->setQuery((string)$query);
        $result = $db->loadObjectList();
        $client[] = HTMLHelper::_('select.option', '', Text::_('MOD_RESETHITS_SELECT_CLIENT'));
        foreach ($result as $row) {
            $client[] = HTMLHelper::_('select.option', $row->id, $row->name);
        }
        $clientlist = HTMLHelper::_('select.genericlist', $client, 'bannerclientid', 'class="inputbox"', 'value', 'text', $BannerClients);
        echo $clientlist;
    }

    public static function getBannerLanguage()
    {
        $BannerLanguage = '';
        $db = Factory::getContainer()->get('DatabaseDriver');
        $query = $db->getQuery(true)
            ->select('lang_code,title')
            ->from('#__languages');
        $db->setQuery((string)$query);
        $result = $db->loadObjectList();
        $bannerlanguages[] = HTMLHelper::_('select.option', '', Text::_('MOD_RESETHITS_SELECT_LANGUAGE'));
        foreach ($result as $row) {
            $bannerlanguages[] = HTMLHelper::_('select.option', $row->lang_code, $row->title);
        }
        $bannerlanguagelist = HTMLHelper::_('select.genericlist', $bannerlanguages, 'bannerlanguage', 'class="inputbox"', 'value', 'text', $BannerLanguage);
        echo $bannerlanguagelist;
    }

    public static function getBannerPinned()
    {
        $BannerPinned = '';
        $bannerspinned[] = HTMLHelper::_('select.option', '', Text::_('MOD_RESETHITS_SELECT_PINNED'));
        $bannerspinned[] = HTMLHelper::_('select.option', '1', Text::_('MOD_RESETHITS_SELECT_PINNED_YES'));
        $bannerspinned[] = HTMLHelper::_('select.option', '0', Text::_('MOD_RESETHITS_SELECT_PINNED_NO'));
        $bannerspinnedlist = HTMLHelper::_('select.genericlist', $bannerspinned, 'bannerpinned', 'class="inputbox"', 'value', 'text', $BannerPinned);
        echo $bannerspinnedlist;
    }

    public static function getBannerState()
    {
        $BannerState = '';
        $bannersstate[] = HTMLHelper::_('select.option', '', Text::_('MOD_RESETHITS_SELECT_STATE'));
        $bannersstate[] = HTMLHelper::_('select.option', '1', Text::_('JPUBLISHED'));
        $bannersstate[] = HTMLHelper::_('select.option', '0', Text::_('JUNPUBLISHED'));
        $bannersstate[] = HTMLHelper::_('select.option', '2', Text::_('JARCHIVED'));
        $bannersstate[] = HTMLHelper::_('select.option', '-2', Text::_('JTRASHED'));
        $bannersstatelist = HTMLHelper::_('select.genericlist', $bannersstate, 'bannerstate', 'class="inputbox"', 'value', 'text', $BannerState);
        echo $bannersstatelist;
    }

    // User Helpers
    public static function getUserPassword()
    {
        $UserPassword = '';
        $db = Factory::getContainer()->get('DatabaseDriver');
        $query = $db->getQuery(true)
            ->select('id,name')
            ->from('#__users');
        $db->setQuery((string)$query);
        $result = $db->loadObjectList();
        $users[] = HTMLHelper::_('select.option', '', Text::_('MOD_RESETHITS_SELECT_USER'));
        foreach ($result as $row) {
            $users[] = HTMLHelper::_('select.option', $row->id, $row->name);
        }
        $userpasswordlist = HTMLHelper::_('select.genericlist', $users, 'user', 'class="inputbox"', 'value', 'text', $UserPassword);
        echo $userpasswordlist;
    }

    public static function getUserGroupPassword()
    {
        $UserGroupPassword = '';
        $db = Factory::getContainer()->get('DatabaseDriver');
        $query = $db->getQuery(true)
            ->select('id,title')
            ->from('#__usergroups');
        $db->setQuery((string)$query);
        $result = $db->loadObjectList();
        $usergroups[] = HTMLHelper::_('select.option', '', Text::_('MOD_RESETHITS_SELECT_USERGROUP'));
        foreach ($result as $row) {
            $usergroups[] = HTMLHelper::_('select.option', $row->id, $row->title);
        }
        $usergrouppasswordlist = HTMLHelper::_('select.genericlist', $usergroups, 'usergroup', 'class="inputbox"', 'value', 'text', $UserGroupPassword);
        echo $usergrouppasswordlist;
    }
}