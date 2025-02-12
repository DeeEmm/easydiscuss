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

class EasyDiscussControllerSearch extends EasyDiscussController
{
	/**
	 * Performs search in EasyDiscuss
	 *
	 * @since	4.0.16
	 * @access	public
	 */
	public function query()
	{
		// Check for request forgeries
		ED::checkToken();

		// Get the query
		$query = $this->input->get('query', '', 'string');

		$categoryId = $this->input->get('category', 0, 'int');
		$category_id = $this->input->get('category_id', 0, 'int');
		$postType = $this->input->get_('post_type', '', 'default');

		$catQuery = '';
		$postTypeQuery = '';

		if ($categoryId) {
			$catQuery .= "&category=" . $categoryId;
		}

		// This must be coming from the Stackideas Toolbar
		if (!$categoryId && $category_id) {
			$catQuery .= "&category=" . $category_id;
		}

		if ($postType) {
			$postTypeQuery = '&types=' . $postType;
		}

		$url = EDR::_('view=search&query=' . $query . $catQuery . $postTypeQuery, false);
		ED::redirect($url);
	}
}