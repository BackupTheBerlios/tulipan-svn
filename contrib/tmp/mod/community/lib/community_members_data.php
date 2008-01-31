<?php


/*
 * community_members_data.php
 *
 * Created on May 4, 2007
 *
 * @author Diego Andr�s Ram�rez Arag�n <diego@somosmas.org>
 * @copyright Corporaci�n Somos m�s - 2007
 */
global $CFG;

if (isset ($parameter)) {
  $community_id= $parameter[0];
  if (count($parameter) == 2) {
    $limit= $parameter[1];
  }

  $query= 'SELECT u.*, f.ident AS friendident FROM ' . $CFG->prefix . 'friends f
                                     JOIN ' . $CFG->prefix . 'users u ON u.ident = f.owner
                                     WHERE f.friend = ' . $community_id . ' AND u.user_type = ' . "'person'";

  if (COMMUNITY_ALLOW_COMMUNITY_TYPE_MEMBERS) {
    $query= 'SELECT u.*, f.ident AS friendident FROM ' . $CFG->prefix . 'friends f
                                       JOIN ' . $CFG->prefix . 'users u ON u.ident = f.owner
                                       WHERE f.friend = ' . $community_id;
  }
  if($limit!=null){
    $query.= " LIMIT $limit";
  }

  $run_result= get_records_sql($query);
}
?>
