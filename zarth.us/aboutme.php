<?php
/**
 *	About Me
 *	
 *	The page that is all about me, myself and I.
 *	
 *	@package	zarth.us
 *	@author		Zarthus <zarthus@zarth.us>
 *	@link		https://github.com/Zarthus/zarth.us
 *	@license	MIT - View http://zarth.us/licenses/zarth.us or the LICENSE.md file in the github repository 
 *	@since		20/03/2014
 */
 
define("USER_PATH", "About Me - aboutme.php");
require_once('includes/php/init.php'); 
?>
<!DOCTYPE html>
<html>
<head>	
	<?php 
		$web['description'] = 'All about Zarthus'; 
		$web['theme'] = 'zarthus-theme.css';
	
		include(HTMLDIR . '/head.php'); 
	?>
		
</head>

<body>
	<?php include(HTMLDIR . '/navbar.php'); ?>
			
	<div class="container content">
		<div class="page-header jumbotron">
			<h1>Hey there, I am Zarthus!</h1>
			<hr>
		</div>
		<br><br>

		
		
		<hr>
		<footer>
			<?php include_once(HTMLDIR . '/footer.php') ?>
			
		</footer>
	</div><!-- /.container -->
			
	<?php include(HTMLDIR . '/body.php'); ?>
</body>
</html>
