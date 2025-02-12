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

jimport('joomla.application.component.model');

if (class_exists('JModelAdmin')) {
	class EasyDiscussAdminMainModel extends JModelAdmin
	{
		public function getForm($data = array(), $loadData = true)
		{
		}
	}
} else {
	class EasyDiscussAdminMainModel extends JModel { }
}

class EasyDiscussAdminModel extends EasyDiscussAdminMainModel
{
	public function __construct()
	{
		parent::__construct();

		$this->app = JFactory::getApplication();
		$this->input = ED::request();
		$this->config = ED::config();
		$this->my = JFactory::getUser();
		$this->db = ED::db();
	}

	/**
	 * Retrieves the data from the state
	 *
	 * @since	4.0
	 * @access	public
	 */
	public function getStateFromRequest($name, $default, $filter)
	{
		$namespace = 'com_easydiscuss.' . $this->name . '.' . $name;
		return $this->getUserStateFromRequest($namespace, $name, $default, $filter);
	}

	/**
	 * Gets the value of a user state variable.
	 *
	 */
	public function getUserStateFromRequest($key, $request, $default = null, $type = 'none')
	{
		$mainframe = JFactory::getApplication();

		if (method_exists($mainframe, 'getUserStateFromRequest')) {
			return $mainframe->getUserStateFromRequest($key, $request, $default, $type);
		}

		if (method_exists($mainframe, 'getUserState')) {

			$cur_state = $mainframe->getUserState($key, $default);
			$new_state = $mainframe->input->get($request, null, $type);

			// Save the new value only if it was set in this request.
			if ($new_state !== null) {
				$mainframe->setUserState($key, $new_state);
			} else {
				$new_state = $cur_state;
			}

			return $new_state;
		}

		return $default;
	}


	public function getForm($data = array(), $loadData = true)
	{
	}

	protected function populateState()
	{
		// Load the parameters.
		$value = JComponentHelper::getParams($this->option);
		$this->setState('params', $value);
	}

	/**
	 * Used to split search fragments up
	 *
	 * @since	4.0.15
	 * @access	public
	 */
	protected function getSearchFragments($query)
	{
		$fragments = explode(':', $query);

		$search = new stdClass();

		if (count($fragments) <= 1) {
			$search->type = 'standard';
			$search->query = $query;
			
			return $search;
		}

		$search->type = strtolower($fragments[0]);
		$search->query = $fragments[1];
		
		return $search;
	}
}
