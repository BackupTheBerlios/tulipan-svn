<?php // requeststatus_iCal_test.php

require_once '../iCalcreator.class.php';

$c = new vcalendar ();
$c->setFormat( "xcal" );

$e = new vevent();
$e->setComment( "1.00, '1 hejsan hejsan', '1 gammalt fel, som skickats igen'" );
$e->setRequestStatus( 1.00, '1 hejsan hejsan', '1 gammalt fel, som skickats igen' );
$c->addComponent( $e );
$e = new vevent();
$e->setProperty( 'Comment', "2.00, '2 hejsan hejsan', '2 gammalt fel, som skickats igen', array ( 'xparamKey' => 'xparamValue')");
$e->setProperty( 'Request-Status'
               , 2.00
               , '2 hejsan hejsan', '2 gammalt fel, som skickats igen'
               , array ( 'xparamKey' => 'xparamValue'));
$c->addComponent( $e );
$e = new vevent();
$e->setComment( "3.00, '3 hejsan hejsan', '3 gammalt fel, som skickats igen', array( 'language' => 'se', 'yParam' )");
$e->setProperty( 'request-status'
               , 3.00
               , '3 hejsan hejsan'
               , '3 gammalt fel, som skickats igen'
               , array( 'language' => 'se', 'yParam' ));
$c->addComponent( $e );

$str = $c->createCalendar();
$str = str_replace( "<", "&lt;", $str );
$str = str_replace( ">", "&gt;", $str );
echo $str."<br />";
// $c->returnCalendar( FALSE, 'test.xml' );

?>