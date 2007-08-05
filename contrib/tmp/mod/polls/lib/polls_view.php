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
$from = __gettext("Title");

$action = __gettext("Action:");
$date = __gettext("Date");
$subject = __gettext("Polls");
$actionMsg = __gettext("Select an action");
$returnConfirm = __gettext("Are you sure you want to permanently delete this poll(s)?");

$action_options = "<option value=\"read\">$finish_poll</option>";
$action_options .= "<option value=\"delete\">$delete</option>";

$filterlink = "";
$where_sent = "to_id=$profile_id AND hidden_to='0'";
if ($sent === 1) {
  $from = __gettext("Sent to");
  $title = __gettext("Sent messages");
  $where_sent = "from_id=$profile_id AND hidden_from='0'";
  $filterlink = "sent/";
  $action_options = "<option value=\"delete\">$delete</option>";
}


$posts = get_records_select('messages', "$where_sent", null, 'posted DESC', '*', $msg_offset, $polls_per_page);
echo "Analizando Poll VIEW POSTS:::::" . $posts;
$numberofposts = count_records_select('messages', "$where_sent");
echo "Analizando Poll VIEW NUMBER:::::" . $posts;

//PAGE VIEW POLL
$msgs = "";
$pagging = "&nbsp;";

////////////

//$graph->Stroke();
//<img src=$graph> 

$pagging .=<<< END
CARGANDO GRAFICO !!!!	
<img src="/mod/polls/jpgraph/src/elgg_polls/graph_poll.php" alt="" border="0">
END;

/////
if (!empty ($posts)) {
  $index = $msg_offset+1;
  foreach ($posts as $post) {
    $msgs .= run("polls:poll:view", array($post,$sent,$index));
    $index++;
  }

  $msg_name = htmlspecialchars($profile_id, ENT_COMPAT, 'utf-8');
  $back = __gettext("Back");
  $next = __gettext("Next");


  if ($numberofposts - ($msg_offset + $polls_per_page) > 0) {
    $display_msg_offset = $msg_offset + $polls_per_page;
    $pagging .=<<< END

                <a href="{$CFG->wwwroot}{$msg_name}/messages/{$filterlink}msg_offset/{$display_msg_offset}">$next &gt;&gt;</a>

END;
  }
  if ($msg_offset > 0) {
    $display_msg_offset = $msg_offset - $polls_per_page;
    if ($display_msg_offset < 0) {
      $display_msg_offset = 0;
    }
    $pagging .=<<< END

                <a href="{$CFG->wwwroot}{$msg_name}/messages/{$filterlink}msg_offset/{$display_msg_offset}">&lt;&lt; $back</a>

END;
  }

}

$run_result .= templates_draw(array (
  'context' => 'plug_messages',
  'messages' => $msgs,
  'paging' => $pagging,
  'from_to' => $from,
  'title' => $title,
  'action_form' => url . "mod/messages/messages_actions.php?action=multiple&sent=$sent",
  'action_options' => $action_options,
  'sent' => $sent,
  'action' => $action,
  'date' => $date,
  'subject' => $subject,
  'actionMsg' => $actionMsg,
  'returnConfirm' => $returnConfirm
));
?>