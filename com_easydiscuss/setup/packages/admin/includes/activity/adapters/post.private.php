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

class EasyDiscussActivityPostPrivate extends EasyDiscussActivityAbstract
{
	/**
	 * method the translate the activity log to a readable content
	 *
	 * @since	5.0
	 * @access	public
	 */
	public function translate($data)
	{
		$actor = ED::user($data->user_id);
		$private = $data->new;
		$timeLapsed = ED::date()->toLapsed($data->created);

		$constant = 'COM_ED_ACTIVITY_POST_MAKE';
		$constant .= $private ? '_PRIVATE' : '_PUBLIC';

		$text = JText::sprintf($constant, $this->getActorName($actor), $timeLapsed);

		return $text;
	}
}