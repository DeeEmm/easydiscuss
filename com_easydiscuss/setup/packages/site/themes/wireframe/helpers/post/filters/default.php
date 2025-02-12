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
<div class="lg:t-mr--sm" data-insert-filter>
	<div class="t-text--right o-dropdown">
		<a href="javascript:void(0);" class="o-btn o-btn--default-o sm:t-d--block sm:t-mb--md t-text--nowrap"
			data-ed-toggle="dropdown"
		>
			<?php echo JText::_('COM_ED_INSERT_FILTER');?> &nbsp;<i class="fa fa-plus-circle t-text--primary"></i>
		</a>

		<div class="o-dropdown-menu t-mt--2xs t-px--md sm:t-w--100" style="min-width: 280px; max-width: 350px; max-height: 350px;" data-ed-filter-container>
			<div class="l-stack">

				<?php if ($labels) { ?>
					<?php echo $this->output('site/helpers/post/filters/filter', [
						'items' => $labels,
						'item_id' => 'id',
						'type' => 'label',
						'title' => 'COM_ED_FILTERS_POST_LABELS',
						'selectedItems' => $selectedLabels
					]); ?>
				<?php } ?>

				<?php if ($types) { ?>
					<?php echo $this->output('site/helpers/post/filters/filter', [
						'items' => $types,
						'item_id' => 'alias',
						'type' => 'type',
						'title' => 'COM_ED_FILTERS_POST_TYPES',
						'selectedItems' => $selectedTypes
					]); ?>
				<?php } ?>

				<?php if ($priorities) { ?>
					<?php echo $this->output('site/helpers/post/filters/filter', [
						'items' => $priorities,
						'item_id' => 'id',
						'type' => 'priority',
						'title' => 'COM_ED_FILTERS_POST_PRIORITIES',
						'selectedItems' => $selectedPriorities
					]); ?>
				<?php } ?>

			</div>
		</div>
	</div>
</div>
