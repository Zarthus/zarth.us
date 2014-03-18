<?php
if (!defined("SITE_INIT")) die("Website is not initialised properly, you cannot open this file directly");
/**
 *	Functions
 *	
 *	A wide array of website functions
 *	
 *	@package	zarth.us
 *	@author		Zarthus <zarthus@zarth.us>
 *	@link		https://github.com/Zarthus/zarth.us
 *	@license	MIT - View http://zarth.us/licenses/zarth.us or the LICENSE.md file in the github repository 
 *	@since		18/03/2014
 */

/**
 *	getSiteName
 *
 *	@param bool $markup - return with or without HTML markup
 *
 *	Returns the site name in "[subdomain.]domain.tld" format
 */
function getSiteName($markup = false)
{
	if (!$markup) return $_SERVER['SERVER_NAME'];
		
	// Split up the domain name (if there is anything to split up, (localhost doesn't)) into array(0 => 'zarth', 1 => 'us')
	$sName = explode('.', $_SERVER['SERVER_NAME']);
	
	$count = count($sName);
	if ($count == 2)
	{	// If the count is 2, we're not on any subdomain
		return '<span class="site-name-primary">' . $sName[0] . '</span>.<span class="site-name-tld">' . $sName[1] . '</span>'; 
	}
	else if ($count > 2) 
	{	// We're on a subdomain
		return '<span class="site-name-subdomains">' . implode('.', array_slice($sName, 0, $count - 2)) . '</span>' .
			'<span class="site-name-primary">' . $sName[$count - 2] . '</span>.' . 
			'<span class="site-name-tld">' . $sName[$count - 1] . '</span>';		
	}
	else 
	{	// If this is the case, we're probably on localhost.
		return '<span class="site-name-primary">' . $sName[0] . '</span><span class="site-name-tld">.tld</span>'; 		
	}
}

/**
 *	getDomainName
 *
 *	@param bool $markup - return with or without HTML markup
 *
 *	Returns the site name in "domain" format
 */
function getDomainName($markup = false)
{
	// Split up the domain name (if there is anything to split up, (localhost doesn't)) into array(0 => 'zarth', 1 => 'us')
	$sName = explode('.', $_SERVER['SERVER_NAME']);
	$count = count($sName);

	if (!$markup) {
		if ($count >= 2)
			return $sName[$count - 2];
		else
			return $sName[0];
	}
	
	
	if ($count == 2)
	{	// If the count is 2, we're not on any subdomain
		return '<span class="site-name"><span class="site-name-primary">' . $sName[0] . '</span></span>'; 
	}
	else if ($count > 2) 
	{	// We're on a subdomain
		return '<span class="site-name"><span class="site-name-primary">' . $sName[$count - 2] . '</span></span>'; 
	}
	else 
	{	// If this is the case, we're probably on localhost.
		return '<span class="site-name"><span class="site-name-primary">' . $sName[0] . '</span></span>'; 		
	}
}

function parseDefaultHead($web)
{
	$extras = "";
	$theme = "";
	
	if (!empty($web['description']))
	{
		$desc = addslashes($web['description']);
		$extras .= "<meta name=\"description\" content=\"$desc\">\n";
	}

	if (!empty($web['theme']) && file_exists('./includes/css/' . $web['theme']))
	{
		$theme .= "<link rel='stylesheet' href='./includes/css/" . $web['theme'] . "'>";
	}
	else
	{
		$theme .= '<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap-theme.min.css">';
	}
	
	$title = '';
	$title .= !empty($web['title_prefix']) ? $web['title_prefix'] . ' | ' : '';
	$title .= !empty($web['title']) ? $web['title'] : getSiteName(); 
	$title .= !empty($web['title_suffix']) ? ' | ' . $web['title_suffix'] : '';
	
	echo <<<HEAD

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	{$extras}

	<title>{$title}</title>
	
	<link rel="shortcut icon" type="image/png" href="favicon.png">

	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
	{$theme}
	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css">


	<!--[if lt IE 9]>
	  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	  <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->

HEAD;
}

