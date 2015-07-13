CREATE TABLE IF NOT EXISTS `#__ec_user` (
	`user` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT, 
	`modified` DATETIME NOT NULL DEFAULT '2015-01-01 00:00:00',
	`userlike` INT(11) UNSIGNED NOT NULL DEFAULT 0,
	`img` VARCHAR(5120) NOT NULL DEFAULT '',
	`profile` VARCHAR(5120) NOT NULL DEFAULT '',
	`option` VARCHAR(5120) NOT NULL DEFAULT '',
	PRIMARY KEY (`user`),
	KEY `idx_modified` (`modified`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



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