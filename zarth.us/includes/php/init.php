<?php

// Setting this makes sure you're authorised to access pages you're otherwise not.
define("SITE_INIT", true);

// Development modes: development (all else is production.)
// Setting this to development shows error notices to everyone. 
define("SCRIPT_ENVIRONMENT", 'development');

// Location of some directories
define("ROOTDIR", dirname(__DIR__));

define("PHPDIR", ROOTDIR . '/php');
define("CLASSDIR", PHPDIR . '/classes');

define("CSSDIR", ROOTDIR . '/css');
define("JSDIR", ROOTDIR . '/js');

// Includes
require_once('config.php');
require_once(CLASSDIR . '/Autoloader.php');

include_once('functions.php');

// Configure the script environment
if (SCRIPT_ENVIRONMENT == 'development')
{
	error_reporting(-1);
	ini_set('display_errors', 1);
	// $logger->setLogLevel(LOG_LEVEL_ALL);
}
else
{
	error_reporting(0);
	ini_set('display_errors', 0);
}

if (isset($lfm['enabled']) && $lfm['enabled'])
{
	if (!isset($lfm['user']) || !isset($lfm['url']) || !isset($lfm['api_key']))
	{
		# TODO: Log error
		throw new Exception('Last FM not properly configured');
	}
	
}

// Make the database connection
try {
	$dbh = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
} catch (PDOException $e) {
	if (ini_get('display_errors') == 1) 
	{
		echo $e->getMessage() . "<br />\n";
	}
	die("Could not connect to the database.");
}

// unset the variables we will never use again.
unset($host, $dbname, $user, $pass);
