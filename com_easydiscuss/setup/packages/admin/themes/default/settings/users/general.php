<?php
/**
* @package		EasyDiscuss
* @copyright	Copyright (C) Stack Ideas Sdn Bhd. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* EasyDiscuss is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See COPYRIGHT.php for copyright notices and details.
*/
defined('_JEXEC') or die('Unauthorized Access');
?>
<div class="row">
	<div class="col-md-6">
		<div class="panel">
			<?php echo $this->html('panel.head', 'COM_EASYDISCUSS_SETTINGS_LAYOUT_USERS_DISPLAY');?>
			<div class="panel-body">
				<div class="o-form-horizontal">

					<?php echo $this->html('settings.dropdown', 'layout_nameformat', 'COM_EASYDISCUSS_DISPLAY_NAME_FORMAT', '', 
						array(
							'name' => 'COM_EASYDISCUSS_DISPLAY_NAME_FORMAT_REAL_NAME',
							'username' => 'COM_EASYDISCUSS_DISPLAY_NAME_FORMAT_USERNAME',
							'nickname' => 'COM_EASYDISCUSS_DISPLAY_NAME_FORMAT_NICKNAME'
						)
					);?>

					<?php echo $this->html('settings.toggle', 'layout_user_details', 'COM_ED_LAYOUT_PROFILE_SHOW_DETAIL_FIELDS'); ?>
					<?php echo $this->html('settings.toggle', 'layout_user_online', 'COM_EASYDISCUSS_SHOW_ONLINE_STATE'); ?>
					<?php echo $this->html('settings.toggle', 'main_signature_visibility', 'COM_EASYDISCUSS_SIGNATURE_ENABLE'); ?>
					<?php echo $this->html('settings.toggle', 'main_profile_public', 'COM_EASYDISCUSS_ALLOW_PUBLIC_USERS_TO_VIEW_PROFILE'); ?>
				</div>
			</div>
		</div>

		<div class="panel">
			<?php echo $this->html('panel.head', 'COM_ED_USER_DOWNLOAD', '', '/docs/easydiscuss/administrators/configuration/general-data-protection-regulation'); ?>
			<div class="panel-body">
				<div class="o-form-horizontal">
					<?php echo $this->html('settings.toggle', 'main_userdownload', 'COM_ED_USER_ALLOW_DOWNLOAD'); ?>

					<?php echo $this->html('settings.textbox', 'main_userdownload_expiry', 'COM_ED_USER_DOWNLOAD_EXPIRY', '', ['size' => 7, 'postfix' => 'COM_EASYDISCUSS_DAYS'], '', '', 'text-center'); ?>
				</div>
			</div>
		</div>
	</div>

	<div class="col-md-6">
		<div class="panel">
			<?php echo $this->html('panel.head', 'COM_ED_USER_RANKING'); ?>

			<div class="panel-body">
				<div class="o-form-horizontal">
					<?php echo $this->html('settings.toggle', 'main_ranking', 'COM_EASYDISCUSS_ENABLE_RANKING'); ?>

					<?php echo $this->html('settings.dropdown', 'main_ranking_calc_type', 'COM_EASYDISCUSS_RANKING_CALCULATION', '', 
						array(
							'posts' => 'COM_EASYDISCUSS_RANKING_TYPE_POSTS',
							'points' => 'COM_EASYDISCUSS_RANKING_TYPE_POINTS'
						)
					);?>
				</div>
			</div>
		</div>

		<div class="panel">
			<?php echo $this->html('panel.head', 'COM_EASYDISCUSS_SETTINGS_LAYOUT_MEMBERS_TITLE'); ?>

			<div class="panel-body">
				<div class="o-form-horizontal">
					<?php echo $this->html('settings.toggle', 'main_user_listings', 'COM_EASYDISCUSS_ALLOW_USER_LISTINGS'); ?>
					<?php echo $this->html('settings.textbox', 'main_exclude_members', 'COM_EASYDISCUSS_EXCLUDE_MEMBERS'); ?>
				</div>
			</div>
		</div>

		<div class="panel">
			<?php echo $this->html('panel.head', 'COM_ED_SETTINGS_LAYOUT_SOCIALS_TITLE'); ?>

			<div class="panel-body">
				<div class="o-form-horizontal">
					<?php echo $this->html('settings.toggle', 'layout_profile_showsocial', 'COM_EASYDISCUSS_LAYOUT_PROFILE_SHOW_SOCIAL'); ?>
					<?php echo $this->html('settings.toggle', 'layout_social_facebook', 'COM_ED_SETTINGS_LAYOUT_SOCIALS_FACEBOOK'); ?>
					<?php echo $this->html('settings.toggle', 'layout_social_twitter', 'COM_ED_SETTINGS_LAYOUT_SOCIALS_TWITTER'); ?>
					<?php echo $this->html('settings.toggle', 'layout_social_linkedin', 'COM_ED_SETTINGS_LAYOUT_SOCIALS_LINKEDIN'); ?>
					<?php echo $this->html('settings.toggle', 'layout_social_skype', 'COM_ED_SETTINGS_LAYOUT_SOCIALS_SKYPE'); ?>
					<?php echo $this->html('settings.toggle', 'layout_social_website', 'COM_ED_SETTINGS_LAYOUT_SOCIALS_WEBSITE'); ?>
				</div>
			</div>
		</div>
	</div>
</div>