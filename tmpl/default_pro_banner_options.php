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

use Joomla\CMS\Language\Text;

?>

	<div class="row">
		<div class="collapse resethits-options" id="pro-banner-options" data-bs-parent="#resethits">
			<a class="btn btn-success btn-sm resethits-pro-badge mb-3" href="https://www.joomill-extensions.com/extensions/reset-article-views-hits-counter" target="_blank" rel="noopener noreferrer">
				<span class="icon-star icon-white" aria-hidden="true"></span> <?php echo Text::_('MOD_RESETHITS_PRO_ONLY'); ?>
			</a>
		</div>
	</div>
