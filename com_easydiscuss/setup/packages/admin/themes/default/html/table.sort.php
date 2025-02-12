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
<a href="javascript:void(0);"
	data-ed-provide="tooltip"
	data-title="<?php echo JText::sprintf('Sort by %1$s', $title);?>"
	data-ed-table-sort
	data-sort="<?php echo $column;?>"
	data-direction="<?php echo $currentDirection === 'desc' ? 'asc' : 'desc';?>"
	class="<?php echo $class; ?>"
>
	<?php echo JText::_($title); ?>

	<?php if ($column === $currentOrdering) { ?>
		<?php if ($currentDirection === 'asc') { ?>
		<i class="fa fa-caret-up"></i>
		<?php } ?>

		<?php if ($currentDirection === 'desc') { ?>
		<i class="fa fa-caret-down"></i>
		<?php } ?>
	<?php } ?>
</a>
