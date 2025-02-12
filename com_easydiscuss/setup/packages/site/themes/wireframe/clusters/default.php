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
<?php echo ED::renderModule('easydiscuss-forums-start'); ?>

<div class="ed-forums l-stack<?php echo !$threads ? ' is-empty' : ''; ?>" data-ed-forums>
	<?php if ($threads) { ?>
	<div class="l-stack">
		<?php foreach ($threads as $thread) { ?>
		<div class="o-card o-card--ed-forum-category">
			<div class="o-card__body l-stack">
				<div class="t-d--flex t-align-items--c">
					<div class="t-flex-grow--1 t-min-width--0 t-pr--lg">
						<div class="o-media">
							<div class="o-media__body">
								<div class="o-title">
									<a href="<?php echo EDR::getClusterRoute($thread->cluster->id, $clusterType, 'listing'); ?>" class="t-d--flex t-align-items--c si-link">
										<div class="o-avatar o-avatar--rounded t-flex-shrink--0 o-avatar--md">
											<img src="<?php echo $thread->cluster->getAvatar();?>" alt="<?php echo $this->html('string.escape', $thread->cluster->title);?>">
										</div>&nbsp;
										<span class="t-text--truncate"><?php echo $thread->cluster->title; ?></span>
									</a>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="ed-forums-items l-stack">
					<?php if ($thread->posts) { ?>
						<?php foreach ($thread->posts as $post) { ?>
							<?php echo $this->html('card.forumPost', $post); ?>
						<?php } ?>
					<?php } ?>

					<?php if (!$thread->posts) { ?>
						<?php echo $this->html('card.emptyCard', 'fa-book', 'COM_EASYDISCUSS_FORUMS_CATEGORY_EMPTY_DISCUSSION_LIST'); ?>
					<?php } ?>
				</div>

				<div class="t-text--center">
					<a href="<?php echo EDR::getClusterRoute($thread->cluster->id, $clusterType, 'listing'); ?>" class="si-link">
						<?php echo JText::_('COM_EASYDISCUSS_CLUSTERS_VIEW_ALL_POST_' . strtoupper($clusterType)); ?>
					</a>
				</div>
			</div>
		</div>
		<?php } ?>
	</div>
	<?php } ?>

	<?php echo $this->html('card.emptyCard', 'far fa-newspaper', 'COM_EASYDISCUSS_EMPTY_DISCUSSION_LIST'); ?>
</div>

<?php if (isset($pagination)) { ?>
	<div class="ed-pagination">
		<?php echo $pagination->getPagesLinks();?>
	</div>
<?php } ?>

<?php echo ED::renderModule('easydiscuss-forums-end'); ?>
