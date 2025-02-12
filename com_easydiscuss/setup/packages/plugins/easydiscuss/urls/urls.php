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

$file = JPATH_ADMINISTRATOR . '/components/com_easydiscuss/includes/plugins.php';

if (!JFile::exists($file)) {
	return;
}

require_once($file);

class plgEasyDiscussUrls extends EasyDiscussPlugins
{
	public $group = 'easydiscuss';
	public $element = 'urls';

	/**
	 * Renders in the post
	 *
	 * @since	5.0.0
	 * @access	public
	 */
	public function onAfterPostContent($post)
	{
		$urls = $this->getUrls($post);

		if (!$urls) {
			return;
		}
		
		$params = $this->getPluginParams();
		$newWindow = $params->get('open_newwindow', false);

		$this->assign('newWindow', $newWindow);
		$this->assign('urls', $urls);
		$contents = $this->output('post');

		return $contents;
	}

	/**
	 * Renders when composer is generating tabs
	 *
	 * @since	5.0.0
	 * @access	public
	 */
	public function onRenderTabs($uid, $post, $composer, $operation)
	{
		if (!$this->canAccessTabs($post)) {
			return;
		}

		$tab = new stdClass();
		$tab->heading = $this->getTabHeader($uid, $post, $composer, $operation);
		$tab->contents = $this->getTabContents($uid, $post, $composer, $operation);
		

		return $tab;
	}

	/**
	 * Renders the tab header
	 *
	 * @since	5.0.0
	 * @access	private
	 */
	private function getTabHeader($uid, $post, $composer, $operation)
	{
		$this->assign('editorId', $uid);
		$this->assign('post', $post);
		$this->assign('composer', $composer);
		$this->assign('operation', $operation);

		$contents = $this->output('heading');

		return $contents;
	}

	/**
	 * Renders the tab contents
	 *
	 * @since	5.0.0
	 * @access	private
	 */
	private function getTabContents($uid, $post, $composer, $operation)
	{
		$this->assign('editorId', $uid);
		$this->assign('post', $post);
		$this->assign('composer', $composer);
		$this->assign('operation', $operation);

		$contents = $this->output('contents');

		return $contents;
	}

	/**
	 * Determines if the user can be posting data in this tab
	 *
	 * @since	5.0.0
	 * @access	public
	 */
	private function canAccessTabs($post)
	{
		$params = $this->getPluginParams();

		// If the user doesn't want to enable this feature, they should disable the plugin instead of creating a settings.
		
		return true;
	}

	/**
	 * Get site details that are associated with the post
	 *
	 * @since   5.0.0
	 * @access  public
	 */
	private function getUrls(EasyDiscussPost $post)
	{
		$urls = $post->getFieldData('references', $post->params);

		if (!$urls) {
			return $urls;
		}

		// Cleanup urls
		foreach ($urls as &$url) {
			$url = strip_tags($url);

			if (EDJString::stristr($url, 'https://') === false && EDJString::stristr($url, 'http://') === false) {
				$url = 'https://' . $url;
			}

			// Remove quotes
			$url = str_ireplace(array('"', "'"), '', $url);
		}

		return $urls;
	}
}