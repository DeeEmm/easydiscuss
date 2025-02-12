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
<form action="index.php" method="post" name="adminForm" id="adminForm" data-ed-form>

	<div class="app-filter-bar">
		<div class="app-filter-bar__cell app-filter-bar__cell--search">
			<?php echo $this->html('table.search', 'search', $search); ?>
		</div>

		<div class="app-filter-bar__cell app-filter-bar__cell--auto-size app-filter-bar__cell--divider-left">
			<div class="app-filter-bar__filter-wrap">
				<?php echo $this->html('table.filter', 'filter_state', $filter, array('published' => 'COM_EASYDISCUSS_PUBLISHED', 'unpublished' => 'COM_EASYDISCUSS_UNPUBLISHED')); ?>
			</div>
		</div>

		<div class="app-filter-bar__cell app-filter-bar__cell--empty"></div>

		<div class="app-filter-bar__cell app-filter-bar__cell--divider-left app-filter-bar__cell--last t-text--center">
			<div class="app-filter-bar__filter-wrap app-filter-bar__filter-wrap--limit">
				<?php echo $this->html('table.limit', $pagination->limit); ?>
			</div>
		</div>
	</div>

	<div class="panel-table">
		<table class="app-table table" data-ed-table>
		<thead>
			<tr>
				<th width="1%" class="center">
					<?php echo $this->html('table.checkall'); ?>					
				</th>
				<th class="title" style="text-align:left;">
					<?php echo $this->html('table.sort', 'COM_ED_COLUMN_TITLE', 'title', $order, $orderDirection); ?>
				</th>
				<th width="20%" class="center"><?php echo JText::_('COM_ED_LABEL_COMMAND'); ?></th>
				<th width="20%" class="center">
					<?php echo $this->html('table.sort', 'COM_EASYDISCUSS_CREATED', 'a.created', $order, $orderDirection); ?>
				</th>
				<th width="1%" class="center">
					<?php echo $this->html('table.sort', 'ID', 'a.id', $order, $orderDirection); ?>
				</th>
			</tr>
		</thead>
		<tbody>
		<?php if ($rules) { ?>
			<?php $i = 0; ?>
			<?php foreach ($rules as $rule) { ?>
			<tr>
				<td width="1%" class="center">
					<?php echo $this->html('table.checkbox', $i++, $rule->id); ?>
				</td>
				<td>
					<?php echo $rule->title; ?>
				</td>
				<td class="center">
					<?php echo $rule->command;?>
				</td>
				<td class="center">
					<?php echo ED::date($rule->created)->toMySQL(true);?>
				</td>
				<td class="center">
					<?php echo $rule->id; ?>
				</td>
			</tr>
			<?php } ?>
		<?php } else { ?>
			<tr>
				<td colspan="7" class="center">
					<?php echo JText::_('COM_ED_NO_RULES_CREATED');?>
				</td>
			</tr>
		<?php } ?>
		</tbody>
			<tfoot>
				<tr>
					<td colspan="7">
						<div class="footer-pagination center">
							<?php echo $pagination->getListFooter(); ?>
						</div>
					</td>
				</tr>
			</tfoot>
		</table>

		<?php echo $this->html('form.ordering', $order, $orderDirection); ?>
		<?php echo $this->html('form.action', 'rules', 'rules'); ?>
	</div>
</form>
