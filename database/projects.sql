--  This is also created in projects.php, please ensure it is changed there too if you modify this.

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

-- Sample INSERT queries
-- 
-- INSERT INTO `projects` (`project_name`, `project_author_title`, `project_url`, `project_language`, `project_desc`, `project_start`, `project_end`, `project_author`, `project_state`, `timestamp`) VALUES
-- ('zarth.us', 'http://zarth.us', 'https://github.com/zarthus/zarth.us', 'PHP, HTML, CSS', 'zarth.us is this very website, it was a hobby project to get me around to finally designing a website for myself and learn to better documentate my code.', '17/03/2014', 'N/A', 'Zarthus', 'Development', '2014-03-22 13:53:59'),
-- ('Code Snippets', 'http://zarth.us', 'https://github.com/Zarthus/Code-Snippets', 'Various', 'General snippets of code from various languages, including PHP, mIRC (mSL), Java, JavaScript. Generally contains things that do not deserve their own repository, but might be useful for someone, somewhere.', 'No specific start', 'No specific end', 'Zarthus', 'No state', '2014-03-22 15:18:21'),
-- ('SA:MP lookup bot', 'http://zarth.us', 'https://github.com/Zarthus/samp-lookupbot', 'PAWN', 'A bot that got data from a wiki page (or rather, interacted with a PHP script that looked things up from the wiki; it was too much of a hassle to do it with PAWN)', '22/01/2014', '24/01/2014', 'Zarthus', 'Release (v0.2)', '2014-03-22 15:21:48');
--
-- Keep in mind it is only minimally sanitized in projects.php; I don't really expect to need a CMS or admin panel for just this. So i'll just insert it manually into the database
-- It has it's complications, but really this is a thing I expect to touch very little.