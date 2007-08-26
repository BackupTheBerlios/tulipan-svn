<?php 
/*
 * @author Johan Eduardo Quijano Garcia <gerencia@treszero.com>
 * @copyright Tres Zero - 2007
 * @author Diego Andrés Ramírez Aragón <diego@somosmas.org>
 * @copyright Corporación Somos Más - 2007
 */

require_once (dirname(dirname(__FILE__)) . "/../../includes.php");


run("polls:init");

global $USER;
global $CFG;
global $messages;
global $profile_id;

$redirect_url = url . user_info('username', $_SESSION['userid']) . "/polls/";
define('redirect_url', $redirect_url);

$poll_vote = new StdClass;
$poll_answer = new StdClass;

$vote_selected = trim($_POST['opcion']);
$poll_vote->id_user = trim($_POST['creator_id']);

 
$quantity = get_record_select('poll_answer', 'ident',$vote_selected,'quantity');
$answer  = get_record('poll_answer', 'ident', $vote_selected);
$poll_id = get_record('poll_answer', 'ident',$vote_selected,null,null,null,null,'id_poll');
$poll_vote->id_poll = $poll_id->id_poll;

$answer->quantity = $answer->quantity + 1;
$votation = update_record('poll_answer',$answer);
$idpoll_vote = insert_record('poll_vote', $poll_vote);


if (defined('redirect_url')) {
  $_SESSION['messages'] = $messages;
  header("Location: " . redirect_url);
  exit;
}
?>