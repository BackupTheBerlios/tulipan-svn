<?php
/*
 * This script initialize the enviroment for show the poll list
 * @author Johan Eduardo Quijano Garcia <gerencia@treszero.com>
 * @copyright Corporación Somos Más - 2007
 */


function polls_pagesetup() {
  // register links --
    global $metatags,$function,$USER;
    global $profile_id;
    global $PAGE;
    global $CFG;
    global $page_owner;

  $pgowner= $profile_id;

  require_once $CFG->dirroot . "mod/polls/default_template.php";

  if (isloggedin() && user_info("user_type", $_SESSION['userid']) != "external") {
    // Add the JavaScript Polls functions
    $url= substr($CFG->wwwroot, 0, -1);
    $metatags .= "<script language=\"javascript\" type=\"text/javascript\" src=\"$url/mod/polls/js/polls.js\"></script>";
    $metatags .= "<link rel=\"stylesheet\" href=\"" . $CFG->wwwroot . "/mod/polls/css/css.css\" type=\"text/css\" media=\"screen\" />";
 

    //Show the poll in the top menu
    if (defined("context") && context == "polls" && $pgowner == $_SESSION['userid']) {
      $PAGE->menu[]= array (
        'name' => 'polls',
        'html' => '<li><a href="' . $CFG->wwwroot . $_SESSION['username'] . '/polls/" class="selected">' .
                  __gettext("Polls") .'</a></li>');
    } else {
      $PAGE->menu[]= array (
        'name' => 'polls',
        'html' => '<li><a href="' . $CFG->wwwroot . $_SESSION['username'] . '/polls/">' . __gettext("Polls") .
                   '</a></li>');
    }

    if (profile_permissions_check("profile") && defined("context") && context == "polls") {

      if (user_type($pgowner) == "person") {
        $PAGE->menu_sub[]= array (
          'name' => 'polls:view',
          'html' => '<a href="' . $CFG->wwwroot . $_SESSION['username'] . '/polls/">' . __gettext("View Polls") . '</a>');

        $PAGE->menu_sub[]= array (
          'name' => 'polls:create',
          'html' => '<a href="' . $CFG->wwwroot . $_SESSION['username'] . '/polls/create">' . __gettext("Create Poll") . '</a>');

        $PAGE->menu_sub[]= array (
          'name' => 'polls:history',
          'html' => '<a href="' . $CFG->wwwroot . $_SESSION['username'] . '/polls/history">' . __gettext("History") . '</a>');

      }
    }
  }

}
function polls_init() {

global $CFG, $function, $db, $METATABLES;
// Functions to perform initializacion

//Database Polls
if (!get_config('polls')) {
		if (file_exists(dirname(__FILE__) . "/" . $CFG->dbtype . ".sql")) {
			modify_database(dirname(__FILE__) . "/" . $CFG->dbtype . ".sql");
		} else {
			error("Error: Your database ($CFG->dbtype) is not yet fully supported by the Elgg polls plug-in.  See the mod/polls directory.");
		}
    set_config('polls',time());
	}

  //Keyword
  $CFG->templates->variables_substitute['active_poll'][] = (string) 'last_active_poll';


  //Paths
  $function['polls:init'][] = $CFG->dirroot . "mod/polls/lib/polls_init.php";

  // Create polls
  $function['polls:new'][] = $CFG->dirroot . "mod/polls/lib/polls_new.php";
/*
  // View a message
  */
  $function['polls:view'][] = $CFG->dirroot . "mod/polls/lib/polls_view.php";
  $function['polls:poll:view'][] = $CFG->dirroot . "mod/polls/lib/polls_poll_view.php";
  $function['polls:detailedview'][] = $CFG->dirroot . "mod/polls/lib/polls_poll_detailedview.php";
  $function['polls:pollforvotation'][] = $CFG->dirroot . "mod/polls/lib/poll_for_votation.php";


  // Sidebar display function
  $function['display:sidebar'][] = $CFG->dirroot . "mod/polls/lib/current_polls_info.php";
  
  // JpGraph
  // http://www.aditus.nu/jpgraph/index.php
  //$function['polls:jpgraph'][] = $CFG->dirroot . "mod/polls/jpgraph/src/elgg_polls/bartutex1.php";
  $function['polls:jpgraph'][] = $CFG->dirroot . "mod/polls/jpgraph/src/elgg_polls/gantt.php";

}

