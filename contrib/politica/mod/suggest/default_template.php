<?php
/*
 * Created on Aug 1, 2007
 *
 * @author Diego Andrés Ramírez Aragón <diego@somosmas.org>
 * @copyright Corporación Somos más - 2007
 */
global $template;

$template['suggest:container'] = file_get_contents(dirname(__FILE__)."/templates/container.html");
$template['suggest:list'] = file_get_contents(dirname(__FILE__)."/templates/list.html");
$template['suggest:detail'] = file_get_contents(dirname(__FILE__)."/templates/detail.html");
?>
