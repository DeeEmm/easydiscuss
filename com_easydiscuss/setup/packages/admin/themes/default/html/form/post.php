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

use Joomla\CMS\HTML\HTMLHelper;
?>
<span class="<?php echo $isJoomla4 ? 'input-group' : 'input-append'; ?>">
    <input type="text" id="<?php echo $id;?>_name" readonly="readonly" value="<?php echo $title; ?>" disabled="disabled" class="form-control disabled" data-post-title />

    <?php if (!$isJoomla4) { ?>
        <a rel="{handler: 'iframe', size: {x: 900, y: 500}}" href="<?php echo JRoute::_('index.php?option=com_easydiscuss&view=posts&tmpl=component&browse=1&browseFunction=insertPost');?>" class="modal btn btn-primary">
            <i class="icon-file"></i> <?php echo JText::_('COM_ED_MENU_OPTIONS_SELECT_POST'); ?>
        </a>
    <?php } ?>

    <?php if ($isJoomla4) { ?>
        <button type="button" class=" btn btn-primary" data-bs-target="#ModalSelectEDPost" data-bs-toggle="modal">
            <i class="icon-file"></i> <?php echo JText::_('COM_ED_MENU_OPTIONS_SELECT_POST'); ?>
        </button>
    <?php } ?>
</span>

<input type="hidden" id="<?php echo $id;?>_id" name="<?php echo $name;?>" value="<?php echo $value;?>" data-post-id />

<?php if ($isJoomla4) { ?>
<?php echo HTMLHelper::_('bootstrap.renderModal', 'ModalSelectEDPost', [
        'title' => JText::_('COM_ED_MENU_OPTIONS_SELECT_POST'),
        'url' => JRoute::_('index.php?option=com_easydiscuss&view=posts&tmpl=component&browse=1&browseFunction=insertPost'),
        'height' => '500px',
        'width' => '900px',
        'bodyHeight' => 80,
        'modalWidth' => 50
]); ?>
<?php } ?>

<script type="text/javascript"> 
    
ed.require(['edq'], function($) {
    const isJoomla4 = <?php echo $isJoomla4 ? 'true' : 'false'; ?>

    window.insertPost = function(id, title) {
        $('[data-post-id]').val(id);
        $('[data-post-title]').val(title);

        if (!isJoomla4) {
            SqueezeBox.close();
        }

        if (isJoomla4) {
            // Close the modal manually
            // SqueezeBox is undefined for Joomla 4
            $('#ModalSelectEDPost').find('[data-bs-dismiss]').trigger('click');
        }
    }
});
</script>