<?php

/*
 * This script loads and append to $run_result the data for the specified poll
 *
 * @uses $profile_id
 * @uses $CFG
 *
 * @author Johan Eduardo Quijano Garcia <gerencia@treszero.com>
 * @copyright Corporación Somos Más - 2007
*/
if (isset ($parameter)) {
  global $CFG, $profile_id;
  $msg= $parameter;

  $sent= optional_param('sent');
  $creator= new StdClass;

 $creatorid= $msg->owner;
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
  $poll_will_finish =__gettext("This Poll will end in:   ");


$from_msg= __gettext("Creator:");
$poll = optional_param('message');
$poll_finished = __gettext("This Poll has finished");
$answers = __gettext("Answers");
$poll_auto = __gettext("This Poll will end Automatically");
$poll_manual = __gettext("This Poll will end when you decide");

$answer_poll  = get_record('polls', 'ident',$poll);
$current_poll = get_record('polls','ident',$poll);

//Updating the actual date of Poll
$actualDate = date("Y-n-j");
$current_poll->actual_date = $actualDate;
$update = update_record('polls',$current_poll);
$current_poll = get_record('polls','ident',$poll);
$daysforendPoll = get_record('polls','ident',$poll,null,null,null,null,'DAY(date_end)-DAY(actual_date) AS days');
$links .= '&nbsp;<a href="' . $CFG->wwwroot . 'mod/polls/polls_actions.php?action=delete&amp;sent=' . $sent . '&amp;poll_id=' . $msg->ident . '" onclick="return confirm(\'' . $returnConfirm . '\')">' . $Delete . '</a> |';

//Check if the poll finish manually
if($current_poll->date_end == '0000-00-00')
{
 	 $imagePoll = "<h2>$poll_manual</h2><br>";
  

if($answer_poll->state == "active" &&  $answer_poll->finish == "manual")
{

 $links .= '&nbsp;<a href="' . $CFG->wwwroot . 'mod/polls/polls_actions.php?action=finish&amp;sent=' . $sent . '&amp;poll_id=' . $msg->ident .'">' . $endPoll . '</a> |';
}

$answer_poll  = get_record('poll_answer', 'id_poll',$poll);
$imagePoll .= '<img src="/mod/polls/jpgraph/src/elgg_polls/bartutex1.php?action=' . $poll .'" alt="" border="0">';
$imagePoll .='<h2>' . $answers . '</h2><ol>';
$inicialNumber = $answer_poll->ident;
$numberofanswers = count_records('poll_answer','id_poll',$poll);
$totalnumberofanswers = count_records('poll_answer');
$cantidadFinal = $totalnumberofanswers + $inicialNumber;
$i = $inicialNumber;
    for($i; $i<$cantidadFinal;$i++)
	{
        	$answerInfo= get_record('poll_answer', 'ident',$i,'id_poll',$poll,null,null,'answer');
        	$answer = $answerInfo->answer;
		if($answer)
                {
		$imagePoll .='<li>' . $answer . '</li>';
                }
	}
$imagePoll .='</ol>';
$username= user_name($creatorid);
}
else
{
//The poll finish Automatically
//
//

//Check the Day for end the  Poll
//Years
$yearsforendPoll = get_record('polls','ident',$current_poll->ident,null,null,null,null,'YEAR(date_end)-YEAR(actual_date) AS years');
  //Months
$monthsforendPoll = get_record('polls','ident',$current_poll->ident,null,null,null,null,'MONTH(date_end)-MONTH(actual_date) AS months');
//Days
$daysforendPoll = get_record('polls','ident',$current_poll->ident,null,null,null,null,'DAY(date_end)-DAY(actual_date) AS days');

if($yearsforendPoll->years == 0)
{
    if($monthsforendPoll->months == 0)
    {
       $daysforendPoll->days = $daysforendPoll->days;
    }
    else
    {
       $daysforendPoll->days = $monthsforendPoll->months + $daysforendPoll->days;
    }
}
else
{
    if($monthsforendPoll->months == 0 || $monthsforendPoll->months > 0)
    {
          if($daysforendPoll->days == 0 || $daysforendPoll->days > 0)
          {$daysforendPoll->days = $yearsforendPoll->years * 365 + $monthsforendPoll->months + $daysforendPoll->days;
          }
          else
          {
           $daysforendPoll->days = $yearsforendPoll->years * 365 + $monthsforendPoll->months + (30 + $daysforendPoll->days); 
          } 
    }
    else
    {
          
          if($daysforendPoll->days == 0 || $daysforendPoll->days > 0)
          {$daysforendPoll->days = $yearsforendPoll->years * 365 + (12 + $monthsforendPoll->months) + $daysforendPoll->days;
          }
          else
          {
           $daysforendPoll->days = $yearsforendPoll->years * 365 + (12 + $monthsforendPoll->months) + (30 + $daysforendPoll->days); 
          } 
    }
}
if($daysforendPoll->days==0 || $daysforendPoll->days<0)
{
  $imagePoll = "<h2>$poll_finished</h2><br>";
}
else
{
  $imagePoll = "<h2>$poll_will_finish   " . $current_poll->date_end . "</h2><br>";
}
if($answer_poll->state == "active" &&  $answer_poll->finish == "manual")
{
 $links .= '&nbsp;<a href="' . $CFG->wwwroot . 'mod/polls/polls_actions.php?action=finish&amp;sent=' . $sent . '&amp;poll_id=' . $msg->ident .'">' . $endPoll . '</a> |';
}
$answer_poll  = get_record('poll_answer', 'id_poll',$poll);
$imagePoll .= '<img src="/mod/polls/jpgraph/src/elgg_polls/bartutex1.php?action=' . $poll .'" alt="" border="0">';
$imagePoll .='<h2>' . $answers . '</h2><ol>';
$inicialNumber = $answer_poll->ident;
$numberofanswers = count_records('poll_answer','id_poll',$poll);
$cantidadFinal = $numberofanswers + $inicialNumber;
$i = $inicialNumber;
    for($i; $i<$cantidadFinal;$i++)
	{
        	$answerInfo= get_record('poll_answer', 'ident',$i,null,null,null,null,'answer');
        	$answer = $answerInfo->answer;
		$imagePoll .='<li>' . $answer . '</li>';
	}
$imagePoll .='</ol>';

$username= user_name($creatorid);

}
$run_result .= templates_draw(array (
    'context' => 'plug_detailedpoll',
    'date' => $date,
    'title' => $title,
    'from_username' => $creator->username,
    'from_name' => $from_msg . ' <a href="' . url . $creator->username . '/">' . $username . "</a>",
    'from_icon' => $creator->icon,
    'body' => $imagePoll,
    'links' => $links
  ));
}
?>