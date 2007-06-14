<?php // created_iCal_test.php

require_once '../iCalcreator.class.php';

$c = new vcalendar ();

$e = new vevent();
$e->setClass( 'PRIVATE' );
$c->addComponent( $e );

$e = new vevent();
$e->setProperty( 'CLASS', 'CONFIDENTIAL', array( 'xparam1', 'xparamKey' => 'xparamValue' ));
$c->addComponent( $e );

// $str = $c->createCalendar();
// echo $str."<br />";
$c->returnCalendar( FALSE, 'test.ics' );

?>
