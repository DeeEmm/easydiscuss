CREATE TABLE IF NOT EXISTS`#__discuss_tags` (
  `id` BIGINT( 20 ) UNSIGNED NOT NULL AUTO_INCREMENT ,
  `title` VARCHAR( 100 ) NOT NULL ,
  `alias` VARCHAR( 100 ) NOT NULL ,
  `created` DATETIME NOT NULL ,
  `published` TINYINT( 1 ) UNSIGNED DEFAULT '0',
  `user_id` INT( 11 ) UNSIGNED,
  PRIMARY KEY (`id`) ,
  KEY `discuss_tags_alias` (`alias`) ,
  KEY `discuss_tags_user_id` (`user_id`) ,
  KEY `discuss_tags_published` (`published`),
  KEY `discuss_tags_query1` (`published`, `id`),
  FULLTEXT `discuss_tags_title` (`title`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `#__discuss_posts_tags` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `post_id` bigint(20) unsigned DEFAULT NULL,
  `tag_id` bigint(20) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `post_tag` (`post_id`,`tag_id`),
  KEY `discuss_posts_tags_tagid` (`tag_id`),
  KEY `discuss_posts_tags_postid` (`post_id`)
) DEFAULT CHARSET=utf8mb4;


