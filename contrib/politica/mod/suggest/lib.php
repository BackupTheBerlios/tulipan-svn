<?php

/*
 * Created on Aug 1, 2007
 *
 * @author Diego Andrés Ramírez Aragón <diego@somosmas.org>
 * @copyright Corporación Somos más - 2007
 */


function suggest_pagesetup() {
	global $CFG, $metatags;

  require_once dirname(__FILE__) . "/config.php";
	
  $metatags .= "<link rel=\"stylesheet\" href=\"" . $CFG->wwwroot . "mod/suggest/css.css\" type=\"text/css\" media=\"screen\" />";

}

function suggest_init() {
	global $CFG;
	$CFG->templates->variables_substitute['suggest'][] = "suggest_mainbody";

	if (!get_config('suggest')) {
		if (file_exists(dirname(__FILE__) . "/" . $CFG->dbtype . ".sql")) {
			modify_database(dirname(__FILE__) . "/" . $CFG->dbtype . ".sql");
		} else {
			error("Error: Your database ($CFG->dbtype) is not yet fully supported by the Elgg suggest plug-in.  See the mod/suggest directory.");
		}
    set_config('suggest',time());
	}
	$CFG->widgets->list[] = array (
		'name' => __gettext("Suggestion's widget"), 
    'description' => __gettext("Displays a list with users and content suggested by your interests."), 
    'type' => "suggest::suggest");

	if (!file_exists($CFG->dataroot . "cache/suggest")) {
		@mkdir($CFG->dataroot . "cache/suggest");
	}
}

/**
 * Function that displays the widget edit form
 * 
 * @param object $widget Widget Object
 * @return string HTML form 
 */
function suggest_widget_edit($widget) {
	global $CFG, $page_owner,$suggest_queries;

	$queries_ = $suggest_queries;
	$suggest_types = widget_get_data("suggest_types", $widget->ident);
	$suggest_types = explode(';', $suggest_types);

	$suggest_number = widget_get_data("suggest_number", $widget->ident);
	$suggest_number = ($suggest_number <= 0) ? SUGGEST_SUGGESTIONS : $suggest_number;

	$title = __gettext("Suggest widget");
	$explanation = __gettext("Configure the type of content about what you want to be suggested and how many of them you like to see");
	$content_types = __gettext("Content types");
	$number = __gettext("Number of suggestions");
	$disclaimer = __gettext("Currently this feature only work in the private access mode.<br> The suggestion are made only for the current logged user. This mean you.");
	$button_label = __gettext("Save");

	$all_['all']['title'] = __gettext("All");
	$queries_ = array_merge($all_, $queries_);
	foreach ($queries_ as $key => $query) {
		$types .= "<option value=\"$key\"";
		if (is_array($suggest_types) && in_array($key, $suggest_types)) {
			$types .= " selected=\"selected\" ";
		}
		$types .= ">";
		if (array_key_exists('title', $query)) {
			$types .= $query['title'];
		} else {
			$types .= ucfirst($key);
		}
		$types .= "</option>\n";
	}

	$body = file_get_contents(dirname(__FILE__) . "/templates/suggest_widget.html");
	$body = str_replace('{{title}}', $title, $body);
	$body = str_replace('{{explanation}}', $explanation, $body);
	$body = str_replace('{{content_types}}', $content_types, $body);
	$body = str_replace('{{suggest_types}}', $types, $body);
	$body = str_replace('{{number}}', $number, $body);
	$body = str_replace('{{suggest_number}}', $suggest_number, $body);
	$body = str_replace('{{button_label}}', $button_label, $body);
	$body = str_replace('{{disclaimer}}', $disclaimer, $body);

	return $body;
}
/**
 * The widget display
 * 
 * @param object $widget The widget object
 * @return string Widget's HTML
 */
function suggest_widget_display($widget) {
	global $CFG,$suggest_queries;

	$suggest_types = widget_get_data("suggest_types", $widget->ident);
	$suggest_number = widget_get_data("suggest_number", $widget->ident);
	$suggest_number = ($suggest_number <= 0) ? SUGGEST_SUGGESTIONS : $suggest_number;

	$vars[] = "suggest";
	$vars[] = $suggest_number;
	$vars[] = $suggest_types;

	return array (
		'content' => suggest_mainbody($vars,
		'widget_'
	));
}

/**
 * This function return a table with suggested contend for the current user.
 *
 * This function is called when the {{suggest}} keyword is placed somewhere in the templates.
 * You can pass extra parameters to especify the type of content that you want to see.
 * This is the syntax that you can use:
 * <pre>     
 *      {{siteusers:[0-5]+:type}}
 * </pre>
 * The defaults returns five users and five contents<br>
 * You can extend this behavior adding your own 'type' and 'queries' in the 'config.php' file
 * <br>
 *  Examples:<br>
 *      {{suggest}}
 *        Suggest five users and five blog posts
 *      {{suggest:10:user}}
 *        Suggest 10 users
 *      {{suggest:5:weblog}}
 *        Suggest five blog posts
 * @param array $vars Parameters array
 * @param string $style The style prefix to be used
 * @return string HTML code
 */
