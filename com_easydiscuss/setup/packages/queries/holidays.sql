CREATE TABLE IF NOT EXISTS `#__discuss_holidays` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `title` text NOT NULL,
  `description` text NOT NULL,
  `created` datetime NOT NULL,
  `start` datetime NOT NULL,
  `end` datetime NOT NULL,
  `published` tinyint(3) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `holiday_start_end` (`start`, `end` )
) DEFAULT CHARSET=utf8mb4;