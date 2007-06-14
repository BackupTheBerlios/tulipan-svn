<?php // completed_iCal_text.php

require_once '../iCalcreator.class.php';

$c = new vcalendar ();
$c->unique_id = 'kigkonsult.se';

$e = new vevent();
$e->setProperty( 'Description', '11.2345, -32.5678' );
$e->setGeo( 11.2345, -32.5678 );
$c->addComponent( $e );

$e = new vevent();
$e->setDescription( '11.2345, -32.5678, array( xparamValue, yparamKey=>yparamValue)' );
$e->setProperty( 'geo'
               , 11.2345, -32.5678
               , array( 'xparamValue', 'yparamKey' => 'yparamValue' ));
$c->addComponent( $e );

// $str = $c->createCalendar();
// echo $str;
$c->returnCalendar( FALSE, 'test.ics' );
