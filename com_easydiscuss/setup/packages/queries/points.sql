CREATE TABLE IF NOT EXISTS `#__discuss_points` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `rule_id` bigint(20) NOT NULL,
  `title` text NOT NULL,
  `created` datetime NOT NULL,
  `published` tinyint(3) NOT NULL,
  `rule_limit` bigint(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `discuss_points_rule` (`rule_id`),
  KEY `discuss_points_published` (`published`)
) DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `#__discuss_rules` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `command` text NOT NULL,
  `title` text NOT NULL,
  `description` text NOT NULL,
  `callback` text NOT NULL,
  `created` datetime NOT NULL,
  `published` tinyint(3) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `discuss_rules_command` ( `command` (190) )
) DEFAULT CHARSET=utf8mb4;
