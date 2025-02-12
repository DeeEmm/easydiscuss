CREATE TABLE IF NOT EXISTS `#__discuss_attachments` (
  `id` int(11) NOT NULL auto_increment,
  `uid` int(11) NOT NULL,
  `title` text NOT NULL,
  `type` varchar(200) NOT NULL,
  `path` text NOT NULL,
  `created` datetime NOT NULL,
  `published` tinyint(3) NOT NULL,
  `mime` text NOT NULL,
  `size` text NOT NULL,
  `storage` VARCHAR(255) NOT NULL DEFAULT 'joomla',
  PRIMARY KEY  (`id`),
  KEY `uid` (`uid`),
  KEY `type` (`type` (190))
) DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `#__discuss_attachments_tmp` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `path` text NOT NULL,
  `title` text NOT NULL,
  `mime` varchar(255) NOT NULL,
  `size` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `userid` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `#__discuss_optimizer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `attachment_id` int(11) NOT NULL,
  `status` tinyint(3) NOT NULL,
  `log` longtext NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `attachment_id` (`attachment_id`),
  KEY `status` (`status`)
) DEFAULT CHARSET=utf8mb4;