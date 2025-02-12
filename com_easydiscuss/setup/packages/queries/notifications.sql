
CREATE TABLE IF NOT EXISTS `#__discuss_notifications` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `title` text NOT NULL,
  `cid` bigint(20) NOT NULL,
  `type` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `target` bigint(20) NOT NULL,
  `author` bigint(20) NOT NULL,
  `permalink` text NOT NULL,
  `state` tinyint(4) NOT NULL,
  `favicon` TEXT,
  `component` VARCHAR(255) NOT NULL,
  `anonymous` tinyint(1) default 0,
  PRIMARY KEY (`id`),
  KEY `discuss_notification_created` (`created`),
  KEY `discuss_notification` (`target`, `state`, `cid`, `created`, `id`)
) DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=1;
