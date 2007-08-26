<?php
/*
 * This script defines the actions avaible for the private polls plug-in.
 *
 * @author Johan Eduardo Quijano Garcia <gerencia@treszero.com>
 * @copyright Tres Zero - 2007
 * @author Diego Andrés Ramírez Aragón <diego@somosmas.org>
 * @copyright Corporación Somos Más - 2007
*/

require_once (dirname(dirname(__FILE__)) . "/../includes.php");



function deletePoll($poll, $user,$sent=0) {
  global $messages;
  if ($poll_info = get_record('polls', 'ident', $poll)) {
      delete_records('polls', 'ident', $poll);
    $messages[] = __gettext("The selected Poll was deleted.");
  } else {
    $messages[] = __gettext("The poll ID its not valid!.");
  }
  return $sent;
}

function finishPoll($poll, $user,$sent=0) {
  global $messages;

  if ($poll_info = get_record('polls', 'ident', $poll->ident)) {
      $poll->state = "closed";
      update_record('polls', $poll);
      $messages[] = __gettext("The selected Poll has been finished");
  } else {
    $messages[] = __gettext("The poll ID its not valid!.");
  }
  return $sent;
}

run("polls:init");

global $USER;
global $CFG;
global $messages;
global $profile_id;

// Actions to perform
$action = optional_param('action');