function last_active_poll($vars) {

global $profile_id;

   $msg_offset = optional_param('msg_offset', 0, PARAM_INT);
   $limit = 1;
   $none = __gettext("Don't have active polls");
   $automatically = __gettext("This poll ends: Automatically");
   $redirect = url . "mod/polls/polls_actions.php?action=votation&user=$profile_id";

   $last_active_poll = get_records_select('polls', "owner_id !=" . $profile_id . " AND state='active'",null, 'date_start DESC');
   if (!empty ($last_active_poll)) {
   foreach ($last_active_poll as $poll) {
   $already_vote = get_record('poll_vote','id_poll',$poll->ident,'id_user',$profile_id);
   if($already_vote)
   {
       if($poll_for_show)
       {$poll_for_show = $poll_for_show;}
       else
       {$poll_for_show = null;}
       }
   else
   {
       if($poll_for_show)
       {$poll_for_show = $poll_for_show;}
       else
       {$poll_for_show = $poll;}
    }   
}

if ($poll_for_show) {
 

  $title = $poll_for_show->question;
   $creatorid= $poll_for_show->owner_id;

        if ($answersPoll= get_record('poll_answer', 'id_poll',$poll_for_show->ident)) {
        $inicialNumber = $answersPoll->ident;
        $numberofanswers = count_records('poll_answer','id_poll',$poll_for_show->ident);
        $cantidadFinal = $numberofanswers + $inicialNumber;
        $creatorPoll = $poll_for_show->owner;
        $answerID = $fullInfo->ident;



   $Poll .=<<<END
	<form name="form1" method="post" action="$redirect">
  	<table width="350" border="1">
    	<tr> 
      	<td colspan="2"><strong>$title</strong>
      	<input type="hidden" name="creator_id" value=$creatorid>
      	<input type="hidden" name="creatorname" value=$creatorPoll>
      	<input type="hidden" name="answer_id" value=$answerID></td>
      	<input type="hidden" name="user" value=$profile_id></td>			
    	</tr>

    	<tr> 
END;

	if($kindPoll->kind == "only")
	{

	$i = $inicialNumber;
    	for($i; $i<$cantidadFinal;$i++)
		{
        	$answerInfo= get_record('poll_answer', 'ident',$i,null,null,null,null,'answer');
        	$answerforshow = $answerInfo->answer;
		$Poll .=<<<END
      	<td width="51"><input type="radio" name="opcion" value="$i"></td>
      	<td width="283">$answerforshow</td>
    	</tr>
    	<?php } ?>
END;
	}
    //
    // End Poll Votation With ONLY one answer
    //
    }
    else
	{
        $i = $inicialNumber;
        $numberForOption = 1;
	$arrayOptions = "";
        for($i; $i<$cantidadFinal;$i++)
	{
        $answerInfo= get_record('poll_answer', 'ident',$i,null,null,null,null,'answer');
        $answerforshow = $answerInfo->answer;
        $nameOption = "opcion" . $numberForOption;
        $arrayOptions .= $nameOption;
        $numberForOption++;

$Poll .=<<<END
      <input type="hidden" name="array_options" value=$arrayOptions>
      <td width="51"><input type="checkbox" name="$nameOption" value="$i"></td>
      <td width="283">$answerforshow</td>
    </tr>
    <?php } ?>
END;
  	}
	// End poll with Multiple Answers
    }


}
    $Poll .=<<<END
      <td><input type="submit" name="submitpoll" value="vote"></td>
  	</table>
	</form>

END;

   return $Poll;  

}
else
   {
   $poll_for_show = $none;
   return $poll_for_show;  

   }

}
else
{
   $poll_for_show = $none;
   return $poll_for_show;  

}



}
   
?>