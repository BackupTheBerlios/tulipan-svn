<?php

//    ELGG weblog view page

// Run includes
require_once("../../includes.php");
$template['css'] .= file_get_contents($CFG->dirroot . "mod/forum/css");

run("profile:init");
run("friends:init");
run("weblogs:init");

global $profile_id;
global $individual;
global $CFG, $page_owner, $template, $PAGE;
global $redirect_url;


define("context", "forum");

$individual = 1;

$post = optional_param('post',0,PARAM_INT);
if (!empty($post)) {
    
    $where = run("users:access_level_sql_where",$_SESSION['userid']);
    
    if (!$post = get_record_select('weblog_posts','('.$where.') AND ident = '.$post)) {
        $post = new StdClass;
        $post->weblog = -1;
        $post->owner = -1;
        $post->title = __gettext("Access denied or post not found");
        $post->posted = time();
        $post->ident = -1;
        $post->body = __gettext("Either this blog post doesn't exist or you don't currently have access privileges to view it.");
    }
    
    global $page_owner;
    global $profile_id;
    $profile_id = $post->weblog;
    $page_owner = $post->weblog;

    
		if ((context == "forum")   && run("users:type:get", $profile_id) == "community")
        {
            // Add to the submenu
						
            $num = count($PAGE->menu_sub) + 1;

            $PAGE->menu_sub[$num]['name'] = "forum:blogview"; 
            $PAGE->menu_sub[$num]['html'] = '<a href="'.$CFG->wwwroot . 'mod/forum/forum.php?owner=' . $page_owner . '">' . __gettext("Return to Forum") . '</a>';
			
			$num = count($PAGE->menu_sub) + 1;
            $PAGE->menu_sub[$num]['name'] = "forum:blogview"; 
			$PAGE->menu_sub[$num]['html'] = "<a href=\"" . $CFG->wwwroot . user_info('username',$post->weblog) . "/weblog/" . $post->ident . ".html#new_weblog_comment\" title=\"" . __gettext("Add a comment...") . "\">" . __gettext("Add new comment") . "</a>";
        }
		
		
    templates_page_setup();
    
    $time = gmstrftime("%b %d, %y",$post->posted);
    $body = "
						<table id=\"forum_table\" cellspacing=\"0\" summary=\"Forum Table\">
					<tr>
						<th scope=\"col\" class=\"nobg\">" . __gettext("From") . "</th>
						<th class=\"cent\">" . $post->title . "</th>
					</tr>";
	
	
								$body .= "

								<tr scope=\"row\">
								<td class=\"cent\" valign=\"top\"><div class=\"user\"><a href=\"" . $CFG->wwwroot . user_info("username",$post->owner) . "/" . "\" title=\"" . __gettext("View profile...") . "\"><img src=\"" . $CFG->wwwroot . "_icon/user/" . $post->icon . "\"><br>" . user_info("name",$post->owner) . "</a><br>" . $time . "</div></td>
								<td>" . run("weblogs:text:process", $post->body) . "";
								
    if (run("permissions:check",array("weblog:edit",$post->owner))) 
	{
        $Edit = __gettext("Edit");
        $returnConfirm = __gettext("Are you sure you want to permanently delete this forum post?");
        $Delete = __gettext("Delete");
        $body .="<div class=\"edit_delete\">
							<a href=\"{$CFG->wwwroot}_weblog/edit.php?action=edit&weblog_post_id={$post->ident}\" title=\"$Edit\"><img src=\"images/edit.gif\" border=0></a>						
							<a href=\"{$CFG->wwwroot}_weblog/action_redirection.php?action=delete_weblog_post&amp;delete_post_id={$post->ident}\" onclick=\"return confirm('$returnConfirm')\" title=\"$Delete\"><img src=\"images/delete.gif\" border=0></a>
						<div>";
			

	}
								
			$body .="					
								</td>
								</tr>
";


							$select='select * from ' . $CFG->prefix . 'weblog_comments Where post_id='. $post->ident . ' ORDER by posted ASC';
							//echo $select;
							$comments = get_records_sql($select);
							$numberofcomments = get_record_sql("select count(*) as numberofcomments from ".$CFG->prefix."weblog_comments WHERE post_id =" . $post->ident);
							$numberofcomments = $numberofcomments->numberofcomments;
							

						
							if (!empty($comments)){
						
								foreach($comments as $comment) {
									$body .= "<tr><td class=\"cent\" valign=\"top\"><div class=\"user\"><a href=\"" . $CFG->wwwroot . user_info("username",$comment->owner) . "/" . "\" title=\"" . __gettext("View profile...") . "\"><img src=\"" . $CFG->wwwroot . "_icon/user/" . user_info("icon",$comment->owner) . "/h/67/w/67\"><br>" . $comment->postedname . "</a><br>" . gmstrftime('%b %d, %y',$comment->posted) . "</div></td><td>" . run("weblogs:text:process", $comment->body);
									
									if (logged_on && ($comment->owner == $_SESSION['userid'] || run("permissions:check",array("weblog:edit",$post->owner)))) 
									{
										$returnConfirm = __gettext("Are you sure you want to permanently delete this forum comment?");
										$Delete = __gettext("Delete");
										$body .="<p align=right>
														<a href=\"{$CFG->wwwroot}_weblog/action_redirection.php?action=weblog_comment_delete&amp;weblog_comment_delete={$comment->ident}\" onclick=\"return confirm('$returnConfirm')\" title=\"$Delete\"><img src=\"images/delete.gif\" border=0></a>
												</p>
												";
									}
		
									
									
									$body .= "</td></tr>";
								}
													
							}
													
							
							$body .= "</table><br><a href=\"" . $CFG->wwwroot . user_info('username',$post->weblog) . "/weblog/" . $post->ident . ".html#new_weblog_comment\" title=\"" . __gettext("Add new comment...") . "\">Add new comment...</a><br><br>";
						}
						
						
						

					

					

    
    // Draw page
        $title = run("profile:display:name") . " :: " . __gettext("Forum") . " :: " . stripslashes($post->title);

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