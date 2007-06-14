<?php // location_iCal_text.php

require_once '../iCalcreator.class.php';

$c = new vcalendar ();
$c->unique_id = 'kigkonsult.se';

$e = new vevent();
$e->setcomment ( '1  Målilla-avdelningen' );
$e->setProperty( 'location', 'Målilla-avdelningen' );
$c->addComponent( $e );

$e = new vevent();
$e->setLanguage( 'no' );
$e->setProperty( 'Comment', "2  setLanguage( 'no' ) 'Målilla-avdelningen' ");
$e->setLocation ( 'Målilla-avdelningen' );
$c->addComponent( $e );

$e = new vevent();
$e->setLanguage( 'no' );
$e->setProperty( 'COMMENT'
               , "3  setLanguage( 'no' ) 'Målilla-avdelningen', array( 'altrep' => 'Buckingham Palace', 'Xparam', 'language' => 'se' )" );
$e->setProperty( 'LOCATION'
               , 'Målilla-avdelningen'
               , array( 'altrep' => 'Buckingham Palace', 'Xparam', 'language' => 'se' ));
$c->addComponent( $e );


$str = $c->createCalendar();
echo $str;
// $c->returnCalendar( FALSE, 'test.ics' );
