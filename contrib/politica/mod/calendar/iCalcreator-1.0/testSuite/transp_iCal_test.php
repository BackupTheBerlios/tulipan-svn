<?php // transp_iCal_test.php

require_once '../iCalcreator.class.php';

$c = new vcalendar ();

$e = new vevent();
$e->setComment( "1: Transparent" );
$e->setTransp( "Transparent" );
$c->addComponent( $e );

$e = new vevent();
$e->setProperty( 'Comment'
               , "2: 'OPAQUE', array( 'visible' => 'occupied' )");
$e->setProperty( 'tranSp'
               , "OPAQUE"
               , array( 'visible' => 'occupied' ));
$c->addComponent( $e );

// $str = $c->createCalendar();
// echo $str;
$c->returnCalendar( FALSE, 'test.ics' );
?>