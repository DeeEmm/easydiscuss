CREATE TABLE IF NOT EXISTS `#__discuss_reports` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `post_id` INT( 11 ) NOT NULL ,
  `reason` text NULL,
  `created_by` bigint(20) unsigned NULL DEFAULT 0,
  `created` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`id`),
  KEY `discuss_reports_post` (`post_id`)
) DEFAULT CHARSET=utf8mb4;

