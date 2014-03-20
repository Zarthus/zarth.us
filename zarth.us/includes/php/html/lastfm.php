<?php 
if (!defined("SITE_INIT")) die("Website is not initialised properly, you cannot open this file directly");
/**
 *	Last FM
 *	
 *	Include the Last FM html by including this file; this prints two columns of data. 
 *	This assumes a row class is already opened. Used in home.php
 *	
 *	@package	zarth.us
 *	@author		Zarthus <zarthus@zarth.us>
 *	@link		https://github.com/Zarthus/zarth.us
 *	@license	MIT - View http://zarth.us/licenses/zarth.us or the LICENSE.md file in the github repository 
 *	@since		20/03/2014
 */
 
if (isset($lfm['enabled']) && $lfm['enabled']) 
{ 
	if (file_exists(CLASSDIR . '/LastFM/lastfm.api.php')) 
	{
		include_once(CLASSDIR . '/LastFM/lastfm.api.php');
		CallerFactory::getDefaultCaller()->setApiKey($lfm['api_key']);
	}
	else
	{
		$logger->error("Could not find the LastFM api in at " . CLASSDIR . "/LastFM/lastfm.api.php", "The Last FM api on the Home page was not found and thus the last FM page could not be displayed.");
		$lfm['enabled'] = false;
	}
	if ($lfm['enabled']) 
	{
		?>
			
	<div class="col-md-12">
		<h2><?php echo "<a href=\"" . $lfm['url'] . "\">BuuGhost</a>" ?> on Last.fm</h2>
	</div>
		<div id="last-fm">
			<?php
			try {
				$xml = User::getRecentTracks($lfm['user']); 

				echo lastfm_generate_html("Recent Tracks", array(
					$xml[0]->getName() . ' (' . $xml[0]->getArtist() . ')',
					$xml[1]->getName() . ' (' . $xml[1]->getArtist() . ')',
					$xml[2]->getName() . ' (' . $xml[2]->getArtist() . ')',
					$xml[3]->getName() . ' (' . $xml[3]->getArtist() . ')',
					$xml[4]->getName() . ' (' . $xml[4]->getArtist() . ')',
				));

			} catch (Error $e) {
				echo lastfm_generate_html_error("Recent Tracks");
				if (SCRIPT_ENVIRONMENT == 'development') echo '<p>' . $e->getMessage() . '</p>';
			}
			
			try {
				$xml = User::getTopArtists($lfm['user']); 

				echo lastfm_generate_html("Top Artists", array(
					$xml[0]->getName() . ' (' . number_format($xml[0]->getPlayCount()) . ' plays)',
					$xml[1]->getName() . ' (' . number_format($xml[1]->getPlayCount()) . ' plays)',
					$xml[2]->getName() . ' (' . number_format($xml[2]->getPlayCount()) . ' plays)',
					$xml[3]->getName() . ' (' . number_format($xml[3]->getPlayCount()) . ' plays)',
					$xml[4]->getName() . ' (' . number_format($xml[4]->getPlayCount()) . ' plays)',
				));

			} catch (Error $e) {
				echo lastfm_generate_html_error("Top Artists");
				if (SCRIPT_ENVIRONMENT == 'development') echo '<p>' . $e->getMessage() . '</p>';
			}
			?>
			
		</div>
	</div>
	<?php 
	}
}
?>