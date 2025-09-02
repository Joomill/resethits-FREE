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
use Joomla\CMS\Installer\InstallerAdapter;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Log\Log;

/**
 * Script file of Reset Hits module
 *
 * @since  4.0.0
 */
class mod_ResethitsInstallerScript
{
	/**
	 * Minimum Joomla version to check
	 *
	 * @var    string
	 * @since  4.0.0
	 */
	private $minimumJoomlaVersion = '4.0';

	/**
	 * Minimum PHP version to check
	 *
	 * @var    string
	 * @since  4.0.0
	 */
	private $minimumPHPVersion = JOOMLA_MINIMUM_PHP;


	/**
	 * Function called before extension installation/update/removal procedure commences
	 *
	 * @param string $type The type of change (install, update or discover_install, not uninstall)
	 * @param InstallerAdapter $parent The class calling this method
	 * @return  boolean  True on success
	 * @throws Exception
	 * @since  4.0.0
	 */
	public function preflight($type, $parent): bool
	{
		if ($type !== 'uninstall') {
			// Check for the minimum PHP version before continuing
			if (!empty($this->minimumPHPVersion) && version_compare(PHP_VERSION, $this->minimumPHPVersion, '<')) {
				Log::add(
					Text::sprintf('JLIB_INSTALLER_MINIMUM_PHP', $this->minimumPHPVersion),
					Log::WARNING,
					'jerror'
				);
				return false;
			}
			// Check for the minimum Joomla version before continuing
			if (!empty($this->minimumJoomlaVersion) && version_compare(JVERSION, $this->minimumJoomlaVersion, '<')) {
				Log::add(
					Text::sprintf('JLIB_INSTALLER_MINIMUM_JOOMLA', $this->minimumJoomlaVersion),
					Log::WARNING,
					'jerror'
				);
				return false;
			}
		}
		return true;
	}

	/**
	 * Function called during the installation of the extension
	 *
	 * @param InstallerAdapter $parent The class calling this method
	 * @return boolean True on success
	 * @since 4.0.0
	 */
	public function install($parent)
	{
		// Enable the extension
		$this->enableModule();

		return true;
	}

	/**
	 * Enable the module by publishing it and assigning it to the cpanel position
	 *
	 * @return void
	 * @since  4.0.0
	 */
	private function enableModule()
	{
		// Check if Module has not been published yet
		$db = Factory::getContainer()->get('DatabaseDriver');
		$query = $db->getQuery(true);
		$query->select($db->quoteName('id'));
		$query->from($db->quoteName('#__modules'));
		$query->where($db->quoteName('module') . ' = ' . $db->quote('mod_resethits'));
		$query->where($db->quoteName('published') . ' = 1');
		$query->where($db->quoteName('position') . ' = ' . $db->quote('cpanel'));
		$db->setQuery($query);
		$moduleId = $db->loadResult();

		// If the Module has not been published, publish + assign it

		if (empty($moduleId)) {
			// Change Module settings to auto publish it on position cpanel
			$query = $db->getQuery(true);
			$fields = array(
				$db->quoteName('title') . ' = ' . $db->quote('Reset Hits module'),
				$db->quoteName('published') . ' = 1',
				$db->quoteName('position') . ' = ' . $db->quote('cpanel'),
				$db->quoteName('access') . ' = 3',
				$db->quoteName('params') . ' = ' . $db->quote('{"articlehits":1,"articlerevisions":1,"bannerimpressions":1,"bannerclicks":1,"userpassword":1,"redirects":1,
				"layout":"_:default","header_icon":"fa-solid fa-arrow-rotate-left","module_tag":"div","bootstrap_size":"0","header_tag":"h2","header_class":"","style":"0"}'),
			);
			$conditions = array($db->quoteName('module') . ' = ' . $db->quote('mod_resethits'));
			$query->update($db->quoteName('#__modules'))->set($fields)->where($conditions);
			$db->setQuery($query);
			$db->execute();

			// Get ID for module
			$query = $db->getQuery(true);
			$query->select($db->quoteName('id'));
			$query->from($db->quoteName('#__modules'));
			$query->where($db->quoteName('module') . ' = ' . $db->quote('mod_resethits'));
			$db->setQuery($query);
			$moduleId = $db->loadResult();

			// Add to modules_menu
			$query = $db->getQuery(true);
			$fields = array(
				$db->quoteName('moduleid') . ' = ' . $db->quote($moduleId),
				$db->quoteName('menuid') . ' = 0',
			);

			$query->insert($db->quoteName('#__modules_menu'))->set($fields);
			$db->setQuery($query);
			$db->execute();
		}
	}

