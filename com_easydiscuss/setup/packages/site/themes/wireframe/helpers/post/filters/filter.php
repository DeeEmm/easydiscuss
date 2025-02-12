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
<div class="ed-filter-group">
	<div class="o-title-01 t-mb--md">
		<?php echo JText::_($title);?>
	</div>
	<div class="l-cluster l-spaces--xs">
		<div>
			<?php foreach ($items as $item) { ?>
			<div class="t-min-width--0">
				<div class="t-d--flex t-text--truncate">
					<a href="javascript:void(0);" class="o-label o-label--ed-filter-label t-text--truncate <?php echo in_array($item->$item_id, $selectedItems) ? 'is-active' : '';?>"
						data-ed-filter="<?php echo $type; ?>"
						data-id="<?php echo $item->$item_id; ?>"
					>
						<?php echo $item->getTitle();?>
					</a>
				</div>
			</div>
			<?php } ?>
		</div>
	</div>
</div>
