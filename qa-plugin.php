<?php
		
/*			  
		Plugin Name: Searcher Badges
		Plugin URI: 
		Plugin Update Check 
		Plugin Description: Adds searcher badges
		Plugin Version: 0.9a
		Plugin Date: 2012-06-05
		Plugin Author: SDC
		Plugin Author URI:							  
		Plugin License: internal use only
		Plugin Minimum Question2Answer Version: 1.5
*/					  


	if (!defined('QA_VERSION')) { // don't allow this page to be requested directly from browser
		header('Location: ../../');
		exit;   
	}
	
	qa_register_plugin_module('module', 'qa-searcher-badges.php', 'qa_searcher_badges', 'Searcher Badges');
	qa_register_plugin_module('event', 'qa-searcher-badges-check.php','qa_searcher_badges_check','Searcher Badges Check');
	
	if(function_exists('qa_register_plugin_phrases')){
		qa_register_plugin_phrases('qa-sb-lang-*.php', 'searcher_badges');
	}
	
/*							  
		Omit PHP closing tag to help avoid accidental output
*/		