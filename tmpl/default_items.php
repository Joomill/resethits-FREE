<?php
/*
 *  package: Reset Hits module - FREE Version
 *  copyright: Copyright (c) 2025. Jeroen Moolenschot | Joomill
 *  license: GNU General Public License version 3 or later
 *  link: https://www.joomill-extensions.com
 */

// No direct access.
defined('_JEXEC') or die;

use Joomla\CMS\Language\Text;

?>
<!--Article Hits-->
<?php if ($params->get('articlehits')) { ?>
    <li class="list-group-item">
        <div class="d-flex justify-content-between align-items-center">
            <div class="sample-data__title me-2">
                <span class="sample-data__icon icon-file-alt me-1" aria-hidden="true"></span>
				<?php echo Text::_('MOD_RESETHITS_ARTICLE_HITS_TITLE'); ?>
            </div>
            <div class="buttons">
                <button class="btn btn-sm" type="button" data-bs-toggle="collapse" data-bs-target="#pro-article-options"
                        aria-expanded="false" aria-controls="pro-article-options">
                    <span class="icon-cog"
                          aria-hidden="true"></span> <?php echo Text::_('MOD_RESETHITS_PRO_OPTIONS'); ?>
                    <span class="visually-hidden"><?php echo Text::_('MOD_RESETHITS_PRO_OPTIONS'); ?></span>
                </button>
                <button name="resethits" value="com_content_hits" type="submit"
                        class="btn btn-secondary btn-sm apply-resethits"
                        onclick="return confirm('<?php echo Text::_('MOD_RESETHITS_CONFIRM'); ?>');">
                    <span class="icon-undo" aria-hidden="true"></span> <?php echo Text::_('MOD_RESETHITS_RESET'); ?>
                    <span class="visually-hidden"><?php echo Text::_('MOD_RESETHITS_ARTICLE_HITS_TITLE'); ?></span>
                </button>
            </div>
        </div>
        <p class="sample-data__desc small mt-1"><?php echo Text::_('MOD_RESETHITS_ARTICLE_HITS_DESC'); ?></p>
    </li>
<?php } ?>

<!--Article Revisions-->
<?php if ($params->get('articlerevisions')) { ?>
    <li class="list-group-item">
        <div class="d-flex justify-content-between align-items-center">
            <div class="sample-data__title me-2">
                <span class="sample-data__icon icon-file-alt me-1" aria-hidden="true"></span>
				<?php echo Text::_('MOD_RESETHITS_ARTICLE_REVISIONS_TITLE'); ?>
            </div>
            <div class="buttons">
                <button class="btn btn-sm" type="button" data-bs-toggle="collapse" data-bs-target="#pro-article-options"
                        aria-expanded="false" aria-controls="pro-article-options">
                    <span class="icon-cog"
                          aria-hidden="true"></span> <?php echo Text::_('MOD_RESETHITS_PRO_OPTIONS'); ?>
                    <span class="visually-hidden"><?php echo Text::_('MOD_RESETHITS_PRO_OPTIONS'); ?></span>
                </button>
                <button name="resethits" value="com_content_revisions" type="submit"
                        class="btn btn-secondary btn-sm apply-resethits"
                        onclick="return confirm('<?php echo Text::_('MOD_RESETHITS_CONFIRM'); ?>');">
                    <span class="icon-undo" aria-hidden="true"></span> <?php echo Text::_('MOD_RESETHITS_RESET'); ?>
                    <span class="visually-hidden"><?php echo Text::_('MOD_RESETHITS_ARTICLE_REVISIONS_TITLE'); ?></span>
                </button>
            </div>
        </div>
        <p class="sample-data__desc small mt-1"><?php echo Text::_('MOD_RESETHITS_ARTICLE_REVISIONS_DESC'); ?></p>
    </li>
<?php } ?>

