CREATE TABLE IF NOT EXISTS `#__discuss_post_labels` (  
  `id` int(11) NOT NULL auto_increment,
  `title` varchar(255) NOT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `colour` varchar(255) NOT NULL,
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=1;

INSERT INTO `#__discuss_post_labels` (`id`, `title`, `published`, `colour`, `created`) VALUES (1, 'On Hold', 1, '#428BCA', '2020-08-07 11:48:20') ON DUPLICATE KEY UPDATE `id` = `id`;
INSERT INTO `#__discuss_post_labels` (`id`, `title`, `published`, `colour`, `created`) VALUES (2, 'Accepted', 1, '#5CB85C', '2020-08-07 11:48:20') ON DUPLICATE KEY UPDATE `id` = `id`;
INSERT INTO `#__discuss_post_labels` (`id`, `title`, `published`, `colour`, `created`) VALUES (3, 'Working On', 1, '#ffd119', '2020-08-07 11:48:20') ON DUPLICATE KEY UPDATE `id` = `id`;
INSERT INTO `#__discuss_post_labels` (`id`, `title`, `published`, `colour`, `created`) VALUES (4, 'Rejected', 1, '#FF0000', '2020-08-07 11:48:20') ON DUPLICATE KEY UPDATE `id` = `id`;