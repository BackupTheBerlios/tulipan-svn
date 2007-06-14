<?php
 // action_iCal_test.php
require_once '../iCalcreator.class.php';
$c = new vcalendar;

$e = new valarm();
$e->setDescription( 'AUDIO' );
$e->setAction( 'AUDIO' );
$c->addComponent( $e );

$e = new valarm();
$e->setDescription( "'AUDIO', array( 'Glaskrasch' )");
$e->setProperty( 'Action' ,'AUDIO', array( 'Glaskrasch' ));
$c->addComponent( $e );

$e = new valarm();
$e->setDescription( "'AUDIO', array('Glaskrasch', 'kristallkrona', 'silverbricka' )");
$e->setAction( 'AUDIO', array('Glaskrasch', 'kristallkrona', 'silverbricka' ));
$c->addComponent( $e );

// $str = $c->createCalendar();
// echo $str;

$c->returnCalendar( FALSE, 'test.ics' );
?>