<!--Banner Impressions-->
<?php if ($params->get('bannerimpressions')) { ?>
    <li class="list-group-item">
        <div class="d-flex justify-content-between align-items-center">
            <div class="sample-data__title me-2">
                <span class="sample-data__icon icon-bookmark me-1" aria-hidden="true"></span>
				<?php echo Text::_('MOD_RESETHITS_BANNER_IMPRESSIONS_TITLE'); ?>
            </div>
            <div class="buttons">
                <button class="btn btn-sm" type="button" data-bs-toggle="collapse" data-bs-target="#pro-banner-options"
                        aria-expanded="false" aria-controls="pro-banner-options">
                    <span class="icon-cog"
                          aria-hidden="true"></span> <?php echo Text::_('MOD_RESETHITS_PRO_OPTIONS'); ?>
                    <span class="visually-hidden"><?php echo Text::_('MOD_RESETHITS_PRO_OPTIONS'); ?></span>
                </button>
                <button name="resethits" value="com_banner_impressions" type="submit"
                        class="btn btn-secondary btn-sm apply-resethits"
                        onclick="return confirm('<?php echo Text::_('MOD_RESETHITS_CONFIRM'); ?>');">
                    <span class="icon-undo" aria-hidden="true"></span> <?php echo Text::_('MOD_RESETHITS_RESET'); ?>
                    <span class="visually-hidden"><?php echo Text::_('MOD_RESETHITS_BANNER_IMPRESSIONS_TITLE'); ?></span>
                </button>
            </div>
        </div>
        <p class="sample-data__desc small mt-1"><?php echo Text::_('MOD_RESETHITS_BANNER_IMPRESSIONS_DESC'); ?></p>
    </li>
<?php } ?>

<!--Banner Clicks-->
<?php if ($params->get('bannerclicks')) { ?>
    <li class="list-group-item">
        <div class="d-flex justify-content-between align-items-center">
            <div class="sample-data__title me-2">
                <span class="sample-data__icon icon-bookmark me-1" aria-hidden="true"></span>
				<?php echo Text::_('MOD_RESETHITS_BANNER_CLICKS_TITLE'); ?>
            </div>
            <div class="buttons">
                <button class="btn btn-sm" type="button" data-bs-toggle="collapse" data-bs-target="#pro-banner-options"
                        aria-expanded="false" aria-controls="pro-banner-options">
                    <span class="icon-cog"
                          aria-hidden="true"></span> <?php echo Text::_('MOD_RESETHITS_PRO_OPTIONS'); ?>
                    <span class="visually-hidden"><?php echo Text::_('MOD_RESETHITS_PRO_OPTIONS'); ?></span>
                </button>
                <button name="resethits" value="com_banner_clicks" type="submit"
                        class="btn btn-secondary btn-sm apply-resethits"
                        onclick="return confirm('<?php echo Text::_('MOD_RESETHITS_CONFIRM'); ?>');">
                    <span class="icon-undo" aria-hidden="true"></span> <?php echo Text::_('MOD_RESETHITS_RESET'); ?>
                    <span class="visually-hidden"><?php echo Text::_('MOD_RESETHITS_BANNER_CLICKS_TITLE'); ?></span>
                </button>
            </div>
        </div>
        <p class="sample-data__desc small mt-1"><?php echo Text::_('MOD_RESETHITS_BANNER_CLICKS_DESC'); ?></p>
    </li>
<?php } ?>

<!--User Password-->
<?php if ($params->get('userpassword')) { ?>
    <li class="list-group-item">
        <div class="d-flex justify-content-between align-items-center">
            <div class="sample-data__title me-2">
                <span class="sample-data__icon icon-users" aria-hidden="true"></span>
				<?php echo Text::_('MOD_RESETHITS_USER_PASSWORD_TITLE'); ?>
            </div>
            <div class="buttons">
                <button class="btn btn-sm" type="button" data-bs-toggle="collapse" data-bs-target="#pro-user-options"
                        aria-expanded="false" aria-controls="pro-user-options">
                    <span class="icon-cog"
                          aria-hidden="true"></span> <?php echo Text::_('MOD_RESETHITS_PRO_OPTIONS'); ?>
                    <span class="visually-hidden"><?php echo Text::_('MOD_RESETHITS_PRO_OPTIONS'); ?></span>
                </button>
                <button name="resethits" value="com_user_password" type="submit"
                        class="btn btn-secondary btn-sm apply-resethits"
                        onclick="return confirm('<?php echo Text::_('MOD_RESETHITS_CONFIRM'); ?>');">
                    <span class="icon-undo" aria-hidden="true"></span> <?php echo Text::_('MOD_RESETHITS_RESET'); ?>
                    <span class="visually-hidden"><?php echo Text::_('MOD_RESETHITS_USER_PASSWORD_TITLE'); ?></span>
                </button>
            </div>
        </div>
        <p class="sample-data__desc small mt-1"><?php echo Text::_('MOD_RESETHITS_USER_PASSWORD_DESC'); ?></p>
    </li>
<?php } //TODO: Translate alert?>

<div class="alert alert-success text-center small m-0">This is the FREE version of Joomla Reset Hits module. <br/> Some
    features and support are only available in the <a class="alert-link" target="_blank"
                                                      href="https://www.joomill-extensions.com/extensions/reset-article-views-hits-counter">PRO
        Version</a></div>
