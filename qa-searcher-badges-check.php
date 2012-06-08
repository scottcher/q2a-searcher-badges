<?php
	
	class qa_searcher_badges_check{
	
		function process_event($event, $userid, $handle, $cookieid, $params) {
		
			if(	qa_opt('badge_active') and
				qa_opt('badge_custom_badges') and 
				function_exists('qa_badge_award_check')) {

				// when a search is performed. The search query is in $params['query'] and the start position in $params['start'].
				if('search' == $event) {
						$this->search_fired($userid);
				} // if this is a search event
			
			} // if badge_active option exists
		
		} // process_event end tag
		
		function search_fired($event_user) {
		
			if($event_user) {
				$usersearchcount = qa_db_read_one_value(
					qa_db_query_sub(
						'SELECT COUNT(*) AS netsearches FROM ^eventlog WHERE event=$ AND userid=#',
						'search', $event_user
					), true
				);
								
				// I wouldn't expect this to happen but could so...
				if($usersearchcount) {
					$badges = array('searcher','researcher','investigator');
					qa_badge_award_check($badges, (int)$usersearchcount, $event_user);
				}
			} // if event_user exists
		
		} // search_fired end tag		
	
	} // class end tag
	
/*							  
		Omit PHP closing tag to help avoid accidental output
*/		