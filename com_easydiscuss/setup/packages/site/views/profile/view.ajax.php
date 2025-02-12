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

require_once(__DIR__ . '/view.abstract.php');

class EasyDiscussViewProfile extends EasyDiscussViewProfileAbstract
{
	/**
	 * Displays the user's points achievement history
	 *
	 * @since	5.0.0
	 * @access	public
	 */
	public function getPointsHistory($tmpl = null)
	{
		if (!$this->config->get('main_points')) {
			die('The feature has been disabled.');
		}

		$id = $this->input->get('id', 0, 'int');

		if (!$id) {
			die('Invalid id provided');
		}

		$user = ED::user($id);

		$model = ED::model('Points', true);
		$history = $model->getPointsHistory($user->id);

		// Format points
		foreach ($history as $item) {
			// If this is a reversed command
			if (stristr($item->command, '.reversed') !== false) {
				$command = str_replace('.reversed', '', $item->command);

				// Retrieve the point of the reversed vote
				$points = ED::points()->getPoints($command);

				// Reverse back the point
				$points[0]->rule_limit = -$points[0]->rule_limit;
			}

			if (stristr($item->command, '.reversed') === false) {
				$points = ED::points()->getPoints($item->command);
			}

			$post = ED::post($item->content_id);
			$post = $post->isReply() ? $post->getParent() : $post;
			$useSprintf = true;

			// To fix 'Unknown format specifier "O" error caused by sprintf() in PHP 8 only for the title is not language constant and contains '%'
			if (strpos(trim($item->title), ' ') !== false) {
				$useSprintf = false;
			}

			$item->title = $post->id && $useSprintf ? JText::sprintf($item->title, $post->getTitle()) : JText::_($item->title);

			if ($points) {
				if ($points[0]->rule_limit < 0) {
					$item->class = 'badge-important';
					$item->points = $points[0]->rule_limit;
				} else {
					$item->class = 'badge-info';
					$item->points = '+'.$points[0]->rule_limit;
				}
			} else {
				$item->class = 'badge-info';
				$item->points = '+';

				// do not assign any point any class name if the point rule is assign custom point for a user.
				if ($item->command == 'easydiscuss.update.custompoint') {
					$item->class = '';
					$item->points = '';
				}
			}
		}

		$history = ED::points()->group($history);

		$theme = ED::themes();
		$theme->set('history', $history);
		$output = $theme->output('site/profile/points');

		return $this->ajax->resolve($output);
	}

	/**
	 * Render contents of a tab from a user profile
	 *
	 * @since	5.0.0
	 * @access	public
	 */
	public function render()
	{
		// Get the current user that should be displayed
		$id = $this->input->get('id', null, 'int');
		$user = ED::user($id);

		// Check if the user is allowed to view
		if (!$this->config->get('main_profile_public') && !$this->my->id) {
			die('Not allowed here');
		}

		$filter = $this->input->get('filter', 'posts', 'default');

		$postsModel = ED::model('Posts');
		$tagsModel = ED::model('Tags');

		$theme = ED::themes();
		$posts = $this->getProfilePosts($filter, $user);

		$pagination	= $this->getProfilePagination();
		$pagination->setVar('id', $user->id);
		$pagination->setVar('view', 'profile');
		$pagination->setVar('filter', $filter);


		$contents = $theme->output('site/posts/list', [
			'featured' => [],
			'posts' => $posts,
			'pagination' => $pagination,
			'hideTitles' => true
		]);

		return $this->ajax->resolve($contents);
	}

	/**
	 * Method to remove the avatar
	 *
	 * @since	4.0
	 * @access	public
	 */
	public function removeAvatar()
	{
		if (!$this->my->id) {
			return $this->ajax->reject(JText::_('COM_EASYDISCUSS_NOT_ALLOWED'));
		}

		$theme = ED::themes();
		$output = $theme->output('site/user/dialogs/photo.delete');

		return $this->ajax->resolve($output);
	}

	/**
	 * Checks if an alias is valid
	 *
	 * @since	4.0
	 * @access	public
	 */
	public function checkAlias()
	{
		$alias = $this->input->get('alias', '', 'default');

		// Only allow registered users
		if ($this->my->guest) {
			return;
		}

		// satinize input
		$filter	= JFilterInput::getInstance();
		$alias = $filter->clean($alias, 'STRING');

		// check for existance
		$db = ED::db();
		$query	= 'SELECT `alias` FROM `#__discuss_users` WHERE `alias` = ' . $db->quote($alias) . ' '
				. 'AND ' . $db->nameQuote('id') . '!=' . $db->Quote($this->my->id);
		$db->setQuery($query);

		$exists = $db->loadResult();

		$message = JText::_('COM_EASYDISCUSS_ALIAS_AVAILABLE');

		if ($exists) {
			$message = JText::_('COM_EASYDISCUSS_ALIAS_NOT_AVAILABLE');
		}

		return $this->ajax->resolve($exists, $message);
	}

	/**
	 * Mark all posts as read
	 *
	 * @since   4.0
	 * @access  public
	 */
	public function markAllRead()
	{
		if ($this->my->guest) {
			return;
		}

		// Get all unread post
		$model = ED::model('Posts');
		$posts = $model->getUnread($this->my->id);

		if (!$posts) {
			return $this->ajax->resolve(JText::_('COM_EASYDISCUSS_NO_UNREAD_POSTS'));
		}

		$user = ED::user($this->my->id);

		// Mark them as read
		foreach ($posts as $post){
			$user->read($post->id);
		}

		return $this->ajax->resolve(JText::_('COM_EASYDISCUSS_MARKED_READ_POSTS'));
	}

	/**
	 * show user mini header in popbox style
	 *
	 * @since	4.1.0
	 * @access	public
	 */
	public function confirmDownload()
	{
		$userId = $this->my->id;

		$table = ED::table('download');
		$table->load(array('userid' => $userId));
		$state = $table->getState();

		$email = $this->my->email;
		$emailPart = explode('@', $email);
		$email = EDJString::substr($emailPart[0], 0, 2) . '****' . EDJString::substr($emailPart[0], -1) . '@' . $emailPart[1];

		$theme = ED::themes();
		$theme->set('userId', $userId);
		$theme->set('email', $email);
		$output = $theme->output('site/user/dialogs/gdpr.confirm');

		return $this->ajax->resolve($output);
	}
}
