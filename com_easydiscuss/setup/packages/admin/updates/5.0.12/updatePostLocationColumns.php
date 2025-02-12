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

class EasyDiscussMaintenanceScriptUpdatePostLocationColumns extends EasyDiscussMaintenanceScript
{
	public static $title = "Update post table latitude and longitude columns";
	public static $description = "Update post table latitude and longitude columns default value to prevent if the existing data stored NULL value.";

	public function main()
	{
		$db = ED::db();

		$query = [];
		$query[] = 'UPDATE ' . $db->nameQuote('#__discuss_posts');
		$query[] = 'SET ' . $db->nameQuote('latitude') . ' = ' . $db->Quote('');
		$query[] = 'WHERE ' . $db->nameQuote('latitude') . ' IS NULL';

		$query = implode(' ' , $query);

		$db->setQuery($query);
		$state = $db->query();

		if ($state) {
			$query = [];
			$query[] = "ALTER TABLE " . $db->nameQuote('#__discuss_posts');
			$query[] = "MODIFY " . $db->nameQuote('latitude') . " varchar(255) NOT NULL DEFAULT ''";

			$query = implode(' ' , $query);

			$db->setQuery($query);
			$db->query();
		}

		$query = [];
		$query[] = 'UPDATE ' . $db->nameQuote('#__discuss_posts');
		$query[] = 'SET ' . $db->nameQuote('longitude') . ' = ' . $db->Quote('');
		$query[] = 'WHERE ' . $db->nameQuote('longitude') . ' IS NULL';

		$query = implode(' ' , $query);

		$db->setQuery($query);
		$state = $db->query();

		if ($state) {
			$query = [];
			$query[] = "ALTER TABLE " . $db->nameQuote('#__discuss_posts');
			$query[] = "MODIFY " . $db->nameQuote('longitude') . " varchar(255) NOT NULL DEFAULT ''";

			$query = implode(' ' , $query);

			$db->setQuery($query);
			$db->query();
		}

		return true;
	}
}