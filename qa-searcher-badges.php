<?PHP
	class qa_searcher_badges {
	
		function custom_badges() {
			return array(
				// Searching badges
				// var: award criteria
				// types: 0=bronze; 1=silver; 2=gold;
				'searcher' => array ('var'=>100, 'type'=>0),
				'researcher' => array ('var'=>1000, 'type'=>1),
				'investigator' => array ('var'=>10000, 'type'=>2)
			); // array
		} // custom_badges end tag
				
		
		function custom_badges_rebuild() {
			$awarded = 0;
			
			if(	qa_opt('badge_active') and
				qa_opt('badge_custom_badges') and 
				function_exists('qa_badge_award_check')) {
			
				// qa_db_query_sub is the preferred method for querying the QA 
				// database.  You can reference tables using ^<table name> and ^
				// will be replaced by the table prefix constant defined in the
				// qa_config.php file.  $ and # values are substituions for 
				// string and numeric values following the query string in 
				// stringformat style (command delimited)
				$usersearchcounts = qa_db_query_sub(
					'SELECT userid, count(*) AS netsearches
					FROM ^eventlog 
					WHERE event=$ AND userid is not null 
					GROUP BY userid',
					'search'
				); // posts query
				
				while (( $usersearchcount=qa_db_read_one_assoc($usersearchcounts,true)) !== null ) {
					$badges = array('searcher','researcher','investigator');
					// qa_badge_award_check is defined in the Badges plugin in qa-plugin.php
					// takes in the array of badges, the score we'll evaluate the award limit
					// for each badge against, the user id that has the potential to get the
					// awarded badge, the postid (if we're awarding based on posts - can be null)
					// and the notification method - 1 for email and popup, 2 for popup alone
					$awarded += count(qa_badge_award_check(
						$badges,
						(int)$usersearchcount['netsearches'],
						$usersearchcount['userid'],
						null, // the postid's are n/a here
						2) // qa_badge_award_check()
					); // count()
				} // while loop
			
			} // health check of badges plugin
			
			return $awarded;
			
		} // custom_badges_rebuild end tag
		
	} // class end tag
	
/*
	Omit PHP closing tag to help avoid accidental output
*/