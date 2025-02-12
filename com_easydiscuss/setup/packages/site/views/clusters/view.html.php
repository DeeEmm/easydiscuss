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

require_once(DISCUSS_ROOT . '/views/views.php');

class EasyDiscussViewClusters extends EasyDiscussView
{
	/**
	 * Displays the clusters layout
	 *
	 * @since	5.0.0
	 * @access	public
	 */
	public function display($tpl = null)
	{
		// experimenting to get the group data based on user id
		$lib = ED::easysocial();

		$clusterType = $this->input->get('cluster_type', 'group', 'default');

		// Check if the group app is exists or not.
		if (!$clusterType || !$lib->isClusterAppExists($clusterType)) {
			ED::getErrorRedirection(JText::_('COM_EASYDISCUSS_NOT_ALLOWED'));
			return;
		}

		$model = ED::model('clusters');

		// If the categoryId is provided, this means that we're in the inner group.
		$clusterId = $this->input->get('cluster_id', 0, 'int');
		$registry = new JRegistry();

		// Try to detect if there's any category id being set in the menu parameter.
		$activeMenu = $this->app->getMenu()->getActive();

		// If there is an active menu, render the params
		if ($activeMenu && !$clusterId) {
			$registry->loadString($activeMenu->getParams());

			if ($registry->get('cluster_id')) {
				$clusterId = $registry->get('cluster_id');
			}
		}

		// Get the pagination limit
		$limit = $registry->get('limit',5);
		$limit = ($limit == '-2') ? ED::getListLimit() : $limit;
		$limit = ($limit == '-1') ? $this->jconfig->get('list_limit') : $limit;

		// Add view to this page.
		$this->logView();

		// Set page title.
		ED::setPageTitle('COM_EASYDISCUSS_TITLE_' . strtoupper($clusterType) . '_DISCUSSIONS');

		// Set the meta of the page.
		ED::setMeta();

		// Add rss feed into headers
		ED::feeds()->addHeaders('index.php?option=com_easydiscuss&view=clusters&cluster_type=' . $clusterType);

		$options = array(
			'userId' => $this->my->id,
			'cluster_id' => $clusterId,
			'cluster_type' => $clusterType,
			'limit' => $limit
		);

		$posts = $lib->getPostsCluster($options);

		$threads = false;

		// Format the posts.
		if ($posts) {
			$threads = $lib->formatPostsCluster($posts, $clusterId, $clusterType);
		}

		// Get the pagination
		$pagination = $model->getPagination();

		$this->set('pagination', $pagination);
		$this->set('threads', $threads);
		$this->set('clusterId', $clusterId);
		$this->set('clusterType', $clusterType);

		parent::display('clusters/default');
	}

	/**
	 * Display the full listing of the cluster layout
	 *
	 * @since	5.0.0
	 * @access	public
	 */
	public function listings()
	{
		$clusterId = $this->input->get('cluster_id', 0, 'int');
		$clusterType = $this->input->get('cluster_type', '', 'default');

		$registry = new JRegistry();

		// Get active category
		$activeCategory = $this->input->get('category', 0, 'int');

		$activeSort = $this->input->get('sort', $registry->get('sort'), 'string');
		$activeFilter = $this->input->get('filter', 'all', 'string');

		// Allows caller to filter posts by post types
		$postTypes = $this->input->get('types', array(), 'string');

		// Allows caller to filter posts by labels
		$postLabels = $this->input->get('labels', array(), 'int');

		// Allows caller to filter posts by priority
		$postPriorities = $this->input->get('priorities', array(), 'int');

		$lib = ED::easysocial();

		// Try to detect if there's any category id being set in the menu parameter.
		$activeMenu = $this->app->getMenu()->getActive();

		// If there is an active menu, render the params
		if ($activeMenu && !$clusterId) {
			$registry->loadString($activeMenu->getParams());

			if ($registry->get('cluster_id')) {
				$clusterId = $registry->get('cluster_id');
			}
		}

		// Get the pagination limit
		$limit = $registry->get('limit',5);
		$limit = ($limit == '-2') ? ED::getListLimit() : $limit;
		$limit = ($limit == '-1') ? $this->jconfig->get('list_limit') : $limit;

		// Add view to this page.
		$this->logView();

		// Set page title.
		ED::setPageTitle();

		// Set the meta of the page.
		ED::setMeta();

		// Add rss feed into headers
		ED::feeds()->addHeaders('index.php?option=com_easydiscuss&view=clusters&cluster_type=' . $clusterType . ' cluster_id=' . $clusterId . '&layout=listings');

		// Get list of categories on the site.
		$model = ED::model('Posts');

		$options = [
			'filter' => $activeFilter,
			'category' => (int) $activeCategory,
			'sort' => $activeSort,
			'limit' => $limit,
			'postTypes' => $postTypes,
			'postLabels' => $postLabels,
			'postPriorities' => $postPriorities,
			'limitstart' => $this->input->get('limitstart', 0, 'int'),
			'userId' => $this->my->id,
			'cluster_id' => $clusterId
		];

		// Get all the posts in this category and it's childs
		$posts = $model->getDiscussions($options);

		// Format the posts.
		$posts = ED::formatPost($posts);

		// Get the pagination
		$pagination = $model->getPagination();

		$header = $lib->renderMiniHeader($clusterId, $clusterType);

		// Used in post filters
		$baseUrl = 'view=clusters&layout=listings&cluster_id=' . $clusterId;

		$this->set('posts', $posts);
		$this->set('pagination', $pagination);
		$this->set('includeChild', false);
		$this->set('header', $header);
		$this->set('clusterId', $clusterId);
		$this->set('clusterType', $clusterType);

		// For filters
		$this->set('postLabels', $postLabels);
		$this->set('postTypes', $postTypes);
		$this->set('postPriorities', $postPriorities);
		$this->set('activeSort', $activeSort);
		$this->set('activeFilter', $activeFilter);
		$this->set('activeCategory', $activeCategory);
		$this->set('baseUrl', $baseUrl);

		parent::display('clusters/listings');
	}
}
