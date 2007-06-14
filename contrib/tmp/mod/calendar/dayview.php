<?php

/* dayview.php */
//   IF event_id is set, display that specific event iin calendar_name
//   else display all events for the specified dayID/monthID/yearID in calendar_name

// paramenters:
//   calendar_name
//   dayID
//   monthID
//   yearID
//   event_id
//



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

    // Initialise page body and title
    $body = "";
    $title =  user_info("name",$user_id) . " :: " . __gettext("View Calendar Events");

     templates_page_setup();

    /* get year, month, day - defaults to current day */

    $year = optional_param('yearID',gmdate('Y'),PARAM_INT);
    $month = optional_param('monthID',gmdate('m'),PARAM_INT);
    $day = optional_param('dayID',gmdate('d'),PARAM_INT);

    // get event_id
    $eventid = optional_param('event_id',"",PARAM_INT);
    

    $export = __gettext("Export");
    $edit = __gettext("Edit");
    $delete = __gettext("Delete");
    $returnConfirm = __gettext("Are you sure you want to delete this event?");
    $text_start_date = __gettext("Date:");
    $text_keyword = __gettext("Keywords:");
    $text_location = __gettext ("Location:");
    $text_description = __gettext("Description:");
    $text_start_time = __gettext("Start Time:");
    $text_end_time = __gettext("End Time:");
	


    if (empty($eventid)) {
	/* get all events for specifed day */

	/* min_time is first hour,min,sec of the day */
	/* max_tme is last hour,min,sec of the day */
	/* so, using min_time and max_time in calendar_get_events should only get events for specifed day */

	$min_time = mktime(0, 0, 0, $month, $day, $year);
	$max_time = mktime(24, 59, 59, $month, $day , $year);

	$events = calendar_get_events($min_time, $max_time,'person');
	}
    else {
	/* get one event for specified eventid */
	/* calendar_get_events does not use min_time and max_time when getting a specific event */
	$events = calendar_get_events(0, 0,'event',$eventid);
	}



    // create body with events found
    if (is_array($events) && !empty($events)) {
	foreach($events as $event){
	    // create event_body with this event


	    // get fullname for user of this event
	    $user_info = get_record('users','ident',$event->owner);
        
	    $fullname = htmlspecialchars($user_info->name, ENT_COMPAT, 'utf-8');

	    //set up event post body
	    // getdate (php function) Returns an associative array containing the 
	    // date information of the timestamp
	    //    "mon" 1-12
	    //  "month "  January, etc.
	    //    "year"  4 digit
	    //    "mday" 1-31
	    // "hours"
	    // "minutes"

	    $start_date = getdate($event->date_start);
	    $end_date = getdate($event->date_end);

	    if ($locale = user_flag_get('language',$page_owner))
		setlocale(LC_TIME,"$local.utf-8",$locale);
	    else
		setlocale(LC_TIME,$CFG->defaultlocale);

	    $start_date = strftime("%d %B %Y",$event->date_start);
	    $start_time = strftime("%I:%M %p",$event->date_start);
	    $end_time = strftime("%I:%M %p",$event->date_end);

	
	    // Add date,start time, end time, location, descrption to event body		
	    $event_body = "<b>" . $text_start_date . "</b> " . $start_date ."<br/>";
	    $event_body .= "<b>" . $text_start_time . "</b> " . $start_time . "<br/>";
	    $event_body .= "<b>" . $text_end_time . "</b> " .  $end_time ."<br/>";
	    $event_body .= "<b>" . $text_location . "</b> " . 
		stripslashes($event->location) ."<br/>";
	    $event_body .= "<b>" . $text_description . "</b></br>" . 
		run("weblogs:text:process", stripslashes($event->description));

	
		
	    // get keywords for this event	
	    $keywords = display_output_field(array("","keywords","calendar","calendar",
		$event->ident,$event->owner));

	    if($keywords != ""){
		// if keywords found, add to event body
		$event_body .= '<p class="weblog_keywords">
				<small>' . $text_keyword . ' ' . $keywords . '</small>
				</p>';
		}

	    // add export edit delete links to event body
						
	    $event_body .= <<< END
		<p>
		<small>
[<a href="{$CFG->wwwroot}mod/calendar/export.php?calendar_name=$calendar_name&event_id={$event->ident}" >$export </a>] 
		
END;
	
	    if($event->owner == $_SESSION['userid']){      

		$event_body .= <<< END

[<a href="{$CFG->wwwroot}mod/calendar/edit.php?calendar_name=$calendar_name&event_id={$event->ident}" >$edit </a>] 
[<a href="{$CFG->wwwroot}mod/calendar/delete.php?calendar_name=$calendar_name&event_id={$event->ident}"  onclick="return confirm('$returnConfirm')" >$delete </a>] 
	   
END;


		}
	    $event_body .= ' </small> </p> ';


	    // Add this event to body			
	    $body .= templates_draw( array(
		'context' => 'weblogpost',
		'date' => $date,
		'username' => $user_info->username,
		'usericon' => user_icon_html(user_info_username("ident",$user_info->username)),
		'body' => $event_body,
		'fullname' => $fullname,
		'title' => stripslashes($event->title) . 
		    "<a name='{$event->ident}'></a>",
		'comments' => ""
		));	
									
	    } /* foreach monthly_events */
	} /* if is_array(monthly_events) */
	else {
	    // There are no events - redirect to add event
	    $messages[] = __gettext("There are no events for this day.  Would you like to add one?");
	    $_SESSION["messages"] = $messages;
	    header("Location: " . $CFG->wwwroot .  "mod/calendar/add.php?calendar_name=$calendar_name".
		"&StartDay=$day&StartMonth=$month&StartYear=$year");
		//"&dayID=$day&monthID=$month&yearID=$year");
	    exit;
	    }


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
