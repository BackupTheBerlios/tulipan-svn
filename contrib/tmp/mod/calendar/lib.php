<?php

    /*
	Calendar 
    
    */

    // Standard page setup function
   

// Add "Your Calendar" and submenu items when logged in
 
      function calendar_pagesetup() {
            global $PAGE, $CFG, $page_owner;

global $function;
 $function['display:sidebar'][] = $CFG->dirroot . "mod/calendar/user_info_menu.php";


// global $metatags;
// $metatags .= file_get_contents($CFG->dirroot . "mod/calendar/css");

//  Must be logged in  and not an external user type

if (isloggedin() && user_info("user_type",$_SESSION['userid']) != "external") {

// IF context=calendar, then have clicked on Your Calendar already
//    add Your Calendar to tabs with class selected  (tab is highlighted)


   if (defined("context") && context == "calendar" && $page_owner == $_SESSION['userid']) {
            $PAGE->menu[] = array( 'name' => 'calendar',
             'html' => "<li><a href=\"{$CFG->wwwroot}{$_SESSION['username']}/calendar/\" class=\"selected\" >" .
		__gettext("Events").'</a></li>');

// Else just add Your Calendar to tabs
    } else {
           $PAGE->menu[] = array( 'name' => 'calendar',
                  'html' => "<li><a href=\"{$CFG->wwwroot}{$_SESSION['username']}/calendar/\" >" .
			__gettext("Events").'</a></li>');
                }

// IF context is calendar, display submenu

    // submenu
    if (defined("context") && context == "calendar") {

        if ($page_owner != -1 ) {
	   
 
            $PAGE->menu_sub[] = array ( 'name' => 'calendar:rssfeed',
                                        'html' => "<a href=\"{$CFG->wwwroot}".  user_info("username",$page_owner). 
				    "/calendar/rss/\"><img src =".
"\"{$CFG->wwwroot}_templates/icons/rss.png\" border=\"0\" alt=\"RSS\" /></a>"); 

            $PAGE->menu_sub[] = array ( 'name' => 'calendar:archives',
                                        'html' => a_href( $CFG->wwwroot."mod/calendar/archiveview.php?calendar_name=".
						user_info("username",$page_owner),
                                                __gettext("Archives")));

            $PAGE->menu_sub[] = array ( 'name' => 'calendar:view',
                                        'html' => a_href( $CFG->wwwroot."mod/calendar/index.php?calendar_name=".
						user_info("username",$page_owner),
                                                __gettext("View Calendar")));

	    if ( run("permissions:check","weblog") ) {
		/* Display "Add New Event" if looking at a calendar I can edit - my calendar or community calenar */
                    $PAGE->menu_sub[] = array( 'name' => 'calendar:edit',
                                               'html' => a_href( $CFG->wwwroot."mod/calendar/add.php?calendar_name=" . 
						user_info("username",$page_owner),
                                                __gettext("Add New Event")));

		    if ($page_owner == $_SESSION['userid']) {
		    /* Display "My Community Events" if looking at my calendar */
		    $PAGE->menu_sub[] = array('name' => 'calendar:community',
			'html' => a_href($CFG->wwwroot."mod/calendar/index.php?calendar_name=".
			    $_SESSION['username']."&caltype=community",__gettext("My Community Events")));
		    /* Display "My Friends Events" if looking at my calendar */
		    $PAGE->menu_sub[] = array('name' => 'calendar:friends',
			'html' => a_href($CFG->wwwroot."mod/calendar/index.php?calendar_name=".
			    $_SESSION['username']."&caltype=friends",__gettext("My Friends Events")));
			}

                } /* if permissions check && logged on */

	    } /* if page_owner != -1 */

         }    /* if defined contenxt = calendar */
   }  /* if islogged on */

} /* function */
        
    // Initialisation function

        function calendar_init() {

            global $CFG, $function, $db, $METATABLES;

    // If the calendar_events tables do not already exist, create it

// Only create tables if logged on as news

if (isloggedin() && user_info("username",$_SESSION['userid']) == 'news') {

            if ( !in_array($CFG->prefix . "calendar_events", $METATABLES)) {
                if (file_exists($CFG->dirroot . "mod/calendar/$CFG->dbtype.sql")) {
                    modify_database($CFG->dirroot . "mod/calendar/$CFG->dbtype.sql");
                } else {
                    error("Error: Your database ($CFG->dbtype) is not yet fully ".
			"supported by the Elgg calendar.  See the mod/calendar directory.");
                }
		// Display a continue button linked to index.php
                print_continue("index.php");
                exit;
            }
    }
        }

?>
