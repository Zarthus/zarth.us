<?php
if (!defined("SITE_INIT")) die("Website is not initialised properly, you cannot open this file directly");
/**
 *	Configuration
 *
 *	The file to configure some of the dynamic things
 *	on the website.
 *
 *	You can configure the following things:
 *	  Database information
 *	  Website settings (title, meta description)
 *	  Last FM API Usage
 *	  Use of Google Analytics
 *	  Navigation panel
 *
 *	@package	zarth.us
 *	@author		Zarthus <zarthus@zarth.us>
 *	@link		https://github.com/Zarthus/zarth.us
 *	@license	MIT - View http://zarth.us/licenses/zarth.us or the LICENSE.md file in the github repository
 *	@since		18/03/2014
 */

// Database information
$host 	= "localhost";
$dbname = "zarthus";
$user 	= "root";
$pass 	= "";


// Development modes: development (all else is production.)
// Setting this to development shows error notices to everyone, and logs debug messages.
define("SCRIPT_ENVIRONMENT", 'production');

// Set the title to "Filename" instead of "filename.php"
$title = "TravisCI";

// This is the title displayed on every page.
$web['title'] = $title;
// The prefix and suffix in the header <title>.
$web['title_prefix'] = '';
$web['title_suffix'] = '';
// The description in the <meta> tag.
$web['description'] = '';
// Display the time it took to execute in the footer.
$web['footer_exec_time'] = false;

// Last FM: Display your LastFM data on the home page.
// If enabled, the `user`, `url`, and `api_key` items are required.
// Due to the nature of how this works (sending two requests to the LastFM api)
//	it's going to slow down your website's home page significantly. So use of
//	caching is recommended. Although ideally you try and disable it entirely.
$lfm['enabled'] = false;
$lfm['user'] = 'BuuGhost';
$lfm['url'] = 'http://www.last.fm/user/' . $lfm['user'];
# $lfm['api_key'] = '****';
$lfm['cache'] = true;

// Google Analytics Array
// Whether or not to use Google Analytics
// Defaults to false if not set.
$ga['enabled'] = false;
// User Account ID
// Should look like: UA-XXXXXX-X
$ga['ua_id'] = "UA-XXXXXXXX-1";
// Website name
$ga['site'] = '';

// The title is displayed left of the navigation bar, but not required.
if (SCRIPT_ENVIRONMENT == 'development')
{	// To make sure we know we are in the developer modes, otherwise there is no way of knowing.
	$navtitle = '<span style="color: #bb00bb">developers environment</span>';
}
else
{
	$navtitle = '';
}
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

	'contact' => array
	(
		'name' => 'Contact',

		'href' => 'contact',

		'icon' => 'fa-user',
	),
);

// Psuedo $_SERVER
$_SERVER = array
(
	'SCRIPT_NAME' => 'TravisCI',
	'REMOTE_ADDR' => '127.0.0.1',
	'REQUEST_URI' => '',
	'SERVER_NAME' => 'TravisCI',
);

# EOF

