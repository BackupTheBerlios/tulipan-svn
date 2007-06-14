<?php // created_iCal_test.php

require_once '../iCalcreator.class.php';

$c = new vcalendar ();

$e = new vevent();

$e->setComment( "This is a comment" );

$c->addComponent( $e );

$e = new vevent();
$e->setDescription( "'This is comment2', array( 'altrep' => 'This is an alternative annotation', 'hejsan', 'language' => 'da' )");
$e->setProperty( 'Comment', "This is comment2", array( 'altrep' => 'This is an alternative annotation', 'hejsan', 'language' => 'da' ));
$c->addComponent( $e );

$e = new vevent();
$e->setDescription( "'Å i åa ä e ö, sa Yngve Öst, ärligt och ångerfyllt', array( 'altrep' => 'This is an alternative annotation', 'hejsan', 'language' => 'da', 'xparamKey' => 'xparamvalue' )");
$e->setComment( "Å i åa ä e ö, sa Yngve Öst, ärligt och ångerfyllt", array( 'altrep' => 'This is an alternative annotation', 'hejsan', 'language' => 'da', 'xparamKey' => 'xparamvalue' ));
$e->setProperty( 'Comment', "This is a comment set via function setProperty" );
$c->addComponent( $e );

// $str = $c->createCalendar();
// echo $str."<br />";

$c->returnCalendar( FALSE, 'test.ics');
?>