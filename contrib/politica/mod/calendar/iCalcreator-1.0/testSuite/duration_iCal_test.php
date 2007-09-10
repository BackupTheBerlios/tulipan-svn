<?php // duration_iCal_test.php

require_once '../iCalcreator.class.php';

$c = new vcalendar ();
$c->setFormat( "xcal" );
$o = new vtodo();
$o->setProperty( 'Duration', 1 );
$o->setComment( '1: 1' );
$c->addComponent( $o );

$o = new vtodo();
$o->setDuration( false, 2, FALSE, FALSE, FALSE, array( 'xparam' ) );
$o->setComment( "2: false, 2, FALSE, FALSE, FALSE, array( 'xparam' )" );
$c->addComponent( $o );

$o = new vtodo();
$o->setProperty( 'duration', false, 2, 3 );
$o->setComment( '3: false, 2, 3' );
$c->addComponent( $o );

$o = new vtodo();
$o->setDuration( false, false, 3, false, 5 );
$o->setComment( '4: false, false, 3, false, 5' );
$c->addComponent( $o );

$o = new vtodo();
$o->setProperty( 'duration'
               , array( 'day' => 2, 'hour' => 3, 'sec' => 5 )
               , array( 'xparamkey' => 'xparamvalue' ));
$o->setComment( "5: array( 'day' => 2, 'hour' => 3,  'sec' => 5 ), array( 'xparamkey' => 'xparamvalue' )" );
$c->addComponent( $o );

$o = new vtodo();
$o->setDuration( 'P1W' );
$o->setComment( '6: P1W' );
$c->addComponent( $o );

$o = new vtodo();
$o->setProperty( 'DURATION', 'PT3H4M5S' );
$o->setComment( '7: PT3H4M5S' );
$c->addComponent( $o );

$o = new vtodo();
$o->setDuration( 'P2DT4H' );
$o->setComment( '8: P2DT4H' );
$c->addComponent( $o );

$o = new vtodo();
$o->setProperty( 'Duration', 'PT4H' );
$o->setComment( '9: PT4H' );
$c->addComponent( $o );

$str = $c->createCalendar();
$str = str_replace( "<", "&lt;", $str );
$str = str_replace( ">", "&gt;", $str );
echo $str;
// $c->returnCalendar( FALSE, 'test.xml' );

/*
echo strtotime ("now"), "<br />
";
echo strtotime ("10 September 2000"), "<br />
";
echo strtotime ("+1 day"), "<br />
";
echo strtotime ("+1 week"), "<br />
";
echo strtotime ("+1 week 2 days 4 hours 2 seconds"), "<br />
";
echo strtotime ("next Thursday"), "<br />
";
echo strtotime ("last Monday"), "<br />
";

// LC_ALL=C TZ=UTC0 date
echo date( 'Y-m-d H:i:s Z', strtotime('Fri Dec 15 19:48:05 UTC 2000'));   echo "<br />
"; // test ###
echo date( 'Y-m-d H:i:s',   strtotime('Fri Dec 15 19:48:05'));            echo "<br />
"; // test ###
// TZ=UTC0 date +"%Y-%m-%d %H:%M:%SZ"
echo date( 'Y-m-d H:i:s Z', strtotime('2000-12-15 19:48:05Z'));           echo "<br />
"; // test ###
// date --iso-8601=seconds  # a GNU extension
echo date( 'Y-m-d H:i:s Z', strtotime('2000-12-15T11:48:05-0800'));       echo "<br />
"; // test ###
// date --rfc-822  # a GNU extension
echo date( 'Y-m-d H:i:s Z', strtotime('Fri, 15 Dec 2000 11:48:05 -0800'));echo "<br />
"; // test ###
// date +"%Y-%m-%d %H:%M:%S %z"  # %z is a GNU extension.
echo date( 'Y-m-d H:i:s Z', strtotime('2000-12-15 11:48:05 -0800'));      echo "<br />
"; // test ###

// string datestring // date in a string, acceptable by strtotime-command, only local time
*/
?>