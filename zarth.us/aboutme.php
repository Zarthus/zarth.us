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
		$web['theme'] = 'zarthus-theme.min.css';
		$web['title'] = 'About Me';

		include(HTMLDIR . '/head.php');
	?>
	<link rel="stylesheet" href="<?php echo JSDIR ?>/jquery-github/assets/base.css">

</head>

<body>
	<?php include(HTMLDIR . '/navbar.php'); ?>

	<div class="container content">
		<div class="page-header jumbotron">
			<h1>Hey there, I am Zarthus!</h1>
			<p>I happen to be the creator of this website.</p>
			<hr>
		</div>

		<div class="row">
			<div class="col-md-offset-2 col-md-8">
				<h3>Who am I anyways?</h3>
				<p>
					I'm Zarthus, but am also known as BuuGhost, or even Jos Ahrens off the internet, I'm from the Netherlands and currently study Software Engineering at the Alfa College in Groningen.
				</p><p>
					I enjoy programming in various languages, as of right now I am most proficient with PHP, I know a little bit of C# and Java, and am also mildly familiar with the C language.
					Currently I'm attempting to learn the C++ language. Recently I have also become rather skilled with Regular Expressions.
				</p><p>
					In relation to music, I enjoy all sorts, but most of the genres I listen to are rock, metal, 80s, and 70s music.
					You can check out what I've recently listened to by checking my last fm account <a href="http://last.fm/user/BuuGhost">BuuGhost</a>, or by checking my <a href="http://open.spotify.com/user/1155290200/playlist/4QXARDBPRoe99fObf6e6db">spotify playlist</a>
				</p><p>
					As for languages that don't relate to programming, I natively speak Dutch, and have learnt a great portion of English over the years, starting at the age of 11.
					I know a little bit of German in addition to that, as for Spanish, I can usually read a little bit of it, but cannot write or speak it.
					<br><br>
				</p>
			</div>
		</div>

		<hr>

		<div class="row">
			<div class="col-md-offset-2 col-md-8">
				<h3>Contributor of</h3>
				<p>
					I happen to be all over the place when it comes to contributing and support.
				</p><p>
					<i>Wikipedia</i>
					<br>
					I contribute to <a href="https://en.wikipedia.org">Wikipedia</a>, under the name of <a href="https://en.wikipedia.org/wiki/Special:Contributions/Zarthus">Zarthus</a><br>
					You can find my contributions to Wikipedia <a href="https://en.wikipedia.org/wiki/Special:Contributions/Zarthus">here</a>
				</p><p>
					<i>Stack Overflow</i>
					<br>
					I roam Stack Overflow and many of its sister and brother websites, but I mostly provide support on <a href="http://stackoverflow.com">Stack Overflow itself</a>.
					The username there, is as you could have guessed, <a href="http://stackoverflow.com/users/3100691/zarthus">Zarthus</a>.
				</p><p>
					<i>GitHub</i>
					<br>
					I think I've already advertised my github profile on my website enough, but if for some reason you weren't aware yet, yes I do
					help out on github occasionally, my profile is <a href="https://github.com/Zarthus">Zarthus</a>.
				</p><p>
					<i>IRC (Internet Relay Chat)</i>
					<br>
					I provide support in many channels on freenode and EsperNet. Not too far below here is an IRC section, and you can also look it up in the contact page on the
					navigation bar above.
				</p>
			</div>
		</div>

		<hr>

		<div class="row">
			<div class="col-md-offset-2 col-md-8">
				<h3>Programming</h3>
				<br><br>
				<div class="table_responsive">
					<table class="table table-bordered table-hover table-condensed">
						<thead>
							<tr>
								<th class="table-centered">Language</th>
								<th class="table-centered">Proficiency</th>
								<th class="table-centered">Year</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>mIRC scripting language (mSL)</td>
								<td>Advanced</td>
								<td>2010 - current</td>
							</tr>
							<tr>
								<td>PAWN</td>
								<td>Advanced</td>
								<td>2011 - 2013</td>
							</tr>
							<tr>
								<td>PHP</td>
								<td>Advanced</td>
								<td>2011 - current</td>
							</tr>
							<tr>
								<td>Webdesign (HTML/CSS/JS)</td>
								<td>Advanced / Intermediate / Intermediate</td>
								<td>2010 - current</td>
							</tr>
							<tr>
								<td>Java</td>
								<td>Intermediate</td>
								<td>2012 - current</td>
							</tr>
							<tr>
								<td>C#</td>
								<td>Novice</td>
								<td>2013</td>
							</tr>
							<tr>
								<td>C++</td>
								<td>Fundamental Awareness</td>
								<td>2013 - current</td>
							</tr>
							<tr>
								<td>Regular Expressions</td>
								<td>Intermediate</td>
								<td>2013 - current</td>
							</tr>
							<tr>
								<td>Assembly</td>
								<td>Basic</td>
								<td>2014 - current</td>
							</tr>
						</tbody>
					</table>
				</div>
				<p>
					<small>
						footnotes: Proficient does not mean I know everything, just that I know enough to solve most problems<br>
						I do not have experience with browser support for IE
					</small>
				</p>
			</div>
		</div>

		<hr>

		<div class="row">
			<div class="col-md-12">
					<h3>Github Spotlights</h3>
					<br>
					<div class="projects">
						<div data-repo="Zarthus/zarth.us" class="github-box-wrap"></div>
						<br>
						<div data-repo="Zarthus/Code-Snippets" class="github-box-wrap"></div>
						<br>
						<div data-repo="Zarthus/School" class="github-box-wrap"></div>
						<br>
					</div>

			</div>
		</div>

		<hr>

		<div class="row">
			<div class="col-md-offset-2 col-md-8">
				<h3>Internet Relay Chat (IRC)</h3>
				<p>
					As an avid IRC user, I roam many networks and channels, you can find me on <a href="irc://irc.esper.net">EsperNet</a> and <a href="irc://irc.freenode.net">Freenode</a>.
					Should you ever wish to contact me, my username on both of those networks is Zarthus.
					<br><br>
					I've been using IRC since 2009 and haven't really stopped using it ever since.
				</p>
			</div>
		</div>

		<hr>

		<div class="row">
			<div class="col-md-12">
				<h3><a href="projects">Why don't you check out some of the projects I have made?</a></h3>
			</div>
		</div>

		<div class="row">
			<div class="col-md-12">
				<div class="col-md-offset-1 col-md-4">
					<h3>For instance, the source code of this website.</h3>
					<p>
						<a href="http://zarth.us">zarth.us</a> is open source and available on GitHub at <a href="http://github.com/Zarthus/zarth.us/">http://github.com/Zarthus/zarth.us</a>
					</p>
					<br><br>
					<h3>There's even more!</h3>
					<p>
						Over at <a href="http://github.com/Zarthus">http://github.com/Zarthus</a> can you find more of my code, like <a href="http://github.com/Zarthus/Code-Snippets">lots of code snippets</a>,
						this website also displays some projects over at <a href="projects">it's projects page</a>.
					</p>
				</div>
				<div class="col-md-6">
					<h3>Or maybe you are interested in my IRC Bots?</h3>
					<p>
						Over the years, I've made many bots that connect to IRC, some sucked, but I still enjoyed making them.
						<br>
					</p>
					<p>
						<a href="#not-yet-available">Eileen</a> | PHP | <a href="http://github.com/Westie/OUTRAGEbot/">OUTRAGEbot fork</a><br>
						<small>
							Eileen is my newest addition to the bot team; an all purpose utility bot
						</small>
					</p>

					<p>
						<a href="http://github.com/Zarthus/TwitchBot">TwitchBot</a> | PHP | <a href="http://github.com/Westie/OUTRAGEbot/">OUTRAGEbot fork</a><br>
						<small>
							TwitchBot was an IRC bot that connects to twitch.tv, it was made to log content from TwitchPlaysPokémon.
						</small>
					</p>

					<p>
						<a href="#source-code-hidden" class="col_red">_404</a> | PHP | Source Code Not Public<br>
						<small>
							_404 was my first PHP bot - it was pretty ugly and full of security issues, hence it's code is not public.
						</small>
					</p>

					<p>
						<a href="#source-code-lost" class="col_red">Convict</a> | mIRC | Source Code Lost<br>
						<small>
							Convict was an all utility mIRC bot that had a lot of functions, like my Games System.
							I'd imagine some of its functions are on <a href="https://github.com/Zarthus/Code-Snippets/tree/master/mSL%20-%20mIRC%20scripting%20language">GitHub</a> now, but it's core is gone forever.
						</small>
					</p>
				</div>
			</div>
		</div>

		<hr>
		<footer>
			<?php include_once(HTMLDIR . '/footer.php') ?>

		</footer>
	</div><!-- /.container -->

	<?php include(HTMLDIR . '/body.php'); ?>
	<script src="<?php echo JSDIR ?>/jquery-github/src/jquery.github.js"></script>
	<script>
		$("[data-repo]").github();
	</script>
</body>
</html>
