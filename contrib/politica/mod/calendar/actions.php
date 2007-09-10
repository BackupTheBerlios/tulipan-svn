<?php


function calendar_event_form($type,$eventid,$calendar_input) {

// create form to add or edit events

/* type is add or edit */
/* eventid is event to edit */
/* calendar_input is values to prefill form with */
/*
        $calendar_input->title 
        $calendar_input->description 
        $calendar_input->keywords 
        $calendar_input->access 
        $calendar_input->location 
        $calendar_input->start_day 
        $calendar_input->start_month 
        $calendar_input->start_year 
        $calendar_input->start_hour 
        $calendar_input->start_minute
        $calendar_input->start_amorpm 
        $calendar_input->end_hour
        $calendar_input->end_minute 
        $calendar_input->end_amorpm
*/
/* returns $body */

    global $CFG;

    global $page_owner;


    // Display Form

    $sectionTitleAdd = __gettext("Add A Calendar Event");
    $sectionTitleEdit = __gettext("Edit A Calendar Event");
    $eventTitle = __gettext("Event Title:");
    $DateTitle = __gettext("Date");
    $TimeTitle = __gettext("Time");
    $eventLocationTitle = __gettext("Event Location:");
    $eventDescriptionTitle = __gettext("Event Description:");
    $KeywordsTitle = __gettext("Keywords (Separated by commas):"); 
    $keywordDescTitle = __gettext("Keywords commonly referred to as 'Tags' are words that represent the calendar post you have just made. This will make it easier for others to search and find your posting."); 
    $accessRes = __gettext("Access restrictions:"); 
    $postButton = __gettext("Save Event"); 
	
    $date = getdate(time());
	
    $calendar_name = user_info("username",$page_owner);

    if ($type == "edit") {
	$formaction = $CFG->wwwroot . "mod/calendar/edit.php?calendar_name=$calendar_name";
	$sectionTitle = $sectionTitleEdit;
	$hiddenaction = "calendar:event:edit";
	}
    else {
	$formaction = $CFG->wwwroot . "mod/calendar/add.php?calendar_name=$calendar_name";
	$sectionTitle = $sectionTitleAdd;
	$hiddenaction = "calendar:event:add";
	}

    // form must have name calform for Active Calendar date picker to work	
    $body = <<< END

<form method="post" name="calform" 
   action="$formaction" method="post"  
    onsubmit="return submitForm();">
	<h2>$sectionTitle</h2>
END;


    $value = $calendar_input ?  $calendar_input->title : "" ;
    $body .= templates_draw( array(
                 'context' => 'databoxvertical',
                 'name' => $eventTitle,
		'contents' => "<input type=\"text\" name=\"calendarEventTitle\" value=\"$value\" size=\"20\" maxlength=\"20\" />"
               ));

    /*  date, using activecalendar date picker */
    require_once("activecalendar/source/activecalendar.php");

    include("config.php");
    $cal=new activeCalendar();

    $cal->setMonthNames(array($jan,$feb,$mar,$apr,$may,$jun,$jul,$aug,$sep,$oct,$nov,$dec));
    $cal->setDayNames(array($sunday,$monday,$tuesday,$wednesday,$thursday,$friday,$saturday));
    $cal->setFirstWeekDay($firstdayofweek);  # only supports 0 for Sunday or 1 for Monday

    /* Must use Select  names -
    /* StartDay StartMonth StartYear 
    /*  for Active Calendar  date picker to work
    */


    $DateContents = "<select name=\"StartDay\">";
    $DateContents .=  calendar_makeSelectDays($calendar_input ? $calendar_input->start_day : $cal->actday); 
    $DateContents .= "</select>";
    $DateContents .= "<select name=\"StartMonth\">";
    $DateContents .= calendar_makeSelectMonths($cal, $calendar_input ? $calendar_input->start_month :$cal->actmonth ); 
    $DateContents .= "</select>";
    $DateContents .= "<select name=\"StartYear\">";
    $DateContents .= calendar_makeSelectYears($calendar_input ? $calendar_input->start_year : $cal->actyear,2000,2016); 
    $DateContents .= "</select>";
    $DateCSS = $CFG->wwwroot . "mod/calendar/activecalendar/data/css/default.css&calmode=start";

    $date_picker_title = __gettext("Calendar Start Date");
    $date_picker_alt = __gettext("date picker");
    $DateContents .= <<< END

<a href="javascript:showcalendar('activecalendar/data/js.php?css=$DateCSS',220,225)" title="$date_picker_title"><img src="activecalendar/data/img/calendar.gif" border="0" alt="$date_picker_alt" /></a>

END;

    /* calendarStartHour Minute and AMorPM are not part of Acive Calendar */
    $time_start_text = __gettext("Start");

    $TimeContents = "$time_start_text <select name=\"calendarStartHour\">";
    $TimeContents .= calendar_makeSelectHours($calendar_input ? $calendar_input->start_hour : 0); 
    $TimeContents .= "</select>";
    $TimeContents .= "<select name=\"calendarStartMinute\">";
    $TimeContents .= calendar_makeSelectMinutes($calendar_input ? $calendar_input->start_minute : 0); 
    $TimeContents .= "</select>";
    $TimeContents .= "<select name=\"calendarStartAMorPM\">";
    $TimeContents .= calendar_makeSelectAMorPM($calendar_input ? $calendar_input->start_amorpm : "am"); 
    $TimeContents .= "</select>";

    $time_end_text = __gettext("End");
    $TimeContents .= "$time_end_text <select name=\"calendarEndHour\">";
    $TimeContents .= calendar_makeSelectHours($calendar_input ? $calendar_input->end_hour : 0); 
    $TimeContents .= "</select>";
    $TimeContents .= "<select name=\"calendarEndMinute\">";
    $TimeContents .= calendar_makeSelectMinutes($calendar_input ? $calendar_input->end_minute : 0); 
    $TimeContents .= "</select>";
    $TimeContents .= "<select name=\"calendarEndAMorPM\">";
    $TimeContents .= calendar_makeSelectAMorPM($calendar_input ? $calendar_input->end_amorpm : "am");
    $TimeContents .= "</select>";

 

    $body .= templates_draw( array(
                'context' => 'databoxvertical',
                'name' => $DateTitle,
                'contents' => $DateContents 
                ));
	
    $body .= templates_draw( array(
                'context' => 'databoxvertical',
                'name' => $TimeTitle,
                'contents' => $TimeContents 
                ));
	
    $body .= templates_draw( array(
                'context' => 'databoxvertical',
                'name' => $eventLocationTitle,
                'contents' => display_input_field(
		    array("calendarEventLocation", 
		    $calendar_input ? $calendar_input->location : "", "text"))
                ));
	
    $body .= templates_draw( array(
               'context' => 'databoxvertical',
               'name' => $eventDescriptionTitle,
               'contents' => display_input_field(
		    array("calendarEventDescription",
		    $calendar_input ? $calendar_input->description : "",
		    "mediumtext"))
               ));
	
    $body .= templates_draw( array(
              'context' => 'databoxvertical',
              'name' => $KeywordsTitle . "<br />" . $keywordDescTitle,
              'contents' =>  display_input_field(
		    array("calendarEventKeywords",
              $calendar_input ? $calendar_input->keywords : "","mediumtext"))
              ));
	
    $body .= templates_draw( array(
              'context' => 'databoxvertical',
              'name' => $accessRes,
              'contents' => run("display:access_level_select",
		array("calendarEventAccess",
              $calendar_input ? $calendar_input->access : ""))
              ));


    $body .= <<< END
	<p>
	<input type="hidden" name="action" value="{$hiddenaction}" />
	<input type="hidden" name="event_id" value="{$eventid}" />
	<input type="submit" value="$postButton" />
	</p>

</form>
END;


    return $body;
} // function calendar_event_form


	
function calendar_get_events($min_time, $max_time,$caltype,$field4 = 0) {

// Get event information from SQL database
// person: get events between min_time and max_time for $page_owner
// community: get events between min_time and max_time for communites that $page_owner belongs to
//  friends: get eventes betweeb min_time and max_time for friends of $papge_owner
// rss: get public events for page_owner (limit is field4)
// event: get one oevent in page_owner's calendar (event_id is field4)

/*

  min_time =  unix timestamp 
  max_time = unix timestamp
  caltyppe =  person, community, friends, rss or  event
  field4 - for rss:limit rss feed to this number of events
           for event:  event_id of the event
*/

/* return $events */

    global $CFG;
    global $page_owner;

    $limit = "";

    // Get access list for this user
    $where = run("users:access_level_sql_where",$_SESSION['userid']);

    // get events between mintime and maxtime
    $where3 = "date_start >= ". $min_time ." ".  "AND date_end <= ". $max_time ." ";

    if($caltype == "event") {
    /* only getting one event */
	$where2 = "ident = $field4 and calendar = $page_owner";
	$whereclause = " WHERE ($where) and ($where2) "; 
	}


    if ($caltype == "person") {
	// limit to events posted to a certain calendar
	// and limit to events between the specified times
	$where2 = "calendar = $page_owner";
	$whereclause = " WHERE ($where) and ($where2) and ($where3)"; 
	}

    if ($caltype == "community") {
	// limit to events posted in communmites that user belongs to
	// and limit to events between the specified times

	// find communites that this user belongs to

        if ($result = get_records_sql('SELECT DISTINCT u.ident,u.username,u.name FROM '.$CFG->prefix.
            'friends f JOIN '.$CFG->prefix.
            'users u ON u.ident = f.friend WHERE f.owner = ? AND u.user_type = ? ',
                                      array($page_owner,'community'))
	    ){ 

	    // limit to events posted to a community  calendars

	    //  example:  calendar IN (1,2,3) 
	    $first = true;
	    $where2 = "calendar IN (";
		foreach($result as $r){
		if ($first == false) { $where2 .=  ",";}
		$where2 .= $r->ident;
		$first = false;
		}
	    $where2 .= ")";

	    $whereclause = " WHERE ($where) and ($where2)  and ($where3)"; 
	    }
	else {
	    /* no communities */
	    return false;
	    }

	}

    if ($caltype == "friends") {
	// limit to events in the calenders of friends
	// and limit to events during specifed times

	// find friends
        if ($result = get_records_sql('SELECT DISTINCT u.ident,u.username,u.name FROM '.$CFG->prefix.
            'friends f JOIN '.$CFG->prefix.
            'users u ON u.ident = f.friend WHERE f.owner = ? AND u.user_type = ? ',
                                      array($page_owner,'person'))
	    ) { 

	    //  example:  calendar IN (1,2,3) 
	    $first = true;
	    $where2 = "calendar IN (";
	    foreach($result as $r){
		if ($first == false) { $where2 .=  ",";}
		$where2 .= $r->ident;
		$first = false;
		}
	    $where2 .= ")";
	    $whereclause = " WHERE ($where) and ($where2)  and ($where3)"; 
	    }
	else {
	    // no friends
	    return false;
	    }

	}

    if ($caltype == "rss" ) {
	// limit to PUBLIC events
	// and limit to events during specified times
	// and limit number of events to $field4

	$where2 = "calendar = $page_owner AND access = 'PUBLIC'";
	$limit = "LIMIT $field4";
	$whereclause = " WHERE ($where) and ($where2)  and ($where3) "; 

	}


    $sql = 
      "SELECT ident, owner, calendar, title, description, access, location, date_start, date_end FROM ".
                $CFG->prefix."calendar_events " .
		$whereclause .
                " ORDER BY date_start $limit";

    if ($events = get_records_sql($sql)){
	// Return them
	return $events;
	}
    else {
	return false;
	}
	

}


