CREATE TABLE IF NOT EXISTS `#__discuss_conversations` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `created` datetime NOT NULL,
  `created_by` bigint(20) NOT NULL,
  `lastreplied` datetime NOT NULL,
  PRIMARY KEY (`id`)
) DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `#__discuss_conversations_message` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `conversation_id` bigint(20) NOT NULL,
  `message` text,
  `created` datetime NOT NULL,
  `created_by` bigint(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `conversation_id` (`conversation_id`),
  KEY `created_by` (`created_by`)
) DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `#__discuss_conversations_message_maps` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL,
  `conversation_id` bigint(20) NOT NULL,
  `message_id` bigint(20) NOT NULL,
  `isread` tinyint(1) NOT NULL DEFAULT '0',
  `state` tinyint(3) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `node_id` (`user_id`),
  KEY `conversation_id` (`conversation_id`),
  KEY `message_id` (`message_id`)
) DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `#__discuss_conversations_participants` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `conversation_id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `conversation_id` (`conversation_id`)
) DEFAULT CHARSET=utf8mb4;
