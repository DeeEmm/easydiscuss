CREATE TABLE IF NOT EXISTS `#__discuss_tnc` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `type` varchar(255) NOT NULL DEFAULT '0',
  `state` tinyint(2) NOT NULL,
  `ipaddress` varchar(15) NOT NULL,
  `session_id` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) DEFAULT CHARSET=utf8mb4;