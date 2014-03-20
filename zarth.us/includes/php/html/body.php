<?php
if (!defined("SITE_INIT")) die("Website is not initialised properly, you cannot open this file directly");
/**
 *	Body
 *	
 *	This is the <body> extras; includes that are mandatory are here
 *	such as jQuery and bootstrap.
 *	
 *	@package	zarth.us
 *	@author		Zarthus <zarthus@zarth.us>
 *	@link		https://github.com/Zarthus/zarth.us
 *	@license	MIT - View http://zarth.us/licenses/zarth.us or the LICENSE.md file in the github repository 
 *	@since		20/03/2014
 */
 
$ganal = getGoogleAnalytics($ga);

echo <<<BODY
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
	<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
	{$ganal}
BODY;
?>