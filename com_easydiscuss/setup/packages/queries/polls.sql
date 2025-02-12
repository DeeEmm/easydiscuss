CREATE TABLE IF NOT EXISTS `#__discuss_polls` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `post_id` bigint(20) NOT NULL,
  `value` text NOT NULL,
  `count` bigint(20) NOT NULL DEFAULT '0',
  `multiple_polls` tinyint(1) UNSIGNED NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `post_id` (`post_id`),
  KEY `polls_posts` ( post_id , id )
) DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS `#__discuss_polls_users` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `poll_id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `session_id` VARCHAR(200) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `poll_id` (`poll_id`,`user_id`)
) DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS `#__discuss_polls_question` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `post_id` bigint(20) NOT NULL,
  `title` text NOT NULL,
  `multiple` tinyint(1) DEFAULT '0',
  `locked` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `post_id` (`post_id`)
) DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=1;