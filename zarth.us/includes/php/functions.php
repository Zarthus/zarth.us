<?php #TODO: Some content is undocumented still
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
		return '<span class="site-name-subdomains">' . implode('.', array_slice($sName, 0, $count - 2)) . '</span>.' .
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

/**
 *	parseGoogleAnalytics
 *
 *	Return the Google Analytic code, used in parseDefaultBody(), this can be
 *	an empty string if an error occured due or google analytics was disabled.
 *
 *	@param array $ga - The google analytics array defined in config.php
 *	@return String google analytics code or empty string
 */
function getGoogleAnalytics($ga)
{
	// Cut off early if we do not use google analytics.
	if (!isset($ga['enabled']) || !$ga['enabled']) return "";

	if (!isset($ga['ua_id']) || !isset($ga['site']))
	{
		Logger::getInstance()->error("Google Analytics was enabled but incorrectly configured. ua_id: " . (isset($ga['ua_id']) ? "set" : "not set") . " | site: " . (isset($ga['site']) ? "set" : "not set"),
			__FUNCTION__ . ": You will have to properly configure google analytics (\$ga) in /includes/php/config.php");
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

	return "";
}

/**
 * getServerName()
 *
 * The primary hostname of the server.
 */
function getServerName()
{
    if (strtolower(PHP_OS) == "linux") {
        return shell_exec("hostname");
    } else {
        return "frost";
    }
}

/**
 * getServerFlavour()
 *
 * Return flavour text of the server.
 */
function getServerFlavour()
{
    return "uncomfortably icy.";
}

function lastfm_init(&$lfm)
{
	if (!$lfm['enabled']) return;
	$lastfm_data = array();

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
