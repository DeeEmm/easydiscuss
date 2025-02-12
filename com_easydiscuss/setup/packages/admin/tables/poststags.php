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

ED::import('admin:/tables/table');

class DiscussPostsTags extends EasyDiscussTable
{
	/*
	 * The id of the tag
	 * @var int
	 */
	public $id		= null;

	/*
	* Post ID
	* @var string
	*/
	public $post_id	= null;

	/*
	* Tag ID
	* @var string
	*/
	public $tag_id	= null;


	/**
	 * Constructor for this class.
	 *
	 * @return
	 * @param object $db
	 */
	public function __construct(& $db )
	{
		parent::__construct( '#__discuss_posts_tags' , 'id' , $db );
	}

	public function exists( $title )
	{
		$db	= ED::db();

		$query	= 'SELECT COUNT(1) '
				. 'FROM ' 	. $db->nameQuote('#__discuss_tags') . ' '
				. 'WHERE ' 	. $db->nameQuote('title') . ' = ' . $db->quote($title) . ' '
				. 'LIMIT 1';
		$db->setQuery($query);

		$result	= $db->loadResult() > 0 ? true : false;

		return $result;
	}

	/**
	 * Overrides parent's delete method to add our own logic.
	 *
	 * @return boolean
	 * @param object $db
	 */
	public function delete( $pk = null )
	{
		$db		= ED::db();

		$query	= 'SELECT COUNT(1) FROM ' . $db->nameQuote( '#__discuss_posts_tags' ) . ' '
				. 'WHERE ' . $db->nameQuote( 'tag_id' ) . '=' . $db->Quote( $this->id );
		$db->setQuery( $query );

		$count	= $db->loadResult();

		if( $count > 0 )
		{
			return false;
		}

		return parent::delete();
	}

	// method to delete all the blog post that associated with the current tag
	public function deletePostTag()
	{
		$db		= ED::db();

		$query	= 'DELETE FROM ' . $db->nameQuote( '#__discuss_posts_tags' ) . ' '
				. 'WHERE ' . $db->nameQuote( 'tag_id' ) . '=' . $db->Quote( $this->id );
		$db->setQuery( $query );

		if($db->query($db))
		{
			return true;
		}
		else
		{
			return false;
		}
	}


	// method to delete all the blog post that associated with the current tag
	public function clearTags($postId)
	{
		$db = ED::db();

		$query = "delete from " . $db->nameQuote('#__discuss_posts_tags');
		$query .= " where " . $db->nameQuote('post_id') . ' = ' . $db->Quote($postId);


		$db->setQuery( $query );
		$state = $db->query();

		return $state;
	}


}
