-- Make sure to also edit /includes/php/classes/Visitor.php Visitor::createTables() 
-- with the correct data if editing this file.

CREATE TABLE IF NOT EXISTS `visitor` (
	`id` int(12) unsigned NOT NULL AUTO_INCREMENT,
	`unique_visitor` smallint(12) NOT NULL DEFAULT '-1',
	`user_ip` varchar(40) NOT NULL,
	`user_language` varchar(64) NOT NULL,
	`user_useragent` varchar(128) NOT NULL,
	`user_path` varchar(128) NOT NULL,
	`user_query_string` varchar(128) NOT NULL,
	`timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;