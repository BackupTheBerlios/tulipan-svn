<?php
/*
 * This script initialize the enviroment for show the message list
 * @author Johan Eduardo Quijano Garcia <gerencia@treszero.com>
 * @author Andrea Ximena Bocanegra Soto <sistemas@treszero.com>
 * @copyright Tres Zero - 2007
 */

global $USER, $messages;
if ($profile_name = optional_param('profile_name')) {
  if ($profile_id = user_info_username('ident', $profile_name)) {

    $page_owner = $profile_id;
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


  $messages[] = __gettext("You may view only your own news");
  $redirect_url = url . user_info('username', $USER->ident) . "/news/";
  $_SESSION['messages'] = $messages;
  header("Location: " . $redirect_url);
  exit;
}
?>