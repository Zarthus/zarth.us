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
		$web['theme'] = 'zarthus-theme.min.css';

		include(HTMLDIR . '/head.php');
	?>

</head>

<body>
	<?php include(HTMLDIR . '/navbar.php'); ?>

	<div class="container content">
			<div class="page-header jumbotron">
				<h1><a class="no-link-markup" href="<?php echo $_SERVER['SERVER_NAME'] ?>">Welcome to <?php echo getSiteName(true) ?></a></h1>
				<hr>
			</div>
			<p>
				Quite honestly, I have no idea what to put here, so check out some of my projects and things I've spent time on!
			</p>
			<br><br>

			<?php include(HTMLDIR . '/lastfm.php'); ?>
			<hr>
			<br>

			<div class="row">
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
			<?php include_once(HTMLDIR . '/footer.php') ?>

		</footer>
	</div><!-- /.container -->

	<?php include(HTMLDIR . '/body.php'); ?>
</body>
</html>
