<?php

    global $page_owner;
    global $PAGE;
    //global $run_result;
    global $CFG;
	

    if ((logged_on) && run("users:type:get", $page_owner) == "community")
	{
            $forum_title = __gettext("Blog/Forum View:");
    $forumRules = __gettext("Set this to 'yes' if you would like to default this user/community blog to a 'forum' view.");

    $body = <<< END

    <h2>$forum_title</h2>
    <p>
        $forumRules
    </p>

END;
		$forum = user_flag_get('forum', $page_owner);
		if (!$forum)
		{
			$forum = "no";
		}
			
	
		if ($forum == "yes")
		{
			$body .= templates_draw( array(
				'context' => 'databox',
				'name' => __gettext("Default Blog View to 'Forum' type: "),
				'column1' => "<label><input type=\"radio\" name=\"forum\" value=\"yes\" checked=\"checked\" /> " . __gettext("Yes") . "</label> <label><input type=\"radio\" name=\"forum\" value=\"no\" /> " . __gettext("No") . "</label>"
				)
				);
		} else 
		{
			$body .= templates_draw( array(
				'context' => 'databox',
				'name' => __gettext("Default Blog View to 'Forum' type: "),
				'column1' => "<label><input type=\"radio\" name=\"forum\" value=\"yes\" /> " . __gettext("Yes") . "</label> <label><input type=\"radio\" name=\"forum\" value=\"no\" checked=\"checked\" /> " . __gettext("No") . "</label>"
				)
				);
		}
	
	
			$run_result .= $body;
        
    }

?>