<?php

    if (logged_on) {
        $run_result .= run("users:infobox", array("Encuestas",array($_SESSION['userid'])));
    }

?>