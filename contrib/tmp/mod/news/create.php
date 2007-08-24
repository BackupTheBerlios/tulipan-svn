<?php
/*
 * This script initialize the enviroment for show the message list
 * @author Johan Eduardo Quijano Garcia <gerencia@treszero.com>
 * @author Andrea Ximena Bocanegra Soto <sistemas@treszero.com>
 * @copyright Tres Zero - 2007
 */

require_once (dirname(dirname(__FILE__)) . "/../includes.php");

run("profile:init");
run("news:init");

define("context", "news");
templates_page_setup();

$title = run("profile:display:name") . " :: " . __gettext("News");

$body .= run("news:new");
// Needed for add the tinymce editor
$body .= run("news:new:body",array(array("new_msg_body")));

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