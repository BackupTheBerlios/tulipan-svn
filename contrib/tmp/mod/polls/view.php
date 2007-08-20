<?php
/*
 * This script initialize the enviroment for view a message
 * @param int $message The msg Id
 * @author Diego Andrés Ramírez Aragón <diego@somosmas.org>
 * @copyright Corporación Somos Más - 2007
 */
require_once (dirname(dirname(__FILE__)) ."/../includes.php");

run("profile:init");
run("polls:init");

define("context", "polls");
templates_page_setup();

$title = run("profile:display:name") . " :: " . __gettext("Polls");
$poll = optional_param('message');

//$poll_information = get_record('polls', 'owner_id', $profile_id);
$poll_information = get_record('polls', 'ident', $poll);

echo "Analizando las encuestas :::Creador del Poll" . $poll_information->owner;
templates_page_setup();
if($poll_information->owner_id == $profile_id)
{
$answer_poll  = get_record('poll_answer', 'ident',$poll);
//$body = run("polls:jpgraph",$answer_poll);
$body = run("polls:detailedview",$poll_information);
}
else
{

$body = run("polls:pollforvotation",$poll_information);
}

$body = templates_draw(array (
  'context' => 'contentholder',
  'title' => $title,
  'body' => "<div id=\"view_own_blog\">" . $body . "</div>"
));
echo templates_page_draw(array (
  $title,
  $body
));
?>