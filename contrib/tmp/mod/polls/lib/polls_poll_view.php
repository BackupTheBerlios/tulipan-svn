<?php

/*
 * This script loads and append to $run_result the basic data for the specified message
 *
 * @param object $msg ($parameter) The message to be showed
 * @param int $sent If the list must to show the sent messages (optional)
 *
 * @uses $profile_id
 * @uses $CFG
 *
 * @author Johan Eduardo Quijano Garcia <gerencia@treszero.com>
 * @copyright Tres Zero - 2007
 * @author Diego Andrés Ramírez Aragón <diego@somosmas.org>
 * @copyright Corporación Somos Más - 2007
*/
global $template;

if (isset ($parameter)) {
  global $CFG, $profile_id;
  $msg= $parameter[0];
  //$sent= $parameter[1];
  $index= $parameter[1];
  $state = __gettext("State");

  $sent= optional_param('sent', 0, PARAM_INT);

  $creatorPoll= new StdClass;

  if ($creatorInfo= get_record('users', 'ident',$msg->owner_id)) {

    $creatorPoll->username= $creatorInfo->username;
    $creatorPoll->fullname= htmlspecialchars($authorInfo->name, ENT_COMPAT, 'utf-8');
    $creatorPoll->ident = $creatorInfo->ident;
  } else {
    $creatorPoll->username= "";
    $creatorPoll->fullname= "";
    $creatorPoll->ident= -1;
  }

  $creatorPoll->icon= '<a href="' . url . $creatorPoll->username . '/">' .user_icon_html($creatorPoll->ident,50). "</a>";
  $mark= "<input type=\"checkbox\" name=\"selected[]\" value=\"" . $msg->ident . "\" onclick=\"mark(this)\">";

  $date= strftime("%d/%m/%Y, %H:%M", $msg->date_start);

  $username= user_info('username', $msg->owner_id);

  $title= run("weblogs:text:process", $msg->title);

  $msg_style= "";

//'<img src="/mod/polls/jpgraph/src/elgg_polls/graph_poll.php" alt="" border="0">'

  /* $run_result .= templates_draw(array (
    'context' => 'plug_poll',
    'date' => $date,
    'title' => '<a href="' . url . $_SESSION['username'] . '/polls/view/' . $msg->owner_id . "/$sent\">" . $title . "</a>",
    'from_username' => $creatorPoll->username,
    'from_name' => '<a href="' . url . $creatorPoll->username . '/">' . $creatorPoll->fullname . "</a>",
    'from_icon' => $creatorPoll->icon,
    'msg_style' => $msg_style,
    'mark' => $mark,
    'index' => $index
  ));*/


$run_result .= templates_draw(array (
    'context' => 'plug_poll',
    'date' => $date,
    'state' => $state,
    'title' => '<a href="' . url . $_SESSION['username'] . '/polls/view/' . $msg->ident . "/$sent\">" . $title . "</a>",
    'from_username' => $creatorPoll->username,
    'from_name' => '<a href="' . url . $creatorPoll->username . '/">' . $creatorPoll->fullname . "</a>",
    'from_icon' => $creatorPoll->icon,
    'msg_style' => $msg_style,
    'mark' => $mark,
    'index' => $index
  ));
}
?>