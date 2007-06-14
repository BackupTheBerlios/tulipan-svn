<?php // dtend_iCal_test.php

require_once '../iCalcreator.class.php';
$c = new vcalendar ();

// test date in an array (excl. timestamp)
$o = new vtodo();
$o->setComment( 'A1a: short array( 1, 2, 3 ), position replaces key' );
$o->setProperty( 'Due', array( 1, 2, 3 ));
$c->addComponent( $o );

$o = new vtodo();
$o->setComment( 'A1b: short array( 1, 2, 3 ), position replace key, param: array(VALUE=>DATE)' );
$o->setDue( array( 1, 2, 3 ), array( 'VALUE' => 'DATE' ));
$c->addComponent( $o );

$o = new vtodo();
$o->setComment( 'A1c: short array( 1, 2, 3 ), position replace key, param: array(VALUE=>DATE-TIME)' );
$o->setProperty( 'Due'
               , array( 1, 2, 3 )
               , array( 'VALUE' => 'DATE-TIME' ));
$c->addComponent( $o );

$o = new vtodo();
$o->setComment( 'A1d: short array( day=>3, month=>2, year=>1 ), array with keys' );
$o->setDue( array( 'day'=>3, 'month'=>2, 'year'=>1 ));
$c->addComponent( $o );

$o = new vtodo();
$o->setComment( 'A1e: short array( day=>3, month=>2, year=>1 ), array with keys, param: array(VALUE=>DATE)' );
$o->setProperty( 'due'
               , array( 'day'=>3, 'month'=>2, 'year'=>1 )
               , array( 'VALUE' => 'DATE' ));
$c->addComponent( $o );

$o = new vtodo();
$o->setComment( 'A1f: short array( day=>3, month=>2, year=>1 ), array with keys, param: array(VALUE=>DATE-TIME)' );
$o->setDue( array( 'day'=>3, 'month'=>2, 'year'=>1 ), array( 'VALUE' => 'DATE-TIME' ));
$c->addComponent( $o );

$o = new vtodo();
$o->setComment( 'A2a: long array( 1, 2, 3, 4, 5, 6 ), position replace key' );
$o->setProperty( 'Due', array( 1, 2, 3, 4, 5, 6 ));
$c->addComponent( $o );

$o = new vtodo();
$o->setComment( 'A2b: long array( 1, 2, 3, 4, 5, 6), position replace key, param: array(VALUE=>DATE)' );
$o->setDue( array( 1, 2, 3, 4, 5, 6 ), array( 'VALUE' => 'DATE' ));
$c->addComponent( $o );

$o = new vtodo();
$o->setComment( 'A2c: long array( 1, 2, 3, 4, 5, 6 ), position replace key, param: array(VALUE=>DATE-TIME)' );
$o->setProperty( 'DUE'
               , array( 1, 2, 3, 4, 5, 6 )
               , array( 'VALUE' => 'DATE-TIME' ));
$c->addComponent( $o );

$o = new vtodo();
$o->setComment( 'A2d: long array( 1, 2, 3, 4, 5, 6, "-0100" ), position replace key' );
$o->setDue( array( 1, 2, 3, 4, 5, 6, '-0100' ));
$c->addComponent( $o );

$o = new vtodo();
$o->setComment( 'A2e: long array( 1, 2, 3, 4, 5, 6, "-0100" ), position replace key, param: array(VALUE=>DATE)' );
$o->setProperty( 'due'
               , array( 1, 2, 3, 4, 5, 6, '-0100' )
               , array( 'VALUE' => 'DATE' ));
$c->addComponent( $o );

$o = new vtodo();
$o->setComment( 'A2f: long array( 1, 2, 3, 4, 5, 6, "-0100" ), position replace key, param: array(VALUE=>DATE-TIME)' );
$o->setDue( array( 1, 2, 3, 4, 5, 6, '-0100' ), array( 'VALUE' => 'DATE-TIME' ));
$c->addComponent( $o );

$o = new vtodo();
$o->setComment( 'A2g: long array( 1, 2, 3, 4, 5, 6, "Europe/Stockholm" ), position replace key' );
$o->setproperty( 'Due', array( 1, 2, 3, 4, 5, 6, 'Europe/Stockholm' ));
$c->addComponent( $o );

