<?php
    // Pagina principal
    global $CFG;
    global $inviteFriend;
    global $showTags;
    global $showNewsLatinPyme;
    global $showFriends;

//Las variables GLOBALES estan definidas en /lib/setup.php

    require_once(dirname(__FILE__)."/includes.php");
    templates_page_setup();
    if (logged_on) {
        $body = templates_draw(array(
                                        'context' => 'frontpage_loggedin'
                                )
                                );
    // Modify by JOHAN Monday 9 of July

     
    //Falta organizar la logica de mis modificaciones por que estoy colocando variables en esta pagina, pero deben estar en otro archivo...
    $inviteFriend .= run("invite:invite");
    $showTags = run("search:tags:display");
    $showNewsLatinPyme = run("news:display");
    $showFriends =  run("friends:editpage");

    // $showFriends = run();

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