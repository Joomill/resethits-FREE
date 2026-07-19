<?php

/**
 * Reset Hits
 *
 * @copyright   Copyright (c) 2026 Jeroen Moolenschot | Joomill
 * @license     GNU General Public License version 3 or later; see LICENSE
 * @link        https://www.joomill-extensions.com
 */

namespace Joomill\Module\Resethits\Administrator\Field;

use Joomla\CMS\Factory;
use Joomla\CMS\Form\FormField;
use Joomla\CMS\Language\Text;

// phpcs:disable PSR1.Files.SideEffects
\defined('_JEXEC') or die;
// phpcs:enable PSR1.Files.SideEffects

/**
 * Form field that teases a PRO-only feature.
 *
 * Renders a "PRO only" badge with an upgrade link instead of a real input, so
 * the FREE configuration screen advertises the features available in the PRO
 * version. Replaces the legacy elements/pro.php field.
 *
 * @since  5.1.0
 */
class ProField extends FormField
{
	/**
	 * The form field type.
	 *
	 * @var    string
	 * @since  5.1.0
	 */
	protected $type = 'Pro';

	/**
	 * Whether the icon-suppressing style has already been added to the document.
	 *
	 * @var    boolean
	 * @since  5.1.0
	 */
	protected static $styleLoaded = false;

	/**
	 * Returns the field input markup: a badge linking to the PRO upgrade page.
	 *
	 * @return  string  The field input markup.
	 *
	 * @since   5.1.0
	 */
	protected function getInput()
	{
		$this->loadStyle();

		return '<a class="btn btn-success btn-sm resethits-pro-badge" href="https://www.joomill-extensions.com/extensions/reset-article-views-hits-counter"'
			. ' target="_blank" rel="noopener noreferrer">'
			. '<span class="icon-star icon-white" aria-hidden="true"></span> '
			. Text::_('MOD_RESETHITS_PRO_ONLY')
			. '</a>';
	}

	/**
	 * Adds a one-off inline style that hides the admin template's external-link
	 * icon on the PRO badge, while keeping the link opening in a new tab.
	 *
	 * @return  void
	 *
	 * @since   5.1.0
	 */
	protected function loadStyle(): void
	{
		if (self::$styleLoaded) {
			return;
		}

		self::$styleLoaded = true;

		Factory::getApplication()->getDocument()->getWebAssetManager()
			->addInlineStyle('.resethits-pro-badge[target="_blank"]::before{content:none !important;}');
	}
}