$o = new vtodo();
$o->setComment( 'A2h: long array( 1, 2, 3, 4, 5, 6, "Europe/Stockholm" ), position replace key, param: array(VALUE=>DATE)' );
$o->setDue( array( 1, 2, 3, 4, 5, 6, 'Europe/Stockholm' ), array( 'VALUE' => 'DATE' ));
$c->addComponent( $o );

$o = new vtodo();
$o->setComment( 'A2i: long array( 1, 2, 3, 4, 5, 6, "Europe/Stockholm" ), position replace key, param: array(VALUE=>DATE-TIME)' );
$o->setproperty( 'Due'
               , array( 1, 2, 3, 4, 5, 6, 'Europe/Stockholm' )
               , array( 'VALUE' => 'DATE-TIME' ));
$c->addComponent( $o );

$o = new vtodo();
$o->setComment( 'A2j: long array( sec=>6,min=>5,hour=>4,day=>3,month=>2,year=>1 ), array with keys' );
$o->setDue( array( 'sec'=>6, 'min'=>5, 'hour'=>4, 'day'=>3, 'month'=>2, 'year'=>1 ));
$c->addComponent( $o );

$o = new vtodo();
$o->setComment( 'A2k: long array( sec=>6,min=>5,hour=>4,day=>3,month=>2,year=>1 ), array with keys, param: array(VALUE=>DATE)' );
$o->setProperty( 'Due'
                , array( 'sec'=>6, 'min'=>5, 'hour'=>4, 'day'=>3, 'month'=>2, 'year'=>1 )
                , array( 'VALUE' => 'DATE' ));
$c->addComponent( $o );

$o = new vtodo();
$o->setComment( 'A2l: long array( sec=>6,min=>5,hour=>4,day=>3,month=>2,year=>1 ), array with keys, param: array(VALUE=>DATE-TIME)' );
$o->setDue( array( 'sec'=>6, 'min'=>5, 'hour'=>4, 'day'=>3, 'month'=>2, 'year'=>1 ), array( 'VALUE' => 'DATE-TIME' ));
$c->addComponent( $o );

$o = new vtodo();
$o->setComment( 'A2m: long array( sec=>6,min=>5,hour=>4,day=>3,month=>2,year=>1,tz=+0400 ), array with keys and timezone' );
$o->setProperty( 'Due'
                , array( 'sec'=>6, 'min'=>5, 'hour'=>4, 'day'=>3, 'month'=>2, 'year'=>1, 'tz'=>'+0400' ));
$c->addComponent( $o );

$o = new vtodo();
$o->setComment( 'A2o: long array( sec=>6,min=>5,hour=>4,day=>3,month=>2,year=>1,tz=+0400 ), array with keys and timezon, param: array(VALUE=>DATE)' );
$o->setDue( array( 'sec'=>6, 'min'=>5, 'hour'=>4, 'day'=>3, 'month'=>2, 'year'=>1, 'tz'=>'+0400' ), array( 'VALUE'=>'DATE' ));
$c->addComponent( $o );

$o = new vtodo();
$o->setComment( 'A2p: long array( sec=>6,min=>5,hour=>4,day=>3,month=>2,year=>1,tz=+0400 ), array with keys and timezon, param: array(VALUE=>DATE-TIME)' );
$o->setpROPERTY( 'Due'
               , array( 'sec'=>6,'min'=>5,'hour'=>4,'day'=>3,'month'=>2,'year'=>1,'tz'=>'+0400' )
               , array( 'VALUE'=>'DATE-TIME' ));
$c->addComponent( $o );

$o = new vtodo();
$o->setComment( 'A2q: long array( sec=>6,min=>5,hour=>4,day=>3,month=>2,year=>1,tz=Europe/Stockholm ), array with keys and timezone' );
$o->setDue( array( 'sec'=>6, 'min'=>5, 'hour'=>4, 'day'=>3, 'month'=>2, 'year'=>1, 'tz'=>'Europe/Stockholm' ));
$c->addComponent( $o );

$o = new vtodo();
$o->setComment( 'A2r: long array( min=>5,hour=>4,day=>3,month=>2,year=>1,tz=Europe/Stockholm ), array with keys and timezon, param: array(VALUE=>DATE)' );
$o->setProperty( 'Due'
               , array( 'min'=>5,'hour'=>4,'day'=>3,'month'=>2,'year'=>1,'tz'=>'Europe/Stockholm' )
               , array( 'VALUE'=>'DATE' ));
