CREATE TABLE IF NOT EXISTS `#__ec_page` (
	`page` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT, 
	`objtype` INT(11) UNSIGNED NOT NULL DEFAULT '0', 
	`objcat` INT(11) UNSIGNED NOT NULL DEFAULT '0', 
	`obj` INT(11) UNSIGNED NOT NULL DEFAULT '0',
	`modified` DATETIME NOT NULL DEFAULT '2015-01-01 00:00:00',
	`title` VARCHAR(255) NOT NULL DEFAULT '',
	`user` INT(11) UNSIGNED NOT NULL DEFAULT 0,
	`pagelike` INT(11) UNSIGNED NOT NULL DEFAULT 0,
	`option` VARCHAR(5120) NOT NULL DEFAULT '',
	`body` TEXT,
	PRIMARY KEY (`page`),
	KEY `idx_modified` (`modified`),
	KEY `idx_obj` (`obj`),
	KEY `idx_user` (`user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



CREATE TABLE IF NOT EXISTS `#__ec_pagelike` (
	`pagelike` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
	`objtype` INT(11) UNSIGNED NOT NULL DEFAULT '0', 
	`objcat` INT(11) UNSIGNED NOT NULL DEFAULT '0', 
	`obj` INT(11) UNSIGNED NOT NULL DEFAULT '0', 
	`modified` DATETIME NOT NULL DEFAULT '2015-01-01 00:00:00',
	`page` INT(11) UNSIGNED NOT NULL DEFAULT 0,
	`user` INT(11) UNSIGNED NOT NULL DEFAULT 0,
	PRIMARY KEY (`pagelike`),
	KEY `idx_modified` (`modified`),
	KEY `idx_obj` (`obj`),
	KEY `idx_page_user` (`page`, `user`),
	KEY `idx_user` (`user`),
	KEY `idx_page` (`page`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;