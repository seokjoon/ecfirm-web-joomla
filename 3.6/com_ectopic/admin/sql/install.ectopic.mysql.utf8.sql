CREATE TABLE IF NOT EXISTS `#__ec_topic` (
	`topic` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT, 
	`modified` DATETIME NOT NULL DEFAULT '2016-01-01 00:00:00',
	`topiccat` INT(11) UNSIGNED NOT NULL DEFAULT '0',
	`user` INT(11) UNSIGNED NOT NULL DEFAULT '0',
	`state` TINYINT(1) NOT NULL DEFAULT '1', 
	`title` VARCHAR(1024) NOT NULL DEFAULT '',
	`hits` INT(11) UNSIGNED NOT NULL DEFAULT 0, 
	`topiccmt` INT(11) UNSIGNED NOT NULL DEFAULT 0,
	`topiclike` INT(11) UNSIGNED NOT NULL DEFAULT 0,
	`options` VARCHAR(2048) NOT NULL DEFAULT '',
	`body` TEXT NOT NULL,
	`imgs` VARCHAR(5120) NOT NULL DEFAULT '',
	`files` VARCHAR(5120) NOT NULL DEFAULT '',
	PRIMARY KEY (`topic`),
	KEY `idx_modified` (`modified`),
	KEY `idx_topiccat` (`topiccat`),
	KEY `idx_user` (`user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



CREATE TABLE IF NOT EXISTS `#__ec_topiccat` (
	`topiccat` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
	`modified` DATETIME NOT NULL DEFAULT '2015-01-01 00:00:00',
	`parent` INT(11) UNSIGNED NOT NULL DEFAULT '0',
	`asset_id` INT(10) UNSIGNED NOT NULL DEFAULT '0',
	`state` TINYINT(1) NOT NULL DEFAULT '1', 
	`title` VARCHAR(255) NOT NULL DEFAULT '',
	`body` VARCHAR(2048) NOT NULL DEFAULT '',
	`options` VARCHAR(2048) NOT NULL DEFAULT '',
	PRIMARY KEY (`topiccat`),
	KEY `idx_modified` (`modified`),
	KEY `idx_parent` (`parent`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `#__ec_topiccat` (`topiccat`, `title`) VALUES
	(1, 'Default Topic');



CREATE TABLE IF NOT EXISTS `#__ec_topiccmt` (
	`topiccmt` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
	`modified` DATETIME NOT NULL DEFAULT '2016-01-01 00:00:00',
	`topic` INT(11) UNSIGNED NOT NULL DEFAULT 0,
	`user` INT(11) UNSIGNED NOT NULL DEFAULT 0,
	`options` VARCHAR(2048) NOT NULL DEFAULT '',
	`body` VARCHAR(5120) NOT NULL DEFAULT '',
	PRIMARY KEY (`topiccmt`),
	KEY `idx_modified` (`modified`),
	KEY `idx_topic` (`topic`),
	KEY `idx_user` (`user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS `#__ec_topiclike` (
	`topiclike` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
	`modified` DATETIME NOT NULL DEFAULT '2016-01-01 00:00:00',
	`topic` INT(11) UNSIGNED NOT NULL DEFAULT 0,
	`user` INT(11) UNSIGNED NOT NULL DEFAULT 0,
	PRIMARY KEY (`topiclike`),
	KEY `idx_modified` (`modified`),
	KEY `idx_topic_user` (`topic`, `user`),
	KEY `idx_user` (`user`),
	KEY `idx_topic` (`topic`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;