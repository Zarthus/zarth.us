<?php
if (!defined("SITE_INIT")) die("Website is not initialised properly, you cannot open this file directly");
/**
 *	Logger
 *
 *	This class handles the logging of certain errors or messages
 *	to the database. It's much like an error handler, but this
 *	also extends on the fact that you can log other things, and
 *	it also catches non fatal errors without displaying them to
 *	the public regardless of error_reporting being enabled
 *
 *	Example errors;
 *		Lack of setting define() that alters the site
 *		(i.e. USER_PATH)
 *
 *		Unmandatory files not existing or being unreadable
 *
 *	@package	zarth.us
 *	@author		Zarthus <zarthus@zarth.us>
 *	@link		https://github.com/Zarthus/zarth.us
 *	@license	MIT - View http://zarth.us/licenses/zarth.us or the LICENSE.md file in the github repository
 *	@since		19/03/2014
 */

class Logger
{
	/**
	 *	@boolean log_errors Log errors
	 */
	public $log_errors;

	/**
	 *	@boolean log_notices Log notices
	 */
	public $log_notices;

	/**
	 *	@boolean log_debug Log debug messages
	 */
	public $log_debug;

	/**
	 *	@array last log recorded in array format.
	 */
	public $last_log = array();

	/**
	 *	@PDO Object database handle
	 */
	private $dbh;

	/**
	 *	@integer visitor id The Visitor::getUserInsertID() ID.
	 */
	private $visitor_id;

	/**
	 *	@string Table name
	 */
	private $logger_table;

	/**
	 * 	@Logger The logger class itself.
	 *	@static
	 */
	public static $instance;

	/**
	 *	Set Instance
	 *
	 *	Set the class with an instance of itself.
	 *
	 *	@param $logger Instance of Logger
	 *	@throws Exception if $logger is not an instance of Logger.
	 *	@access public
	 *	@static
	 */
	public static function setInstance($logger)
	{
		if (!($logger instanceof Logger))
		{
			throw new Exception("\$logger was not an instance of Logger");
		}

		self::$instance = $logger;
	}

	/**
	 *	Set Instance
	 *
	 *	Set the class with an instance of itself.
	 *
	 *	@throws Exception if self::$instance is not set.
	 *	@return Logger Instance of self.
	 *	@access public
	 *	@static
	 */
	public static function getInstance()
	{
		if (!isset(self::$instance))
		{
			throw new Exception("Could not get instance of Logger as its instance was not set.");
		}

		return Logger::$instance;
	}

	/**
	 *	Constructor
	 *
	 *	Set the database handle, and multiple other user related variables.
	 *
	 *	@param $dbh PDO Object
	 *	@param $log_errors Boolean (true) Log messages that are passed with the 'error' severity.
	 *	@param $log_notice Boolean (true) Log messages that are passed with the 'notice' severity.
	 *	@param $log_debug Boolean (false) Log messages that are passed with the 'debug' severity.
	 *	@param $create_table Boolean (true) Create table if it does not exist yet
	 *	@param $table_name String ("logs") name of the table.
	 *	@throws Exception if $dbh is not an instance of PDO.
	 *	@throws Exception if $log_* is not a boolean.
	 *	@access public
	 */
	public function __construct($dbh, $visitor_id, $log_errors = true, $log_notices = true, $log_debug = false, $create_table = true, $table_name = "logs")
	{
		if (!($dbh instanceof PDO))
		{
			throw new Exception("\$dbh is not instance of PDO");
		}

		$this->dbh = $dbh;

		if (!is_bool($log_errors) || !is_bool($log_notices) || !is_bool($log_debug))
		{
			if (!is_bool($log_errors)) throw new Exception("\$log_errors is not a boolean value. Is type " . gettype($log_errors) . ' instead');
			if (!is_bool($log_notices)) throw new Exception("\$log_notices is not a boolean value. Is type " . gettype($log_notices) . ' instead');
			if (!is_bool($log_debug)) throw new Exception("\$log_debug is not a boolean value. Is type " . gettype($log_debug) . ' instead');
		}

		$this->log_errors = $log_errors;
		$this->log_notices = $log_notices;
		$this->log_debug = $log_debug;

		$this->visitor_id = (int) $visitor_id;

		$this->logger_table = Utilities::sanitizeTableName($table_name);
		if ($create_table) $this->createTables();

		Logger::setInstance($this);

		$this->debug("Logger initialised properly", "Whenever the class is created, this is logged.");
	}

	/**
	 *	PHP Error
	 *
	 *	Log a PHP error to the database, used in the Error Handler.
	 *
	 *	@param String errtype The Error Type (E_NOTICE, E_ERROR, ..) in string format.
	 *	@param String message The message to log
	 *	@param String description A small description of what could cause the issue
	 *	@return Boolean false if error logging is disabled, true otherwise.
	 *	@access public
	 */
	public function php_error($errtype, $message, $description = "")
	{
		if (!$this->log_errors) return false;
		if ($description == "") $description = "No description provided";

		$this->log($errtype, $message, $description);

		return true;
	}

