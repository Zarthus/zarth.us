<?php
if (!defined("SITE_INIT")) die("Website is not initialised properly, you cannot open this file directly");
/**
 *	Visitor
 *	
 *	The class that handles everything that occurs to new visitors.
 *	
 *	@package	zarth.us
 *	@author		Zarthus <zarthus@zarth.us>
 *	@link		https://github.com/Zarthus/zarth.us
 *	@license	MIT - View http://zarth.us/licenses/zarth.us or the LICENSE.md file in the github repository 
 *	@since		18/03/2014
 */

class Visitor 
{
	/**
	 *	@string The IP of the visitor.
	 */
	public $user_ip;

	/**
	 *	@string The browser language that is requested.
	 */
	public $user_lang;

	/**
	 *	@string The query string of the user.
	 */
	public $user_querystring;
	
	/**
	 *	@string The page the user is visiting.
	 */	
	public $user_path;

	/**
	 *	@integer The ID that was added to the database.
	 */	
	public $user_insert_id;

	/**
	 *	@PDO Object database handle
	 */
	private $dbh;
	
	/**
	 *	@string Table name
	 */
	private $visitor_table;
		
	/**
	 *	Constructor
	 *
	 *	Set the database handle, and multiple other user related variables.
	 *
	 *	@param $dbh PDO Object
	 *	@param $insert_immediately Boolean (true) insert the fetched data immediately into the database.
	 *	@param $create_table Boolean (true) Create table if it does not exist yet
	 *	@param $table_name String ("visitor") name of the table.
	 *	@throws Exception if $dbh is not an instance of PDO.
	 *	@access public
	 */
	public function __construct($dbh, $insert_immediately = true, $create_table = true, $table_name = "visitor")  
	{
		if (!($dbh instanceof PDO))
		{
			throw new Exception("\$dbh is not instance of PDO");
		}
		
		$this->dbh = $dbh;
		
		$this->user_ip 				= $_SERVER['REMOTE_ADDR'];
		$this->user_querystring 	= !empty($_SERVER['QUERY_STRING']) ? $_SERVER['QUERY_STRING'] : "No querystring";
		$this->user_lang 			= !empty($_SERVER['HTTP_ACCEPT_LANGUAGE']) ? $_SERVER['HTTP_ACCEPT_LANGUAGE'] : "Unknown";
		$this->user_useragent 		= !empty($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : "No user agent";
		$this->user_path 			= $this->getUserPath();
		
		$this->visitor_table = Utilities::sanitizeTableName($table_name);
		if ($create_table) $this->createTables();
		if ($insert_immediately) $this->insertUserData();
	}

	/**
	 *	Get User Path 
	 *
	 *	Return the path the user is coming from.
	 *
	 *	@return String path the user is coming from
	 *	@access public
	 */
	public function getUserPath()
	{
		return $this->user_path;
	}
	
	/**
	 *	Get User Inserted ID 
	 *
	 *	Return the ID the user has when inserting the data in the database.
	 *
	 *	@return Integer the table inserted ID, 0 if user_insert_id was not yet set.
	 *	@access public
	 */
	public function getUserInsertID()
	{
		if ($this->user_insert_id === null) 
			$this->user_insert_id = 0;
		
		return $this->user_insert_id;
	}
	
	/**
	 *	Insert User Data
	 *
	 *	Insert the data gathered into the Visitor table.
	 *
	 *	@access public
	 */
	public function insertUserData()
	{
		$unique = $this->getUserVisits($this->user_ip);
		
		// The IP is not an IP.
		if ($unique === false) 
		{
			$unique = -1;
			# TODO: Log Error
		}
		
		// Insert the data into the database
		$stmt = $this->dbh->prepare("
			INSERT INTO `{$this->visitor_table}` 
			(`unique_visitor`, `user_ip`, `user_language`, `user_useragent`, `user_path`, `user_query_string`)
			VALUES
			(:unique, :ip, :ulang, :uagent, :upath, :uquerystring)
		");
		$stmt->bindParam(':unique', $unique, PDO::PARAM_INT, 12);
		$stmt->bindParam(':ip', $this->user_ip, PDO::PARAM_STR, 40);
		$stmt->bindParam(':ulang', $this->user_lang, PDO::PARAM_STR, 128);
		$stmt->bindParam(':uagent', $this->user_useragent, PDO::PARAM_STR, 128);
		$stmt->bindParam(':upath', $this->user_path, PDO::PARAM_STR, 128);
		$stmt->bindParam(':uquerystring', $this->user_querystring, PDO::PARAM_STR, 128);
		$stmt->execute();
		
		// Fetch the last inserted id from the database.
		$stmt = $this->dbh->prepare("SELECT id FROM `{$this->visitor_table}` WHERE `unique_visitor` = :unique AND `user_ip` = :ip LIMIT 1 ORDER BY `id` DESC");
		$stmt->bindParam(':unique', $unique, PDO::PARAM_INT, 12);
		$stmt->bindParam(':ip', $this->user_ip, PDO::PARAM_STR, 40);
		$stmt->execute();
		$result = $stmt->fetch();
		$this->user_insert_id = $result['id'];
	}
	
	/**
	 *	Get User Visits
	 *
	 *	Determine if the user has visited the website before.
	 *	This method checks by IP basis, so dynamic IP's are not going to be detected.
	 *
	 *	This method returns a boolean FALSE as well as values that can evaluate to FALSE.
	 *	Make use of the is identical operator (===) when checking for uniqueness.
	 *
	 *	@access public
	 *	@return The amount of the times the user has visited the website, false if not a valid IP.
	 */
	public function getUserVisits($ip = "")
	{
		if ($ip == "") $ip = $_SERVER['REMOTE_ADDR'];
		
		if (!filter_var($ip, FILTER_VALIDATE_IP))
			return FALSE;
		
		$stmt = $this->dbh->prepare("SELECT count(user_ip) AS ip FROM {$this->visitor_table} WHERE user_ip = :ip");
		$stmt->bindParam(':ip', $ip, PDO::PARAM_STR, 40);
		$stmt->execute();
		$result = $stmt->fetch();
		
		return $result['ip'];
	}
	 
	/**
	 *	Get User Path
	 *
	 *	Try to determine which page the user is visiting.
	 *
	 *	@return string the page the user is visiting. 
	 *	@access private
	 */
	private function getUserPath()
	{
		// The script itself can give a far more accurate naming to the 
		// places the user visits than $_SERVER ever can.
		if (defined("USER_PATH")) return USER_PATH;		
		
		if (isset($_SERVER['SCRIPT_NAME'])) return $_SERVER['SCRIPT_NAME'];
		if (isset($_SERVER['SCRIPT_FILENAME'])) return $_SERVER['SCRIPT_FILENAME'];
		if (isset($_SERVER['PHP_SELF'])) return $_SERVER['PHP_SELF'];

		return "Unknown";
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
		$this->dbh->query("CREATE TABLE IF NOT EXISTS `{$this->visitor_table}` (
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
		");
	}
}