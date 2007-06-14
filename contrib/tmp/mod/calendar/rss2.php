<?php
global $CFG;
global $page_owner;

    // Load Elgg framework
        @require_once("../../includes.php");

    //  Load calendar actions
        @require_once("actions.php");

    // Define context
        define("context","calendar");

    // Load global variables
        global $CFG, $PAGE, $page_owner;

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


if (isset($page_owner)) {
    
    if ($page_owner != -1) {
        $username = user_info('username', $page_owner);
    } else {
        $username = "news";
    }

    if ($username) {
            
            $output = "";
            if ($page_owner != -1 && $info = get_record('users','ident',$page_owner)) {
                    $mainurl = $CFG->wwwroot . $info->username . "/calendar/";
                    $rssurl = $mainurl . "rss" ;
                    $xslurl = $mainurl . "rss/rssstyles.xsl";
                }
                
              $name = (stripslashes($info->name));
               $rssdescription = sprintf(__gettext("The calendar for %s, hosted on %s."),$name,$CFG->sitename);
	    $rsscalendar = __gettext("Calendar");

                    /* <?xml-stylesheet type="text/xsl" href="{$CFG->wwwroot}_rss/styles.xsl?url=$mainurl&rssurl=$rssurl"?> */
                    /* <?xml-stylesheet type="text/xsl" href="{$rssurl}/rssstyles.xsl"?> */


                if (!empty($xslurl)) {
                    $output .= "<?xml-stylesheet type=\"text/xsl\" href=\"{$xslurl}\"?>\n\n";
                }
                $output .= <<< END
<rss version='2.0'   xmlns:dc='http://purl.org/dc/elements/1.1/'>        
    <channel xml:base='$mainurl'>
	<ttl>1</ttl>
        <title><![CDATA[$name : $rsscalendar]]></title>
        <description><![CDATA[$rssdescription]]></description>
        <link>$mainurl</link>
END;

    $twoweeksinseconds = 2 * 7 * 24 * 60 * 60;
    $today = time();
    $mintime = $today - $twoweeksinseconds;
    $maxtime = $today + $twoweeksinseconds;

                $events =  calendar_get_events($mintime,$maxtime,'rss',20);

///
            if (is_array($events) && sizeof($events) > 0) {
                foreach($events as $event) {
                    $title = (stripslashes($event->title));

//   mod/calendar/dayview.php?calendar_name= month day year

$month = gmdate('m',$event->date_start);
$day = gmdate('d',$event->date_start);
$year = gmdate('Y',$event->date_start);
$calendar_name = user_info("username",$event->calendar);

$link = url . "mod/calendar/dayview.php?calendar_name=".$calendar_name."&amp;month=".$month."&amp;day=".$day."&amp;year=".$year;
                  //  $link = url .user_info("username", $event->calendar). "/calendar/" . $event->ident . ".html";
                    //$body = (run("weblogs:text:process",stripslashes($entry->body)));

/* body needs to be made:  Start time, End Time, etc */

                    $description = (stripslashes($event->description));
                    //$start_date = gmdate("D, d M Y H:i:s T", $event->date_start);
                    //$end_date = gmdate("D, d M Y H:i:s T", $event->date_end);
                    $eventdate = gmdate("D, d M Y", $event->date_start);
                    $start_time = gmdate("H:i:s T", $event->date_start); 
                    $end_time = gmdate("H:i:s T", $event->date_end); 
		    $location = $event->location;
                    $keywordtags = "";
                    if ($keywords = get_records_select('tags','tagtype = ? AND ref = ?',array('calendar',$event->ident))) {
                        foreach($keywords as $keyword) {
                            //$keywordtags .= "\n\t\t<dc:subject><![CDATA[" . (stripslashes($keyword->tag)) . "]]></dc:subject>";
                            $keywordtags .= "\t".(stripslashes($keyword->tag));
                        }
                    }

/* guid - different, unique, and unchanging URL for each item */
$guidlink = $CFG->wwwroot. user_info("username",$event->calendar) . "/calendar/" . $event->ident . ".html";
$date_text = __gettext("Date:");
$start_time_text = __gettext("Start Time:");
$end_time_text = __gettext("End Time:");
$location_text = __gettext("Location:");
$description_text = __gettext("Description:");
$keywords_text = __gettext("Keywords:");

$body = <<< END
<table>
<tr><td><b>$date_text</b></td><td> $eventdate </td></tr>
<tr><td><b>$start_time_text</b></td><td> $start_time </td></tr>
<tr><td><b>$end_time_text</b></td><td> $end_time </td></tr>
<tr><td><b>$location_text</b></td><td> $location </td></tr>
<tr><td><b>$description_text</b></td><td> $description </td></tr>
<tr><td><b>$keywords_text</b></td><td> $keywordtags </td></tr>
</table>
END;

                    $output .= <<< END

        <item>
                        <title><![CDATA[$title]]></title>
                        <link>$link</link>
                        <description><![CDATA[$body]]></description>
			<guid>$guidlink</guid>
        </item>

END;
                }
            } else {
                //$output .= "no items";
            }

///
                
                $output .= <<< END

    </channel>
</rss>
END;
            } /* if $username */
            
            if ($output) {
/*
                header("Pragma: public");
                header("Cache-Control: public"); 
                header('Expires: ' . gmdate("D, d M Y H:i:s", (time()+3600)) . " GMT");
*/

   // Last-Modified should be set ?
//The Last-Modified header value returned in an HTTP response is passed as the  If-Modified-Since HTTP header in future HTTP requests.

// http://fishbowl.pastiche.org/2002/10/21/http_conditional_get_for_rss_hackers
//  http://www.kbcafe.com/rss/rssfeedstate.html

          
// The cient saves the Etag and next time he requests the same URL, he includes the Etag as the  If-None-Match header

		$if_none_match = (isset($_SERVER['HTTP_IF_NONE_MATCH'])) ? preg_replace('/[^0-9a-f]/', '', 
		    $_SERVER['HTTP_IF_NONE_MATCH']) : false;
                

                $etag = md5($output);
                header('ETag: "' . $etag . '"');
                

// If feed not modified since last time you checked, return 304 Not Modified

                if ($if_none_match && $if_none_match == $etag) {
                    header("{$_SERVER['SERVER_PROTOCOL']} 304 Not Modified");
                    exit;
                }
               

// If feed was modified, return new feed
                header("Content-Length: " . strlen($output));
                
                header("Content-type: text/xml; charset=utf-8");
                echo $output;
            }  /* if $output */
    } /* if */
