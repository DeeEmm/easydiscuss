<?php
/**
* @package		EasyDiscuss
* @copyright	Copyright (C) Stack Ideas Private Limited. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* EasyDiscuss is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See COPYRIGHT.php for copyright notices and details.
*/
defined('_JEXEC') or die('Unauthorized Access');

require_once(__DIR__ . '/abstract.php');

class JFormFieldModal_Tags extends EasyDiscussFormField
{
	var	$_name = 'Modal_Tags';

	protected function getInput()
	{
		$title = JText::_('COM_ED_MENU_SELECT_TAG_TITLE');

		if ($this->value) {
			$tag = ED::table('Tags');
			$tag->load($this->value);

			$title = $tag->title;
		}

		$this->theme->set('id', $this->id);
		$this->theme->set('name', $this->name);
		$this->theme->set('value', $this->value);
		$this->theme->set('title', $title);
		$this->theme->set('isJoomla4', ED::isJoomla4());

		$output = $this->theme->output('admin/html/form/tag');

		return $output;
	}
}