function suggest_mainbody($vars, $style = "") {
	global $CFG,$suggest_queries;

  include_once dirname(__FILE__) . "/config.php";
  
	$type = "all";
	$number = (count($vars) >= 2) ? $vars[1] : SUGGEST_SUGGESTIONS;
	$type = (count($vars) >= 3) ? $vars[2] : "all";

	if (page_owner() == $_SESSION['userid']) {

		if ($type != "all" && array_key_exists($type, $suggest_queries)) {
			$title = $suggest_queries[$type]['title'];
			$schema = (!empty ($query['schema'])) ? $query['schema'] : "";

			$query = $suggest_queries[$type]['query'];
			$query = str_replace('{{limit}}', $number, $query);

			$results = suggest_cache($_SESSION['userid'] . $type);
			if (empty ($results)) {
				$results = get_records_sql($query);
				suggest_set_cache($_SESSION['userid'] . $type, $results);
			}
			if (SUGGEST_FILTER && $type != "user") {
				$results_ = tracking_filter($_SESSION['userid'], $type, $results);
				if (count($results_) != count($results)) {
					suggest_set_cache($_SESSION['userid'] . $type, $results_);
					$results = $results_;
				}
			}

			$suggestions .= suggest_display($title, $results, $type, $schema, $style);
		} else {
			foreach ($suggest_queries as $key => $query) {
				$schema = (!empty ($query['schema'])) ? $query['schema'] : "";
				$query_ = $query['query'];
				$query_ = str_replace('{{limit}}', $number, $query_);

				$results = suggest_cache($_SESSION['userid'] . $key);
				if (empty ($results)) {
					$results = get_records_sql($query_);
					suggest_set_cache($_SESSION['userid'] . $key, $results);
				}
				if (SUGGEST_FILTER && $key != "user") {
					$results_ = tracking_filter($_SESSION['userid'], $key, $results);
					if (count($results_) != count($results)) {
						suggest_set_cache($_SESSION['userid'] . $key, $results_);
						$results = $results_;
					}
				}
				$suggestions .= suggest_display($query['title'], $results, $key, $schema, $style);
			}
		}

		if (!empty ($suggestions)) {
			$title = __gettext("Suggestions");
			return templates_draw(array (
				'context' => 'suggest:container',
				'style' => $style,
				'title' => $title,
				'content' => $suggestions
			));
		}
	}
}

/**
 * Returns the HTML with the information from the specified objects
 *
 * Those objects must to have the following properties:
 * <ul>
 *  <li>ident</li>
 *  <li>username</li>
 *  <li>name</li>
 *  <li>icon</li>
 * </ul> 
 * @param string $title Title
 * @param array $objects Objects to be displayed
 * @return string
 */
function suggest_display($title, $objects, $type, $url_schema = "{{username}}", $style = "") {
	require_once dirname(__FILE__) . "/default_template.php";

	if (is_array($objects) && !empty ($objects)) {
		foreach ($objects as $object) {
			$_GET['extension'] = $type;
			if (function_exists('icon_html')) {
				$image = icon_html($object->icon, 40);
			} else {
				$image = user_icon_html($object->icon, 40);
			}

			$url = url . "mod/suggest/tracking.php?username=" . $object->username . "&type=$type&ident=" . $object->ident;
			if (!empty ($url_schema)) {
				$url .= "&schema=" . urlencode($url_schema);
			}

			$image = "<a href=\"$url\">" . $image . "</a>";

			$content = $object->name;

			$result .= templates_draw(array (
				'context' => 'suggest:detail',
				'image' => $image,
				'content' => $content
			));
		}
		return templates_draw(array (
			'context' => 'suggest:list',
			'title' => $title,
			'suggestions' => $result,
			'style' => $style
		));
	}

	// Only show this message within widgets 
	if (strpos($style,"widget") !== false) {
		$result = sprintf(__gettext("<p>At the moment there are not '%s' that match your interests.<p>"), $title);
		return templates_draw(array (
			'context' => 'suggest:list',
			'title' => $title,
			'suggestions' => $result,
			'style' => $style
		));
	}
	return "";
}

/**
 * Gets the suggestion data from the cache for the specified userid
 * 
 * @param int $key Cache key
 * @return mixed The suggestion data available in the cache
 */
function suggest_cache($key) {
	global $CFG;

	$cache_file = $CFG->dataroot . "cache/suggest/" . md5($key);
	if (file_exists($cache_file)) {
		$timeout = @ filemtime($cache_file);
		if ($timeout < (time() - SUGGEST_CACHE_TIME)) {
			@ unlink($cache_file);
			return null;
		}
		return unserialize(file_get_contents($cache_file));
	}
	return null;
}

/**
 * Puts the suggestion info in the cache
 * 
 * @param int $key Cache key
 * @param mixed $data Data to be stored
 */
function suggest_set_cache($key, $data) {
	global $CFG;
	$cache_file = $CFG->dataroot . "cache/suggest/" . md5($key);
	$mr = fopen($cache_file, "w+");
	if ($mr) {
		fputs($mr, serialize($data));
		fclose($mr);
	}
}

/**
 * This functions filter the suggested data using the tracking data
 * 
 * @param int $id User id
 * @param string $type Data type
 * @param array $results Data to be filtered
 * @return array The filtered array
 */
function tracking_filter($id, $type, $results) {
	$response = array ();

	$filtered = get_records_select('suggest_tracking', "type='$type' AND userid = $id", null, '', 'contentid');
	$filtered = (!is_array($filtered)) ? array () : $filtered;

  if(is_array($results)){
  	foreach ($results as $result) {
  		if (!in_array($result->ident, array_keys($filtered))) {
  			$response[] = $result;
  		}
  	}
  }
	return $response;
}
?>