$c->addComponent( $o );

$o = new vtodo();
$o->setComment( 'A2s: long array( sec=>6,min=>5,hour=>4,day=>3,month=>2,year=>1,tz=Europe/Stockholm ), array with keys and timezon, param: array(VALUE=>DATE-TIME)' );
$o->setProperty( 'Due'
               , array( 'sec'=>6, 'min'=>5, 'hour'=>4, 'day'=>3, 'month'=>2, 'year'=>1, 'tz'=>'Europe/Stockholm' )
               , array( 'VALUE'=>'DATE-TIME' ));
$c->addComponent( $o );

$o = new vtodo();
$o->setComment( 'A2t: long array( sec=>6,min=>5,hour=>4,day=>3,month=>2,year=>1,tz=Europe/Stockholm ), array with keys and timezon, param: array(VALUE=>DATE, TZID=>Europe/Helsinki)' );
$o->setDue( array( 'sec'=>6, 'min'=>5, 'hour'=>4, 'day'=>3, 'month'=>2, 'year'=>1, 'tz'=>'Europe/Stockholm' ), array( 'VALUE'=>'DATE', 'TZID'=>'Europe/Helsinki' ));
$c->addComponent( $o );

// test date in an array (incl. timestamp)
$o = new vtodo();
$timestamp = mktime ( date('H') + 4, date('i'), date('s'), date('m'), date('d'), date('Y'));
$o->setComment( 'B1a '.$timestamp.' =now+4hours tre xparams' );
$o->setProperty( 'Due'
               , array( 'timestamp' => $timestamp )
               , array ( 'jestanes', 'xkey' => 'xvalue', 'xxx' => 'yyy' ) );
$c->addComponent( $o );

$o = new vtodo();
$timestamp = mktime ( date('H') + 4, date('i'), date('s'), date('m'), date('d'), date('Y'));
$o->setComment( 'B2a '.$timestamp.' =now+4hours tz=+0100 tre xparams' );
$o->setDue( array( 'timestamp' => $timestamp, 'tz' => '+0100' ), array ( 'jestanes', 'xkey' => 'xvalue', 'xxx' => 'yyy' ) );
$c->addComponent( $o );

$o = new vtodo();
$timestamp = mktime ( date('H') + 4, date('i'), date('s'), date('m'), date('d'), date('Y'));
$o->setComment( 'B2b '.$timestamp.' =now+4hours tz=CEST tre xparams' );
$o->setProperty( 'due'
               , array( 'timestamp' => $timestamp, 'tz' => 'CEST' )
               , array ( 'jestanes', 'xkey' => 'xvalue', 'xxx' => 'yyy' ) );
$c->addComponent( $o );

$o = new vtodo();
$timestamp = mktime ( date('H') + 4, date('i'), date('s'), date('m'), date('d'), date('Y'));
$o->setComment( 'B2c '.$timestamp.' =now+4hours tz=+0100 tre xparams+VALUE=>DATE' );
$o->setDue( array( 'timestamp' => $timestamp, 'tz' => '+0100' ), array ( 'jestanes', 'xkey' => 'xvalue', 'xxx' => 'yyy', 'VALUE' => 'DATE' ) );
$c->addComponent( $o );

$o = new vtodo();
$timestamp = mktime ( date('H') + 4, date('i'), date('s'), date('m'), date('d'), date('Y'));
$o->setComment( 'B2d '.$timestamp.' =now+4hours tz=CEST tre xparams+VALUE=>DATE-TIME' );
$o->setProperty( 'DUE'
               , array( 'timestamp' => $timestamp, 'tz' => 'CEST' )
               , array( 'jestanes', 'xkey' => 'xvalue', 'xxx' => 'yyy', 'VALUE' => 'DATE-TIME' ));
$c->addComponent( $o );

// test date in a string
$o = new vtodo();
$o->setComment( 'C1: 2001-02-03 04:05:06 US-Eastern' );
$o->setDue( '2001-02-03 04:05:06 US-Eastern' );
$c->addComponent( $o );

