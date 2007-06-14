<?php // description_iCal_test.php

require_once '../iCalcreator.class.php';

$c = new vcalendar ();
$c->setFormat( "xcal" );
$c->unique_id = 'kigkonsult.se';

$e = new vevent();
$e->setDescription( 'This is a dexcription' );
$c->addComponent( $e );

$e = new vevent();
$e->setLanguage( 'no' );
$e->setComment ( "setLanguage( 'no' )  'This is a dexcription' ");
$e->setProperty( 'Description', 'This is a dexcription' );
$c->addComponent( $e );

$e = new vevent();
$e->setLanguage( 'no' );
$e->setComment( "setLanguage( 'no' ) 'This is description2', array( 'altrep' => 'This is an alternative annotation', 'hejsan', 'language' => 'da' )" );
$e->setDescription( 'This is description2'
                  , array( 'altrep' => 'This is an alternative annotation'
                         , 'hejsan'
                         , 'language' => 'da' ));
$c->addComponent( $e );

$e = new vevent();
$e->setConfig( 'language'
             , 'en' );
$e->setComment( "setLanguage( 'en' ), 'å i åa ä e ö sa Yngve Öst, Ärligt och Ångerfyllt', array( 'altrep' => 'This is an alternative annotation', 'hejsan', 'xparamKey' => 'xparamvalue' )" );
$e->setProperty( 'description'
                , 'å i åa ä e ö sa Yngve Öst, Ärligt och Ångerfyllt'
                , array( 'altrep' => 'This is an alternative annotation'
                       , 'hejsan'
                       , 'xparamKey' => 'xparamvalue' ));
$c->addComponent( $e );

$str = $c->createCalendar();
$str = str_replace( "<", "&lt;", $str );
$str = str_replace( ">", "&gt;", $str );
echo $str."<br />";
// $c->returnCalendar( FALSE, 'test.xml' );

?>