<?php
if (!defined("SITE_INIT")) die("Website is not initialised properly, you cannot open this file directly");
/**
 *	Navigation Bar
 *
 *	Include this file to parse the navigation bar.
 *
 *	@package	zarth.us
 *	@author		Zarthus <zarthus@zarth.us>
 *	@link		https://github.com/Zarthus/zarth.us
 *	@license	MIT - View http://zarth.us/licenses/zarth.us or the LICENSE.md file in the github repository
 *	@since		20/03/2014
 */

function getDropdownHTML($nav, $fname)
{
	$items = '';
	$ddname = $nav['name'];

	foreach ($nav['pages'] as $page)
	{
		if (isset($page['show']) && !$page['show'])
			continue;

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
		$items .= "<li><a$attr>$icon$name</a></li>\n";
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

echo <<<NAVBAR

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
