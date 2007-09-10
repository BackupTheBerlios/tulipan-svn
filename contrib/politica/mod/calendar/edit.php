<?php
/* edit.php */

//
//   if action="calendar:event:edit" then use form input to update SQL record for event_id
//   else display update form
//

// parameters:
// calendar_name 
// action - if calendar:event:edit update date in SQL, else display form
// event_id 

// paramenters from forn input:
//        calendarEventTitle
//        calendarEventDescription
//        calendarEventKeywords
//        calendarEventAccess
//        calendarEventLocation
//        StartDay
//        StartMonth
//        StartYear
//        calendarStartHour
//        calendarStartMinute
//        calendarStartAMorPM
//        calendarEndHour
//        calendarEndMinute
//        calendarEndAMorPM

    // Load Elgg framework
    @require_once("../../includes.php");

    // Load global variables
    global $CFG, $PAGE, $page_owner, $messages;

    //  Load calendar actions
    @require_once("actions.php");

    // Define context
    define("context","calendar");

    // Who's calendar 
    $calendar_name = trim(optional_param('calendar_name',''));
    $user_id = user_info_username("ident",$calendar_name);

    $page_owner = $user_id;

    //  If no user information, 
    //      redirect user to main ELGG page and exit

    if (empty($calendar_name) || $user_id == false) {
        header("Location: " . $CFG->wwwroot);
	exit;
	}


    // We need to be logged on for this!
    if (!isloggedin()) {
	$messages[] = __gettext("You must be logged in to edit an event.");
	$_SESSION["messages"] = $messages;
	header("Location: " . $CFG->wwwroot . $calendar_name .  "/calendar");
	exit;
	}

    // Get action and event_id
    $action  = optional_param('action');
    $event_id = trim(optional_param('event_id',false,PARAM_INT));

    //   If event not supplied, print error and redurect to main calendar page
    if (empty($event_id) || $event_id == false) {
	$messages[] = __gettext("You must spply the event id.");
	$_SESSION["messages"] = $messages;
	header("Location: " . $CFG->wwwroot . $calendar_name .  "/calendar");
	exit;
	}

    // Is event in calendar?
    $events = calendar_get_events(0,0,"event",$event_id);
    if (empty($events)) {
	$messages[] = __gettext("Event $event_id not found in calendar.");
        $_SESSION["messages"] = $messages;
         header("Location: " . $CFG->wwwroot . $calendar_name . "/calendar");
         exit;
         }
           
    list($key, $event) = each($events);


    // Are we eligible to edit this?
    if (!run("permissions:check",array("weblog:edit",$event->owner))) {
	$messages[] = __gettext("You do not have permissions to edit this event.");
	$_SESSION["messages"] = $messages;
        header("Location: " . $CFG->wwwroot . $calendar_name . "/calendar");
	exit;
	}

    // form input
    $calendar_form_input->title = trim(optional_param('calendarEventTitle'),"");
    $calendar_form_input->description = trim(optional_param('calendarEventDescription'),"");
    $calendar_form_input->keywords = trim(optional_param('calendarEventKeywords'),"");
    $calendar_form_input->access = trim(optional_param('calendarEventAccess'),"");
    $calendar_form_input->location = trim(optional_param('calendarEventLocation'),"");
    $calendar_form_input->start_day = trim(optional_param('StartDay'),"");
    $calendar_form_input->start_month = trim(optional_param('StartMonth'),"");
    $calendar_form_input->start_year = trim(optional_param('StartYear'),"");
    $calendar_form_input->start_hour = trim(optional_param('calendarStartHour'),"");
    $calendar_form_input->start_minute = trim(optional_param('calendarStartMinute'),"");
    $calendar_form_input->start_amorpm = trim(optional_param('calendarStartAMorPM'),"");
    $calendar_form_input->end_hour = trim(optional_param('calendarEndHour'),"");
    $calendar_form_input->end_minute = trim(optional_param('calendarEndMinute'),"");
    $calendar_form_input->end_amorpm = trim(optional_param('calendarEndAMorPM'),"");



    // Initialise page body and title
    $body = "";
    $title =  user_info("name",$user_id) . " :: "  . __gettext("Edit calendar event");

    // setup $PAGE menu_top and menu_sub items, also runs calendar_pagesetup
    templates_page_setup();



    // if action="calenar:event:edit" then try to update the event data in SQL
    if ( !empty($action)  && $action == "calendar:event:edit" ) {

	if (calendar_event_create($calendar_form_input,"edit",$event_id)) {
	    /* sucessful */
	    $messages[] = __gettext("Event has been sucessfully edited.");
	    $_SESSION["messages"] = $messages;
	    header("Location: " .  $CFG->wwwroot . $calendar_name. 
               "/calendar/". $event_id.  ".html");
	    exit;
	    }

	else {
	    /* unsuccessful -  the message is set in $messages by calendar_event_create*/
	    /* body is form with fields prefilled with previous form input */
	    $body = calendar_event_form("edit",$event_id,$calendar_form_input);
	    }
	} 

    else {

	/* body is form with fields prefilled with information from SQL */

	$calendar_sql_input->title =  $event->title;
	$sdate = getdate($event->date_start);
	$calendar_sql_input->start_day  = $sdate["mday"];
	$calendar_sql_input->start_month  =  $sdate["mon"];
	$calendar_sql_input->start_year  =  $sdate["year"];
	if ($sdate["hours"] > 12) {
	    $calendar_sql_input->start_hour  = $sdate["hours"]-12;  /*0-23 */
	    $calendar_sql_input->start_amorpm = "pm"; 
	    }
    	else {
	    $calendar_sql_input->start_hour  = $sdate["hours"];  /*0-23 */
	    $calendar_sql_input->start_amorpm = "am"; 

	    }
    	$calendar_sql_input->start_minute = $sdate["minutes"]; 
	$edate = getdate($event->date_end);
	if ($edate["hours"] > 12) {
	    $calendar_sql_input->end_hour  = $edate["hours"] -12 ;
	    $calendar_sql_input->end_amorpm = "pm"; 
	    }
	else {
	    $calendar_sql_input->end_hour  = $edate["hours"] ;
	    $calendar_sql_input->end_amorpm = "am";
	    }
	$calendar_sql_input->end_minute  = $edate["minutes"]; 
	$calendar_sql_input->location = $event->location;
	$calendar_sql_input->description = $event->description;
    
	/* get keywords from tags */


	// Everything this user can access
	$where = run("users:access_level_sql_where",$_SESSION['userid']);
	// limit to tags for this event
	$where2 = "tagtype = \"calendar\" AND ref = $event->ident";
	if ($tags  = get_records_select('tags',"($where) AND tagtype = \"calendar\" AND ref = ".
	    $event->ident,null,'tag ASC')
	    ){
	    $keywords = "";
	    $first = true;
	    foreach($tags as $key => $tag) {
		if (empty($first)) {
		    $keywords .= ", ";
		    }
		$keywords .= stripslashes($tag->tag);
		$first = false;
		}

	    $calendar_sql_input->keywords = $keywords; 
	    }
	else {
	    $calendar_sql_input->keywords = ""; 
	    }

	$calendar_sql_input->access = $event->access;


	$body = calendar_event_form("edit",$event_id,$calendar_sql_input);



	} /* else */


/* Display Form */

    /* javascript for date picker */
    $body .= <<< END
<script src="activecalendar/data/functions.js" type="text/javascript" language="javascript"></script>
END;

    // $messages global variable is set by calendar_event_create and used in tempates_page_draw 

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