function parseDefaultBody($ga = array())
{
	// $jsDir = JSDIR;
	//<script src="$jsDir/jquery.min.js"></script>
	$ganal = getGoogleAnalytics($ga);

	echo <<<BODY
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
	<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
	{$ganal}
BODY;
}

function getDropdownHTML($nav, $fname)
{
	$items = '';
	$ddname = $nav['name'];
	
	foreach ($nav['pages'] as $page)
	{
		if (isset($page['show']) && !$page['show']) 
			continue;

		$title = isset($page['title']) ? ' title="' . $page['title'] . '"' : '';	
		
		$attr = " ";
		
		$icon = ''; 
	
		if (!empty($page['icon'])) 
			$icon .= '<span class="fa fa-fw ' . $page['icon'] . '"></span> ';
		
		$attr .= isset($page['href']) ? 'href="' . $page['href'] . '" ' : 'href="#" ';
		$attr .= isset($page['title']) ? 'title="' . $page['title'] . '" ' : '';
		$attr .= isset($page['class']) ? 'class="' . $page['class'] . '"' : '';
		
		$attr = rtrim($attr);

		$name = isset($page['name']) ? $page['name'] : "<!--ERROR: NavName not found-->";
			
		if (isset($page['separator-before'])) $items .= "<li class=\"divider\"></li>\n";
		$items .= "<li><a$attr$title>$icon$name</a></li>\n";
		if (isset($page['separator-after'])) $items .= "<li class=\"divider\"></li>\n";
	}
	
	# TODO: Implement href,class for the main menu item.
	$icon = ''; 

	if (!empty($nav['icon'])) 
		$icon .= '<span class="fa fa-fw ' . $nav['icon'] . '"></span> ';

	$attr = "";

	$attr .= isset($nav['href']) ? 'href="' . $nav['href'] . '" ' : 'href="#" ';
	$attr .= isset($nav['title']) ? 'title="' . $nav['title'] . '" ' : '';
	
	$attr = rtrim($attr);

	$html = <<<HTML
	<li class="dropdown">
		<a class="dropdown-toggle" data-toggle="dropdown" {$attr}>{$icon}{$ddname} <b class="caret"></b></a>
		<ul class="dropdown-menu">
			{$items}
		</ul>
	</li>
HTML;

	return $html;
}

function getNavigationHTML($nav, $fname)
{
	$active = '';
	
	if (isset($nav['href'])) 
	{
		$active = $nav['href'] == $fname ? ' class="active"' : "";
	}	
	
	$icon = ''; 

	if (!empty($nav['icon'])) 
		$icon .= '<span class="fa fa-fw ' . $nav['icon'] . '"></span> ';

	$attr = "";

	$attr .= isset($nav['href']) ? 'href="' . $nav['href'] . '" ' : 'href="#" ';
	$attr .= isset($nav['title']) ? 'title="' . $nav['title'] . '" ' : '';
	
	$attr = rtrim($attr);

	$navName = isset($nav['name']) ? $nav['name'] : "<!--ERROR: NavName not found-->";
	return "<li{$active}><a {$attr}>{$icon}{$navName}</a></li>\n";
}

function parseNavbar($navbar, $navtitle = '')
{
	if (empty($navtitle))
		$navtitle = getSiteName();
	
	$navigation = "";
	$fname = basename($_SERVER['PHP_SELF']);

	foreach ($navbar as $nav)
	{
		if (isset($nav['show']) && !$nav['show'])
			continue;
			
		if (isset($nav['pages']) && is_array($nav['pages'])) 
		{
			$navigation .= getDropdownHTML($nav, $fname);
		} 
		else
		{
			$navigation .= getNavigationHTML($nav, $fname);
		}
	}
					
	$nav = <<<NAVBAR
	
	<div class='navbar-wrapper'>
		<div class='container'>
			<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
				<div class="container">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<a class="navbar-brand" href="#">{$navtitle}</a>
					</div>
					<div class="collapse navbar-collapse">
						<ul class="nav navbar-nav">
							{$navigation}
						</ul>
					</div><!--/.nav-collapse -->
				</div>
			</div>
		</div>
	</div>
NAVBAR;

	echo $nav;
}


