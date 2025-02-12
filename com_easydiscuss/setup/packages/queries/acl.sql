CREATE TABLE IF NOT EXISTS `#__discuss_acl` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `group` varchar(64) NOT NULL,
  `action` varchar(255) NOT NULL,
  `default` tinyint(1) NOT NULL DEFAULT '1',
  `description` text NOT NULL,
  `published` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `ordering` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `public` tinyint(1) unsigned default '0',
  PRIMARY KEY (`id`),
  KEY `discuss_post_acl_action` (`action` (190))
) DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `#__discuss_acl_group` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `content_id` bigint(20) unsigned NOT NULL,
  `acl_id` bigint(20) unsigned NOT NULL,
  `status` tinyint(1) NOT NULL,
  `type` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `discuss_post_acl_content_type` (`content_id`,`type` (180)),
  KEY `discuss_post_acl` (`acl_id`)
) DEFAULT CHARSET=utf8mb4;
