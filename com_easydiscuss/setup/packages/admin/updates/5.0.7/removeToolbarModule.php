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

require_once(DISCUSS_ADMIN_ROOT . '/includes/maintenance/dependencies.php');

class EasyDiscussMaintenanceScriptRemoveToolbarModule extends EasyDiscussMaintenanceScript
{
	public static $title = "Remove Toolbar Module";
	public static $description = "Removing Toolbar Module from Packages table";

	public function main()
	{
		$db = JFactory::getDBO();

		$query = 'DELETE FROM `#__discuss_packages` WHERE `element` = ' . $db->quote('mod_easydiscuss_toolbar');

		$db->setQuery($query);
		$db->execute();

		return true;
	}
}