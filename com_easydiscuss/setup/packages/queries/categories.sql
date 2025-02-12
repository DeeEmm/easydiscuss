
CREATE TABLE IF NOT EXISTS `#__discuss_category` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `created_by` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` TEXT,
  `alias` varchar(255) DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `published` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `ordering` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `avatar` varchar(255) DEFAULT NULL,
  `parent_id` int(11) DEFAULT '0',
  `private` int(11) unsigned NOT NULL DEFAULT '0',
  `default` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `level` int(11) NULL,
  `lft` int(11) NULL,
  `rgt` int(11) NULL,
  `params` TEXT NOT NULL,
  `container` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `language` char(7) NOT NULL,
  `global_acl` tinyint(1) NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `discuss_cat_published` (`published`),
  KEY `discuss_cat_parentid` (`parent_id`),
  KEY `discuss_cat_mod_categories1` (`published`, `private`, `id`),
  KEY `discuss_cat_mod_categories2` (`published`, `private`, `ordering`),
  KEY `discuss_cat_acl` (`parent_id`, `published`, `ordering`),
  KEY `idx_cat_childs` (`parent_id`, `published`, `lft`),
  KEY `idx_lft_rgt` (`lft`, `rgt`),
  KEY `idx_rgt_lft` (`rgt`, `lft`)
) DEFAULT CHARSET=utf8mb4;


CREATE TABLE IF NOT EXISTS `#__discuss_category_acl_item` (
  `id` bigint(20) NOT NULL auto_increment,
  `action` varchar(255) NOT NULL,
  `description` text,
  `published` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `default` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`)
) DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS `#__discuss_category_acl_map` (
  `id` bigint(20) NOT NULL auto_increment,
  `category_id` bigint(20) NOT NULL,
  `acl_id` bigint(20) NOT NULL,
  `type` varchar(25) NOT NULL,
  `content_id` bigint(20) NOT NULL,
  `status` tinyint(1) default 0,
  PRIMARY KEY  (`id`),
  KEY `discuss_category_acl` (`category_id`),
  KEY `discuss_category_acl_id` (`acl_id`),
  KEY `discuss_content_type` (`content_id`, `type`),
  KEY `discuss_category_content_type` (`category_id`, `content_id`, `type`),
  KEY `discuss_category_acl_content_type` (`category_id`, `acl_id`, `content_id`, `type`)
) DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=1;

INSERT INTO `#__discuss_category_acl_item` (`id`, `action`, `description`, `published`, `default`) values ('1', 'select', 'can select the category during question creation.', 1, 1) ON DUPLICATE KEY UPDATE `default` = '1';
INSERT INTO `#__discuss_category_acl_item` (`id`, `action`, `description`, `published`, `default`) values ('2', 'view', 'can view the category posts.', 1, 1) ON DUPLICATE KEY UPDATE `default` = '1';
INSERT INTO `#__discuss_category_acl_item` (`id`, `action`, `description`, `published`, `default`) values ('3', 'reply', 'can reply to category posts.', 1, 1) ON DUPLICATE KEY UPDATE `default` = '1';
INSERT INTO `#__discuss_category_acl_item` (`id`, `action`, `description`, `published`, `default`) values ('4', 'viewreply', 'can view the category replies.', 1, 1) ON DUPLICATE KEY UPDATE `default` = '1';
INSERT INTO `#__discuss_category_acl_item` (`id`, `action`, `description`, `published`, `default`) values ('5', 'moderate', 'can moderate this category.', 1, 0) ON DUPLICATE KEY UPDATE `default` = '0';
INSERT INTO `#__discuss_category_acl_item` (`id`, `action`, `description`, `published`, `default`) values ('6', 'uploadattachment', 'can upload attachments to category posts.', 1, 1) ON DUPLICATE KEY UPDATE `default` = '1';
INSERT INTO `#__discuss_category_acl_item` (`id`, `action`, `description`, `published`, `default`) values ('7', 'comment', 'can add comment in this category.', 1, 1) ON DUPLICATE KEY UPDATE `default` = '1';
INSERT INTO `#__discuss_category_acl_item` (`id`, `action`, `description`, `published`, `default`) values ('8', 'assignment', 'assign moderator into posts that associated with this category.', 1, 0) ON DUPLICATE KEY UPDATE `default` = '0';
