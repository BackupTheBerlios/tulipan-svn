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
$poll = optional_param('poll');

$msg = get_record('messages', 'ident', $poll);

templates_page_setup();

$body = run("polls:detailedview",$msg);

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