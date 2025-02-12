CREATE TABLE IF NOT EXISTS `#__discuss_oauth` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(255) NOT NULL,
  `request_token` text,
  `access_token` text,
  `message` text,
  `params` text,
  PRIMARY KEY (`id`),
  KEY `discuss_oauth_type` (`type` (190))
) DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `#__discuss_oauth_posts` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `post_id` bigint(20) NOT NULL,
  `oauth_id` bigint(20) NOT NULL,
  PRIMARY KEY (`id`)
) DEFAULT CHARSET=utf8mb4;