<?php
if (defined("SITE_INIT")) die("You are trying to include the website initialisation twice.");
/**
 *	Initialisation
 *	
 *	The website initalisation. This is not the file to configure 
 *	your website, use config.php for that.
 *	
 *	@package	zarth.us
 *	@author		Zarthus <zarthus@zarth.us>
 *	@link		https://github.com/Zarthus/zarth.us
 *	@license	MIT - View http://zarth.us/licenses/zarth.us or the LICENSE.md file in the github repository 
 *	@since		18/03/2014
 */

if (version_compare(PHP_VERSION, '5.4.0', '<')) 
{	// Successfully tested on version 5.5.9 and 5.4.3, might not work below on versions 5.4.3.
	die("You need at least a PHP Version of 5.4.0 to make use of this, you are running version " . PHP_VERSION);
} 

// Config.php needs to exist to continue, if it does exist, all is well.
// if it doesn't, we look for the default configuration file, and notify the user he needs to copy that.  
if (!file_exists('config.php')) 
{
	if (file_exists('config.default.php')) 
	{
		die("Could not find config.php, but config.default.php was found, please copy this file and rename it to 'config.php', then configure it to your desire.");
	}
	die("Could not find config.default.php or config.php, please ensure everything was installed properly. " .
		"<br>If you are at a total loss, you can get the default configuration at <a href='http://zarth.us/source/default_configuration'>http://zarth.us/source/default_configuration</a>");
}
  
// Setting this makes sure you're authorised to access pages you're otherwise not.
define("SITE_INIT", true);

// Location of some directories
define('ROOTDIR', '/');
define('CURDIR', './');

define('INCDIR', CURDIR . 'includes');

define("PHPDIR", INCDIR . '/php');
define("CLASSDIR", PHPDIR . '/classes');
define("HTMLDIR", PHPDIR . '/html');

define("CSSDIR", INCDIR . '/css');
define("JSDIR", INCDIR . '/js');

// Includes
require_once('config.php');
require_once(CLASSDIR . '/autoloader.php');

include_once('functions.php');

// Configure the script environment
if (SCRIPT_ENVIRONMENT == 'development')
{
	error_reporting(-1);
	ini_set('display_errors', 1);
}
else
{
	error_reporting(0);
	ini_set('display_errors', 0);
}

// Make the database connection
if ($host == '' || $dbname == '' || $user == '') 
{
	die("config.php was not configured properly, please ensure the database details are filled in.");
}

try {
	$dbh = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
} catch (PDOException $e) {
	if (SCRIPT_ENVIRONMENT == 'development') 
	{
		echo $e->getMessage() . "<br />\n";
	}
	die("Could not connect to the database.");
}

// unset the variables we will never use again.
unset($host, $dbname, $user, $pass);

// Add the visitor to the database.
// Please ensure you set "USER_PATH" to the file, path, or small description 
// of where the user is in prior to including init.php to verify the path is 
// correctly loaded.
$visitor = new Visitor($dbh);

// Also allow debug messages if script environment = development.
if (SCRIPT_ENVIRONMENT == 'development') {
	$logger = new Logger($dbh, $visitor->getUserInsertID(), true, true, true);
} else {
	$logger = new Logger($dbh, $visitor->getUserInsertID(), true, true, false);
}

$logger->debug("Added visitor database entry with ID: " . $visitor->getUserInsertID() . ".");

if (isset($lfm['enabled']) && $lfm['enabled'])
{
	if (!isset($lfm['user']) || !isset($lfm['url']) || !isset($lfm['api_key']))
	{
		$logger->error("Last FM is not properly configured, but it was enabled.", "user set: " . (isset($lfm['user']) ? "Yes" : "No") . "  | url set: " . (isset($lfm['url']) ? "Yes" : "No") . "  api_key set: " . (isset($lfm['api_key']) ? "Yes" : "No"));
		$lfm['enabled'] = false;
	}
}

if (!defined("USER_PATH"))
{
	$logger->notice("Suboptimal configuration; USER_PATH is not defined", "Please ensure you define USER_PATH on every accessable page for more descriptive logging"); 
}

$site_name = getSiteName(); 