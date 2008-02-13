<?php

    /*
    
        Elgg Dashboard
        http://elgg.org/
    
    */

    // Load Elgg framework
        @require_once("../../includes.php");

    // We need to be logged on for this!
        
        if (isloggedin()) {
            
        // Define context
            define("context","dashboard");
            
        // Load global variables
            global $CFG, $PAGE, $db, $page_owner, $messages;
            
        // Get widget details
            $ident = optional_param('wid',0,PARAM_INT);
            $widget = get_record('widgets','ident',$ident);
            
        // Page owner = where the widget resides
            $page_owner = $widget->owner;
            
        // Do we have permission to touch this?
        // If so, wipe it!
            if (run("permissions:check","profile")) {
                
                widget_destroy($widget->ident);
                widget_reorder($page_owner,$widget->location,$widget->location_id);
                
            }
            
        // Get the username of the widget owner
            $username = user_info("username",$widget->owner);
            
        // Add a message
            $messages[] = __gettext("Widget deleted.");
            $_SESSION['messages'] = $messages;
            
        // Redirect back to the relevant location 
            switch( $widget->location ) {
                case 'profile':
                case '':
                    $redirect_url = $CFG->wwwroot . $username . "/profile/";
                    break;
                default:
                     // get module from the widget type
                    $module = '';
                    $mod_pos = strpos($widget->type,"::");
                    if ($mod_pos) {
                        $module = substr($widget->type,0,$mod_pos);
                    }               
                    $redirect_url = widget_get_display_url($module).'?'.widget_get_display_query();
                    break;
                }
            header("Location: " . $redirect_url);
            exit;
        
        }
        
?>