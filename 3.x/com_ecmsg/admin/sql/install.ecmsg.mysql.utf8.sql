CREATE TABLE IF NOT EXISTS `#__ec_msg` (
	`msg` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT, 
	`objtype` INT(11) UNSIGNED NOT NULL DEFAULT '0', 
	`objcat` INT(11) UNSIGNED NOT NULL DEFAULT '0', 
	`obj` INT(11) UNSIGNED NOT NULL DEFAULT '0', 
	`modified` DATETIME NOT NULL DEFAULT '2015-01-01 00:00:00',
	`enable` TINYINT(1) NOT NULL DEFAULT 10,
	`featured` TINYINT(1) NOT NULL DEFAULT 10,
	`user` INT(11) UNSIGNED NOT NULL DEFAULT 0,
	`msgcmt` INT(11) UNSIGNED NOT NULL DEFAULT 0,
	`msglike` INT(11) UNSIGNED NOT NULL DEFAULT 0,
	`imgs` VARCHAR(5120) NOT NULL DEFAULT '',
	`options` VARCHAR(5120) NOT NULL DEFAULT '',
	`body` TEXT,
	PRIMARY KEY (`msg`),
	KEY `idx_modified` (`modified`),
	KEY `idx_obj` (`obj`),
	KEY `idx_user` (`user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



CREATE TABLE IF NOT EXISTS `#__ec_msglike` (
	`msglike` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
	`objtype` INT(11) UNSIGNED NOT NULL DEFAULT '0', 
	`objcat` INT(11) UNSIGNED NOT NULL DEFAULT '0', 
	`obj` INT(11) UNSIGNED NOT NULL DEFAULT '0', 
	`modified` DATETIME NOT NULL DEFAULT '2015-01-01 00:00:00',
	`msg` INT(11) UNSIGNED NOT NULL DEFAULT 0,
	`user` INT(11) UNSIGNED NOT NULL DEFAULT 0,
	PRIMARY KEY (`msglike`),
	KEY `idx_modified` (`modified`),
	KEY `idx_obj` (`obj`),
	KEY `idx_msg_user` (`msg`, `user`),
	KEY `idx_user` (`user`),
	KEY `idx_msg` (`msg`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



CREATE TABLE IF NOT EXISTS `#__ec_msgcmt` (
	`msgcmt` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
	`objtype` INT(11) UNSIGNED NOT NULL DEFAULT '0', 
	`objcat` INT(11) UNSIGNED NOT NULL DEFAULT '0', 
	`obj` INT(11) UNSIGNED NOT NULL DEFAULT '0', 
	`modified` DATETIME NOT NULL DEFAULT '2015-01-01 00:00:00',
	`msg` INT(11) UNSIGNED NOT NULL DEFAULT 0,
	`user` INT(11) UNSIGNED NOT NULL DEFAULT 0,
	`options` VARCHAR(5120) NOT NULL DEFAULT '',
	`body` TEXT,
	PRIMARY KEY (`msgcmt`),
	KEY `idx_modified` (`modified`),
	KEY `idx_obj` (`obj`),
	KEY `idx_msg` (`msg`),
	KEY `idx_user` (`user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;