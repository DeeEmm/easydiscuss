CREATE TABLE IF NOT EXISTS `#__discuss_comments` (
  `id` bigint(20) UNSIGNED NOT NULL auto_increment,
  `comment` text NULL,
  `name` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT '',
  `url` varchar(255) DEFAULT '',
  `ip` varchar(255) DEFAULT '',
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified` datetime DEFAULT '0000-00-00 00:00:00',
  `published` tinyint(1) UNSIGNED DEFAULT '0',
  `ordering` tinyint(1) UNSIGNED DEFAULT '0',
  `post_id` bigint(20) UNSIGNED ,
  `user_id` INT(11) UNSIGNED DEFAULT '0',
  `parent_id` INT( 11 ) NOT NULL DEFAULT 0,
  `sent` TINYINT( 1 ) NOT NULL DEFAULT 0,
  `lft` INT( 11 ) NOT NULL DEFAULT 0,
  `rgt` INT( 11 ) NOT NULL DEFAULT 0,
  PRIMARY KEY  (`id`),
  KEY `discuss_comment_postid` (`post_id`),
  KEY `discuss_comment_post_created` ( `post_id`, `created` )
) DEFAULT CHARSET=utf8mb4;

