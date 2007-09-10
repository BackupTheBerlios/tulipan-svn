<?php


		
    function forum_pagesetup()
    {
        global $CFG, $PAGE, $page_owner;
    
        if (defined("context") && (context == "weblog") && run("users:type:get", page_owner()) == "community")
        {
            // Add to the submenu
            $num = count($PAGE->menu_sub) + 1;

            $PAGE->menu_sub[$num]['name'] = "weblog:forum"; 
            $PAGE->menu_sub[$num]['html'] = '<a href="'.$CFG->wwwroot .  'mod/forum/forum.php?owner='.page_owner().'">' . __gettext("View as Forum") . '</a>';
        }
		
		

    }
	
	function forum_init() 
	{
        

		global $function, $CFG, $page_owner, $profile_id, $db, $METATABLES;
        include('config.php');
		
		
		if (in_array($CFG->prefix . "weblog_posts", $METATABLES)) {
			$messagesTable = $db->MetaColumnNames($CFG->prefix . "weblog_posts", true);
		    // If dosn't exists adding the colummns 'last_updated'
		    if (!in_array("last_updated", $messagesTable)) {
		      if (file_exists($CFG->dirroot . "mod/forum/$CFG->dbtype.sql")) {
		        modify_database($CFG->dirroot . "mod/forum/$CFG->dbtype.sql");
		      } else {
		        error("Error: Your database ($CFG->dbtype) is not yet fully supported by the Elgg messages plug-in.  See the mod/forum directory.");
		      }
		    }
		}
		
		listen_for_event("weblog_post","publish","forum_publish_blog");
		listen_for_event("weblog_post","republish","forum_publish_blog");
		listen_for_event("weblog_post","delete","forum_publish_blog");
		listen_for_event("weblog_comment","publish","forum_publish_blog");
		listen_for_event("weblog_comment","delete","forum_publish_blog");



		//redirect some functions to use our custom pages for community details...
		$function['userdetails:edit:details'][] = $CFG->dirroot . "mod/forum/userdetails_edit.php";
		$function['userdetails:init'][] = $CFG->dirroot . "mod/forum/userdetails_actions.php";


	
		$forum_flag = user_flag_get('forum', page_owner());
		//echo $forum_flag;
		//echo $forum_default;		
		
		if ((!$forum_flag) && ($forum_default == 0))
		{
			$use_forum= "yes";
		}
		else if ((!$forum_flag) && ($forum_default == 1))
		{
			$use_forum= "no";
		}
		else
		{
			$use_forum= $forum_flag;
		}

		//echo $use_forum;
		
		foreach($function['display:sidebar'] as $key => $file) 
		{
			if (($file == $CFG->dirroot .  "units/weblogs/weblogs_user_info_menu.php") && ($use_forum == "yes"))			
			{
				$custom_sidebar=$CFG->dirroot .  'mod/forum/forum_user_info_menu.php';
				$function['display:sidebar'][$key] = $custom_sidebar;
			}
				
		}


    } // end function forum_init
	
	
function forum_publish_blog($object_type, $event, $object)
{
	global $CFG, $PAGE, $profile_id, $page_owner, $redirct_url; 
	include('config.php');
    
    //echo run("users:type:get", page_owner());
	
	if ($object_type == "weblog_comment") { 
		$post = get_record('weblog_posts','ident',$object->post_id);
		$redirect_url= $CFG->wwwroot . 'mod/forum/forum_view_thread.php?post=' . $post->ident;
		$community=$post->weblog;
		
		if ($forum_sort == 1){
			//NOW UPDATE THE LAST_MODIFIED STATUS OF THE WEBLOG_POST TO BE NOW SO THAT WE CAN SORT ON THIS IN THE FORUM VIEW...
			$post->last_updated=time();
			update_record('weblog_posts',$post);
		}
		
	}
	
	if ($object_type == "weblog_post") { 
		$post = $object->ident;
		$redirect_url= $CFG->wwwroot . 'mod/forum/forum_view_thread.php?post=' . $post;
		$community=$object->weblog;
		
		if ($forum_sort == 1){
			//NOW UPDATE THE LAST_MODIFIED STATUS OF THE WEBLOG_POST TO BE NOW SO THAT WE CAN SORT ON THIS IN THE FORUM VIEW...
			$object->last_updated=time();
			update_record('weblog_posts',$object);
		}
		
		if ($event == "delete") {$redirect_url= $CFG->wwwroot . 'mod/forum/forum.php?owner=' . $community;}
	}


	
		$forum_flag = user_flag_get('forum', page_owner());
		//echo $forum_flag;
		//echo $forum_default;		
		
		if ((!$forum_flag) && ($forum_default == 0))
		{
			$use_forum= "yes";
		}
		else if ((!$forum_flag) && ($forum_default == 1))
		{
			$use_forum= "no";
		}
		else
		{
			$use_forum= $forum_flag;
		}
		

	if (run("users:type:get", $community) == "person"){
		$redirect_url= $CFG->wwwroot . user_info('username', $community) . '/weblog';
	}

	if ($use_forum == "yes")
	{
		define('redirect_url',$redirect_url);
		
		if (defined('redirect_url')) {
			header("Location: " . redirect_url);
        } else {
            header("Location: " . $CFG->wwwroot);
        }
	}


	
	return $object; 
}

?>
