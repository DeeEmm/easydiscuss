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
				<?php if (!$browse) { ?>
					<th width="1%" class="center">
						<?php echo $this->html('table.checkall'); ?>
					</th>
				<?php } ?>

				<th style="text-align: left;">
					<?php echo $this->html('table.sort', 'COM_EASYDISCUSS_BADGE_TITLE', 'a.title', $order, $orderDirection); ?>
				</th>

				<?php if (!$browse) { ?>
					<th width="10%" class="center">
						<?php echo JText::_('COM_EASYDISCUSS_PUBLISHED'); ?>
					</th>
					<th width="10%" class="center">
						<?php echo JText::_('COM_EASYDISCUSS_ACHIEVERS'); ?>
					</th>
				<?php } ?>

				<th width="15%" class="center">
					<?php echo JText::_('COM_EASYDISCUSS_THUMBNAIL'); ?>
				</th>

				<?php if (!$browse) { ?>
					<th width="10%" class="center">
						<?php echo $this->html('table.sort', 'COM_EASYDISCUSS_DATE', 'a.created', $order, $orderDirection); ?>
					</th>
				<?php } ?>

				<th width="5%" class="center">
					<?php echo $this->html('table.sort', 'COM_EASYDISCUSS_ID', 'a.id', $order, $orderDirection); ?>
				</th>
			</tr>
		</thead>

		<tbody>
		<?php if ($badges) { ?>
			<?php $i = 0; ?>
			<?php foreach ($badges as $badge) { ?>
				<tr>
					<?php if (!$browse) { ?>
						<td class="center" style="text-align: center;">
							<?php echo $this->html('table.checkbox', $i++, $badge->id); ?>
						</td>
					<?php } ?>

					<td style="text-align:left;">
						<?php if (!$browse) { ?>
							<a href="<?php echo $badge->editLink; ?>"><?php echo $badge->title; ?></a>
						<?php } else { ?>
							<a href="javascript:void(0);" onclick="parent.<?php echo $browseFunction; ?>('<?php echo $badge->id;?>','<?php echo $userIds;?>');"><?php echo $badge->title;?></a>
						<?php } ?>
					</td>

					<?php if (!$browse) { ?>

						<td class="center">
							<?php echo $this->html('table.state', 'badges', $badge, 'published'); ?>
						</td>

						<td class="center">
							<?php echo $badge->totalUsers;?>
						</td>
					<?php } ?>

					<td class="center">
						<img src="<?php echo JURI::root();?>/media/com_easydiscuss/badges/<?php echo $badge->avatar;?>" width="32" />
					</td>

					<?php if (!$browse) { ?>
						<td class="center">
							<?php echo $badge->date->toSql(); ?>
						</td>
					<?php } ?>

					<td class="center">
						<?php echo $badge->id;?>
					</td>
				</tr>
			<?php } ?>
		<?php } else { ?>
			<tr>
				<td colspan="7" class="center">
					<?php echo JText::_('COM_EASYDISCUSS_NO_BADGES_YET');?>
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

		<?php if ($browse) { ?>
		<input type="hidden" name="browse" value="1" />
		<input type="hidden" name="browseFunction" value="<?php echo $browseFunction; ?>" />
		<input type="hidden" name="tmpl" value="component" />
		<?php } ?>

		<?php echo $this->html('form.ordering', $order, $orderDirection); ?>
		<?php echo $this->html('form.action', 'badges', 'badges'); ?>

	</div>
</form>