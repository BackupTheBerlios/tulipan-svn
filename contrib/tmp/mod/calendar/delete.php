<?php

    // Load Elgg framework
    @require_once("../../includes.php");

    //  Load calendar actions
    @require_once("actions.php");

    // Define context
    define("context","calendar");

    // Load global variables
    global $CFG, $PAGE, $page_owner;

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

    $event_id = trim(optional_param('event_id',false,PARAM_INT));

    // We need to be logged on for this!
    if (!isloggedin()) {
	$messages[] = __gettext("You must be logged in delete this event.");
        $_SESSION["messages"] = $messages;
        header("Location: " . $CFG->wwwroot . $calendar_name . "/calendar");
        exit;
        }

    // Must have event_id
    if (empty($event_id) || $event_id == false) {
	$messages[] = __gettext("You must supply the event id.");
        $_SESSION["messages"] = $messages;
        header("Location: " . $CFG->wwwroot . $calendar_name . "/calendar");
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



    // Are we eligible to delete this?
    if (!run("permissions:check",array("weblog:edit",$event->owner))) {
        $messages[] = __gettext("You do not have permissions to delete this event.");
        $_SESSION["messages"] = $messages;
	header("Location: " . $CFG->wwwroot . $calendar_name . "/calendar");
        exit;
        }

	
    /* delete this event */
    $rc = delete_records("calendar_events","ident",$event_id);


    /* delete keywords for this event */
    $rc = delete_records("tags","ref",$event_id,"tagtype","calendar");

    /* redirect back to day view */
    $start_date = getdate($event->date_start);

    $year = $start_date["year"];
    $month = $start_date["mon"];
    $day = $start_date["mday"];

    $messages[] = __gettext("Calendar event has been deleted.");
    $_SESSION["messages"] = $messages;
    header("Location: " . $CFG->wwwroot . 
                "mod/calendar/dayview.php?calendar_name=$calendar_name&yearID=" . $year .
                "&monthID=" . $month .  "&dayID=" . $day );

?>
