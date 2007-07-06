<?php
    // Pagina principal
    global $CFG;
    global $invitarAmigo;
    global $showTags;

    require_once(dirname(__FILE__)."/includes.php");
    templates_page_setup();
    if (logged_on) {
        $body = templates_draw(array(
                                        'context' => 'frontpage_loggedin'
                                )
                                );
    // Modify by JOHAN Friday 6 of July

    $invitarAmigo .= run("invite:invite");
    $showTags = run("search:tags:display");

   // End modify 

} else {
        $body = templates_draw(array(
                                        'context' => 'frontpage_loggedout'
                                )
                                );
    }
   
    echo templates_page_draw( array(
                    $CFG->sitename,
                    $body
            )
            );
    

?>