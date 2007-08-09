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
  if ($pol_info = get_record('polls', 'ident', $poll)) {
      delete_records('polls', 'ident', $poll);
    $messages[] = __gettext("The selected Poll was deleted.");
  } else {
    $messages[] = __gettext("The message ID its not valid!.");
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
          echo "Eliminado";

    $msg = optional_param('msg_id', 0, PARAM_INT);
    $sent = optional_param('sent',0,PARAM_INT);
    if (logged_on && !empty ($msg)) {
      $redirect_url = url . user_info('username', $USER->ident) . "/polls/";
      $sent = deleteMessage($msg, $USER->ident);
      define('redirect_url', $redirect_url);
    }
    break;
  
  case "create" :
    $redirect_url = url . user_info('username', $_SESSION['userid']) . "/polls/";
    $poll_creator_id = optional_param('new_poll');
    $creator_poll_name = (isset ($poll_creator_id)) ? user_info('name', $poll_creator_id) : "";
    $title_poll = optional_param('new_poll_name');
    $kind_poll = optional_param('new_kind_poll');
    $poll_question = optional_param('new_poll_question');
    $answer_poll = optional_param('new_answer_poll');
    $date = optional_param('new_date_poll');
    //echo "KIND FORM" . $kind_poll . "POLL QUESTION::" . $poll_question . "ANSWER POLL:::" . $answer_poll . "DATE :::" . $date;


      if (trim($title_poll) != "") {


         if (trim($poll_question) != "") {

		if (trim($answer_poll) != "") {

        //Poll
        $poll = new StdClass;
        $poll->owner_id = trim($poll_creator_id);
        $poll->owner = trim($creator_poll_name);
        $poll->title = trim($title_poll);
        $poll->question = trim($poll_question);
        $poll->kind = trim($kind_poll);
        $poll->date_start = time();
        $poll->date_end = trim($date);
	$idpoll = insert_record('polls', $poll);
        //Poll Answer
        $answer = new StdClass;
        $answer->id_poll = $idpoll;
        $answer->answer = trim($answer_poll);
	$idpoll_answer = insert_record('poll_answer', $answer);

        //Poll Votes CUANDO UN USUARIO CUALQUIERA VOTE ............ CAPTURA DE LOS VOTOS
        //$vote = new StdClass;
        //$vote->id_answer = $idpoll_answer;
        //$vote->id_user = $_SESSION['userid'];
 	//$idpoll_vote = insert_record('poll_vote', $vote);

          if ($idpoll != -1) {
            $poll++;
          }
/*
        // The members will see the poll
        $recipients = array ();
        //$recipient = get_record("users", "ident", "*");
        //If the message if for the community
        if ($recipient->user_type == "community") {
          $members = get_records_sql('SELECT u.*, f.ident AS friendident FROM ' . $CFG->prefix . 'friends f ' .
                                     'JOIN ' . $CFG->prefix . 'users u ON u.ident = f.owner ' .
                                     'WHERE f.friend = ? AND u.user_type = ?', array (
            $to,
            'person'
          ));

          foreach ($members as $key => $infoMember) {
            $recipients[] = $key;
          }
        } else {
          $recipients[] = $to;
        }

        $msgs = 0;
        foreach ($recipients as $rcpt) {
          $msg->to_id = trim($rcpt);
          $msg->title = $subject;
          if ($recipient->user_type == "community") {
            $msg->title = "[" . $recipient->name . "] " . $subject;
          }


          $insert_idpoll = insert_record('polls', $poll);
          if ($insert_idpoll != -1) {
            $poll++;
          }

          // MAIL !!!!!!
          // Send the email confirmation if configured
          // Don't use the weblog plug-in hook because it inserts data in the polls table too
          $notifications = user_flag_get("emailnotifications", $msg->to_id);
          if ($notifications) {
            $email_from = new StdClass;
            $email_from->email = $CFG->noreplyaddress;
            $email_from->name = $CFG->sitename;
            $email_message = sprintf(__gettext("You have received a message from %s."), user_info("name", $msg->from_id));
            $email_message .= "\n\n";
            $email_message .= sprintf(__gettext("To reply, click here: %s"), $CFG->wwwroot . user_info("username", $msg->to_id) . "/messages/");
            $email_message = wordwrap($email_message);

            if ($email_to = get_record_sql("select * from " . $CFG->prefix . "users where ident = " . $msg->to_id)) {

              if (!email_to_user($email_to, $email_from, $msg->title, $email_message . "\n\n\n" . __gettext("You cannot reply to this message by email."))) {
                $messages[] = __gettext("Failed to send email. An unknown error occurred.");
              }
            }
          }
        }

        if ($msgs == count($recipients)) {
          $messages[] = __gettext("Your message was sent");
          $redirect_url = url . user_info('username', $USER->ident) . "/messages/sent";
        }
       */	
		}
		else {
        	$messages[] = __gettext("You must specify minimun two Answers!");
      	     	     }
	     }
      	     else {
             	$messages[] = __gettext("You must specify a Question!");
      	          }
	}
        else {
      		$messages[] = __gettext("You must specify the Poll's Name!");
             }

    define('redirect_url', $redirect_url);
    break;

case "multiple" :
    $action_type = optional_param('message_action_type', -1, PARAM_ALPHA);
    $selected = optional_param('selected');
    $sent = optional_param('sent');
    if (is_array($selected)) {
      foreach ($selected as $option) {
        $msg = get_record('polls', 'ident', $option);
        switch ($action_type) {
          case "read";
            if ($msg->status == "unread") {
              $msg->status = "read";
              update_record('messages', $msg);
            }
            break;
          case "unread";
            if ($msg->status == "read") {
              $msg->status = "unread";
              update_record('messages', $msg);
            }
            break;
          case "delete";
            deletePoll($option, $USER->ident,$sent);
            break;
        }
      }
    }

    $redirect_url = url . user_info('username', $USER->ident) . "/messages/";
    if ($sent) {
      $redirect_url .= "sent";
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