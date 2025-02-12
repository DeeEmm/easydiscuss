<?php
/**
* @package      EasyBlog
* @copyright    Copyright (C) 2010 - 2014 Stack Ideas Sdn Bhd. All rights reserved.
* @license      GNU/GPL, see LICENSE.php
* EasyBlog is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See COPYRIGHT.php for copyright notices and details.
*/
defined('_JEXEC') or die('Unauthorized Access');
?>
<dialog>
    <width>1024</width>
    <height>800</height>
    <selectors type="json">
    {
        "{closeButton}" : "[data-close-button]"
    }
    </selectors>
    <bindings type="javascript">
    {
        "{closeButton} click": function() {
            this.parent.close();
        }
    }
    </bindings>
    <title><?php echo JText::_('COM_EASYDISCUSS_EMAIL_PREVIEW'); ?></title>
    <content type="text"><?php echo $url;?></content>
    <buttons>
        <button data-close-button type="button" class="ed-dialog-footer-content__btn"><?php echo JText::_('COM_EASYDISCUSS_SETTINGS_NOTIFICATIONS_EMAIL_TEMPLATES_CLOSE'); ?></button>
    </buttons>
</dialog>
