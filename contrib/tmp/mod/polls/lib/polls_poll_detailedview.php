<?php

/*
 * This script loads and append to $run_result the data for the specified message
 *
 * @param object $msg ($parameter) The message to be showed
 * @param int $sent If the list must to show the sent messages (optional)
 *
 * @uses $profile_id
 * @uses $CFG
 *
 * @author Diego Andrés Ramírez Aragón <diego@somosmas.org>
 * @copyright Corporación Somos Más - 2007
*/
if (isset ($parameter)) {
  global $CFG, $profile_id;
  $msg= $parameter;

  $sent= optional_param('sent');
  $creator= new StdClass;

 $creatorid= $msg->ident;
  if ($creatorInfo= get_record('users', 'ident', $creatorid)) {
    $creator->username= $creatorInfo->username;
    $creator->fullname= htmlspecialchars($creatorInfo->name, ENT_COMPAT, 'utf-8');
    $creator->ident  = $creatorInfo->ident;
  } else {
    $creator->username= "";
    $creator->fullname= "";
    $creator->ident= -1;
  }
  $creator->icon= '<a href="' . url . $creator->username . '/">' .user_icon_html($creator->ident)."</a>";

  $date= strftime("%d %b %Y, %H:%M", $msg->posted);
  $title= run("weblogs:text:process", $msg->title);
  $body= run("weblogs:text:process", $msg->body);
 
  $returnConfirm= __gettext("Are you sure you want to permanently delete this Poll?");
  $Delete= __gettext("Delete");
  $endPoll = __gettext("Finish the Poll");

  $from_msg= __gettext("Creator:");
 
$poll = optional_param('message');
$answer_poll  = get_record('polls', 'ident',$poll);
//Check if the Poll is active with the dates !!!
//if($answer_poll->


$current_poll = get_record('polls','ident',$poll);

//Updating the actual date of Poll
$actualDate = date("Y-n-j");
$current_poll->actual_date = $actualDate;
$update = update_record('polls',$current_poll);
$current_poll = get_record('polls','ident',$poll);
$daysforendPoll = get_record('polls','ident',$poll,null,null,null,null,'DAY(date_end)-DAY(actual_date) AS days');
echo "DIAS para que termine el POLL ::::" . $daysforendPoll->days;
$links .= '&nbsp;<a href="' . $CFG->wwwroot . 'mod/polls/polls_actions.php?action=delete&amp;sent=' . $sent . '&amp;poll_id=' . $msg->ident . '" onclick="return confirm(\'' . $returnConfirm . '\')">' . $Delete . '</a> |';


if($daysforendPoll->days==0 || $daysforendPoll->days<0)
{
  $imagePoll = "<h2>This Poll has finished</h2><br>";
  
}
else
{
  $imagePoll = "<h2>This Poll will end in:   " . $current_poll->date_end . "</h2><br>";
}



if($answer_poll->state == "active" &&  $answer_poll->finish == "manual")
{

echo "Estamos en POLL :::" . $poll;

 $links .= '&nbsp;<a href="' . $CFG->wwwroot . 'mod/polls/polls_actions.php?action=finish&amp;sent=' . $sent . '&amp;poll_id=' . $msg->ident .'">' . $endPoll . '</a> |';
//$links .= '&nbsp;<a href="' . $CFG->wwwroot . 'mod/polls/polls_actions.php?action=finish&amp;sent=' . $sent  . '</a> |';
}


//$imagePollrun = run("polls:jpgraph",$answer_poll);

//  $imagePoll = '<img src="/mod/polls/jpgraph/src/elgg_polls/bartutex1.php" alt="" border="0">';
$answer_poll  = get_record('poll_answer', 'id_poll',$poll);
$imagePoll .= '<img src="/mod/polls/jpgraph/src/elgg_polls/bartutex1.php?action=' . $poll .'" alt="" border="0">';
$imagePoll .='<h2>Answers</h2><ol>';
$inicialNumber = $answer_poll->ident;
$numberofanswers = count_records('poll_answer','id_poll',$poll);
$cantidadFinal = $numberofanswers + $inicialNumber;
$i = $inicialNumber;
    for($i; $i<$cantidadFinal;$i++)
	{
        	$answerInfo= get_record('poll_answer', 'ident',$i,null,null,null,null,'answer');
		//echo "Variable i::::" . $i;
        	$answer = $answerInfo->answer;
		$imagePoll .='<li>' . $answer . '</li>';
	}
$imagePoll .='</ol>';

//$imagePoll .='<h2>Answers</h2><ol><li>respuesta1</li></ol>';



$run_result .= templates_draw(array (
    'context' => 'plug_detailedpoll',
    'date' => $date,
    'title' => $title,
    'from_username' => $creator->username,
    'from_name' => $from_msg . ' <a href="' . url . $creator->username . '/">' . $creator->fullname . "</a>",
    'from_icon' => $creator->icon,
    'body' => $imagePoll,
    'links' => $links
  ));
}
?>