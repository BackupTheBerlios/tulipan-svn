<?php

global $page_owner;
global $CFG;
$profile_id = $page_owner;
$sitename = sitename;

    if (logged_on || (isset($page_owner) && $page_owner != -1)) {
    
    $title = __gettext("Polls");

    $polls_name = user_info("username",$page_owner);
    $body = "<ul><li>"; 
    $body .= "<a href=\"". $CFG->wwwroot . $_SESSION['username'] . "/polls/\">" .
	    __gettext("View Active Polls") . "</a></li></ul>";

            $run_result .= "<li id=\"poll\">";
    $run_result .= templates_draw(array(
                                        'context' => 'sidebarholder',
                                        'title' => $title,
                                        'body' => $body,
                                        )
                                  );
            $run_result .= "</li>";
}

        

?>