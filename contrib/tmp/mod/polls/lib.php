<?php
/*
 * This script initialize the enviroment for show the poll list
 * @author Johan Eduardo Quijano Garcia <gerencia@treszero.com>
 * @copyright Corporación Somos Más - 2007
 */


function polls_pagesetup() {
  // register links --
    global $metatags,$function,$USER;
    global $profile_id;
    global $PAGE;
    global $CFG;
    global $page_owner;

  $pgowner= $profile_id;

  require_once $CFG->dirroot . "mod/polls/default_template.php";

  if (isloggedin() && user_info("user_type", $_SESSION['userid']) != "external") {
    // Add the JavaScript Polls functions
    $url= substr($CFG->wwwroot, 0, -1);
    $metatags .= "<script language=\"javascript\" type=\"text/javascript\" src=\"$url/mod/polls/js/polls.js\"></script>";
    $metatags .= "<link rel=\"stylesheet\" href=\"" . $CFG->wwwroot . "/mod/polls/css/css.css\" type=\"text/css\" media=\"screen\" />";
 

    //Show the poll in the top menu
    if (defined("context") && context == "polls" && $pgowner == $_SESSION['userid']) {
      $PAGE->menu[]= array (
        'name' => 'polls',
        'html' => '<li><a href="' . $CFG->wwwroot . $_SESSION['username'] . '/polls/" class="selected">' .
                  __gettext("Polls") .'</a></li>');
    } else {
      $PAGE->menu[]= array (
        'name' => 'polls',
        'html' => '<li><a href="' . $CFG->wwwroot . $_SESSION['username'] . '/polls/">' . __gettext("Polls") .
                   '</a></li>');
    }

    if (profile_permissions_check("profile") && defined("context") && context == "polls") {

      if (user_type($pgowner) == "person") {
        $PAGE->menu_sub[]= array (
          'name' => 'polls:view',
          'html' => '<a href="' . $CFG->wwwroot . $_SESSION['username'] . '/polls/">' . __gettext("View Polls") . '</a>');

        $PAGE->menu_sub[]= array (
          'name' => 'polls:create',
          'html' => '<a href="' . $CFG->wwwroot . $_SESSION['username'] . '/polls/create">' . __gettext("Create Poll") . '</a>');

        $PAGE->menu_sub[]= array (
          'name' => 'polls:history',
          'html' => '<a href="' . $CFG->wwwroot . $_SESSION['username'] . '/polls/history">' . __gettext("History") . '</a>');

      }
    }
  }

}
function polls_init() {

global $CFG, $function, $db, $METATABLES;
// Functions to perform initializacion

//Database Polls
if (!get_config('polls')) {
		if (file_exists(dirname(__FILE__) . "/" . $CFG->dbtype . ".sql")) {
			modify_database(dirname(__FILE__) . "/" . $CFG->dbtype . ".sql");
		} else {
			error("Error: Your database ($CFG->dbtype) is not yet fully supported by the Elgg polls plug-in.  See the mod/polls directory.");
		}
    set_config('polls',time());
	}



  $function['polls:init'][] = $CFG->dirroot . "mod/polls/lib/polls_init.php";

  // Create polls
  $function['polls:new'][] = $CFG->dirroot . "mod/polls/lib/polls_new.php";
/*
  // View a message
  */
  $function['polls:view'][] = $CFG->dirroot . "mod/polls/lib/polls_view.php";
  $function['polls:poll:view'][] = $CFG->dirroot . "mod/polls/lib/polls_poll_view.php";
  $function['polls:detailedview'][] = $CFG->dirroot . "mod/polls/lib/polls_poll_detailedview.php";
  $function['polls:pollforvotation'][] = $CFG->dirroot . "mod/polls/lib/poll_for_votation.php";


  // Sidebar display function
  $function['display:sidebar'][] = $CFG->dirroot . "mod/polls/lib/current_polls_info.php";
  
  // JpGraph
  // http://www.aditus.nu/jpgraph/index.php
  //$function['polls:jpgraph'][] = $CFG->dirroot . "mod/polls/jpgraph/src/elgg_polls/bartutex1.php";
  $function['polls:jpgraph'][] = $CFG->dirroot . "mod/polls/jpgraph/src/elgg_polls/gantt.php";

}
   
?>