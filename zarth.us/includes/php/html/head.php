<?php
if (!defined("SITE_INIT")) die("Website is not initialised properly, you cannot open this file directly");
/**
 *	Head
 *
 *	The website head that is included on every page.
 *	This is the <head> tag content; not the header.
 *
 *	@package	zarth.us
 *	@author		Zarthus <zarthus@zarth.us>
 *	@link		https://github.com/Zarthus/zarth.us
 *	@license	MIT - View http://zarth.us/licenses/zarth.us or the LICENSE.md file in the github repository
 *	@since		20/03/2014
 */

$head_extras = "";
$head_theme = "";

if (!empty($web['description']))
{
	$head_desc = addslashes($web['description']);
	$head_extras .= "<meta name=\"description\" content=\"$head_desc\">\n";
}

if (!empty($web['theme']) && file_exists(CSSDIR . "/" . $web['theme']))
{
	$head_theme .= "<link rel=\"stylesheet\" href=\"" . CSSDIR . "/" . $web['theme'] . "\">";
}
else
{
	$head_theme .= '<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap-theme.min.css">';

	if (!empty($web['theme']))
	{
		$logger->notice("CSS Theme " . CSSDIR . '/' . $web['theme'] . " does not exist; including default bootstrap theme instead.",
			"This occurs when \$web['theme'] is pointing towards an empty file or is empty.");
	}
}

$head_title = '';
$head_title .= !empty($web['title_prefix']) ? $web['title_prefix'] . ' | ' : '';
$head_title .= !empty($web['title']) ? $web['title'] : getSiteName();
$head_title .= !empty($web['title_suffix']) ? ' | ' . $web['title_suffix'] : '';

echo <<<HEAD

	<meta charset="utf-8">
	<!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge"><![endif]-->
	<meta name="viewport" content="width=device-width, initial-scale=1">

	{$head_extras}

	<title>{$head_title}</title>

	<link rel="shortcut icon" type="image/png" href="favicon.png">

	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
	{$head_theme}
	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css">


	<!--[if lt IE 9]>
	  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	  <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->

HEAD;

?>
