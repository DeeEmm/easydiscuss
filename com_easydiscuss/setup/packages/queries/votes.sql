CREATE TABLE IF NOT EXISTS `#__discuss_votes` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(11) UNSIGNED DEFAULT NULL,
  `post_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `ipaddress` varchar(15) DEFAULT NULL,
  `value` TINYINT(2) DEFAULT '0' NULL,
  `session_id` VARCHAR(200) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `discuss_user_post` (`user_id`, `post_id`),
  KEY `discuss_post_id` (`post_id`),
  KEY `discuss_user_id` (`user_id`),
  KEY `discuss_session_id` (`session_id` (190))
) DEFAULT CHARSET=utf8mb4;

