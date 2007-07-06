<?php
    // Pagina principal
    global $CFG;
    global $invitarAmigo;
    global $showTags;
    global $showNewsLatinPyme;

    require_once(dirname(__FILE__)."/includes.php");
    templates_page_setup();
    if (logged_on) {
        $body = templates_draw(array(
                                        'context' => 'frontpage_loggedin'
                                )
                                );
    // Modify by JOHAN Friday 6 of July
    //Falta organizar la logica de mis modificaciones por que estoy colocando variables en esta pagina, pero deben estar en otro archivo...
    $invitarAmigo .= run("invite:invite");
    $showTags = run("search:tags:display");
//Estoy siguiendo la logica de ELGG para crear una funcionalidad llamada NEWS donde se muestren las noticias de LATINPYME en la pagina de inicio
    $showNewsLatinPyme = run("news:display");
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