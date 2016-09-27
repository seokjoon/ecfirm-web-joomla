CREATE TABLE IF NOT EXISTS `#__ec_user` (
	`user` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT, 
	`modified` DATETIME NOT NULL DEFAULT '2015-01-01 00:00:00',
	`usercat` INT(11) UNSIGNED NOT NULL DEFAULT 0,
	`userlike` INT(11) UNSIGNED NOT NULL DEFAULT 0,
	`profile` VARCHAR(5120) NOT NULL DEFAULT '',
	`options` VARCHAR(5120) NOT NULL DEFAULT '',
	`terms` VARCHAR(5120) NOT NULL DEFAULT '',
	`imgs` TEXT NOT NULL,
	PRIMARY KEY (`user`),
	KEY `idx_modified` (`modified`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



CREATE TABLE IF NOT EXISTS `#__ec_usercat` (
	`usercat` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT, 
	`modified` DATETIME NOT NULL DEFAULT '2015-01-01 00:00:00',
	`title` VARCHAR(5120) NOT NULL DEFAULT '',
	`options` VARCHAR(5120) NOT NULL DEFAULT '',
	PRIMARY KEY (`usercat`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `#__ec_usercat` (`usercat`, `modified`, `title`) VALUES 
	(1, 1, 'shopkeeper'), (2, 1, 'shopper'), (3, 1, 'admin');
	


CREATE TABLE IF NOT EXISTS `#__ec_userlike` (
	`userlike` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
	`objtype` INT(11) UNSIGNED NOT NULL DEFAULT '0', 
	`objcat` INT(11) UNSIGNED NOT NULL DEFAULT '0', 
	`obj` INT(11) UNSIGNED NOT NULL DEFAULT '0', 
	`modified` DATETIME NOT NULL DEFAULT '2015-01-01 00:00:00',
	`userTrg` INT(11) UNSIGNED NOT NULL DEFAULT 0,
	`userSrc` INT(11) UNSIGNED NOT NULL DEFAULT 0,
	PRIMARY KEY (`userlike`),
	KEY `idx_modified` (`modified`),
	KEY `idx_obj` (`obj`),
	KEY `idx_userTrg_userSrc` (`userTrg`, `userSrc`),
	KEY `idx_userTrg` (`userTrg`),
	KEY `idx_userSrc` (`userSrc`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;