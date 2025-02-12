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

$references = $post->getFieldData('references', $post->params);
?>
<div id="links-<?php echo $editorId;?>" class="ed-editor-tab__content tab-pane">
	
	<div class="ed-editor-tab__content-note">
		<?php echo JText::_('COM_EASYDISCUSS_URL_REFERENCES_INFO'); ?>
	</div>

	<div class="ed-editor-input-list l-stack l-spaces--sm" data-ed-links-list>
		<?php if ($references) { ?>
			<?php foreach ($references as $reference) { ?>
			<div class="o-input-group" data-ed-links-item>
				<input type="text" name="params_references[]" class="o-form-control" placeholder="<?php echo JText::_('COM_EASYDISCUSS_URL_REFERENCES_PLACEHOLDER');?>" value="<?php echo $this->html('string.escape', $reference);?>" />
				
				
				<button class="o-btn o-btn--danger o-btn--ed-input-del" type="button" data-ed-links-remove>x</button>
				
			</div>
			<?php } ?>
		<?php } else { ?>
			<div class="o-input-group" data-ed-links-item>
				<input type="text" name="params_references[]" class="o-form-control" placeholder="<?php echo JText::_('COM_EASYDISCUSS_URL_REFERENCES_PLACEHOLDER');?>" value="" />
				
				
				<button class="o-btn o-btn--danger o-btn--ed-input-del" type="button" data-ed-links-remove>x</button>
				
			</div>
		<?php } ?>
	</div>

	<div class="ed-editor__input-list">
		<a class="o-btn o-btn--default-o o-btn--sm" href="javascript:void(0);" data-ed-links-insert><?php echo JText::_('COM_EASYDISCUSS_ADD_ANOTHER_LINK');?></a>
	</div>
</div>