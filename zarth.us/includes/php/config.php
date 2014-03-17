<?php
if (!defined("SITE_INIT")) die("Website is not initialised properly, you cannot open this file directly");

/**
 *	Web configuration
 *
 *	Some smaller details can be configured here, either leaving them out or leaving them at ''
 *	implies they will not be used.
 */

// Set the title to "Filename" instead of "filename.php" 
$title = explode('.',  basename($_SERVER['SCRIPT_NAME']))[0];
$title = strtoupper(substr($title, 0, 1)) . substr($title, 1);

$web = array();

// This is the title displayed on every page.
$web['title'] = $title;

// The prefix and suffix in the header <title>.
$web['title_prefix'] = '';
$web['title_suffix'] = $_SERVER['SERVER_NAME'];
	
// The description in the <meta> tag.
$web['description'] = '';
// End Web Configuration	
	
// Last FM: Display your LastFM data on the home page.
// If enabled, the `user`, `url`, and `api_key` items are required. 
// Due to the nature of how this works (sending two requests to the LastFM api)
//	it's going to slow down your website's home page significantly. So use of 
//	caching is recommended. Although ideally you try and disable it entirely.
$lfm['enabled'] = true;
$lfm['user'] = 'BuuGhost';
$lfm['url'] = 'http://www.last.fm/user/' . $lfm['user'];
#$lfm['api_key'] = '****';
$lfm['cache'] = true;

// The title is displayed left of the navigation bar, but not required.
$navtitle = '';

// The navigation bar
$navbar = array
(

	/**
	 *	Each navbar page is an array item, it should at the very least have a 'name' item, and 'href' is recommended as well.
	 *	
	 *	'name' : How the menu tab is called and displayed
	 *	'href' : The location to forward to.
	 *	'title': The information to display when hovering over it.
	 *	'icon' : The icon to display before the name [from Font Awesome]
	 *	'class': Classes to give (space delimited).
	 *	'show' : Boolean to indicate if this entry should be shown or not, default true.
	 *	'pages': Array that makes the menuoption into a dropdown menu.
	 *		'separator-before': Specific to 'pages', insert a line separator in the dropdown menu.
	 *		'separator-after' : Specific to 'pages', insert a line separator in the dropdown menu.
	 */
	'home' => array
	(
		'name' => 'Home',

		'href' => 'home',

		'icon' => 'fa-home',
	),

	'project' => array
	(
		'name' => 'Projects',
		
		'href' => 'projects',
		
		'icon' => 'fa-folder-open',

		'pages' => array
		(
			'allproj' => array
			(
				'name' => 'All Projects',
				
				'href' => 'projects',
				'title' => 'Projects I\'ve made in the past',
				'icon' => 'fa-sitemap',
				
				'separator-after' => true,
			),

			'zarth.us' => array
			(
				'name' => 'zarth.us',
				
				'href' => 'https://github.com/Zarthus/zarth.us/',
				'icon' => 'fa-heart-o',
			),

			'twitchbot' => array
			(
				'name' => 'Twitch IRC bot',
				
				'href' => 'https://github.com/Zarthus/twitchbot/',
				'icon' => 'fa-code-fork',
			),

			'euler' => array
			(
				'name' => 'Project Euler',
				
				'href' => 'https://github.com/Zarthus/School/',
				'icon' => 'fa-question',
			),

			'snippets' => array
			(
				'name' => 'Code Snippets',
				
				'href' => 'https://github.com/Zarthus/Code-Snippets/',
				'icon' => 'fa-code',
			),
		),
	),
	
	'aboutme' => array
	(
		'name' => 'About Me',
		
		'href' => 'aboutme',
		
		'icon' => 'fa-heart',
	),
	
	'github' => array
	(
		'name' => 'Github',
		
		'href' => 'https://github.com/zarthus/',
		'title' => 'This website has it\'s own repository over there too!',

		'icon' => 'fa-github',
	),
);

// Google Analytics Array
$ga = array
(
	// Whether or not to use Google Analytics
	// Defaults to false if not set.
	'enabled' => true,
	
	// User Account ID
	// Should look like: UA-XXXXXX-X
	'ua_id' => "UA-48792360-1",
	
	// Website name
	'site' => 'zarth.us'
);

// Database information
$host 	= "localhost";
$dbname = "website";
$user 	= "zarth-web";
$pass 	= "";
