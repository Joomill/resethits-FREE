<?php
/*
 *  package: Reset Hits module - FREE Version
 *  copyright: Copyright (c) 2026. Jeroen Moolenschot | Joomill
 *  license: GNU General Public License version 3 or later
 *  link: https://www.joomill-extensions.com
 */

namespace Joomill\Module\Resethits\Administrator\Dispatcher;

use Joomla\CMS\Dispatcher\AbstractModuleDispatcher;
use Joomla\CMS\Factory;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Session\Session;
use Joomla\Database\DatabaseInterface;

// No direct access.
\defined('_JEXEC') or die;

class Dispatcher extends AbstractModuleDispatcher
{
	/**
	 * Returns the layout data.
	 *
	 * @return  array
	 *
	 * @since   5.1.0
	 */
	protected function getLayoutData()
	{
		$data = parent::getLayoutData();

		$this->handleReset();

		return $data;
	}

	/**
	 * Processes a reset request submitted from the module form.
	 *
	 * @return  void
	 *
	 * @since   5.1.0
	 */
	private function handleReset(): void
	{
		if (strtoupper($this->input->getMethod()) !== 'POST') {
			return;
		}

		$task = $this->input->post->getCmd('resethits');

		if ($task === '') {
			return;
		}

		// CSRF protection.
		if (!Session::checkToken('post')) {
			$this->app->enqueueMessage(Text::_('JINVALID_TOKEN'), 'error');

			return;
		}

		switch ($task) {
			case 'com_content_hits':
				$this->resetContent('hits', 'MOD_RESETHITS_ARTICLE_HITS_SUCCESS');
				break;

			case 'com_content_revisions':
				$this->resetContent('version', 'MOD_RESETHITS_ARTICLE_REVISIONS_SUCCESS');
				break;

			case 'com_banner_impressions':
				$this->resetBanner('impmade', 'MOD_RESETHITS_BANNER_IMPRESSIONS_SUCCESS');
				break;

			case 'com_banner_clicks':
				$this->resetBanner('clicks', 'MOD_RESETHITS_BANNER_IMPRESSIONS_SUCCESS');
				break;

			case 'com_user_password':
				$this->resetUserPassword();
				break;

			case 'com_redirects':
				$this->resetRedirects();
				break;
		}
	}

	/**
	 * Returns the database driver from the container.
	 *
	 * @return  DatabaseInterface
	 *
	 * @since   5.1.0
	 */
	private function getDb(): DatabaseInterface
	{
		return Factory::getContainer()->get(DatabaseInterface::class);
	}

	/**
	 * Resets a counter column on the content table.
	 *
	 * @param   string  $column      The column to reset to zero.
	 * @param   string  $successKey  The language key for the success message.
	 *
	 * @return  void
	 *
	 * @since   5.1.0
	 */
	private function resetContent(string $column, string $successKey): void
	{
		$db = $this->getDb();

		$query = $db->getQuery(true)
			->update($db->quoteName('#__content'))
			->set($db->quoteName($column) . ' = 0');

		$db->setQuery($query)->execute();
		$this->app->enqueueMessage(Text::_($successKey), 'success');
	}

	/**
	 * Resets a counter column on the banners table.
	 *
	 * @param   string  $column      The column to reset to zero.
	 * @param   string  $successKey  The language key for the success message.
	 *
	 * @return  void
	 *
	 * @since   5.1.0
	 */
	private function resetBanner(string $column, string $successKey): void
	{
		$db = $this->getDb();

		$query = $db->getQuery(true)
			->update($db->quoteName('#__banners'))
			->set($db->quoteName($column) . ' = 0');

		$db->setQuery($query)->execute();
		$this->app->enqueueMessage(Text::_($successKey), 'success');
	}

	/**
	 * Resets the password reset counter on the users table.
	 *
	 * @return  void
	 *
	 * @since   5.1.0
	 */
	private function resetUserPassword(): void
	{
		$db = $this->getDb();

		$query = $db->getQuery(true)
			->update($db->quoteName('#__users'))
			->set($db->quoteName('resetCount') . ' = 0');

		$db->setQuery($query)->execute();
		$this->app->enqueueMessage(Text::_('MOD_RESETHITS_USER_PASSWORD_SUCCESS'), 'success');
	}

	/**
	 * Resets the hit counter on the redirect links table.
	 *
	 * @return  void
	 *
	 * @since   5.1.0
	 */
	private function resetRedirects(): void
	{
		$db = $this->getDb();

		$query = $db->getQuery(true)
			->update($db->quoteName('#__redirect_links'))
			->set($db->quoteName('hits') . ' = 0');

		$db->setQuery($query)->execute();
		$this->app->enqueueMessage(Text::_('MOD_RESETHITS_REDIRECTS_SUCCESS'), 'success');
	}
}
