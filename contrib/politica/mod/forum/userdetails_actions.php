<?php

    // Save the user's editor choice
    $action = optional_param('action');
    $id = optional_param('id',0,PARAM_INT);
    $value = optional_param('forum');

    if (logged_on && !empty($action) 
        && run("permissions:check", array("userdetails:change",$id))) {
        if (!empty($value) && in_array($value,array('yes','no'))) {

            // Get the current value, will also create an initial entry if not yet set
            $current = run('userdetails:forum', $id);
            if ($current == $value) {
                $messages[] .= __gettext("Your forum view preferences have been saved");
            } else {
                if (user_flag_set('forum', $value, $id)) {
                    $messages[] .= __gettext("Your forum view preferences have been changed");
                } else {
                    $messages[] .= __gettext("Your forum view preferences could not be changed");
                }
            }
        }
    }

?>