switch ($action) {
  case "delete" :

    $poll = optional_param('poll_id', 0, PARAM_INT);
    $sent = optional_param('sent',0,PARAM_INT);

    if (logged_on && !empty ($poll)) {
      $redirect_url = url . user_info('username', $USER->ident) . "/polls/";
      $sent = deletePoll($poll, $USER->ident,$sent);
      if ($sent) {
        $redirect_url .= "view";
      }
      define('redirect_url', $redirect_url);
    }
    break;

case "finish" :
    $poll_id = optional_param('poll_id', 0, PARAM_INT);
    $sent = optional_param('sent',0,PARAM_INT);
    $poll = get_record('polls', 'ident', $poll_id);

    if (logged_on && !empty ($poll)) {
      $redirect_url = url . user_info('username', $USER->ident) . "/polls/";
      finishPoll($poll, $USER->ident,$sent);
      define('redirect_url', $redirect_url);
    }
    break;
  
  case "create" :
    $redirect_url = url . user_info('username', $_SESSION['userid']) . "/polls/";
    $poll_creator_id = optional_param('new_poll');
    $creator_poll_name = (isset ($poll_creator_id)) ? user_info('name', $poll_creator_id) : "";
    $title_poll = optional_param('new_poll_name');
    $kind_poll = optional_param('new_kind_poll');
    if($kind_poll == "")
    {
      $kind_poll = "only"; 
    }
    $dateend_poll = optional_param('date_poll');
    $datestart_poll = date("Y/m/d");
    $finish = optional_param('new_date_poll');
    if($finish == "")
    {
      $finish = "manual"; 
    }

//Checking the DATE information of the news poll
if($finish == "manual")
{  
   $dateend_poll = "0000/00/00";
   $statePoll = "active";

}
else
{
    if($dateend_poll == $datestart_poll)
    {
       $statePoll = "closed";
       $redirect_url = url . user_info('username', $USER->ident) . "/polls/create";
       $messages[] = __gettext("The Poll finish today !! Please select other date");
       define('redirect_url', $redirect_url);

       break;

    }
    else if($dateend_poll < $datestart_poll)
    {
       $statePoll = "closed";
       $redirect_url = url . user_info('username', $USER->ident) . "/polls/create";
       $messages[] = __gettext("Your date for finish the poll already pass !! Please select other date");
       define('redirect_url', $redirect_url);

       break;
    }
    else
    {
       $statePoll = "active";

    }

}

//Answers MAX 10   
    $poll_question = optional_param('new_poll_question');
    $answers_quantity = optional_param('poll_answers');
	switch ($answers_quantity) {

  	case "2" :
	$answers_poll =array(optional_param('answer1'),optional_param('answer2'));
    	break;
	case "3" :
	$answers_poll =array(optional_param('answer1'),optional_param('answer2'),optional_param('answer3'));
    	break;
	case "4" :
	$answers_poll =array(optional_param('answer1'),optional_param('answer2'),optional_param('answer3'),optional_param('answer4'));
    	break;
	case "5" :
	$answers_poll =array(optional_param('answer1'),optional_param('answer2'),optional_param('answer3'),optional_param('answer4'),optional_param('answer5'));
    	break;
	case "6" :
	$answers_poll =array(optional_param('answer1'),optional_param('answer2'),optional_param('answer3'),optional_param('answer4'),optional_param('answer5'),optional_param('answer6'));
    	break;
	case "7" :
	$answers_poll =array(optional_param('answer1'),optional_param('answer2'),optional_param('answer3'),optional_param('answer4'),optional_param('answer5'),optional_param('answer6'),optional_param('answer7'));
    	break;
	case "8" :
	$answers_poll =array(optional_param('answer1'),optional_param('answer2'),optional_param('answer3'),optional_param('answer4'),optional_param('answer5'),optional_param('answer6'),optional_param('answer7'),optional_param('answer8'));
    	break;
	case "9" :
	$answers_poll =array(optional_param('answer1'),optional_param('answer2'),optional_param('answer3'),optional_param('answer4'),optional_param('answer5'),optional_param('answer6'),optional_param('answer7'),optional_param('answer8'),optional_param('answer9'));
    	break;
	case "10" :
	$answers_poll =array(optional_param('answer1'),optional_param('answer2'),optional_param('answer3'),optional_param('answer4'),optional_param('answer5'),optional_param('answer6'),optional_param('answer7'),optional_param('answer8'),optional_param('answer9'),optional_param('answer10'));
    	break;

	}
    

    	$date = optional_param('new_date_poll');

if(trim($statePoll) == "active"){ 

      if (trim($title_poll) != "") {


         if (trim($poll_question) != "") {

		if (trim($answers_poll[0]) != "") {

        //Poll
        $poll = new StdClass;
        $poll->owner_id = trim($poll_creator_id);
        $poll->owner = trim($creator_poll_name);
        $poll->title = trim($title_poll);
        $poll->question = trim($poll_question);
        $poll->kind = trim($kind_poll);
        $poll->date_start = $datestart_poll;
        $poll->date_end = trim($dateend_poll);
        $poll->state = trim($statePoll);
        $poll->finish = trim($finish);
	$idpoll = insert_record('polls', $poll);
        //Poll Answer
        $answer = new StdClass;
        $answer->id_poll = $idpoll;
        foreach ($answers_poll as $answer_poll) {
		$answer->answer = trim($answer_poll);
                $idpoll_answer = insert_record('poll_answer', $answer);

	}

          if ($idpoll != -1) {
            $poll++;
          	}	
	



		}
		else {
                $redirect_url = url . user_info('username', $_SESSION['userid']) . "/polls/create";
        	$messages[] = __gettext("You must specify minimun two Answers!");
      	     	     }
	     }
      	     else {
                $redirect_url = url . user_info('username', $_SESSION['userid']) . "/polls/create";
             	$messages[] = __gettext("You must specify a Question!");
      	          }
	}
        else {
                $redirect_url = url . user_info('username', $_SESSION['userid']) . "/polls/create";
      		$messages[] = __gettext("You must specify the Poll's Name!");
             }
}
else {
       $messages[] = __gettext("Your Poll will end today. Plase choose other date!");
       $redirect_url = url . user_info('username', $_SESSION['userid']) . "/polls/create";
     }



    define('redirect_url', $redirect_url);
    break;

case "multiple" :
    $action_type = optional_param('poll_action_type', -1, PARAM_ALPHA);
    $selected = optional_param('selected');
    $sent = optional_param('sent');
    if (is_array($selected)) {
      foreach ($selected as $option) {
        $msg = get_record('polls', 'ident', $option);
        switch ($action_type) {
          case "finish";
            finishPoll($msg, $USER->ident,$sent);
            break;
          case "delete";
            deletePoll($option, $USER->ident,$sent);
            break;
        }
      }
    }

    $redirect_url = url . user_info('username', $USER->ident) . "/polls/";
    if ($sent) {
      $redirect_url .= "history";
    }
    define('redirect_url', $redirect_url);

    break;
  
}

if (defined('redirect_url')) {
  $_SESSION['messages'] = $messages;
  header("Location: " . redirect_url);
  exit;
}
?>