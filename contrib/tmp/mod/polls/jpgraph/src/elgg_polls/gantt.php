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
	//echo "Variable i::::" . $i;
        $answers[$i]= $answerInfo->quantity;
	}
$i = $inicialNumber;
$j = 0;
for($i; $i<$cantidadFinal;$i++)
	{
	//echo "Variable i::::" . $i;
        $databary[$j]= $answers[$i];
        $j++;
	}

//$datay=array(12,8,19,3,10,5);

// Create the graph. These two calls are always required
$graph = new Graph(300,200,"auto");	
$graph->SetScale("textlin");

// Add a drop shadow
$graph->SetShadow();

// Adjust the margin a bit to make more room for titles
$graph->img->SetMargin(40,30,20,40);

// Create a bar pot
$bplot = new BarPlot($databary);

// Adjust fill color
$bplot->SetFillColor('orange');

// Setup values
$bplot->value->Show();
$bplot->value->SetFormat('%d');
$bplot->value->SetFont(FF_FONT1,FS_BOLD);

// Center the values in the bar
$bplot->SetValuePos('center');

// Make the bar a little bit wider
$bplot->SetWidth(0.7);

$graph->Add($bplot);

// Setup the titles
$graph->title->Set($question);
$graph->xaxis->title->Set("Votes");
$graph->yaxis->title->Set("Answers");

$graph->title->SetFont(FF_FONT1,FS_BOLD);
$graph->yaxis->title->SetFont(FF_FONT1,FS_BOLD);
$graph->xaxis->title->SetFont(FF_FONT1,FS_BOLD);

// Display the graph
$graph->Stroke();
?>
