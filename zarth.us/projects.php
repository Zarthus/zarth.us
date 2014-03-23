<?php
/**
 *	Projects
 *	
 *	The page that hosts all projects I've ever made.
 *	
 *	@package	zarth.us
 *	@author		Zarthus <zarthus@zarth.us>
 *	@link		https://github.com/Zarthus/zarth.us
 *	@license	MIT - View http://zarth.us/licenses/zarth.us or the LICENSE.md file in the github repository 
 *	@since		22/03/2014
 */
define("USER_PATH", "Projects - projects.php");
require_once('includes/php/init.php'); 

$dbh->query("
	CREATE TABLE IF NOT EXISTS `projects` (
	  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
	  `project_name` varchar(64) NOT NULL,
	  `project_url` varchar(128) NOT NULL,
	  `project_language` varchar(32) NOT NULL,
	  `project_desc` varchar(1024) NOT NULL,
	  `project_start` varchar(25) NOT NULL,
	  `project_end` varchar(25) NOT NULL,
	  `project_author` varchar(128) NOT NULL,
	  `project_author_title` varchar(64) NOT NULL,
	  `project_state` varchar(25) NOT NULL,
	  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
	  PRIMARY KEY (`id`)
	) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
");

$stmt = $dbh->query("SELECT * FROM `projects`");
$projects = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>	
	<?php 
		$web['description'] = 'A wide list of projects that I have made'; 
		$web['theme'] = 'zarthus-theme.css';
	
		include(HTMLDIR . '/head.php'); 
	?>
		
</head>

<body>
	<?php include(HTMLDIR . '/navbar.php'); ?>
			
	<div class="container content">
		<div class="page-header jumbotron">
			<h1>Projects</h1>
			<?php 
				$count = count($projects);
				$proj_string = $count == 1 ? $count . ' project was found' : $count . ' projects were found';
				$fa_icon = $count == 1 ? 'fa-gear' : 'fa-gears';
			?>
			<p><i class="fa <?php echo $fa_icon ?>"></i> <?php echo $proj_string ?></p>
			<hr>
		</div>
		
		<!-- Start Project listing -->
		<?php
			
			foreach($projects as $project)
			{
				$project_id 		 = $project['id'];
				$project_url 		 = $project['project_url'];
				
				$is_git_url = strpos($project['project_url'], 'https://github.com') !== FALSE;
				$project_url_icon 	 = $is_git_url ? 'fa-github-alt' : 'fa-external-link'; 				
				$project_url_title	 = $is_git_url ? ' title="Project is located on GitHub"' : '';
				
				$project_name 		 = htmlentities($project['project_name']);
				$project_desc 		 = htmlentities($project['project_desc']);
				$project_language	 = htmlentities($project['project_language']);
				$project_start 		 = htmlentities($project['project_start']);
				$project_end 		 = htmlentities($project['project_end']);
				$project_author 	 = htmlentities($project['project_author']);
				$project_authortitle = !empty($project['project_author_title']) ? ' title="' . htmlentities($project['project_author_title']) . '"' : '';
				$project_state 		 = htmlentities($project['project_state']);
			
				$html =  "\n" . '<div class="row project-wrapper">' . "\n";
				$html .= '	<div class="col-md-offset-1 col-md-3 project-wrapper-left">' . "\n";
				$html .= '		<i class="fa fa-users"></i><span class="project-preface"> Author: </span><span class="project-author"' . $project_authortitle . '>' . $project_author . "</span><br>\n";
				if ($is_git_url) 
					$html .= '		<span ' . $project_url_title . '><i class="fa ' . $project_url_icon . '"></i><span class="project-preface"> URL   : </span><span class="project-title"><a href="' . $project_url . '">' . $project_name . "</a></span></span><br>\n";
				else
					$html .= '		<i class="fa ' . $project_url_icon . '"></i><span class="project-preface"> URL   : </span><span class="project-title"><a href="' . $project_url . '">' . $project_name . "</a></span><br>\n";
				$html .= '		<i class="fa fa-terminal"></i><span class="project-preface"> Lang  : </span><span>' . $project_language . "</span><br>\n";
				$html .= '		<span class="project-preface">   Start : </span><span>' . $project_start . "</span><br>\n";
				if ($project_state == 'Released' || $project_end != 'N/A') 
					$html .= '		<span class="project-preface">   End   : </span><span class="project-end">' . $project_end . "</span><br>\n";
				$html .= '		<span class="project-preface">   State : </span><span class="project-state">' . $project_state . "</span><br>\n";
				$html .= '	</div><div class="col-md-6 project-wrapper-right">' . "\n";
				$html .= '		<h2 class="project-header">' . $project_name . "</h2>\n";
				$html .= '		<p class="project-desc">' . $project_desc . "</p>\n";
				$html .= "	</div>\n";
				$html .= '</div> <!-- End Project ID: #' . $project_id . " -->\n";
				$html .= "<br><br><br>\n";
				
				echo $html;
			}
		?>
		
		<hr>
		<footer>
			<?php include_once(HTMLDIR . '/footer.php') ?>
			
		</footer>
	</div><!-- /.container -->
			
	<?php include(HTMLDIR . '/body.php'); ?>
</body>
</html>
<?php $logger->debug("Found a total of $count projects; and displayed them to the visitor"); ?>