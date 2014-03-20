<?php 
/**
 *	Home
 *	
 *	Index page for zarth.us
 *
 *	@package	zarth.us
 *	@author		Zarthus <zarthus@zarth.us>
 *	@link		https://github.com/Zarthus/zarth.us
 *	@license	MIT - View http://zarth.us/licenses/zarth.us or the LICENSE.md file in the github repository 
 *	@since		18/03/2014
 */
define("USER_PATH", "Home - home.php");
require_once('includes/php/init.php'); 
?>
<!DOCTYPE html>
<html>
<head>	
	<?php 
		$web['description'] = 'Welcome to ' . $site_name . ', there is no place like home.';
		$web['theme'] = 'zarthus-theme.css';
	
		parseDefaultHead($web); 
	?>
		
</head>

<body>
	<?php parseNavbar($navbar, $navtitle); ?>
			
	<div class="container">
		<div class="content">
			<div class="page-header jumbotron">
				<h1><a class="no-link-markup" href="<?php echo $_SERVER['SERVER_NAME'] ?>">Welcome to <?php echo getSiteName(true) ?></a></h1>
				<hr>
			</div>
			<p>
				Quite honestly, I have no idea what to put here, so check out some of my projects and things I've spent time on!
			</p>
			<br><br>
			<div class="row">
			<?php 
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
			<br>
			<hr>
			<br>
			<div class="row homedisplay">
				<div class="col-md-4 marketing-text">
					<h2>
						<a href="projects" class="blog noline"><span class="fa fa-fw fa-folder-open"></span> Projects</a>
					</h2>   
					<p>
						I've done a few things over the years, like making <a href="http://<?php echo $site_name ?>">this website</a>,
						developing a few <a>IRC Bots</a>,
						and solve problems on <a href="http://projecteuler.net">Project Euler</a>.
					</p>
				</div>

				<div class="col-md-4 marketing-text">
					<h2>
						<a href="aboutme"><span class="fa fa-fw fa-heart"></span> About Me</a>
					</h2>   
					<p>It's a website about me, it'd be weird to not have an about me page!</p> 
				</div>

				<div class="col-md-4">
					<h2>
						<a href="https://github.com/zarthus/"><span class="fa fa-fw fa-github"></span> Github</a>
					</h2>
					<p>Github is where all the magic happens.</p> 
				</div>			
			</div>
		</div>


		<hr>
		<footer>
			<?php include_once('includes/php/footer.php') ?>
			
		</footer>
	</div><!-- /.container -->
			
	<?php parseDefaultBody($ga); ?>
</body>
</html>
