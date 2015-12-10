CREATE TABLE IF NOT EXISTS `#__ec_cont` (
	`cont` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT, 
	`modified` DATETIME NOT NULL DEFAULT '2015-01-01 00:00:00',
	`objtype` INT(11) UNSIGNED NOT NULL DEFAULT '0', 
	`objcat` INT(11) UNSIGNED NOT NULL DEFAULT '0', 
	`obj` INT(11) UNSIGNED NOT NULL DEFAULT '0', 
	`user` INT(11) UNSIGNED NOT NULL DEFAULT 0,
	`title` VARCHAR(1024) NOT NULL DEFAULT '0',
	`enable` TINYINT(1) NOT NULL DEFAULT 10,
	`featured` TINYINT(1) NOT NULL DEFAULT 10,
	`contcmt` INT(11) UNSIGNED NOT NULL DEFAULT 0,
	`contlike` INT(11) UNSIGNED NOT NULL DEFAULT 0,
	`options` VARCHAR(5120) NOT NULL DEFAULT '',
	`body` TEXT NOT NULL,
	`imgs` TEXT NOT NULL,
	`file` TEXT NOT NULL,
	PRIMARY KEY (`cont`),
	KEY `idx_modified` (`modified`),
	KEY `idx_obj` (`obj`),
	KEY `idx_user` (`user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



CREATE TABLE IF NOT EXISTS `#__ec_contlike` (
	`contlike` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
	`objtype` INT(11) UNSIGNED NOT NULL DEFAULT '0', 
	`objcat` INT(11) UNSIGNED NOT NULL DEFAULT '0', 
	`obj` INT(11) UNSIGNED NOT NULL DEFAULT '0', 
	`modified` DATETIME NOT NULL DEFAULT '2015-01-01 00:00:00',
	`cont` INT(11) UNSIGNED NOT NULL DEFAULT 0,
	`user` INT(11) UNSIGNED NOT NULL DEFAULT 0,
	PRIMARY KEY (`contlike`),
	KEY `idx_modified` (`modified`),
	KEY `idx_obj` (`obj`),
	KEY `idx_cont_user` (`cont`, `user`),
	KEY `idx_cont` (`cont`),
	KEY `idx_user` (`user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



CREATE TABLE IF NOT EXISTS `#__ec_contcmt` (
	`contcmt` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
	`objtype` INT(11) UNSIGNED NOT NULL DEFAULT '0', 
	`objcat` INT(11) UNSIGNED NOT NULL DEFAULT '0', 
	`obj` INT(11) UNSIGNED NOT NULL DEFAULT '0', 
	`modified` DATETIME NOT NULL DEFAULT '2015-01-01 00:00:00',
	`cont` INT(11) UNSIGNED NOT NULL DEFAULT 0,
	`user` INT(11) UNSIGNED NOT NULL DEFAULT 0,
	`options` VARCHAR(5120) NOT NULL DEFAULT '',
	`body` TEXT NOT NULL,
	PRIMARY KEY (`contcmt`),
	KEY `idx_modified` (`modified`),
	KEY `idx_obj` (`obj`),
	KEY `idx_cont` (`cont`),
	KEY `idx_user` (`user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;