	/**
	 *	Error
	 *
	 *	Log an error to the database.
	 *
	 *	@param String message The message to log
	 *	@param String description A small description of what could cause the issue
	 *	@return Boolean false if error logging is disabled, true otherwise.
	 *	@access public
	 */
	public function error($message, $description = "")
	{
		if (!$this->log_errors) return false;
		if ($description == "") $description = "No description provided";

		$this->log('error', $message, $description);

		return true;
	}

	/**
	 *	Notice
	 *
	 *	Log a notice to the database.
	 *
	 *	@param String message The message to log
	 *	@param String description A small description of what could cause the issue
	 *	@return Boolean false if notice logging is disabled, true otherwise.
	 *	@access public
	 */
	public function notice($message, $description = "")
	{
		if (!$this->log_notices) return false;
		if ($description == "") $description = "No description provided";

		$this->log('notice', $message, $description);

		return true;
	}

	/**
	 *	Debug
	 *
	 *	Log a debug notice to the database.
	 *
	 *	@param String message The message to log
	 *	@param String description A small description of what could cause the issue
	 *	@return Boolean false if debug logging is disabled, true otherwise.
	 *	@access public
	 */
	public function debug($message, $description = "")
	{
		if (!$this->log_debug) return false;
		if ($description == "") $description = "No description provided";

		$this->log('debug', $message, $description);

		return true;
	}

	/**
	 *	Get Last Log
	 *
	 *	Return the last recorded log entry
	 *
	 *	@return Array last log recorded, or an empty array if nothing was logged
	 *	@access public
	 */
	public function getLastLog()
	{
		return $this->last_log;
	}

	/**
	 *	Log
	 *
	 *	Insert the data to the database.
	 *
	 *	@access private
	 */
	private function log($log_type, $log_message, $log_description)
	{
		// Retrieve all necessary data prior to executing the query.
		if (strtoupper(substr(PHP_OS, 0, 3)) == 'WIN')
		{	// Windows
			$uptime = exec('net statistics server | find "Statistics since"');
		}
		else
		{ 	// Linux, other OSes are not supported.
			$uptime = exec('uptime');
		}

		$err = error_get_last();
		if ($err === null) $err = "No errors occured during runtime";
		else
		{
			$err = '[' . $err['type'] . '] ' . $err['message'] . ' | File: ' . $err['file'] . ' | Line: ' . $err['line'];
		}

		$mem = memory_get_usage();
		$mempeak = memory_get_peak_usage();
		$incfiles = implode(', ', get_included_files());
		$pver = PHP_VERSION;
		$pos = PHP_OS;

		// Insert into database
		$stmt = $this->dbh->prepare("
			INSERT INTO `{$this->logger_table}`
			(`visitor_id`, `log_type`, `log_message`, `log_description`,
			 `php_version`, `php_last_error`, `php_memory_usage`, `php_peak_memory_usage`, `php_included_files`, `php_os`,
			 `shell_uptime`)
			VALUES
			(:vid, :ltype, :lmessage, :ldescription, :pversion, :perr, :pmem, :pmempeak, :pinc, :pos, :sup)
		");
		// Visitor ID bind
		$stmt->bindParam(':vid', $this->visitor_id, PDO::PARAM_INT, 12);
		// Log type binds
		$stmt->bindParam(':ltype', $log_type, PDO::PARAM_STR, 32);
		$stmt->bindParam(':lmessage', $log_message, PDO::PARAM_STR, 256);
		$stmt->bindParam(':ldescription', $log_description, PDO::PARAM_STR, 128);
		// PHP type binds
		$stmt->bindParam(':pversion', $pver, PDO::PARAM_STR, 12);
		$stmt->bindParam(':perr', $err, PDO::PARAM_STR, 256);
		$stmt->bindParam(':pmem', $mem, PDO::PARAM_INT, 25);
		$stmt->bindParam(':pmempeak', $mempeak, PDO::PARAM_INT, 25);
		$stmt->bindParam(':pinc', $incfiles, PDO::PARAM_STR, 512);
		$stmt->bindParam(':pos', $pos, PDO::PARAM_STR, 64);
		// Uptime bind
		$stmt->bindParam(':sup', $uptime, PDO::PARAM_STR, 64);

		$stmt->execute();

		$this->last_log = array
		(
			"log_type" 			=> $log_type,
			"log_message" 		=> $log_message,
			"log_description" 	=> $log_description,
			"php_version" 		=> $pver,
			"php_os" 			=> $pos,
			"last_php_error" 	=> $err,
			"memory" 			=> $mem,
			"memory_peak" 		=> $mempeak,
			"included_files" 	=> $incfiles,
			"uptime" 			=> $uptime
		);
	}

	/**
	 *	Create Tables
	 *
	 *	Create the table required if not already existing.
	 *
	 *	@access private
	 */
	private function createTables()
	{
		$this->dbh->query("
			CREATE TABLE IF NOT EXISTS `{$this->logger_table}` (
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
		");
	}
}
