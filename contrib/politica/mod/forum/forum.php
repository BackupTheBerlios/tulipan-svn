<?php
	
	// Run includes
		require_once("../../includes.php");
		include(dirname(__FILE__) . '/config.php');

        global $CFG, $page_owner, $template, $PAGE;
		$template['css'] .= file_get_contents($CFG->dirroot . "mod/forum/css");
		$profile_id=$_GET['owner'];

		$page_owner = $_GET['owner'];

        define("context", "forum");
		
		if ((context == "forum")   && run("users:type:get", $page_owner) == "community")
        {
            // Add to the submenu
			$num = count($PAGE->menu_sub) + 1;
			$PAGE->menu_sub[$num]['name'] = "forum:rssfeed";
            $PAGE->menu_sub[$num]['html'] = '<a href="'.$CFG->wwwroot . user_info("username",$page_owner) . '/weblog/rss/"><img src="' . $CFG->wwwroot . 'mod/template/icons/rss.png" border="0" alt="rss" /></a>'; 

			if(run("permissions:check", "weblog")){
				$num = $num + 1;
	            $PAGE->menu_sub[$num]['name'] = "forum:add_discussion"; 
	            $PAGE->menu_sub[$num]['html'] = "<a href=\"{$CFG->wwwroot}_weblog/edit.php?action=edit&amp;owner={$profile_id}\">" . __gettext("Add New Item") . "</a>";
			}
			
            $num = $num + 1;
            $PAGE->menu_sub[$num]['name'] = "forum:blogview"; 
            $PAGE->menu_sub[$num]['html'] = '<a href="'.$CFG->wwwroot . user_info("username",$page_owner) . '/weblog/">' . __gettext("View as Blog") . '</a>';
			

        }
		
        
        templates_page_setup();
        


					// If the weblog offset hasn't been set, it's 0
					$weblog_offset = optional_param('weblog_offset',0,PARAM_INT);
					$filter = optional_param('filter');
					
					// Get all posts in the system that we can see
					
					$where = run("users:access_level_sql_where",$_SESSION['userid']);
					
					if ($forum_sort == 1){
						$forum_sort_string="last_updated DESC, posted DESC";
					}
					else
					{
						$forum_sort_string="posted DESC";					
					}
					
					
					if (empty($filter)) {
						$posts = get_records_select('weblog_posts','('.$where.') AND weblog = '.$profile_id,null,$forum_sort_string,'*',$weblog_offset,'25');
						$numberofposts = count_records_select('weblog_posts','('.$where.') AND weblog = '.$profile_id);
						//echo $numberofposts;
					} else {
						$where = str_replace("access","wp.access",$where);
						$where = str_replace("owner","wp.owner",$where);
						$posts = get_records_sql("select * from ".$CFG->prefix."tags t join ".$CFG->prefix."weblog_posts wp on wp.ident = t.ref where ($where) AND t.tagtype = 'weblog' AND wp.weblog = $profile_id AND t.tag = " . $db->qstr($filter) . " order by " . $forum_sort_string . " limit $weblog_offset,25");
						$numberofposts = get_record_sql("select count(wp.ident) as numberofposts from ".$CFG->prefix."tags t join ".$CFG->prefix."weblog_posts wp on wp.ident = t.ref where ($where) AND t.tagtype = 'weblog' AND wp.weblog = $profile_id AND t.tag = " . $db->qstr($filter));
						$numberofposts = $numberofposts->numberofposts;
					}
					
					
					$body="
					<table id=\"forum_table\" cellspacing=\"0\" summary=\"Forum Table\">
					<tr>
						<th scope=\"col\" class=\"nobg\">" . __gettext("Discussion Topic") . "</th>
						<th class=\"cent\">" . __gettext("Started by") . "</th>
						<th class=\"cent\">" . __gettext("Comments") . "</th>
					</tr>";

					
					if (!empty($posts)) {
						
						
						foreach($posts as $post) {
							
							$time = strftime("%B %d, %Y",$post->posted);
							
							$select='select * from ' . $CFG->prefix . 'weblog_comments Where post_id='. $post->ident . ' ORDER by posted DESC';
							//echo $select;
							$comments = get_records_sql($select);
							$numberofcomments = get_record_sql("select count(*) as numberofcomments from ".$CFG->prefix."weblog_comments WHERE post_id =" . $post->ident);
							$numberofcomments = $numberofcomments->numberofcomments;
							
							//$body .= run("weblogs:posts:view",$post);
							//<td><a href=\"" . $CFG->wwwroot . user_info("username",$page_owner) . "/weblog/" . $post->ident . ".html\" title=\"View full discussion...\">" . $post->title . "</a></td>
							
							// handle empty titles  
							if(empty($post->title)){
								$words = 6; // 5 words, really
								$cut_body = preg_replace("/<[^<>]>/","",$post->body);
								$cut_body = explode(" ",$cut_body,$words);
								array_pop($cut_body);
								$post->title = "<em>".implode(" ",$cut_body)." ...</em>";
							}
							
							
							$body .= "

								<tr scope=\"row\">
								<td><a href=\"forum_view_thread.php?post=" . $post->ident . "\" title=\"" . __gettext("View full discussion...") . "\">" . $post->title . "</a></td>
								<td class=\"cent\"><a href=\"" . $CFG->wwwroot . user_info("username",$post->owner) . "/" . "\" title=\"" . __gettext("View profile...") . "\">" . user_info("name",$post->owner) . "</a></td>
								<td class=\"cent\"><a href=\"forum_view_thread.php?post=" . $post->ident . "\" title=\"" . __gettext("View comments...") . "\">" . $numberofcomments . "</a></td>

								</tr>";
							
						}
						
						
						
					}
					
					$body .= '</table><br><a href="' . $CFG->wwwroot . '_weblog/edit.php?action=edit&amp;owner=' . $profile_id . '" title="' . __gettext("Add New Item") . '">' . __gettext("Add New Item") . '...</a><br><br>';
					
if (!empty($posts)) {
        
    if ($numberofposts - ($weblog_offset + 25) > 0) {
        $display_weblog_offset = $weblog_offset + 25;
        $back = __gettext("Back");
        $body .= <<< END
                
                <a href="{$CFG->wwwroot}mod/forum/forum.php?owner={$profile_id}&weblog_offset={$display_weblog_offset}">&lt;&lt; $back</a>
                
END;
    }
    if ($weblog_offset > 0) {
        $display_weblog_offset = $weblog_offset - 25;
        if ($display_weblog_offset < 0) {
            $display_weblog_offset = 0;
        }
        $next = __gettext("Next");
        $body .= <<< END
                
                <a href="{$CFG->wwwroot}mod/forum/forum.php?owner={$profile_id}&weblog_offset={$display_weblog_offset}">$next &gt;&gt;</a>
                
END;
    }
    
}

    // Draw page
        $title = run("profile:display:name") . " :: " . __gettext("Forum");

        $body = templates_draw(array(
                        'context' => 'contentholder',
                        'title' => $title,
                        'body' => $body
                    )
                    );

        echo templates_page_draw( array(
                        $title, $body
                    )
                    );

		
?>


