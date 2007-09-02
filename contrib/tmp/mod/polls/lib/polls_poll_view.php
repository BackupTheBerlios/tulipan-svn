<?php

/*
 * This script loads and append to $run_result the basic data for the specified poll
 *
 * @uses $profile_id
 * @uses $CFG
 *
 * @author Johan Eduardo Quijano Garcia <gerencia@treszero.com>
 * @copyright Corporación Somos Más - 2007
*/
global $template;

if (isset ($parameter)) {
  global $CFG, $profile_id;
  $poll= $parameter[0];
  $sent= $parameter[1];
  $index= $parameter[1];

  $sent= optional_param('sent', 0, PARAM_INT);

  $creatorPoll= new StdClass;

  if ($creatorInfo= get_record('users', 'ident',$poll->owner)) {

    $creatorPoll->username= $creatorInfo->username;
    $creatorPoll->fullname= htmlspecialchars($creatorPoll->name, ENT_COMPAT, 'utf-8');
    $creatorPoll->ident = $creatorInfo->ident;

  } else {
    $creatorPoll->username= "";
    $creatorPoll->fullname= "";
    $creatorPoll->ident= -1;
  }

  $creatorPoll->icon= '<a href="' . url . $creatorPoll->username . '/">' .user_icon_html($creatorPoll->ident,50). "</a>";

  if($profile_id == $poll->owner)
  {
      $mark= "<input type=\"checkbox\" name=\"selected[]\" value=\"" . $poll->ident . "\" onclick=\"mark(this)\">";

  }
  else
  {
      $mark=""; 
  }

  $username= user_name($poll->owner);

  $date= $poll->date_start;
  ////State of Poll
  $vote_of_the_user= get_record('poll_vote','id_poll',$poll->ident,'id_user',$profile_id,null,null,'state_current_poll');
  if($vote_of_the_user->state_current_poll)
  {
     $state = $vote_of_the_user->state_current_poll;  

  }
  else
  {
  $state = $poll->state;  
  }
  $title= run("weblogs:text:process", $poll->title);

  $poll_style= "";


$run_result .= templates_draw(array (
    'context' => 'plug_poll',
    'date' => $date,
    'state' => $state,
    'title' => '<a href="' . url . $_SESSION['username'] . '/polls/view/' . $poll->ident . "/$sent\">" . $title . "</a>",
    'from_username' => $creatorPoll->username,
    'from_name' => '<a href="' . url . $creatorPoll->username . '/">' . $username . "</a>",
    'from_icon' => $creatorPoll->icon,
    'msg_style' => $poll_style,
    'mark' => $mark,
    'index' => $index
  ));
}
?>