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
//PENDIENTE MIRAR DONDE ESTAN DEFINIDAS
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
$actionPoll = __gettext("Select an action");
$returnConfirm = __gettext("Are you sure you want to permanently delete this poll(s)?");

$action_options = "<option value=\"read\">$finish_poll</option>";
$action_options .= "<option value=\"delete\">$delete</option>";

$filterlink = "";
$where_sent = "to_id=$profile_id AND hidden_to='0'";
//PENDIENTE HISTORIAL !!!!
if ($sent === 1) {
  $from = __gettext("Sent to");
  $title = __gettext("Historial of Polls");
  $where_sent = "from_id=$profile_id AND hidden_from='0'";
  $filterlink = "history/";
  $action_options = "<option value=\"delete\">$delete</option>";
}

$polls = get_records_select('polls');
//$polls = get_records_select('polls', "", null, '', '*', $msg_offset,'');
$numberofpolls = count_records_select('polls');

//PAGE VIEW POLL
$msgs = "";
$pagging = "&nbsp;";


/*$pagging .=<<< END
CARGANDO GRAFICO !!!!	
<img src="/mod/polls/jpgraph/src/elgg_polls/graph_poll.php" alt="" border="0">
END;*/

/////
if (!empty ($polls)) {
  $index = $msg_offset+1;
  foreach ($polls as $poll) {
    $msgs .= run("polls:poll:view", array($poll,$index));
    $index++;
  }

  $msg_name = htmlspecialchars($profile_id, ENT_COMPAT, 'utf-8');
  $back = __gettext("Back");
  $next = __gettext("Next");

//Pagging the Polls
echo "PAGINANDO::::::";
echo $numberofpolls;
echo "::::: offset :::::" . $msg_offset;
echo "polls por pagina :::" . $polls_per_page;
  //if ($numberofpolls - ($msg_offset + $polls_per_page) > 0) {
if ($numberofpolls  > $polls_per_page) {

    $display_msg_offset = $msg_offset + $polls_per_page;
    echo "entro al primer IF::::DISPLAY" . $display_msg_offset;

    $pagging .=<<< END

                <a href="{$CFG->wwwroot}{$msg_name}/polls/{$filterlink}msg_offset/{$display_msg_offset}">$next &gt;&gt;</a>

END;
  }
  if ($msg_offset > 0) {
    echo "Entro al segundo IF";
    $display_msg_offset = $msg_offset - $polls_per_page;
    if ($display_msg_offset < 0) {
      $display_msg_offset = 0;
    }
    $pagging .=<<< END

                <a href="{$CFG->wwwroot}{$msg_name}/polls/{$filterlink}msg_offset/{$display_msg_offset}">&lt;&lt; $back</a>

END;
  }

}
//http://pymera/mod/messages/messages_actions.php?action=multiple&sent=0
$run_result .= templates_draw(array (
  'context' => 'plug_polls',
  'messages' => $msgs,
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