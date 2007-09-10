<?php // priority_iCal_text.php

require_once '../iCalcreator.class.php';

$c = new vcalendar ();
$c->unique_id = 'kigkonsult.se';

$t = new vtodo();
$t->setComment( '1: 3' );
$t->setPriority( 3 );
$c->addComponent( $t );

$t = new vtodo();
$t->setProperty( 'comment'
               , "2: 2, array( 'priority' => 'HIGH', 'Important' )");
$t->setProperty( 'priority'
               , 2
               , array( 'priority' => 'HIGH', 'Important' ));
$c->addComponent( $t );

// $str = $c->createCalendar();
// echo $str;
$c->returnCalendar( FALSE, 'test.ics' );
