<?php
/*
 * This script configure the templates used for the private messages plug-in
 *
 * @author Diego Andrés Ramírez Aragón <diego@somosmas.org>
 * @copyright Corporación Somos Más - 2007
*/
global $template;
global $template_definition;

$template['css'] .= file_get_contents($CFG->dirroot . "mod/polls/css.css");

// Registering template definitions
$template_definition[] = array ('id' => 'plug_polls',
                                'name' => __gettext("Poll List"),
                                'description' => __gettext("A template for the poll list"),
                                'glossary' => array ('{{polls}}' => __gettext("The list of polls"),
                                                     '{{paging}}' => __gettext("The list of page links when there are lots of polls"),
                                                     '{{from_to}}' => __gettext("From | To Label for the poll list"),
                                                     'action' => "",
                                                     'date' => '',
                                                     'subject' => '',
                                                     'actionMsg' => '',
                                                     'returnConfirm' => ''
                                                     )
                              );


$template_definition[] = array ('id' => 'plug_poll',
                                'name' => __gettext("Poll"),
                                'description' => __gettext("A template for each poll"),
                                'glossary' => array ('{{date}}' => __gettext("The time and date of the poll"),
                                                     '{{title}}' => __gettext("Poll title"),
                                                     '{{from_username}}' => __gettext("The username from the sender"),
                                                     '{{from_name}}' => __gettext("The full name from the sender"),
                                                     '{{from_icon}}' => __gettext("The icon from the sender"),
                                                     '{{msg_style}}' => __gettext("The poll status style (read|unread)")
                                                     )
                                );

$template_definition[] = array ('id' => 'plug_detailedpoll',
                                'name' => __gettext("Poll"),
                                'description' => __gettext("A template for each poll"),
                                'glossary' => array ('{{date}}' => __gettext("The time and date of the poll"),
                                                     '{{title}}' => __gettext("Poll title"),
                                                     '{{from_username}}' => __gettext("The username from the sender"),
                                                     '{{from_name}}' => __gettext("The full name from the sender"),
                                                     '{{from_icon}}' => __gettext("The icon from the sender"),
                                                     '{{body}}' => __gettext("The poll body text"),
                                                     '{{links}}' => __gettext("Links related with the poll (delete|reply)")
                                                     )
                                );


$template['plug_poll'] = file_get_contents(dirname(__FILE__)."/templates/polls_polls.html");
$template['plug_poll'] = file_get_contents(dirname(__FILE__)."/templates/polls_polls.html");
$template['plug_detailedpoll'] = file_get_contents(dirname(__FILE__)."/templates/polls_detailed_poll.html");

?>