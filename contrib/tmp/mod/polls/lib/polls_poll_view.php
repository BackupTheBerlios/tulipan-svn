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

$date_poll  = get_record_sql('SELECT date(date_start) AS date FROM '.$CFG->prefix.'polls WHERE ident = '.$poll->ident);
  $date= $date_poll->date;
  ////State of Poll

//First check if the poll has been published.
$poll_published= get_record('polls','ident',$poll->ident,null,null,null,null,'published');
if($poll_published->published == "no")
{
   $state = __gettext("Not Published");;
}
else
{

 //
  $vote_of_the_user= get_record('poll_vote','id_poll',$poll->ident,'id_user',$profile_id,null,null,'state_current_poll');
  if($vote_of_the_user->state_current_poll)
  {
     $state = $vote_of_the_user->state_current_poll;  

  }
  else
  {
  $state = $poll->state;  
  }

}
  $title= run("weblogs:text:process", $poll->title);

  $poll_style= "";

//VIEW OR EDIT Poll
if($poll->published == "no")
{
$Link_of_Poll = '<a href="' . url . $_SESSION['username'] . '/polls/edit/' . $poll->ident . "/$sent\" " . "?poll_id=" . $poll->ident . ">" . $title  .  "</a>";
}
else
{  $Link_of_Poll = '<a href="' . url . $_SESSION['username'] . '/polls/view/' . $poll->ident . "/$sent\">" . $title . "</a>";
}

$run_result .= templates_draw(array (
    'context' => 'plug_poll',
    'date' => $date,
    'state' => $state,
    'title' => $Link_of_Poll,
    'from_username' => $creatorPoll->username,
    'from_name' => '<a href="' . url . $creatorPoll->username . '/">' . $username . "</a>",
    'from_icon' => $creatorPoll->icon,
    'msg_style' => $poll_style,
    'mark' => $mark,
    'index' => $index
  ));
}
?>