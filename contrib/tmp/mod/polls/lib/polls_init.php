<?php
/*
 * This script initialize the enviroment for the private poll.
 * It checks if the user is logged and if he is trying to access another private polls
 * @author Johan Eduardo Quijano Garcia <gerencia@treszero.com>
 * @copyright Tres Zero-- 2007
 * @author Diego Andrés Ramírez Aragón <diego@somosmas.org>
 * @copyright Corporación Somos Más - 2007
 */

global $USER, $messages;


if ($profile_name = optional_param('profile_name')) {

echo $profile_name;

  if ($profile_id = user_info_username('ident', $profile_name)) {
    $page_owner = $profile_id;
	
echo $page_owner;

  }
}

if (empty ($profile_id)) {

  $profile_id = optional_param("profile_id", optional_param("profileid", $_SESSION['userid'], PARAM_INT), PARAM_INT);
}


if (!logged_on) {
  header("Location: " . url);
  exit;
}
if ($profile_id != $USER->ident || !logged_on) {


  $messages[] = __gettext("You may view only your own polls");
  $redirect_url = url . user_info('username', $USER->ident) . "/poll/";
  $_SESSION['polls'] = $messages;
  header("Location: " . $redirect_url);
  exit;
}


?>