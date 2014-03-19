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
	 *	@string last log recorded in format "[logtype] logmessage"
	 */
	public $last_log;
	
	/**
	 *	@PDO Object database handle
	 */
	private $dbh;
	
	/**
	 *	@boolean initialised You cannot log messages if this is set to false.
	 */
	private $initialised;
	
	/**
	 *	@integer visitor id The Visitor::getUserInsertID() ID.
	 */
	private $visitor_id;
	
	/**
	 *	@string Table name
	 */
	private $logger_table;
	
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
			if (!is_bool($log_errors)) throw new Exception("\$log_errors is not a boolean value.");
			if (!is_bool($log_notices)) throw new Exception("\$log_notices is not a boolean value.");
			if (!is_bool($log_debug)) throw new Exception("\$log_debug is not a boolean value.");
		}
		
		$this->log_errors = $log_errors;
		$this->log_notices = $log_notices;
		$this->log_debug = $log_debug;
		
		$this->visitor_id = (int) $visitor_id;
	
		$this->logger_table = Utilities::sanitizeTableName($table_name);
		if ($create_table) $this->createTables();
	}
	
	/**
	 *	Error
	 *
	 *	Log an error to the database.
	 *	
	 *	@param String message The message to log
	 *	@param String description A small description of what could cause the issue
	 *	@access public
	 */
	public function error($message, $description = "")
	{
		
	}
	
	/**
	 *	Notice
	 *
	 *	Log a notice to the database.
	 *	
	 *	@param String message The message to log
	 *	@param String description A small description of what could cause the issue
	 *	@access public
	 */
	public function notice($message, $description = "")
	{
	
	}
	
	/**
	 *	Debug
	 *
	 *	Log a debug notice to the database.
	 *
	 *	@param String message The message to log
	 *	@param String description A small description of what could cause the issue
	 *	@access public
	 */
	public function debug($message, $description = "")
	{
	
	}
	
	/**
	 *	Get Last :og
	 *
	 *	Return the last recorded log entry
	 *
	 *	@return String the last log recorded, an empty string if none.
	 *	@access public
	 */
	public function getLastLog()
	{
		if ($this->last_log === null)
			return "";
			
		return $this->last_log;
	}
		
	private function log()
	{
	
	}
	
	private function createTables()
	{
	
	}
}