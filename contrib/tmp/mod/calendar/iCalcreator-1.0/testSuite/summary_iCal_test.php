<?php // summary_iCal_test.php

require_once '../iCalcreator.class.php';


$c = new vcalendar ();
$c->setFormat( "xcal" );

$e = new vevent();
$e->setDescription( "Here is a newline character
and here is another one
period" );
$e->setSummary( "Here is a newline character
and here is another one
period" );
$c->addComponent( $e );

$e = new vevent();
$e->setProperty( 'Description', "'This is a summary for the event', array( 'altrep' => 'This is another summary for the event', 'language' => 'de' )");
$e->setProperty( 'Summary'
               , "This is a summary for the event"
               , array( 'altrep' => 'This is another summary for the event'
                      , 'language' => 'de' ));
$c->addComponent( $e );

$e = new vevent();
$e->setLanguage( 'fr' );
$e->setDescription( "setLanguage( 'fr' ); 'This is a summary for the event', array( 'altrep' => 'This is another summary for the event','singing_in_the_rain' =>  'April in Paris', 'language' => 'se' )");
$e->setProperty( 'Summary'
               , "This is a summary for the event"
               , array( 'altrep'              => 'This is another summary for the event'
                      , 'singing_in_the_rain' => 'April in Paris'
                      , 'language'            => 'se' ));
$c->addComponent( $e );


$str = $c->createCalendar();
$str = str_replace( "<", "&lt;", $str );
$str = str_replace( ">", "&gt;", $str );
echo $str;
// $c->returnCalendar( FALSE, 'test.xml' );

?>