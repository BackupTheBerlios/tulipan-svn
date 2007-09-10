<?php
/*
 * Created on Aug 1, 2007
 *
 * @author Diego Andrés Ramírez Aragón <diego@somosmas.org>
 * @copyright Corporación Somos más - 2007
 */

########################################## Suggestion Constants Config ####################################
/**
 * Define the cache timeout in seconds
 * Default value: 3600
 */
define('SUGGEST_CACHE_TIME',3600);

/**
 * Define the default number of suggestions
 * Default value: 3
 */
define('SUGGEST_SUGGESTIONS',3);

/**
 * Define if you want to use the suggest tracking feature
 * Default value: true
 */
define('SUGGEST_FILTER',true);

########################################## Suggestion Query Config ########################################
# You can extend/change the way the suggestions are done
# For add a new type of suggestions you only needs to add an entry in the $queries array.
# Where the first key match with the third param from the {{suggest}} keyword.
# A shor description about the mean of each key follow:
# 
# $suggest_queries[<type>]['title']			Is the section title header
# $suggest_queries[<type>]['schema']		Is the URL schema of the content.
#									In this schema you can use the following keywords:
#									  - {{username}}  
#									  - {{type}}
#									  - {{ident}}
# $suggest_queries[<type>]['query']			The SQL query to be executed to get the suggested content
#									Here you MUST to use the {{limit}} keyword to limit the number
#									of contents to be retrieved.
###########################################################################################################
global $db,$CFG,$suggest_queries;

# Suggested users and communities
##################################

$suggest_queries['user']['title'] = __gettext("Users and Communities");
$suggest_queries['user']['query'] = "SELECT u.ident,u.username,u.name, u.icon, count(t.tag) as metric FROM {$CFG->prefix}tags t";
$suggest_queries['user']['query'] .= " JOIN {$CFG->prefix}users u on u.ident = t.owner";
$suggest_queries['user']['query'] .= " WHERE t.tagtype = \"interests\" AND t.owner <> {$_SESSION['userid']}";
$suggest_queries['user']['query'] .= " AND tag in ( SELECT tag FROM {$CFG->prefix}tags WHERE tagtype = \"interests\"";
$suggest_queries['user']['query'] .= "              AND owner = {$_SESSION['userid']} ) ";
$suggest_queries['user']['query'] .= " AND u.ident NOT IN (SELECT friend FROM {$CFG->prefix}friends WHERE owner = {$_SESSION['userid']})";
$suggest_queries['user']['query'] .= " GROUP BY u.ident ORDER BY metric DESC LIMIT {{limit}}";


# Suggested weblog related posts (included extra context)
##############################################################
if (is_array($CFG->weblog_extensions)) {
	foreach ($CFG->weblog_extensions as $key => $value) {
		$suggest_queries[$key]['schema'] = "{{username}}/$key/{{ident}}.html";

		$suggest_queries[$key]['title'] = ucfirst($key);
		if (array_key_exists('name', $value)) {
			$suggest_queries[$key]['title'] = $value['name'];
		}

		$filter = array ();
		if ($key != 'weblog' && array_key_exists('type', $value)) {
			$nofilter[] = $value['type'];
			$filter[] = $value['type'];
		}
		if ($key != 'weblog' && array_key_exists('values', $value)) {
			if (is_array($value['values'])) {
				$nofilter = array_merge($value['values'], $nofilter);
			}
		}
		if ($key != 'weblog' && array_key_exists('extra_type', $value)) {
			if (is_array($value['extra_type'])) {
				$nofilter = array_merge($value['extra_type'], $nofilter);
				$filter = array_merge($value['extra_type'], $filter);
			}
		}

		$where = run("users:access_level_sql_where", $_SESSION['userid']);
		$where = str_replace("access", "w.access", $where);
		$where = str_replace("owner", "w.owner", $where);
		$filter = implode(',', array_map(array ($db,'qstr'), $filter));

		$suggest_queries[$key]['query'] = "SELECT w.ident,u.username,w.title as name, w.icon ";
		$suggest_queries[$key]['query'] .= " FROM {$CFG->prefix}users u, {$CFG->prefix}weblog_posts w";
		$suggest_queries[$key]['query'] .= " WHERE ($where) AND u.ident = w.owner";
		$suggest_queries[$key]['query'] .= " AND w.ident IN (SELECT w.ident FROM {$CFG->prefix}tags t, {$CFG->prefix}weblog_posts w";
		$suggest_queries[$key]['query'] .= "                 WHERE t.tagtype='weblog' ";
		$suggest_queries[$key]['query'] .= "                 AND t.tag IN (SELECT tag FROM {$CFG->prefix}tags WHERE tagtype = 'interests' AND owner={$_SESSION['userid']})";
		$suggest_queries[$key]['query'] .= "                 AND t.owner <> {$_SESSION['userid']} AND t.ref = w.ident";
		$suggest_queries[$key]['query'] .= "                 GROUP BY w.ident)";

		if ($key != "weblog" && !empty ($filter)) {
			$suggest_queries[$key]['query'] .= " AND w.ident IN (SELECT ref FROM {$CFG->prefix}tags WHERE tagtype='weblog' AND tag IN ($filter)";
			$suggest_queries[$key]['query'] .= "                 AND owner <> {$_SESSION['userid']})";
		} else {
			$suggest_queries[$key]['query'] .= " {{nofilter}}";
		}
		$suggest_queries[$key]['query'] .= " ORDER BY rand() DESC LIMIT {{limit}}";
	}

  if(is_array($nofilter)){
  	$nofilter = implode(',', array_map(array ($db,'qstr'), $nofilter));
  	$nofilter = " AND w.ident NOT IN (SELECT ref FROM {$CFG->prefix}tags WHERE tagtype='weblog' AND tag IN ($nofilter)";
  	$nofilter .= "                 AND owner <> {$_SESSION['userid']})";
  }

	$suggest_queries['weblog']['query'] = str_replace('{{nofilter}}', $nofilter, $suggest_queries['weblog']['query']);
}
?>
