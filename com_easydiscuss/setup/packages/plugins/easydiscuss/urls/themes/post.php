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
<div class="o-card o-card--ed-post-widget">
	<div class="o-card__body l-stack">
		<div class="o-title-01">
			<?php echo JText::_('COM_EASYDISCUSS_REFERENCES'); ?>
		</div>
		<ol class="ed-post-ref-nav">
			<?php foreach ($urls as $url) { ?>
			<li>
				<a class="si-link" href="<?php echo $this->html('string.escape', $url); ?>" <?php echo $newWindow ? 'target="_blank"' : '';?> <?php echo ED::getLinkAttributes(); ?>>
					<?php echo $this->html('string.escape', $url); ?>
				</a>
			</li>
			<?php } ?>
		</ol>
	</div>
</div>