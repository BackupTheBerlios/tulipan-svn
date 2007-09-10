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
  $polls = get_records_select('polls', "state='active'", null, 'date_start', '*', $msg_offset, $polls_per_page);
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

}
$run_result .= templates_draw(array (
  'context' => 'plug_polls',
  'polls_list' => $msgs,
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