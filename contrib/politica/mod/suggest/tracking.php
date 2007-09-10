<?php

/*
 * This script process the suggestion tracking
 * 
 * Created on Aug 21, 2007
 * @author Diego Andrés Ramírez Aragón <diego@somosmas.org>
 * @copyright Corporación Somos más - 2007
 */
require_once (dirname(dirname(__FILE__)) . "/../includes.php");

$username = optional_param('username');
$type = optional_param('type');
$ident = optional_param('ident');
$schema = optional_param('schema');

if (!empty ($username) && !empty ($type) && !empty ($ident)) {
	$tracking = get_records_select('suggest_tracking', "type='$type' AND contentid=$ident AND userid = " . $_SESSION['userid']);
	if (empty ($tracking)) {
		$tracking = new StdClass;
		$tracking->userid = $_SESSION['userid'];
		$tracking->contentid = $ident;
		$tracking->type = $type;

		$insert_id = insert_record('suggest_tracking', $tracking);
	} else {
		$tracking = array_pop($tracking);
		$tracking->visited = $tracking->visited + 1;
		update_record('suggest_tracking', $tracking);
	}

	$url = url . "{{username}}";
	if (!empty ($schema)) {
		$schema = urldecode($schema);
		$url = url . $schema;
	}
	$url = str_replace('{{username}}', $username, $url);
	$url = str_replace('{{type}}', $type, $url);
	$url = str_replace('{{ident}}', $ident, $url);
	header("Location: $url");
}
?>
