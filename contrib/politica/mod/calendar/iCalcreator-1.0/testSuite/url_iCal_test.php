<?php // url_iCal_test.php

require_once '../iCalcreator.class.php';

$c = new vcalendar ();

$e = new vevent();
$e->setUnique_id( 'domain.net' );
$e->setComment( "URL set to http://www.icaldomain.net, xparam= 'IP-num' => '123.456.789.123'" );
$e->setUrl( 'http://www.icaldomain.net', array( 'IP-num' => '123.456.789.123' ));
$c->addComponent( $e );

$e2 = new vevent();
$e2->setUnique_id( 'domain2.net' );
$e2->setProperty( 'Comment'
                , "URL set to http://www.icaldomain2.net, xparam= 'IP-num' => '222.222.222.222'" );
$e2->setProperty( 'url'
                , 'http://www.icaldomain2.net'
                , array( 'IP-num' => '222.222.222.222' ));
$c->addComponent( $e2 );

// $str = $c->createCalendar();
// echo $str;
$c->returnCalendar( FALSE, 'test.ics' );

?>