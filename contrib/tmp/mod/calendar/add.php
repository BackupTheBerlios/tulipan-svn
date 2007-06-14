<?php

// if action = calendar:event:add then add a new event to SQL
// else display form

//  add.php

// paramenters:
//  calendar_name
//  action 

//  form paramneters:
//      calendarEventTitle
//      calendarEventDescription
//      calendarEventKeywords
//      calendarEventAccess
//      calendarEventLocation
//      StartDay
//      StartMonth
//      StartYear
//      calendarStartHour
//      calendarStartMinute
//      calendarStartAMorPM
//      calendarEndHour
//      calendarEndMinute
//      calendarEndAMorPM

    // Load Elgg framework
    @require_once("../../includes.php");

    // Load global variables
    global $CFG, $PAGE, $page_owneri, $messages;

    //  Load calendar actions
    @require_once("actions.php");

    // Define context
    define("context","calendar");


    // Get the name of calendar
    $calendar_name = trim(optional_param('calendar_name',''));
    $user_id = user_info_username("ident",$calendar_name);

    $page_owner = $user_id;



    //  If no user information, 
    //      redirect user to main ELGG page and exit

    if (empty($calendar_name) || $user_id == false) {
	$messages[] = __gettext("Cannot find calendar for user $calendar_name");
        $_SESSION["messages"] = $messages;
        header("Location: " . $CFG->wwwroot);
        exit;
        }

    // We need to be logged on for this!

    if (!isloggedin()) {
	$messages[] =  __gettext("You must be logged in to add events in this calendar.");
        $_SESSION["messages"] = $messages;
        header("Location: " .$CFG->wwwroot.
	    "mod/calendar/index.php?calendar_name=" . $calendar_name);
        exit;
        }

    // Are we eligible to edit this?
    if (! run("permissions:check","weblog")) {
	$messages[] =  __gettext("You do not have permission to add events in this calendar.");
        $_SESSION["messages"] = $messages;
        header("Location: " .$CFG->wwwroot.
	    "mod/calendar/index.php?calendar_name=" . $calendar_name);
        exit;
	}

    $calendar_form_input->title = trim(optional_param('calendarEventTitle'));
    $calendar_form_input->description = trim(optional_param('calendarEventDescription'));
    $calendar_form_input->keywords = trim(optional_param('calendarEventKeywords'));
    $calendar_form_input->access = trim(optional_param('calendarEventAccess'));
    $calendar_form_input->location = trim(optional_param('calendarEventLocation'));
    $calendar_form_input->start_day = trim(optional_param('StartDay'));
    $calendar_form_input->start_month = trim(optional_param('StartMonth'));
    $calendar_form_input->start_year = trim(optional_param('StartYear'));
    //$calendar_form_input->start_day = trim(optional_param('dayID'));
    //$calendar_form_input->start_month = trim(optional_param('monthID'));
    //$calendar_form_input->start_year = trim(optional_param('yearID'));
    $calendar_form_input->start_hour = trim(optional_param('calendarStartHour'));
    $calendar_form_input->start_minute = trim(optional_param('calendarStartMinute'));
    $calendar_form_input->start_amorpm = trim(optional_param('calendarStartAMorPM'));
    $calendar_form_input->end_hour = trim(optional_param('calendarEndHour'));
    $calendar_form_input->end_minute = trim(optional_param('calendarEndMinute'));
    $calendar_form_input->end_amorpm = trim(optional_param('calendarEndAMorPM'));


    // Initialise page body and title
    $body = "";
    $title = user_info("name",$user_id) . " :: "  . __gettext("Add calendar event");


    // setup $PAGE menu_top and menu_sub items, also runs calendar_pagesetup
    templates_page_setup();

    // Get action
    $action = trim(optional_param('action'));


    if ( !empty($action)  && $action == "calendar:event:add" ) {
	//  attetmp to add event to SQL table, if successful then exit
	$calendar_form_input->calendar = $page_owner;
	$calendar_form_input->owner = $_SESSION['userid'];
	$event_id = calendar_event_create($calendar_form_input,"add");
	if ($event_id) {
	    /* sucessful */
	    $messages[] = __gettext("Event has been sucessfully added to your calendar.");
	    $_SESSION["messages"] = $messages;
            header("Location: " .$CFG->wwwroot. $calendar_name .
		"/calendar/" . $event_id . ".html");
	    exit;
	    }
	else {
	    /* unsucceassful */
	    /* form body with fields fron previous request */
	    $body = calendar_event_form("add","",$calendar_form_input);
	    }
	}
    else {
	
 
	if (!empty($calendar_form_input->start_day) ) {
	/* body with form fileds from request 
           - got here if clicked View Calendar, then a day with no entries
           - the day, month, year will be in $calendar_form_input
           - so the form created has that date already selected
          */
	   $body = calendar_event_form('add',"",$calendar_form_input);
	}
	else {
	/* form body with empty fields */
	   $body = calendar_event_form('add',"","");
	}

	}

    /* javascript for date picker */

    $body .= <<< END
<script src="activecalendar/data/functions.js" type="text/javascript" language="javascript"></script>
END;


    /* templates_page_draw uses message in $messages */
    // Output to the screen
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
