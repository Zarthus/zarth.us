<?php 
/**
 *	Contact Me
 *	
 *	This page provides information on how you could contact me.
 *
 *	@package	zarth.us
 *	@author		Zarthus <zarthus@zarth.us>
 *	@link		https://github.com/Zarthus/zarth.us
 *	@license	MIT - View http://zarth.us/licenses/zarth.us or the LICENSE.md file in the github repository 
 *	@since		20/03/2014
 */
define("USER_PATH", "Contact Me - contact.php");
require_once('includes/php/init.php'); 
?>
<!DOCTYPE html>
<html>
<head>	
	<?php 
		$web['description'] = 'Should you wish to contact me, this is the place'; 
		$web['theme'] = 'zarthus-theme.css';
	
		include(HTMLDIR . '/head.php'); 
	?>
		
</head>

<body>
	<?php include(HTMLDIR . '/navbar.php'); ?>
			
	<div class="container content">
		<div class="page-header jumbotron">
			<h1>Contact Me</h1>
			<hr>
		</div>

		<div class="row">
			<div class="col-md-offset-2 col-md-8">
				<h3>Contacting me</h3>
				<p>
					<strong>Email</strong>
					<br>
					You can send me an email: &quot;zarthus<i> <!-- Spells '@' --> &#97;&#116; </i>zar<!--Just to keep the bots out-->th<i> <!-- Spells 'dot' --> &#100;&#111;&#116; </i>us&quot;,
					where the italics should be replaced with '@' and '.' respectively.
					<br><br>
					<strong>IRC</strong>
					<br>
					Then there is Internet Relay Chat, short for IRC. You can ignore this section if you do not use of IRC.
					<br>
					I roam <a href="http://esper.net">EsperNet</a> and <a href="http://freenode.net">Freenode</a> quite often. You can connect to <a href="irc://irc.esper.net">EsperNet here</a> and <a href="irc://irc.freenode.net">Freenode here</a>
					<br><br>
					On EsperNet, you can find me in the channels <code>#lobby</code> and <code>#zarthus</code>, but <code>/msg Zarthus &lt;your message&gt;</code> also works.
					<br><br>
					On Freenode, I don't really have any frequent channels, but I mostly talk in <code>#web</code>, <code>##php</code>, <code>#freenode</code>. Opening a query by <code>/msg Zarthus &lt;your message&gt;</code> is encouraged, though.
					<br><br>
					<strong>Please note</strong>, Apart from <code>#zarthus</code>, none of the above mentioned channels are part of this website.
					
				</p>
			</div>
		</div>
			
		<div class="row">
			<div class="col-md-offset-2 col-md-8">
				<h3>Reporting Bugs or sending in Suggestions</h3>
				<p>
					If you managed to find a bug in my website, it's appreciated if you could create an issue on its <a href="http://github.com/Zarthus/zarth.us/issues/new">actual repository over at GitHub</a>, 
					but any form of bug reporting (be it IRC, email or just GitHub) is appreciated. 
				</p>
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