$o = new vtodo();
$o->setComment( "C2: 2001-02-03 04:05:06 US-Eastern, array( 'VALUE' => 'DATE' )" );
$o->setProperty( 'Due'
               , '2001-02-03 04:05:06 US-Eastern'
               , array( 'VALUE' => 'DATE' ));
$c->addComponent( $o );

$o = new vtodo();
$o->setComment( "C3: '2001-02-03 04:05:06 US-Eastern', array( 'VALUE' => 'DATE-TIME' )" );
$o->setDue( '2001-02-03 04:05:06 US-Eastern', array( 'VALUE' => 'DATE-TIME' ) );
$c->addComponent( $o );

$o = new vtodo();
$o->setComment( 'C4: 2001-02-03' );
$o->setProperty( 'Due', '2001-02-03' );
$c->addComponent( $o );

$o = new vtodo();
$o->setComment( 'C5: 20010203' );
$o->setDue( '20010203' );
$c->addComponent( $o );

$o = new vtodo();
$o->setComment( 'C6: 20010203040506 UTC' );
$o->setProperty( 'due', '20010203040506 UTC' );
$c->addComponent( $o );

$o = new vtodo();
$o->setComment( 'C7: 3 Feb 2001 GMT' );
$o->setDue( '3 Feb 2001 GMT' );
$c->addComponent( $o );

$o = new vtodo();
$o->setComment( 'C8: 02/03/2001' );
$o->setproperty( 'due', '02/03/2001' );
$c->addComponent( $o );

// test date with dateparts in all variables
$o = new vtodo();
$o->setComment( 'D1: 1, 2, 3' );
$o->setDue( 1, 2, 3 );
$c->addComponent( $o );

$o = new vtodo();
$o->setComment( 'D2: 1, 2, 3, 4, 5, 6' );
$o->setProperty( 'due', 1, 2, 3, 4, 5, 6 );
$c->addComponent( $o );

$o = new vtodo();
$o->setComment( "D3: 2006, 8, 11, 16, 30, 0, '-040000'" );
$o->setDue( 2006, 8, 11, 16, 30, 0, '-040000' ); // 11 august 2006 16.30.00 -040000
$c->addComponent( $o );

$o = new vtodo();
$o->setComment( "D4: 2006, 8, 11, 16, 30, 0, '-040000', array( 'VALUE' => 'DATE' )" );
$o->setproperty( 'due'
               , 2006, 8, 11, 16, 30, 0, '-040000'
               , array( 'VALUE' => 'DATE' )); // 11 august 2006 16.30.00 -040000
$c->addComponent( $o );

$o = new vtodo();
$o->setComment( "D5: 2006, 8, 11, 16, 30, 0, '-040000', array( 'VALUE' => 'DATE-TIME' )" );
$o->setDue( 2006, 8, 11, 16, 30, 0, '-040000', array( 'VALUE' => 'DATE-TIME' ) ); // 11 august 2006 16.30.00 -040000
$c->addComponent( $o );

$o = new vtodo();
$o->setComment( "D6: 2006, 8, 11, 16, 30, 0, 'Europe/Stockholm'" );
$o->setProperty( 'due'
               , 2006, 8, 11, 16, 30, 0, 'Europe/Stockholm' ); // 11 august 2006 16.30.00 -040000
$c->addComponent( $o );

$o = new vtodo();
$o->setComment( "D7: 2006, 8, 11, 16, 30, 0, 'Europe/Stockholm', array( 'VALUE' => 'DATE' )" );
$o->setDue( 2006, 8, 11, 16, 30, 0, 'Europe/Stockholm', array( 'VALUE' => 'DATE' )); // 11 august 2006 16.30.00 -040000
$c->addComponent( $o );

$o = new vtodo();
$o->setComment( "D8: 2006, 8, 11, 16, 30, 0, 'Europe/Stockholm', array( 'VALUE' => 'DATE-TIME' )" );
$o->setproperty( 'DUE'
               , 2006, 8, 11, 16, 30, 0, 'Europe/Stockholm'
               , array( 'VALUE' => 'DATE-TIME' ) ); // 11 august 2006 16.30.00 -040000
$c->addComponent( $o );

// $str = $c->createCalendar();
// echo $str;
$c->returnCalendar( FALSE, 'test.ics' );

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