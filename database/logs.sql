-- This is also used in /includes/php/classes/logger.php
-- If you modify this file, make sure to look at Logger::createTables()

CREATE TABLE IF NOT EXISTS `logs` (
  `id` int(12) unsigned NOT NULL AUTO_INCREMENT,
  `visitor_id` int(12) unsigned NOT NULL,
  `log_type` varchar(32) NOT NULL,
  `log_message` varchar(256) NOT NULL,
  `log_description` varchar(128) DEFAULT NULL,
  `php_version` varchar(12) NOT NULL,
  `php_last_error` varchar(256) DEFAULT NULL,
  `php_memory_usage` int(25) NOT NULL,
  `php_peak_memory_usage` int(25) NOT NULL,
  `php_included_files` varchar(512) DEFAULT NULL,
  `php_os` varchar(64) NOT NULL,
  `shell_uptime` varchar(64) DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_visit_id` (`visitor_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;