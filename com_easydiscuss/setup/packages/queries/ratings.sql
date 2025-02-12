CREATE TABLE IF NOT EXISTS `#__discuss_ratings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `created_by` int(11) NOT NULL,
  `sessionid` varchar(255) NOT NULL,
  `value` int(11) NOT NULL,
  `ip` varchar(50) NOT NULL,
  `published` tinyint(3) NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `ratings_uid_created_by` (`uid`,`created_by`)
) DEFAULT CHARSET=utf8mb4;