/** 
 *	parseGoogleAnalytics
 *
 *	@param array $ga - The google analytics array defined in config.php
 *
 *	Return the Google Analytic code. [Used in parseDefaultBody()]
 */ 
function getGoogleAnalytics($ga)
{
	// Cut off early if we do not use google analytics.
	if (!isset($ga['enabled']) || !$ga['enabled']) return;

	if (!isset($ga['ua_id']) || !isset($ga['site']))
	{
		//TODO: Log error
	}
	else
	{
	
		$js = <<<JS
	
	<script>
		(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

		ga('create', '{$ga['ua_id']}', '{$ga['site']}');
		ga('send', 'pageview');
	</script>

JS;

		return $js;
	}
}

function lastfm_init(&$lfm)
{
	$lastfm_data = array();
	if (!$lfm['enabled']) return;
	
	try {
		$xml = User::getRecentTracks($lfm['user']); 

		$lastfm_data['recent_tracks'] = lastfm_generate_html("Recent Tracks", array(
			$xml[0]->getName() . ' (' . $xml[0]->getArtist() . ')',
			$xml[1]->getName() . ' (' . $xml[1]->getArtist() . ')',
			$xml[2]->getName() . ' (' . $xml[2]->getArtist() . ')',
			$xml[3]->getName() . ' (' . $xml[3]->getArtist() . ')',
			$xml[4]->getName() . ' (' . $xml[4]->getArtist() . ')',
		));

	} catch (Error $e) {
		$lastfm_data['recent_tracks'] = lastfm_generate_html_error("Recent Tracks");
		if (SCRIPT_ENVIRONMENT == 'development') echo '<p>' . $e->getMessage() . '</p>';
	}


	try {
		$xml = User::getTopArtists($lfm['user']); 

		$lastfm_data['top_artists'] = lastfm_generate_html("Top Artists", array(
			$xml[0]->getName() . ' (' . number_format($xml[0]->getPlayCount()) . ' plays)',
			$xml[1]->getName() . ' (' . number_format($xml[1]->getPlayCount()) . ' plays)',
			$xml[2]->getName() . ' (' . number_format($xml[2]->getPlayCount()) . ' plays)',
			$xml[3]->getName() . ' (' . number_format($xml[3]->getPlayCount()) . ' plays)',
			$xml[4]->getName() . ' (' . number_format($xml[4]->getPlayCount()) . ' plays)',
		));

	} catch (Error $e) {
		$lastfm_data['top_artists'] = lastfm_generate_html_error("Top Artists");
		if (SCRIPT_ENVIRONMENT == 'development') echo '<p>' . $e->getMessage() . '</p>';
	}
	
	$lfm['initialised'] = true;
	return $lastfm_data;
}

function lastfm_generate_html($header, array $data) 
{
	$lfmData = '';
	foreach($data as $row) {
		$lfmData .= "$row<br />\n";
	}
	
	$last_fm = <<<LASTFM
	<div class="col-md-6 last-fm-entry">
		<h2>{$header}</h2>
		<p class="last-fm-data">
			{$lfmData}
		</p>
	</div>	
LASTFM;

	return $last_fm;
}


function lastfm_generate_html_error($header) 
{
	$last_fm = <<<LASTFM
	<div class="col-md-6 last-fm-entry">
		<h2>{$header}</h2>
		<p class="last-fm-data">
			Failed to get data from last.fm
		</p>
	</div>	
LASTFM;

	return $last_fm;
}