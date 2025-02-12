<?php
/**
* @package      EasyDiscuss
* @copyright    Copyright (C) Stack Ideas Sdn Bhd. All rights reserved.
* @license      GNU/GPL, see LICENSE.php
* EasyDiscuss is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See COPYRIGHT.php for copyright notices and details.
*/
defined('_JEXEC') or die('Unauthorized Access');
?>
<form name="adminForm" id="adminForm" method="post">
	<div class="row">
		<div class="col-md-6">
			<div class="panel">
				<div class="panel-head">
					<b>
						<span><?php echo JText::_('Invalid API Key');?></span>
					</b>
				</div>

				<div class="panel-body">
					<p><?php echo JText::_('The package which you have downloaded does not contain the necessary API key. Please get in touch with our support team should the problem continue to persist.');?></p>
					<a href="https://stackideas.com/forums" class="o-btn o-btn--default-o" target="_blank"><?php echo JText::_('Contact Support Team'); ?></a>
				</div>
			</div>
		</div>
	</div>

	<?php echo $this->html('form.action', 'settings', 'settings', 'saveApi'); ?>
	<input type="hidden" name="return" value="<?php echo $return;?>" />
</form>