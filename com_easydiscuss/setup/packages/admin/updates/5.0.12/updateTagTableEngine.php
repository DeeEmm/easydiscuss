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

class EasyDiscussMaintenanceScriptUpdateTagTableEngine extends EasyDiscussMaintenanceScript
{
	public static $title = 'Update tag db table engine to innodb' ;
	public static $description = 'Update tag table storage engine';

	public function main()
	{
		$db = ED::db();

		$defaultEngine = $this->getDefaultEngineType();
		$requireConvert = $this->isRequireConvertion();

		if ($defaultEngine != 'myisam' && $requireConvert) {

			try {
				
				$query = "ALTER TABLE `#__discuss_tags` engine=InnoDB";
				$db->setQuery($query);
				$db->query();
				
			} catch (Exception $err) {
				// do nothing.
			}
		}

		return true;
	}

	/**
	 * Get default database table engine from mysql server
	 *
	 * @since	5.0
	 * @access	public
	 */
	private function getDefaultEngineType()
	{
		$default = 'myisam';
		$db = ED::db();

		try {

			$query = "SHOW ENGINES";
			$db->setQuery($query);

			$results = $db->loadObjectList();

			if ($results) {
				foreach ($results as $item) {
					if ($item->Support == 'DEFAULT') {
						$default = strtolower($item->Engine);
						break;
					}
				}

				if ($default != 'myisam' && $default != 'innodb') {
					$default = 'myisam';
				}
			}

		} catch (Exception $err) {
			$default = 'myisam';
		}

		return $default;
	}

	/**
	 * Determine if we need to convert myisam engine to innodb
	 *
	 * @since	5.0
	 * @access	public
	 */
	private function isRequireConvertion()
	{
		$require = false;
		$db = ED::db();

		try {
			$query = "SHOW TABLE STATUS WHERE `name` LIKE " . $db->Quote('%_discuss_tags');
			$db->setQuery($query);
			$result = $db->loadObject();

			if ($result) {
				$currentEngine = strtolower($result->Engine);
				if ($currentEngine == 'myisam') {
					$require = true; 
				}
			}

		} catch (Exception $err) {
			// do nothing.
			$require = false;
		}

		return $require;
	}
}