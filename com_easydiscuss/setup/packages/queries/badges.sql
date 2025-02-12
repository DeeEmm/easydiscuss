
CREATE TABLE IF NOT EXISTS `#__discuss_badges` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `rule_id` bigint(20) NOT NULL,
  `title` text NOT NULL,
  `alias` VARCHAR(255) NOT NULL,
  `description` text NOT NULL,
  `avatar` text NOT NULL,
  `created` datetime NOT NULL,
  `published` tinyint(3) NOT NULL,
  `rule_limit` bigint(20) NOT NULL,
  `achieve_type` VARCHAR(65) NOT NULL DEFAULT 'frequency',
  `badge_achieve_rule` VARCHAR(255) NULL,
  `badge_remove_rule` VARCHAR(255) NULL,
  `points_threshold` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `discuss_badges_alias` (`alias` (190)),
  KEY `discuss_badges_published` (`published`)
) DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `#__discuss_badges_history` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL,
  `title` text NOT NULL,
  `command` text NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `#__discuss_badges_rules` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `command` text NOT NULL,
  `title` text NOT NULL,
  `description` text NOT NULL,
  `callback` text NOT NULL,
  `created` datetime NOT NULL,
  `published` tinyint(3) NOT NULL,
  PRIMARY KEY (`id`)
) DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `#__discuss_badges_users` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `badge_id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `created` datetime NOT NULL,
  `published` tinyint(3) NOT NULL,
  `custom` TEXT,
  PRIMARY KEY (`id`),
  KEY `badge_id` (`badge_id`,`user_id`)
) DEFAULT CHARSET=utf8mb4;
