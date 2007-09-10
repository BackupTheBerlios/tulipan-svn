<?php // percentcomplete_iCal_text.php

require_once '../iCalcreator.class.php';

$c = new vcalendar ();
$c->unique_id = 'kigkonsult.se';

$t = new vtodo();
$t->setComment( '1: 90' );
$t->setPercentComplete( 90 );
$c->addComponent( $t );

$t = new vtodo();
$t->setProperty( 'comment', "2: 75, array( 'xparamKey' => 'xparamValue', 'yParam' )");
$t->setProperty( 'Percent-Complete'
               , 75
               , array( 'xparamKey' => 'xparamValue'
                      , 'yParam' ));
$c->addComponent( $t );

// $str = $c->createCalendar();
// echo $str;
$c->returnCalendar( FALSE, 'test.ics' );
