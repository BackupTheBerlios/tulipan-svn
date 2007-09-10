<?php

/* index.php
   display a monthly calendar with events

      person - I am viewing my calendar, or another user's calendar
      community - I am viewing events of all the communites I am in
      friends - I am viewing the events of all my friends

    calendar_name
    caltype: person, community, friends
    yearID
    monthID
*/



    // Load Elgg framework
    @require_once("../../includes.php");

    // Load calendar functions
    @require_once("actions.php");

    // Define context
   define("context","calendar");

   // Load global variables
   global $CFG, $PAGE, $page_owner, $profile_id;

   // CSS for  monthly calendar
   global $metatags;
   $metatags .= file_get_contents($CFG->dirroot . "mod/calendar/css");

    // Get the current user
   $calendar_name = trim(optional_param('calendar_name',''));
   $user_id = user_info_username("ident",$calendar_name);


    //  If no user information, 
    //      redirect user to main ELGG page and exit

    if (empty($calendar_name) || $user_id == false) {
	header("Location: " . $CFG->wwwroot);
        exit;
        }
        

    //   if calendar_type is not set, then person is used
    $calendar_type = trim(optional_param('caltype','person'),PARAM_ALPHA);


    // Set page_owner and profile_id
    $page_owner = $user_id;
    $profile_id = $page_owner;


    // Initialise page body and title
    $body = "";

    $title = user_info("name",$user_id) . " :: " . __gettext("Calendar");

    templates_page_setup();


    // Active Calendar
    require_once("activecalendar/source/activecalendar.php");

    // Active Calendar needs thses as yearID monthID for monthly navigation controls to work
    // get yearID, monthID - defaults to current
    $yearID = optional_param('yearID',gmdate('y'),PARAM_INT);
    $monthID = optional_param('monthID',gmdate('m'),PARAM_INT);
    $dayID = false; //current day

    // min_time is first day of month
    // max_time is last day of month
    $min_time = mktime(0, 0, 0, $monthID, 1, $yearID);
    //get the last day of the month by starting with 0:00 on the first day of the next month, 
    // and then subtract 1 second.
    $max_time = mktime(0, 0, 0, $monthID+1, 1, $yearID) - 1;


    // create calenar of the month
    $cal = new activeCalendar($yearID,$monthID,$dayID);

    include ("config.php");
    $cal->setMonthNames(array($jan,$feb,$mar,$apr,$may,$jun,$jul,$aug,$sep,$oct,$nov,$dec));
    $cal->setDayNames(array($sunday,$monday,$tuesday,$wednesday,$thursday,$friday,$saturday));
    $cal->setFirstWeekDay($firstdayofweek);  # only supports 0 for Sunday or 1 for Monday

    // get events
    if ($calendar_type == "person") {
	$myurl= $CFG->wwwroot . "mod/calendar/index.php?calendar_name=$calendar_name"; 
	$monthly_events = calendar_get_events($min_time, $max_time,'person');
	// make each day a link
	$cal->enableDayLinks($CFG->wwwroot."mod/calendar/dayview.php?calendar_name=".$calendar_name); 
	} 
    else if ($calendar_type == "community") {
	$myurl= $CFG->wwwroot . "mod/calendar/index.php?calendar_name=$calendar_name&caltype=$calendar_type"; 
	$monthly_events = calendar_get_events($min_time, $max_time,'community');
	$title = user_info("name",$user_id) . " :: " . __gettext("My Community Events");
	}
    else if ($calendar_type == "friends") {
	$myurl= $CFG->wwwroot . "mod/calendar/index.php?calendar_name=$calendar_name&caltype=$calendar_type"; 
	$monthly_events = calendar_get_events($min_time, $max_time,'friends');
	$title = user_info("name",$user_id) . " :: " . __gettext("My Friends Events");
	}

    //  enable the month's navigation controls
    $cal->enableMonthNav($myurl); 

    // set each event as a link in the calendar
    if (is_array($monthly_events) && !empty($monthly_events)) {
	foreach($monthly_events as $monthlyevent){


	    // mysqlContent is what is used for the text on the calendar
	    if ($calendar_type == "person")  {
		$mysqlContent =  $monthlyevent->title;
		}
	    if ($calendar_type == "community" || $calendar_type == "friends")  {
		$mysqlContent = user_info('username',$monthlyevent->calendar) . ":". $monthlyevent->title;
		}

	    // link the text to here
	    $mysqlLink = $CFG->wwwroot . user_info('username',$monthlyevent->calendar)."/calendar/".
		$monthlyevent->ident. ".html";

	    // eventCSSclas is the CSS (color coding of text) used for this content.
	    // CSS is in mod/calendar/css file
	    // 
	    $eventCSSclass = "";
	    if ($monthlyevent->access == "PUBLIC") $eventCSSclass = "publicevent";
	    else if ($monthlyevent->access == "user".$_SESSION['userid']) $eventCSSclass = "privateevent";
	    else if ($monthlyevent->access == "LOGGED_IN") $eventCSSclass = "loggedinevent";
	    else $eventCSSclass = "defaultevent";


	    // get month, day, year for this event
	    $start_time = $monthlyevent->date_start;
	    $start_time = getdate($start_time);
	    $mysqlYear = $start_time["year"]; // 4 digit
	    $mysqlMonth = $start_time["mon"]; // 1-12
	    $mysqlDay = $start_time["mday"]; // 1-31

	    // set event content and link
	    $cal->setEventContent($mysqlYear,$mysqlMonth,$mysqlDay,
		$mysqlContent,$mysqlLink, $eventCSSclass); 

	    }
	}

    // create calenndar
    $body =  $cal->showMonth();

    $public_access = __gettext("Public access");
    $private_access = __gettext("Private access");
    $loggedin_access = __gettext("Logged in access");
    // table at end of calendar that displays color coding for public, private and logged in events
    $body .= <<< END
<table width="100%" style="border: 1px solid #000000">
<tr><td>
<table width="30%" style="font-size: 15px">
    <tr>
    <td width="25px">
        <div class="publiceventlegend">
	&nbsp;
        </div>
    </td>
    <td>
	$public_access
    </td>

    </tr>
</table>
<table width="30%" style="font-size: 15px">
    <tr>
    <td width="25px">
        <div class="privateeventlegend">
	&nbsp;
        </div>
    </td>
    <td>
	$private_access
    </td>
    </tr>
</table>
<table width="30%" style="font-size: 15px">
    <tr>
    <td width="25px">
        <div class="loggedineventlegend">
        &nbsp;
        </div>

    </td>
    <td>
	$loggedin_access
    </td>
    </tr>
</table>
</td></tr>
</table>
END;
      
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
