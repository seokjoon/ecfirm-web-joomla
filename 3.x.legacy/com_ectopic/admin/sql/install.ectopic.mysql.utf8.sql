CREATE TABLE IF NOT EXISTS `#__ec_topic` (
	`topic` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT, 
	`modified` DATETIME NOT NULL DEFAULT '2016-01-01 00:00:00',
	`objcat` INT(11) UNSIGNED NOT NULL DEFAULT '0', 
	`user` INT(11) UNSIGNED NOT NULL DEFAULT '0',
	`title` VARCHAR(1024) NOT NULL DEFAULT '',
	`attr` TINYINT(1) NOT NULL DEFAULT '1', 
	`topiccmt` INT(11) UNSIGNED NOT NULL DEFAULT 0,
	`topiclike` INT(11) UNSIGNED NOT NULL DEFAULT 0,
	`options` VARCHAR(5120) NOT NULL DEFAULT '',
	`body` TEXT NOT NULL,
	`imgs` TEXT NOT NULL,
	`files` TEXT NOT NULL,
	PRIMARY KEY (`topic`),
	KEY `idx_modified` (`modified`),
	KEY `idx_user` (`user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



CREATE TABLE IF NOT EXISTS `#__ec_topiccmt` (
	`topiccmt` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
	`modified` DATETIME NOT NULL DEFAULT '2016-01-01 00:00:00',
	`objcat` INT(11) UNSIGNED NOT NULL DEFAULT '0', 
	`topic` INT(11) UNSIGNED NOT NULL DEFAULT 0,
	`user` INT(11) UNSIGNED NOT NULL DEFAULT 0,
	`options` VARCHAR(5120) NOT NULL DEFAULT '',
	`body` TEXT NOT NULL,
	PRIMARY KEY (`topiccmt`),
	KEY `idx_modified` (`modified`),
	KEY `idx_topic` (`topic`),
	KEY `idx_user` (`user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS `#__ec_topiclike` (
	`topiclike` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
	`modified` DATETIME NOT NULL DEFAULT '2016-01-01 00:00:00',
	`objcat` INT(11) UNSIGNED NOT NULL DEFAULT '0', 
	`topic` INT(11) UNSIGNED NOT NULL DEFAULT 0,
	`user` INT(11) UNSIGNED NOT NULL DEFAULT 0,
	PRIMARY KEY (`topiclike`),
	KEY `idx_modified` (`modified`),
	KEY `idx_topic_user` (`topic`, `user`),
	KEY `idx_user` (`user`),
	KEY `idx_topic` (`topic`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;