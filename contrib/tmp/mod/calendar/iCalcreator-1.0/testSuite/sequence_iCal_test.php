<?php // sequence_iCal_test.php

require_once '../iCalcreator.class.php';

$c = new vcalendar ();

$e = new vevent();
$e->setComment( "1: 2" );
$e->setSequence( 2 );
$c->addComponent( $e );

$e = new vevent();
$e->setProperty( 'Comment', "2: 2, array( 'xparamKey' => 'xparamValue' ");
$e->setProperty( 'Sequence', 2, array( 'xparamKey' => 'xparamValue' ));
$c->addComponent( $e );

$e = new vevent();
$e->setComment( "3: 4, array( 'x-number' => 'FOUR' )");
$e->setSequence( 4, array( 'x-number' => 'FOUR' ));
$c->addComponent( $e );

// $str = $c->createCalendar();
// echo $str."<br />";
$c->returnCalendar( FALSE, 'test.ics' );

?>