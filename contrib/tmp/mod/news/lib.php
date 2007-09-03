<?php
/*
 * This script initialize the enviroment for show the message list
 * @author Johan Eduardo Quijano Garcia <gerencia@treszero.com>
 * @author Andrea Ximena Bocanegra Soto <sistemas@treszero.com>
 * @copyright Tres Zero - 2007
 */


function news_pagesetup() {
  // register links --
    global $metatags,$function,$USER;
    global $profile_id;
    global $PAGE;
    global $CFG;
    global $page_owner;

  $pgowner= $profile_id;

  //require_once $CFG->dirroot . "mod/polls/lib/polls_config.php";
  //require_once $CFG->dirroot . "mod/polls/default_template.php";

  if (isloggedin() && user_info("user_type", $_SESSION['userid']) != "external") {
    // Add the JavaScript functions
    // Lose the trailing slash
    $url= substr($CFG->wwwroot, 0, -1);
    $metatags .= "<script language=\"javascript\" type=\"text/javascript\" src=\"$url/mod/news/polls.js\"></script>";
    $metatags .= "<link rel=\"stylesheet\" href=\"" . $CFG->wwwroot . "/mod/news/css.css\" type=\"text/css\" media=\"screen\" />";

    //$messages = count_records_select('polls','to_id='.$USER->ident." AND status='unread'");
    if (defined("context") && context == "news" && $pgowner == $_SESSION['userid']) {
      $PAGE->menu[]= array (
        'name' => 'polls',
        'html' => '<li><a href="' . $CFG->wwwroot . $_SESSION['username'] . '/news/" class="selected">' .
                  __gettext("News") .'</a></li>');
    } else {
      $PAGE->menu[]= array (
        'name' => 'polls',
        'html' => '<li><a href="' . $CFG->wwwroot . $_SESSION['username'] . '/news/">' . __gettext("News") .
                   '</a></li>');
    }

    if (profile_permissions_check("profile") && defined("context") && context == "news") {

      if (user_type($pgowner) == "person") {
        $PAGE->menu_sub[]= array (
          'name' => 'polls:view',
          'html' => '<a href="' . $CFG->wwwroot . $_SESSION['username'] . '/news/">' . __gettext("View News") . '</a>');

        $PAGE->menu_sub[]= array (
          'name' => 'polls:create',
          'html' => '<a href="' . $CFG->wwwroot . $_SESSION['username'] . '/news/create">' . __gettext("Create News") . '</a>');

        $PAGE->menu_sub[]= array (
          'name' => 'polls:history',
          'html' => '<a href="' . $CFG->wwwroot . $_SESSION['username'] . '/news/history">' . __gettext("History") . '</a>');

	/*$PAGE->menu_sub[]= array (
          'name' => 'polls:best',
          'html' => '<a href="' . $CFG->wwwroot . $_SESSION['username'] . '/polls/sent">' . __gettext("Best Polls") . '</a>');*/
      }
    }
  }

}
function news_init() {

global $CFG, $function, $db, $METATABLES;
// Functions to perform initializacion
     if (!get_config('news')) {

		if (file_exists(dirname(__FILE__) . "/" . $CFG->dbtype . ".sql")) {
			modify_database(dirname(__FILE__) . "/" . $CFG->dbtype . ".sql");
		} else {
			error("Error: Your database ($CFG->dbtype) is not yet fully supported by the Elgg suggest plug-in.  See the mod/suggest directory.");
		}
    set_config('news',time());
	}


  $function['news:init'][] = $CFG->dirroot . "mod/news/lib/news_init.php";

  // Create/ Delete news

  $function['news:new'][] = $CFG->dirroot . "mod/news/lib/news_new.php";
  $function['news:new:body'][] = $CFG->dirroot . "units/tinymce/tinymce_js.php";
/*
  // View a message
  */
  //$function['polls:view'][] = $CFG->dirroot . "mod/polls/lib/polls_view.php";
  //$function['polls:poll:view'][] = $CFG->dirroot . "mod/polls/lib/polls_poll_view.php";
  //$function['polls:detailedview'][] = $CFG->dirroot . "mod/polls/lib/polls_poll_detailedview.php";
  //$function['polls:pollforvotation'][] = $CFG->dirroot . "mod/polls/lib/poll_for_votation.php";


  // Sidebar display function
  //$function['messages:contact:link'][] = $CFG->dirroot ."/mod/messages/lib/messages_sidebar_link.php";
  //$function['users:infobox:menu:text'][] = $CFG->dirroot ."/mod/messages/lib/messages_sidebar_link.php";

  //$function['display:sidebar'][] = $CFG->dirroot . "mod/polls/sidebar/current_polls_info.php";
  //$function['polls:info'][]= $CFG->dirroot . "mod/polls/sidebar/poll_sidebar.php";
  // JpGraph
  // http://www.aditus.nu/jpgraph/index.php

  //$function['polls:jpgraph'][] = $CFG->dirroot . "mod/polls/jpgraph/src/elgg_polls/bartutex1.php";
  //$function['polls:jpgraph_bar'][] = $CFG->dirroot . "mod/polls/jpgraph/src/jpgraph_bar.php";


}


   
?>