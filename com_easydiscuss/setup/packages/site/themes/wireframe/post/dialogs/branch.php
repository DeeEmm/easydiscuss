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
<dialog>
	<width>400</width>
	<height>280</height>
	<selectors type="json">
	{
		"{closeButton}": "[data-close-button]",
		"{form}": "[data-form-response]",
		"{submitButton}": "[data-submit-button]",
		"{postAlias}": "[data-ed-post-alias]",
		"{replyId}": "[data-ed-reply-id]"
	}
	</selectors>
	<bindings type="javascript">
	{
		"{closeButton} click": function() {
			this.parent.close();
		},

		"{submitButton} click": function() {

			var replyId = this.replyId().val();

			var aliasField = this.postAlias();
			var postAlias = aliasField.val();

			var aliasFieldParent = aliasField.parents();

			if (postAlias == "") {
				aliasFieldParent.addClass('has-error');
				return false;
			}

			aliasFieldParent.removeClass('has-error');

			var form = this.form();

			EasyDiscuss.ajax('site/views/post/normalizeAlias', {
				"id": replyId,
				"alias": postAlias
			})
			.done(function(alias) {

				// update the alias in the hidden input
				aliasField.val(alias);

				aliasFieldParent.removeClass('has-error');

				form.submit();

			}).fail(function(msg) {
				aliasFieldParent.addClass('has-error');
			});
		}
	}
	</bindings>
	<title><?php echo JText::_('COM_EASYDISCUSS_BRANCH_POST_TITLE'); ?></title>
	<content>
		<p class="mb-10">
			<?php echo JText::_('COM_EASYDISCUSS_BRANCH_POST_DESC'); ?>
		</p>

		<form data-form-response method="post" action="<?php echo JRoute::_('index.php');?>">
			<div class="">
				<input type="text" name="alias" id="alias" value="" class="o-form-control" data-ed-post-alias />
				<div class="o-form-text" style="font-size:12px"><?php echo JText::_('COM_ED_BRANCH_POST_ALIAS_HELP'); ?></div>
			</div>

			<input type="hidden" name="id" value="<?php echo $id;?>" data-ed-reply-id />
			<?php echo $this->html('form.action', 'posts', null, 'branch'); ?>
		</form>
	</content>
	<buttons>
		<button data-close-button type="button" class="ed-dialog-footer-content__btn"><?php echo JText::_('COM_EASYDISCUSS_BUTTON_CANCEL'); ?></button>
		<button data-submit-button type="button" class="ed-dialog-footer-content__btn t-text--primary"><?php echo JText::_('COM_EASYDISCUSS_BUTTON_BRANCH'); ?></button>
	</buttons>
</dialog>
