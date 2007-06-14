<?php
/*
 * This script configure the templates used for the private messages plug-in
 *
 * @author Diego Andrés Ramírez Aragón <diego@somosmas.org>
 * @copyright Corporación Somos Más - 2007
*/
global $template;
global $template_definition;

$template['css'] .= file_get_contents($CFG->dirroot . "mod/messages/css.css");

// Registering template definitions
$template_definition[] = array ('id' => 'plug_messages',
                                'name' => __gettext("Message List"),
                                'description' => __gettext("A template for the message list"),
                                'glossary' => array ('{{messages}}' => __gettext("The list of messages themselves"),
                                                     '{{paging}}' => __gettext("The list of page links when there are lots of messages"),
                                                     '{{from_to}}' => __gettext("From | To Label for the message list"),
                                                     'action' => "",
                                                     'date' => '',
                                                     'subject' => '',
                                                     'actionMsg' => '',
                                                     'returnConfirm' => ''
                                                     )
                              );


$template_definition[] = array ('id' => 'plug_message',
                                'name' => __gettext("Message"),
                                'description' => __gettext("A template for each message"),
                                'glossary' => array ('{{date}}' => __gettext("The time and date of the message"),
                                                     '{{title}}' => __gettext("Message title"),
                                                     '{{from_username}}' => __gettext("The username from the sender"),
                                                     '{{from_name}}' => __gettext("The full name from the sender"),
                                                     '{{from_icon}}' => __gettext("The icon from the sender"),
                                                     '{{msg_style}}' => __gettext("The message status style (read|unread)")
                                                     )
                                );

$template_definition[] = array ('id' => 'plug_detailedmessage',
                                'name' => __gettext("Message"),
                                'description' => __gettext("A template for each message"),
                                'glossary' => array ('{{date}}' => __gettext("The time and date of the message"),
                                                     '{{title}}' => __gettext("Message title"),
                                                     '{{from_username}}' => __gettext("The username from the sender"),
                                                     '{{from_name}}' => __gettext("The full name from the sender"),
                                                     '{{from_icon}}' => __gettext("The icon from the sender"),
                                                     '{{body}}' => __gettext("The message body text"),
                                                     '{{links}}' => __gettext("Links related with the message (delete|reply)")
                                                     )
                                );


$template['plug_messages'] = file_get_contents(dirname(__FILE__)."/templates/messages_messages.html");
$template['plug_message'] = file_get_contents(dirname(__FILE__)."/templates/messages_message.html");
$template['plug_detailedmessage'] = file_get_contents(dirname(__FILE__)."/templates/messages_detailed_message.html");

?>