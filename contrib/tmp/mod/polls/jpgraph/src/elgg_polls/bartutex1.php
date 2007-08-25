<?php

require_once (dirname(dirname(__FILE__)) . "/../../../../includes.php");
include ("../jpgraph.php");
include ("../jpgraph_bar.php");


run("polls:init");

$action = optional_param('action');
$id_current_poll = $action;
if($action)
{
$answer_poll  = get_record('poll_answer', 'id_poll',$id_current_poll);
$inicialNumber = $answer_poll->ident;
$numberofanswers = count_records('poll_answer','id_poll',$id_current_poll);
$cantidadFinal = $numberofanswers + $inicialNumber;
$question= get_record('polls', 'ident',$id_current_poll,null,null,null,null,'question');

}

$i = $inicialNumber;
    for($i; $i<$cantidadFinal;$i++)
	{
        $answerInfo= get_record('poll_answer', 'ident',$i,null,null,null,null,'quantity');
        $answers[$i]= $answerInfo->quantity;
	}
$i = $inicialNumber;
$j = 0;
for($i; $i<$cantidadFinal;$i++)
	{
        $databary[$j]= $answers[$i];
        $j++;
	}
 

// New graph with a drop shadow
$graph = new Graph(500,350,'auto');
$graph->SetShadow();

// Use a "text" X-scale
$graph->SetScale("textlin");
//Question for show in the poll
//$title = "Poll : " . $question->question;
$title = "Poll : " . $question->question;
// Set title and subtitle
$graph->title->Set($title);

// Use built in font
$graph->title->SetFont(FF_FONT1,FS_BOLD);

// Create the bar plot
$b1 = new BarPlot($databary);
//$b1->SetLegend("Votes");
$b1->SetLegend("Votes");

//$b1->SetAbsWidth(6);
//$b1->SetShadow();

// The order the plots are added determines who's ontop
$graph->Add($b1);

// Finally output the  image
$graph->Stroke();

?>