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

class EasyDiscussControllerFilters extends EasyDiscussController
{
	/**
	 * Get the filters based on category
	 *
	 * @since	5.0
	 * @access	public
	 */
	public function getFilters()
	{
		ED::checkToken();

		$config = ED::config();

		$categoryId = $this->input->get('categoryId', '', 'int');
		$selectedItems = $this->input->get('selectedItems', [], 'array');

		$labels = [];

		if ($config->get('main_labels')) {
			$model = ED::model('PostLabels');
			$labels = $model->getLabels();

			if ($labels) {
				foreach ($labels as $label) {
					ED::cache()->set($label, 'labels');
				}
			}
		}

		$types = [];

		if ($config->get('layout_post_types')) {
			$model = ED::model('PostTypes');
			$types = $model->getPostTypesOnListings($categoryId);

			foreach ($types as $type) {
				ED::cache()->set($type, 'posttypes');
			}
		}

		$priorities = [];

		if ($config->get('post_priority')) {
			$model = ED::model('Priorities');
			$priorities = $model->getAllPriorities();

			foreach ($priorities as $priority) {
				ED::cache()->set($priority, 'priorities');
			}
		}

		$selectedLabels = [];
		$selectedTypes = [];
		$selectedPriorities = [];

		$theme = ED::themes();
		$theme->set('labels', $labels);
		$theme->set('types', $types);
		$theme->set('priorities', $priorities);
		$theme->set('selectedLabels', $selectedLabels);
		$theme->set('selectedTypes', $selectedTypes);
		$theme->set('selectedPriorities', $selectedPriorities);
		$output = $theme->output('site/helpers/post/filters/default');

		return $this->ajax->resolve($output);
	}
}
