<?php
/*
 * @author Johan Eduardo Quijano Garcia <gerencia@treszero.com>
 * @copyright Tres Zero - 2007
 * @author Diego Andrés Ramírez Aragón <diego@somosmas.org>
 * @copyright Corporación Somos Más - 2007
*/


// Get the current profile ID
global $profile_id, $CFG, $db;
$polls_per_page = 7;

// If the msg offset hasn't been set, it's 0
$msg_offset = optional_param('msg_offset', 0, PARAM_INT);
$sent = optional_param('sent', 0, PARAM_INT);
//******************************
$delete = __gettext("Delete");
$finish_poll = __gettext("Finish the Poll");

$title = __gettext("Polls");
$creatorPoll = __gettext("Creator");

$action = __gettext("Action:");
$date = __gettext("Date");
$pollname = __gettext("Polls");
$state = __gettext("State");
$actionPoll = __gettext("--Select an action: --");
$returnConfirm = __gettext("Are you sure you want to permanently delete this poll(s)?");

$action_options = "<option value=\"finish\">$finish_poll</option>";
$action_options .= "<option value=\"delete\">$delete</option>";

$filterlink = "";
$polls_closed = get_record('polls','state','closed');

//Polls History
if ($sent === 1) {
  $title = __gettext("Historial of Polls");
  $filterlink = "history/";
  $action_options = "<option value=\"delete\">$delete</option>";
  $polls = get_records_select('polls', "state='closed'", null, 'date_start', '*', $msg_offset, $polls_per_page);
  $numberofpolls = count_records('polls','state','closed');

}
else
{
  $polls_owner = get_record('polls','owner_id',$profile_id);

  $polls = get_records_select('polls', "owner_id =" . $profile_id . " AND state='active'",null, 'date_start DESC', '*', $msg_offset, $polls_per_page);




  //Polls voted for the user
$polls_voted = get_records('poll_vote','id_user',$profile_id);
$user_votes = get_record('poll_vote','id_user',$profile_id);

  if($user_votes->id_poll)
  {
     $index = $msg_offset+1;

     foreach ($polls_voted as $poll_active) {
    
     $sql_and .= " AND ident!= " . $poll_active->id_poll;

     }

     $polls_of_others_active = get_records_select('polls', "owner_id !=" . $profile_id  . " AND state='active'" . $sql_and,null, 'date_start DESC', '*', $msg_offset, $polls_per_page); 


     /////////////////////////
     if (!empty ($polls_of_others_active)) {

          foreach ($polls_of_others_active as $poll_voted_active) {   
          $sql_and_voted .= " AND ident!= " . $poll_voted_active->ident;

          }
     }
     else
     { 
       $sql_and_voted .= " ";

     }
         $polls_of_others_voted = get_records_select('polls', "owner_id !=" . $profile_id  . " AND state='active'" . $sql_and_voted,null, 'date_start DESC', '*', $msg_offset, $polls_per_page);
 
  }
  else
  {

      $polls_of_others = get_records_select('polls', "owner_id !=" . $profile_id  . " AND state='active'",null, 'date_start DESC', '*', $msg_offset, $polls_per_page);
  }
  //$polls_of_others = get_records_select('polls', "owner_id !=" . $profile_id  . " AND state='active'",null, 'date_end', '*', $msg_offset, $polls_per_page);
  //$polls_of_others_voted = get_records_select('polls', "owner_id !=" . $profile_id  . " AND state='active'" . " and ident=(select id_poll from elggpoll_vote where state_current_poll ='voted' )",null, 'date_end', '*', $msg_offset, $polls_per_page);

  $numberofpolls = count_records('polls','state','active');

}


//PAGE VIEW POLL
$msgs = "";
$pagging = "&nbsp;";

//
if (!empty ($polls)) {
  $index = $msg_offset+1;
  foreach ($polls as $poll) {
    $msgs .= run("polls:poll:view", array($poll,$index));
    $index++;
  }
}

if (!empty ($polls_of_others)) {
  $index = $msg_offset+1;

  foreach ($polls_of_others as $poll_other) {
    $polls_net .= run("polls:poll:view", array($poll_other,$index));
    $index++;
  }
}
else
{
//PAGE VIEW POLL

//
if (!empty ($polls_of_others_active)) {

  $index = $msg_offset+1;
  foreach ($polls_of_others_active as $poll_net) {
    $polls_net .= run("polls:poll:view", array($poll_net,$index));
    $index++;
    
  }
  
}
if (!empty ($polls_of_others_voted)) {

  //$index = $msg_offset+1;
  foreach ($polls_of_others_voted as $poll_voted) {
    $polls_net .= run("polls:poll:view", array($poll_voted,$index));
    $index++;
    
  }
  
}

}


//Pagging the Polls
  $msg_name = htmlspecialchars($profile_id, ENT_COMPAT, 'utf-8');
  $back = __gettext("Back");
  $next = __gettext("Next");

  if ($numberofpolls - ($msg_offset + $polls_per_page) > 0) {

    $display_msg_offset = $msg_offset + $polls_per_page;

    $pagging .=<<< END

                <a href="{$CFG->wwwroot}{$msg_name}/polls/{$filterlink}msg_offset/{$display_msg_offset}">$next &gt;&gt;</a>

END;
  }
  if ($msg_offset > 0) {
    $display_msg_offset = $msg_offset - $polls_per_page;
    if ($display_msg_offset < 0) {
      $display_msg_offset = 0;
    }
    $pagging .=<<< END

                <a href="{$CFG->wwwroot}{$msg_name}/polls/{$filterlink}msg_offset/{$display_msg_offset}">&lt;&lt; $back</a>

END;
  }




$run_result .= templates_draw(array (
  'context' => 'plug_polls',
  'polls_list' => $msgs,
  'polls_other_list' => $polls_net,
  'paging' => $pagging,
  'title' => $title,
  'creator' => $creatorPoll,
  'action_form_poll' => url . "mod/polls/polls_actions.php?action=multiple&sent=$sent",
  'action_options_poll' => $action_options,
  'sent' => $sent,
  'action' => $action,
  'date' => $date,
  'state' => $state,
  'polls_name' => $pollname,
  'actionPoll' => $actionPoll,
  'returnConfirm' => $returnConfirm
));
?>