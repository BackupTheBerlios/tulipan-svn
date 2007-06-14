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
        $messages[] = __gettext("Cannot find user");
        $_SESSION["messages"] = $messages;
	header("Location: " . $CFG->wwwroot);
        exit;
        }

    // Initialise page body and title
    $body = "";
    $title = user_info("name",$user_id) . " :: "  . __gettext("Event Archive");


    //  function from Elgg core 
    // setup $PAGE menu_top and menu_sub items, also runs calendar_pagesetup
    templates_page_setup();

    // Get calendar events up to today	
    $archives = calendar_get_events(0,time(),"person");
	
    if (sizeof($archives) > 0) {
	/* calender entries found */
	$lastyear = 0;
	$lastmonth = 0;;
	
	foreach($archives as $archive) {
	    $start_date = getdate($archive->date_start);

	    $year = $start_date["year"];  /* 4 digit year */
	    $month_name = $start_date["month"]; /* January, February, etc */
	    $month_number = $start_date["mon"]; /* 1,2,, etc */
	    $monthyear = $month_name.$year;

		

	    /* for each year, add  "Year" header to body */
	    if ($year != $lastyear) {
		if ($lastyear != 0) {
		    $body .= "</ul>";
		    }
		$lastyear = $year;
		$body .= "<h2>$year</h2>";
		$body .= "<ul>";
		}
			

	    /* for each month, add "Month Year" link to list */
	    if ($monthyear != $lastmonthyear) {
			
		$body .= "<li>";
		$body .= "<a href=\"" . $CFG->wwwroot . 
		    "mod/calendar/index.php?calendar_name=".$calendar_name."&yearID=".$year."&monthID=".$month_number."\">";
		$body .= $month_name . " " . $year;
		$body .= "</a>";
		$body .= "</li>";
		$lastmonthyear = $month_name . $year;
		}	
	    } /* foreach $archives */

	/* close list */	
    	$body .= "</ul>";
		
	} /* if sizeof($archives)*/
    else {
	$body .= "<p>There are no calendar events to archive as yet.</p>";
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
