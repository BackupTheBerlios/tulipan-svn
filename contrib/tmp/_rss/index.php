<?php

    require_once(dirname(dirname(__FILE__))."/includes.php");
    
//    global $page_owner;
    
    run("weblogs:init");
    run("profile:init");
    
    $username = trim(optional_param('profile_name',''));
    $user_id = user_info_username("ident", $username);
    if (!$user_id) {
        $user_id = $page_owner;
    } else {
        $page_owner = $user_id;
        $profile_id = $user_id;
    }
    
    run("rss:init"); // down here cos it sends $page_owner to rss function_actions.php
    
    define('context','resources');
    templates_page_setup();
    
    $title = run("profile:display:name", $user_id) ." :: " . __gettext("Feeds");
    
    run("rss:update:all", $user_id);
    $body = run("rss:view", $user_id);
    
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