	/**
	 * Function called after extension installation/update/removal procedure commences
	 *
	 * @param string $type The type of change (install, update or discover_install, not uninstall)
	 * @param InstallerAdapter $parent The class calling this method
	 *
	 * @return  boolean  True on success
	 * @since  4.0.0
	 */
	public function postflight($type, $parent)
	{
		if ($type === 'install') {
			echo '<style>a[target="_blank"]::before {display: none};</style>';
			echo '<div class="mb-3 text-center"><img src="https://www.joomill-extensions.com/images/joomill-logo.png" alt="Joomill Extensions" /></div>';
			echo '<div class="mb-3 text-center"><strong>' . Text::_('MOD_RESETHITS_XML_DESCRIPTION') . '</strong></div>';
            echo '<h3 class="text-center">' . Text::_('MOD_RESETHITS_THANKYOU') . '</h3>';
			echo '<br>';
			echo '<h3>' . Text::_('MOD_RESETHITS_QUICKSTART') . ':</h3>';
			echo '<ul>';
			echo '<li><a style="text-decoration: underline;" href="index.php" target="_blank">' . Text::_('MOD_RESETHITS_INSTALL_CONFIGURATION') . '</a></li>';
			echo '<li><a style="text-decoration: underline;" href="https://www.joomill-extensions.com/documentation/reset-hits-module" target="_blank">' . Text::_('MOD_RESETHITS_INSTALL_NEEDHELP') . '</a></li>';
			echo '</ul>';
			echo '<hr>';
			echo '<div class="text-center">' . Text::_('MOD_RESETHITS_FOLLOWME') . ':</div>';
			echo '<div class="text-center">';
			echo '<a class="m-2" href="https://www.linkedin.com/in/jeroenmoolenschot/" target="_blank"><i class="fa-brands fa-linkedin"> </i></a>';
			echo '<a class="m-2" href="https://www.facebook.com/Joomill" target="_blank"><i class="fa-brands fa-facebook-f"> </i></a>';
			echo '<a class="m-2" href="https://www.instagram.com/Joomill" target="_blank"><i class="fa-brands fa-instagram"> </i></a>';
			echo '<a class="m-2" href="https://bsky.app/profile/joomill.bsky.social" target="_blank"><i class="fa-brands fa-bluesky"> </i></a>';
			echo '<a class="m-2" href="https://joomla.social/@joomill" target="_blank"><i class="fa-brands fa-mastodon"> </i></a>';
			echo '<a class="m-2" href="https://www.threads.net/@joomill" target="_blank"><i class="fa-brands fa-threads"> </i></a>';
			echo '<a class="m-2" href="https://www.twitter.com/Joomill" target="_blank"><i class="fa-brands fa-brands fa-x-twitter"> </i></a>';
			echo '<a class="m-2" href="https://community.joomla.org/service-providers-directory/listings/67:joomill.html" target="_blank"><i class="fa-brands fa-joomla"> </i></a>';
			echo '</div>';
		}
		if ($type === 'uninstall') {
			echo '<style>a[target="_blank"]::before {display: none};</style>';
			echo '<div class="mb-3 text-center"><img src="https://www.joomill-extensions.com/images/joomill-logo.png" alt="Joomill Extensions" /></div>';
			echo '<br>';
			echo '<h3 class="text-center">' . Text::_('MOD_RESETHITS_THANKYOU') . '</h3>';
			echo '<br>';
			echo '<div class="text-center">' . Text::_('MOD_RESETHITS_FOLLOWME') . ':</div>';
			echo '<div class="text-center">';
			echo '<a class="m-2" href="https://www.linkedin.com/in/jeroenmoolenschot/" target="_blank"><i class="fa-brands fa-linkedin"> </i></a>';
			echo '<a class="m-2" href="https://www.facebook.com/Joomill" target="_blank"><i class="fa-brands fa-facebook-f"> </i></a>';
			echo '<a class="m-2" href="https://www.instagram.com/Joomill" target="_blank"><i class="fa-brands fa-instagram"> </i></a>';
			echo '<a class="m-2" href="https://bsky.app/profile/joomill.bsky.social" target="_blank"><i class="fa-brands fa-bluesky"> </i></a>';
			echo '<a class="m-2" href="https://joomla.social/@joomill" target="_blank"><i class="fa-brands fa-mastodon"> </i></a>';
			echo '<a class="m-2" href="https://www.threads.net/@joomill" target="_blank"><i class="fa-brands fa-threads"> </i></a>';
			echo '<a class="m-2" href="https://www.twitter.com/Joomill" target="_blank"><i class="fa-brands fa-brands fa-x-twitter"> </i></a>';
			echo '<a class="m-2" href="https://community.joomla.org/service-providers-directory/listings/67:joomill.html" target="_blank"><i class="fa-brands fa-joomla"> </i></a>';
			echo '</div>';
		}

		return true;
	}
}