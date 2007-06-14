<?php
global $CFG;

    // Load Elgg framework
    @require_once("../../includes.php");

    //  Load calendar actions
    @require_once("actions.php");

    // 
    $time_zone = strftime("%z") . '00';
    @require_once ("iCalcreator/iCalcreator.class.php");

    // Define context
    define("context","calendar");

    // Load global variables
    global $CFG, $PAGE, $page_owner;

    // Get the name of calendar
    $calendar_name = trim(optional_param('calendar_name',''));
    $user_id = user_info_username("ident",$calendar_name);

    $page_owner = $user_id;


    $event_id = trim(optional_param('event_id',false,PARAM_INT));

    if (empty($event_id) || $event_id == false) {
	$messages[] = __gettext("Must supply event id.");
        $_SESSION["messages"] = $messages;
        header("Location: " . $CFG->wwwroot . $calendar_name . "/calendar");
        exit;
        }

    /* Get information from database for this event */
    $events = calendar_get_events(0,0,"event",$event_id);
    if (empty($events)) {
        $messages[] = __gettext("Event "). $event_id . __gettext(" not found in calendar.");
        $_SESSION["messages"] = $messages;
         header("Location: " . $CFG->wwwroot . $calendar_name . "/calendar");
         exit;
         }
           
    list($key, $event) = each($events);


    if ($event->ident == false || empty($event)) {
	$messages[] = __gettext("Can not find event to export.");
        $_SESSION["messages"] = $messages;
        header("Location: " . $CFG->wwwroot . $calendar_name . "/calendar");
        exit;
        }

	
    $username = user_info("username",$user_id);
	
    $filename = "export/" . str_replace(" ", "_", $username) . "_" .
	str_replace(" ", "_", $event->title) . ".ics";
    $localfilename = $CFG->dataroot.$filename;

	
    $start_date = getdate($event->date_start);
    $end_date = getdate($event->date_end);
    $now = getdate(time());

    $v = new vcalendar();                          // initiate new CALENDAR
    //$v->setLanguage( 'se' );

    $e = new vevent();                             // initiate a new EVENT
    $e->setCategories( 'Calendar Event' );                 // catagorize
    $e->setDtstart($start_date["year"], $start_date["mon"], $start_date["mday"], $start_date["hours"], 
       $start_date["minutes"], $time_zone );    // yyyy mm dd hh mm tz
    $e->setDtend($end_date["year"], $end_date["mon"], $end_date["mday"], $end_date["hours"], 
       $end_date["minutes"], $time_zone );    // yyyy mm dd hh mm tz
    //$e->setDtstart( 2007, 03, 07, 03, 30, 00 );    // yyyy mm dd hh mm tz
    //$e->setDtend( 2007, 03, 07, 03, 30, 00 );    // yyyy mm dd hh mm tz
    $e->setSummary( stripslashes($event->title) );
    $e->setDescription( stripslashes($event->description) ); // describe the event
    $e->setLocation( stripslashes($event->location) );                     // locate the event

    $v->addComponent( $e );                        // add component to calendar

    $content = $v->createCalendar();                   // generate and get output in string

	
    // get handle
    $handle = fopen($localfilename, "w");
	
    // write file
    if(fwrite($handle, $content) === FALSE){
	echo "Cannot write file";
	exit;
	}
	
    fclose($handle);
	
    // read file
    $ics_file = fopen($localfilename, "r");
    $ics_data = fread($ics_file, filesize($localfilename));
	
    // output file
    header("Pragma: public");
    header("Expires: 0");
    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
    header("Content-Length: " . strlen($contents));
    header("Content-type: application/txt");
    header("Content-Disposition: inline; filename=" . $filename);
	
    print $ics_data;

    fclose($ics_file);
    exit;

?>
