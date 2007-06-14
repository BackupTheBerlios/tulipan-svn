<?php // created_iCal_test.php

require_once '../iCalcreator.class.php';

$c = new vcalendar ();

$e = new vevent();
$e->setComment( 'generate (auto) uid' );
$e->setComment(  $e->getUid());
$c->addComponent( $e );

$e = new vevent();
$e->setProperty( 'Uid', '19960401T080045Z-4000F192713-0052@host1.com' );
$e->setProperty( 'Comment', 'set (store) uid' );
$e->setproperty( 'comment', $e->getUid());
$c->addComponent( $e );

// $str = $c->createCalendar();
// echo $str;
$c->returnCalendar( FALSE, 'test.ics' );

?>