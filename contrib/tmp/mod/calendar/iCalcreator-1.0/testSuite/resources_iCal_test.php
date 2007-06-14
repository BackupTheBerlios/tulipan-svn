<?php // resources_iCal_test.php

require_once '../iCalcreator.class.php';

$c = new vcalendar ();

$e = new vevent();
$e->setComment( "1: 'Ficklampa', array( 'altrep' => 'trattgrammofon' )" );
$e->setResources( 'Ficklampa', array( 'altrep' => 'trattgrammofon' ));
$e->setLocation( 'Buckingham Palace' );
$e->setComment( "2: array( 'Oljekanna', 'trassel' )" );
$e->setResources( array( 'Oljekanna', 'trassel' ));
$c->addComponent( $e );

$e = new vevent();
$e->setLanguage( 'no' );
$e->setProperty( 'Comment', "3: 'Ficklampa', array( 'altrep' => 'trattgrammofon' )" );
$e->setProperty( 'resources'
               , 'Ficklampa'
               , array( 'altrep' => 'trattgrammofon' ));
$e->setProperty( 'Location', 'Buckingham Palace' );
$e->setComment( "4: array( 'Oljekanna', 'trassel' )" );
$e->setResources( array( 'Oljekanna', 'trassel' ));
$c->addComponent( $e );

$e = new vevent();
$e->setProperty( 'Comment', "5: array( 'Oljekanna', 'trassel' ), array( 'language' => 'se', 'yParam', 'altrep' => 'rundsmörjningsgrejjor' )" );
$e->setLanguage( 'no' );
$e->setProperty( 'Location', 'Buckingham Palace' );
$e->setproperty( 'resources'
               , array( 'Oljekanna', 'trassel' )
               , array( 'language' => 'se'
                      , 'yParam'
                      , 'altrep' => 'rundsmörjningsgrejjor' ));
$e->setComment( "'6: Ficklampa', array( 'trattgrammofon' )" );
$e->setResources( 'Ficklampa', array( 'trattgrammofon' ));
$c->addComponent( $e );

// $str = $c->createCalendar();
// echo $str."<br />";
$c->returnCalendar( FALSE, 'test.ics' );

?>