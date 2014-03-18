<?php 
if (!defined("SITE_INIT")) die("Website is not initialised properly, you cannot open this file directly");
/**
 *	Footer
 *	
 *	The website footer that is included on every page.
 *	
 *	@package	zarth.us
 *	@author		Zarthus <zarthus@zarth.us>
 *	@link		https://github.com/Zarthus/zarth.us
 *	@license	MIT - View http://zarth.us/licenses/zarth.us or the LICENSE.md file in the github repository 
 *	@since		18/03/2014
 */

$year_made = 2014;
$year_curr = date('Y');
$year_string = ($year_made == $year_curr) ? $year_curr : $year_made . ' - ' . $year_curr;

$footer = <<<FOOTER
	<div class='row' style='text-align: center;'>
		<div class="col-md-3">
			<p>&copy; $year_string $site_name</p>\n
		</div>
		<div class="col-md-6">
			<p><small>This website would not be possible without <a href='http://getbootstrap.com' title='This website is built using bootstrap.'>Bootstrap</a>,
			<a href='http://atheme.org' title='The website design is inspired by this website.'>Atheme</a>,
			and <a title='Those icons are all Font Awesomes doing.' href='http://fortawesome.github.io/Font-Awesome/'>Font Awesome</a></small>
		</div>
		<div class="col-md-3">
			<p><a href="#top">Back to top</a></p>
		</div>
	</div>
FOOTER;
			
echo $footer;