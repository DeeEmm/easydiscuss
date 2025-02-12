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

class EasyDiscussActivityAbstract
{
	public function getThemes()
	{
		static $theme = null;

		if (is_null($theme)) {
			$theme = ED::themes();
		}

		return $theme;
	}

	/**
	 * Renders the actor name in html format
	 *
	 * @since	5.0.0
	 * @access	public
	 */
	public function getActorName(DiscussProfile $actor, $popbox = true, $postId = '')
	{
		static $cache = [];

		if (!isset($cache[$actor->id])) {

			$theme = $this->getThemes();
			$output = $theme->html('user.username', $actor, ['popbox' => $popbox]);

			if ($postId) {
				$post = ED::post($postId);

				// Anonymous post + the activity log added by the post owner
				// Then only need to hide the real name from the post owner   
				if ($post->id && $post->isAnonymous() && (($actor->id == $post->user_id) || (!$actor->id && !$post->user_id))) {

					if ($post->canAccessAnonymousPost()) {
						$output = $theme->html('user.username', $post->getOwner(), [
							'isAnonymous' => true, 
							'canViewAnonymousUsername' => $post->canAccessAnonymousPost(), 
							'posterName' => $post->poster_name
						]);
					} else {
						$output = JText::_('COM_EASYDISCUSS_ANONYMOUS_USER');
					}					
				}
			}

			$cache[$actor->id] = $output;
		}

		return $cache[$actor->id];
	}


	/**
	 * Renders the actor name in html format
	 *
	 * @since	5.0.0
	 * @access	public
	 */
	public function getCategoryTitle(EasyDiscussCategory $category, $popbox = true)
	{
		static $cache = [];

		if (!isset($cache[$category->id])) {
			$theme = $this->getThemes();

			$cache[$category->id] = $theme->html('category.title', $category, ['popbox' => $popbox]);
		}

		return $cache[$category->id];
	}

	/**
	 * Get reply permalink
	 *
	 * @since	5.0.0
	 * @access	public
	 */
	public function getReplyPermalink($replyId, $includeAnchorTag = true)
	{
		static $cache = [];

		if (!isset($cache[$replyId])) {
			$reply = ED::post($replyId);

			if (!$reply->id) {
				// post no longer exists in system.

				$link = '<s>#' . $replyId . '</s>';
				$cache[$replyId] = $link;
				return $link;
			}

			$link = $reply->getPermalink();
			if ($includeAnchorTag) {
				$link = '<a href="' . $link . '" data-ed-post-reply-seq="' . $replyId . '">#' . $replyId . '</a>';
			}

			$cache[$replyId] = $link;
		}

		return $cache[$replyId];
	}
}
