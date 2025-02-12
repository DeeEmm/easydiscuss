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

class EasyDiscussMaintenanceScriptUpdateColumnsUtf8mb4 extends EasyDiscussMaintenanceScript
{
	public static $title = "Update required table columns charset to support utf8mb4.";
	public static $description = "This script will attempt to update the required EasyDiscuss table columns charset to support utf8mb4 type.";

	public function main()
	{
		$db = ED::db();
		$jConfig = JFactory::getConfig();
		$dbType = $jConfig->get('dbtype');

		if (($dbType == 'mysql' || $dbType == 'mysqli') && $this->hasUTF8mb4Support()) {
			$query = 'ALTER TABLE `#__discuss_posts` MODIFY `title` text CHARACTER SET utf8mb4 NULL';

			$db->setQuery($query);
			$db->query();

			$query = 'ALTER TABLE `#__discuss_mailq` MODIFY `subject` text CHARACTER SET utf8mb4 NOT NULL, MODIFY `body` LONGTEXT CHARACTER SET utf8mb4 NOT NULL';

			$db->setQuery($query);
			$db->query();
		}

		return true;
	}

	/**
	 *
	 * @since	5.0.8
	 * @access	public
	 */
	private function hasUTF8mb4Support()
	{
		static $_cache = null;

		if (is_null($_cache)) {

			$db = JFactory::getDBO();

			if (method_exists($db, 'hasUTF8mb4Support')) {
				$_cache = $db->hasUTF8mb4Support();
				return $_cache;
			}

			// we check the server version 1st
			$server_version = $db->getVersion();
			if (version_compare($server_version, '5.5.3', '<')) {
				 $_cache = false;
				 return $_cache;
			}

			$client_version = '5.0.0';

			if (function_exists('mysqli_get_client_info')) {
				$client_version = mysqli_get_client_info();
			} else if (function_exists('mysql_get_client_info')) {
				$client_version = mysql_get_client_info();
			}

			if (strpos($client_version, 'mysqlnd') !== false) {
				$client_version = preg_replace('/^\D+([\d.]+).*/', '$1', $client_version);
				$_cache = version_compare($client_version, '5.0.9', '>=');
			} else {
				$_cache = version_compare($client_version, '5.5.3', '>=');
			}

		}

		return $_cache;
	}
}