function calendar_event_create($calendar_input,$action,$event_id = 0) {

// Add or Edit a calendar event to SQL 

// calendar_input array containing form data
// action should be either edit or add
// event_id is ident value for event to edit (not used in add)

// return  false if error and error message is set in global $messages
// return true of no erorr and action = edit
// return insert_id if not error acnd action = add

    global $CFG, $messages;

    $flag = 0 ;

    if(empty($action) || ($action != "edit" && $action != "add")){
	$messages[] = __gettext("Invalid action, must be edit or add.");
	$flag = 1;
	}

    if(!$calendar_input->title){
	$messages[] = __gettext("Please enter a title for your event.");
	$flag = 1;
	}

    /* check start for valid date  (for example Feb 31 is not valid)*/				
    if (checkdate ( $calendar_input->start_month ,
	$calendar_input->start_day,$calendar_input->start_year ) === 
	false) {
	    // bad date
	    $messages[] = __gettext("Please enter a Date that is valid");
	    $flag = 1;
	}


    /* check if start time is before end time */

    if ($calendar_input->start_amorpm == "pm" ) 
	$start_hour = $calendar_input->start_hour + 12;
    else 
	$start_hour = $calendar_input->start_hour;

    if ($calendar_input->end_amorpm == "pm" ) 
	$end_hour = $calendar_input->end_hour + 12;
    else 
	$end_hour = $calendar_input->end_hour;

    /* start_month start_day start_year is used to make noth startmktime and endmktime
	as events can only happen on one specific day.
    */
    $startmktime = mktime($start_hour, $calendar_input->start_minute, 0, 
	$calendar_input->start_month, $calendar_input->start_day,
	$calendar_input->start_year ) ; 

    $endmktime = mktime($end_hour, $calendar_input->end_minute, 0, 
	$calendar_input->start_month, $calendar_input->start_day, $calendar_input->start_year ) ; 


    if ($startmktime > $endmktime ) {
    	$messages[] = __gettext("Please make sure your event start time occurs before the event end time");
	$flag = 1;
	}

    if ($flag == 1) return false;

    /* everything checks out OK - add/edit event information to SQL dataabse */
    $eventpost = new StdClass;
    $eventpost->title = $calendar_input->title ;
    $eventpost->description = $calendar_input->description ;
    $eventpost->access = $calendar_input->access; 
    $eventpost->location = $calendar_input->location ;
    $eventpost->date_start = $startmktime;
    $eventpost->date_end =	$endmktime;

    if ($action == "add") {
	// actiom is add, insert new record
	$eventpost->owner = $calendar_input->owner ;
	$eventpost->calendar = $calendar_input->calendar ;
	$insert_id = insert_record("calendar_events",$eventpost);
	}
    else {
	// action not add (is edit), update existing record
	$eventpost->ident = $event_id;
	if (update_record("calendar_events",$eventpost)) $insert_id = $eventpost->ident;
	else $insert_id == false;
	}

    if (empty($insert_id) || $insert_id == false) {
	// SQL error
    	$messages[] = __gettext("MySQL Error, failed to insert or update event.");
	return false;
	}

    if ($action == "edit") {
	/* delete old tags before saving new ones is action is edit */
        delete_records("tags","ref",$event_id,"tagtype","calendar");
	}

    //save tags if isset
    if(isset($calendar_input->keywords) ){
	insert_tags_from_string($calendar_input->keywords,"calendar",$insert_id,$calendar_input->access,
	    $_SESSION['userid']);
	} 

    // if action add return the insert_id, else return true
			
    if ($action == "add") return $insert_id;	
    else	return true;

    }  /* function calendar_event_create */
	

