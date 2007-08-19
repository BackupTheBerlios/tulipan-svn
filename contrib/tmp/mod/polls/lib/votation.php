<?php 

require_once (dirname(dirname(__FILE__)) . "/../../includes.php");


run("polls:init");

global $USER;
global $CFG;
global $messages;
global $profile_id;

//include ("../jpgraph.php");
//include ("../jpgraph_bar.php");

//echo $_POST['opcion'];
//echo $_POST['creatorname'];
//echo $_POST['creator_id'];

//$action = optional_param('action');

//if ($action == "vote")
//{


$redirect_url = url . user_info('username', $_SESSION['userid']) . "/polls/";
define('redirect_url', $redirect_url);

$poll_vote = new StdClass;
$poll_answer = new StdClass;

// PENDIENTE MIRAR SI SON MULTIPLES VOTACIONES !!!! opcion 1, 2, 3, 4 , 5 etc...
$poll_vote->id_answer = trim($_POST['opcion']);
$poll_vote->id_user = trim($_POST['creator_id']);
//$poll_answer->ident = trim($_POST['answer_id']);
//Get IDENT from Current Poll



//Get the quantity of votes from the Answer 
$quantity = get_record_select('poll_answer', 'ident',$poll_vote->id_answer,'quantity');
$answer  = get_record('poll_answer', 'ident', $poll_vote->id_answer);
//echo "Show RECORD::: IDENT::" . $answer->ident . "ANSWER:::" . $answer->answer . "CANTIDAD" . $answer->quantity; 
$answer->quantity = $answer->quantity + 1;
//echo "NUEVA CANTIDAD :::: " . $answer->quantity;
$votation = update_record('poll_answer',$answer);
$idpoll_vote = insert_record('poll_vote', $poll_vote);

//run("polls:jpgraph",$answer);

if (defined('redirect_url')) {
  $_SESSION['messages'] = $messages;
  header("Location: " . redirect_url);
  exit;
}
?>