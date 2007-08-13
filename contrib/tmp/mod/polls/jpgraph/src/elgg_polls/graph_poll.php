<?php
/*
 * This script defines the actions avaible for the private polls plug-in.
 *
 * @author Johan Eduardo Quijano Garcia <gerencia@treszero.com>
 * @copyright Tres Zero - 2007
 * @author Diego Andrés Ramírez Aragón <diego@somosmas.org>
 * @copyright Corporación Somos Más - 2007
*/

//require_once (dirname(dirname(__FILE__)) . "/../includes.php");


global $USER;
global $CFG;
global $messages;
global $profile_id;

include ("../jpgraph.php");
include ("../jpgraph_bar.php");
include ("../jpgraph_bar.php");

//echo $_POST['opcion'];
//echo $_POST['creatorname'];
//echo $_POST['creator_id'];



$poll_vote = new StdClass;
$poll_vote->id_answer = trim($_POST['opcion']);
$poll_vote->id_user = trim($_POST['creator_id']);
$idpoll_vote = insert_record('poll_vote', $poll_vote);

//echo "Mostrando resultados:::" . $answers_poll;


$data = array(0.1235,0.4567,0.67,0.35,0.832);

// Callback function
// Get called with the actual value and should return the
// value to be displayed as a string
/*function cbFmtPercentage($aVal) {
    return sprintf("%.1f%%",100*$aVal); // Convert to string
}

// Create the graph.
$graph = new Graph(300,200);
$graph->SetScale("textlin");

// Create a bar plots
$bar1 = new BarPlot($data);

// Setup the callback function
$bar1->value->SetFormatCallback("cbFmtPercentage");
$bar1->value->Show();

// Add the plot to the graph
$graph->Add($bar1);

// .. and send the graph back to the browser
$graph->Stroke();*/
?>