/* Active Calendar Functions */	
function calendar_makeSelectDays($selectedDay){
$out="";
for ($x=1;$x<=31;$x++){
if ($x==$selectedDay) $out.="<option value=".$x." selected=\"selected\">".$x."</option>\n";
else $out.="<option value=".$x.">".$x."</option>\n";
}
return $out;
}

function calendar_makeSelectMonths($cal,$selectedMonth){
$out="";
for ($x=1;$x<=12;$x++){
if ($x==$selectedMonth) $out .= "<option value=".$x." selected=\"selected\">".$cal->getMonthName($x)."</option>\n";
else $out .=  "<option value=".$x.">".$cal->getMonthName($x)."</option>\n";
}
return $out;
}

function calendar_makeSelectYears($selectedYear,$startYear,$endYear){
$out="";
for ($x=$startYear;$x<=$endYear;$x++){
if ($x==$selectedYear) $out .=  "<option value=".$x." selected=\"selected\">".$x."</option>\n";
else $out .= "<option value=".$x.">".$x."</option>\n";
}
return $out;
}

function calendar_makeSelectHours($selectedHour) {
$out = "";
for ($x=0;$x<=12;$x++){
if ($x==$selectedHour) $out .=  "<option value=".$x." selected=\"selected\">".$x."</option>\n";
  else $out .= "<option value=\"$x\">$x</option>\n";
  }
return $out;
}

function calendar_makeSelectMinutes($selectedMinute) {
$out = "";
for ($x=0;$x<=60;$x++){
if ($x==$selectedMinute) $out .=  "<option value=".$x." selected=\"selected\">".$x."</option>\n";
else  $out .= "<option value=\"$x\">$x</option>\n";
  }
return $out;
}

function calendar_makeSelectAMorPM($selectedAMorPM) {
$out = "";
if ($selectedAMorPM == "am") {
 $out .= "<option value=\"am\" selected=\"selected\" >am</option>\n";
  $out .= "<option value=\"pm\">pm</option>\n";
    }
else {
 $out .= "<option value=\"am\">am</option>\n";
  $out .= "<option value=\"pm\" selected=\"selected\" >pm</option>\n";
}
return $out;
}


?>
