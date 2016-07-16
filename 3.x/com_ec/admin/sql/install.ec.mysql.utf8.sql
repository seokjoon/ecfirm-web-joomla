CREATE TABLE IF NOT EXISTS `#__ec_ecjcat` (
	`eccat` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT, 
	`modified` DATETIME NOT NULL DEFAULT '2015-01-01 00:00:00',
	`ectype` INT(11) UNSIGNED NOT NULL DEFAULT 0, 
	`parent` INT(11) UNSIGNED NOT NULL DEFAULT '0', 
	`asset_id` INT(10) UNSIGNED NOT NULL DEFAULT '0',
	`title` VARCHAR(255) NOT NULL DEFAULT '',
	`body` VARCHAR(2048) NOT NULL DEFAULT '',
	`options` VARCHAR(2048) NOT NULL DEFAULT '',
	PRIMARY KEY (`eccat`),
	KEY `idx_modified` (`modified`),
	KEY `idx_parent` (`parent`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `#__ec_eccat` (`eccat`, `ectype`, `title`) VALUES 
	(1, 1, 'Default User'), (2, 2, 'Default Topic');
	
	
	
CREATE TABLE IF NOT EXISTS `#__ec_ectype` (
	`ectype` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT, 
	`modified` DATETIME NOT NULL DEFAULT '2015-01-01 00:00:00',
	`title` VARCHAR(255) NOT NULL DEFAULT '',
	PRIMARY KEY (`ectype`),
	KEY `idx_modified` (`modified`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `#__ec_ectype` (`ectype`, `title`) VALUES 
	(1, 'User'), (2, 'Topic');



CREATE TABLE IF NOT EXISTS `#__ec_objcat` (
	`objcat` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT, 
	`objtype` INT(11) UNSIGNED NOT NULL DEFAULT 0, 
	`modified` DATETIME NOT NULL DEFAULT '2015-01-01 00:00:00',
	`asset_id` INT(10) UNSIGNED NOT NULL DEFAULT '0',
	`name` VARCHAR(255) NOT NULL DEFAULT '',
	`options` VARCHAR(5120) NOT NULL DEFAULT '',
	PRIMARY KEY (`objcat`),
	KEY `idx_modified` (`modified`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `#__ec_objcat` (`objcat`, `objtype`, `name`) VALUES 
	(1, 1, 'Default User'), (2, 2, 'Default Topic');
	
	
	
CREATE TABLE IF NOT EXISTS `#__ec_objtype` (
	`objtype` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT, 
	`modified` DATETIME NOT NULL DEFAULT '2015-01-01 00:00:00',
	`name` VARCHAR(255) NOT NULL DEFAULT '',
	`options` VARCHAR(5120) NOT NULL DEFAULT '',
	PRIMARY KEY (`objtype`),
	KEY `idx_modified` (`modified`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `#__ec_objtype` (`objtype`, `name`) VALUES 
	(1, 'User'), (2, 'Topic');