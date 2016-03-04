CREATE TABLE IF NOT EXISTS `#__ec_objcat` (
	`objcat` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT, 
	`objtype` INT(11) UNSIGNED NOT NULL DEFAULT 0, 
	`modified` DATETIME NOT NULL DEFAULT '2015-01-01 00:00:00',
	`name` VARCHAR(255) NOT NULL DEFAULT '',
	`options` VARCHAR(5120) NOT NULL DEFAULT '',
	PRIMARY KEY (`objcat`),
	KEY `idx_modified` (`modified`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `#__ec_objcat` (`objcat`, `objtype`, `name`) VALUES 
	(1, 1, 'User Default'), (2, 2, 'Topic Default');
	
	
	
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