CREATE TABLE IF NOT EXISTS `#__discuss_ranks` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `title` text NOT NULL,
  `start` bigint(20) NOT NULL default 0,
  `end` bigint(20) NOT NULL default 0,
  PRIMARY KEY (`id`),
  KEY `discuss_ranks_range` ( `start`, `end` )
) DEFAULT CHARSET=utf8mb4;


CREATE TABLE IF NOT EXISTS `#__discuss_ranks_users` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `rank_id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `ranks_users` (`rank_id`,`user_id`),
  KEY `ranks_id` (`rank_id`),
  KEY `ranks_userid` (`user_id`),
  KEY `idx_userrank` (`user_id`, `rank_id`)
) DEFAULT CHARSET=utf8mb4;

INSERT INTO `#__discuss_ranks` (`id`, `title`, `start`, `end` ) values ('1', 'New Member', '1', '50') ON DUPLICATE KEY UPDATE `id` = `id`;
INSERT INTO `#__discuss_ranks` (`id`, `title`, `start`, `end` ) values ('2', 'Junior Member', '51', '150') ON DUPLICATE KEY UPDATE `id` = `id`;
INSERT INTO `#__discuss_ranks` (`id`, `title`, `start`, `end` ) values ('3', 'Senior Member', '151', '350') ON DUPLICATE KEY UPDATE `id` = `id`;
INSERT INTO `#__discuss_ranks` (`id`, `title`, `start`, `end` ) values ('4', 'Expert Member', '351', '600') ON DUPLICATE KEY UPDATE `id` = `id`;
