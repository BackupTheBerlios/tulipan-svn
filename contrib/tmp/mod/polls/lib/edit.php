<?php
/*
 * This script initialize the enviroment for show the polls list
 * @author Johan Eduardo Quijano Garcia <gerencia@treszero.com>
 * @copyright Corporación Somos Más - 2007
 */
require_once(dirname(dirname(__FILE__))."/../../includes.php");

run("profile:init");
run("polls:init");

define("context", "polls");
templates_page_setup();

$poll = optional_param('message');
$poll_information = get_record('polls', 'ident', $poll);

$title = run("profile:display:name") . " :: " . __gettext("Polls");
$body .= run("polls:publish",$poll_information);

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