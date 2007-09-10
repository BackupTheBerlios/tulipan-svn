<?php // dtend_iCal_test.php

require_once '../iCalcreator.class.php';
$c = new vcalendar ();
$c->setFormat( "xcal" );

// test date in an array (excl. timestamp)
$o = new vtodo();
$o->setComment( 'A1a: short array( 1, 2, 3 ), position replaces key' );
$o->setRecurrenceid( array( 1, 2, 3 ));
$c->addComponent( $o );
$o = new vtodo();
$o->setProperty( 'Comment', 'A1b: short array( 1, 2, 3 ), position replace key, param: array(VALUE=>DATE)' );
$o->setProperty( 'Recurrence-id'
               , array( 1, 2, 3 )
               , array( 'VALUE' => 'DATE' ));
$c->addComponent( $o );
$o = new vtodo();
$o->setComment( 'A1c: short array( 1, 2, 3 ), position replace key, param: array(VALUE=>DATE-TIME,RANGE=THISANDFUTURE)' );
$o->setRecurrenceid( array( 1, 2, 3 ), array( 'VALUE' => 'DATE-TIME', 'RANGE' => 'THISANDFUTURE' ));
$c->addComponent( $o );
$o = new vtodo();
$o->setProperty( 'comMent', 'A1d: short array( day=>3, month=>2, year=>1 ), array with keys' );
$o->setProperty( 'Recurrence-ID'
               , array( 'day'=>3, 'month'=>2, 'year'=>1 ));
$c->addComponent( $o );
$o = new vtodo();
$o->setComment( 'A1e: short array( day=>3, month=>2, year=>1 ), array with keys, param: array(VALUE=>DATE)' );
$o->setRecurrenceid( array( 'day'=>3, 'month'=>2, 'year'=>1 ), array( 'VALUE' => 'DATE' ));
$c->addComponent( $o );
$o = new vtodo();
$o->setProperty( 'Comment', 'A1f: short array( day=>3, month=>2, year=>1 ), array with keys, param: array(VALUE=>DATE-TIME,RANGE=>THISANDPRIOR)' );
$o->setProperty( 'RECurrence-id'
               , array( 'day'=>3, 'month'=>2, 'year'=>1 )
               , array( 'VALUE' => 'DATE-TIME'
                      , 'RANGE' => 'THISANDPRIOR' ));
$c->addComponent( $o );

$o = new vtodo();
$o->setComment( 'A2a: long array( 1, 2, 3, 4, 5, 6 ), position replace key' );
$o->setRecurrenceid( array( 1, 2, 3, 4, 5, 6 ));
$c->addComponent( $o );
$o = new vtodo();
$o->setProperty( 'Comment', 'A2b: long array( 1, 2, 3, 4, 5, 6), position replace key, param: array(VALUE=>DATE)' );
$o->setProperty( 'RecuRRence-id'
               , array( 1, 2, 3, 4, 5, 6 )
               , array( 'VALUE' => 'DATE' ));
$c->addComponent( $o );
$o = new vtodo();
$o->setComment( 'A2c: long array( 1, 2, 3, 4, 5, 6 ), position replace key, param: array(VALUE=>DATE-TIME)' );
$o->setRecurrenceid( array( 1, 2, 3, 4, 5, 6 ), array( 'VALUE' => 'DATE-TIME' ));
$c->addComponent( $o );
$o = new vtodo();
$o->setProperty( 'Comment', 'A2d: long array( 1, 2, 3, 4, 5, 6, "-0100" ), position replace key, param: array(RANGE=>THISANDFUTURE)' );
$o->setProperty( 'Recurrence-id'
               , array( 1, 2, 3, 4, 5, 6, '-0100' )
               , array( 'RANGE'=>'THISANDFUTURE'));
$c->addComponent( $o );
$o = new vtodo();
$o->setComment( 'A2e: long array( 1, 2, 3, 4, 5, 6, "-0100" ), position replace key, param: array(VALUE=>DATE)' );
$o->setRecurrenceid( array( 1, 2, 3, 4, 5, 6, '-0100' ), array( 'VALUE' => 'DATE' ));
$c->addComponent( $o );
$o = new vtodo();
$o->setProperty( 'Comment', 'A2f: long array( 1, 2, 3, 4, 5, 6, "-0100" ), position replace key, param: array(VALUE=>DATE-TIME)' );
$o->setProperty( 'Recurrence-id'
               , array( 1, 2, 3, 4, 5, 6, '-0100' )
               , array( 'VALUE' => 'DATE-TIME' ));
$c->addComponent( $o );
$o = new vtodo();
$o->setComment( 'A2g: long array( 1, 2, 3, 4, 5, 6, "Europe/Stockholm" ), position replace key, param: array(RANGE=>THISANDPRIOR)' );
$o->setRecurrenceid( array( 1, 2, 3, 4, 5, 6, 'Europe/Stockholm' ), array( 'RANGE' => 'THISANDPRIOR'));
$c->addComponent( $o );
$o = new vtodo();
$o->setProperty( 'Comment', 'A2h: long array( 1, 2, 3, 4, 5, 6, "Europe/Stockholm" ), position replace key, param: array(VALUE=>DATE)' );
$o->setProperty( 'Recurrence-id'
               , array( 1, 2, 3, 4, 5, 6, 'Europe/Stockholm' )
               , array( 'VALUE' => 'DATE' ));
$c->addComponent( $o );
$o = new vtodo();
$o->setComment( 'A2i: long array( 1, 2, 3, 4, 5, 6, "Europe/Stockholm" ), position replace key, param: array(VALUE=>DATE-TIME)' );
$o->setRecurrenceid( array( 1, 2, 3, 4, 5, 6, 'Europe/Stockholm' ), array( 'VALUE' => 'DATE-TIME' ));
$c->addComponent( $o );
$o = new vtodo();
$o->setProperty( 'Comment', 'A2j: long array( sec=>6,min=>5,hour=>4,day=>3,month=>2,year=>1 ), array with keys, param: array(RANGE=>THISANDFUTURE)' );
$o->setProperty( 'Recurrence-id'
               , array( 'sec'=>6, 'min'=>5, 'hour'=>4, 'day'=>3, 'month'=>2, 'year'=>1 )
               , array( 'RANGE'=>'THISANDFURURE' ));
$c->addComponent( $o );
$o = new vtodo();
$o->setComment( 'A2k: long array( sec=>6,min=>5,hour=>4,day=>3,month=>2,year=>1 ), array with keys, param: array(VALUE=>DATE)' );
$o->setRecurrenceid( array( 'sec'=>6, 'min'=>5, 'hour'=>4, 'day'=>3, 'month'=>2, 'year'=>1 ), array( 'VALUE' => 'DATE' ));
$c->addComponent( $o );
$o = new vtodo();
$o->setProperty( 'Comment', 'A2l: long array( sec=>6,min=>5,hour=>4,day=>3,month=>2,year=>1 ), array with keys, param: array(VALUE=>DATE-TIME,RANGE=>THISANDPRIOR)' );
$o->setProperty( 'Recurrence-id'
               , array( 'sec'=>6, 'min'=>5, 'hour'=>4, 'day'=>3, 'month'=>2, 'year'=>1 )
               , array( 'VALUE' => 'DATE-TIME', 'RANGE'=>'THISANDPRIOR' ));
$c->addComponent( $o );
$o = new vtodo();
$o->setComment( 'A2m: long array( sec=>6,min=>5,hour=>4,day=>3,month=>2,year=>1,tz=+0400 ), array with keys and timezone' );
$o->setRecurrenceid( array( 'sec'=>6, 'min'=>5, 'hour'=>4, 'day'=>3, 'month'=>2, 'year'=>1, 'tz'=>'+0400' ));
$c->addComponent( $o );
$o = new vtodo();
$o->setProperty( 'Comment', 'A2o: long array( sec=>6,min=>5,hour=>4,day=>3,month=>2,year=>1,tz=+0400 ), array with keys and timezon, param: array(VALUE=>DATE)' );
$o->setProperty( 'Recurrence-id'
               , array( 'sec'=>6,'min'=>5,'hour'=>4,'day'=>3,'month'=>2,'year'=>1,'tz'=>'+0400' )
               , array( 'VALUE'=>'DATE' ));
$c->addComponent( $o );
$o = new vtodo();
$o->setComment( 'A2p: long array( sec=>6,min=>5,hour=>4,day=>3,month=>2,year=>1,tz=+0400 ), array with keys and timezon, param: array(VALUE=>DATE-TIME,RANGE=>THISANDFUTURE)' );
$o->setRecurrenceid( array( 'sec'=>6, 'min'=>5, 'hour'=>4, 'day'=>3, 'month'=>2, 'year'=>1, 'tz'=>'+0400' ), array( 'VALUE'=>'DATE-TIME', 'RANGE'=>'THISANDFUTURE' ));
$c->addComponent( $o );
$o = new vtodo();
$o->setProperty( 'Comment', 'A2q: long array( sec=>6,min=>5,hour=>4,day=>3,month=>2,year=>1,tz=Europe/Stockholm ), array with keys and timezone' );
$o->setProperty( 'Recurrence-id'
               , array( 'sec'=>6, 'min'=>5, 'hour'=>4, 'day'=>3, 'month'=>2, 'year'=>1, 'tz'=>'Europe/Stockholm' ));
$c->addComponent( $o );
$o = new vtodo();
$o->setComment( 'A2r: long array( sec=>6,min=>5,hour=>4,day=>3,month=>2,year=>1,tz=Europe/Stockholm ), array with keys and timezon, param: array(VALUE=>DATE)' );
$o->setRecurrenceid( array( 'sec'=>6, 'min'=>5, 'hour'=>4, 'day'=>3, 'month'=>2, 'year'=>1, 'tz'=>'Europe/Stockholm' ), array( 'VALUE'=>'DATE' ));
$c->addComponent( $o );
$o = new vtodo();
$o->setProperty( 'Comment', 'A2s: long array( sec=>6,min=>5,hour=>4,day=>3,month=>2,year=>1,tz=Europe/Stockholm ), array with keys and timezon, param: array(VALUE=>DATE-TIME,RANGE=>THISANDPRIOR)' );
$o->setProperty( 'Recurrence-id'
               , array( 'sec'=>6, 'min'=>5, 'hour'=>4, 'day'=>3, 'month'=>2, 'year'=>1, 'tz'=>'Europe/Stockholm' )
               , array( 'VALUE'=>'DATE-TIME'
                      , 'RANGE'=>'THISANDPRIOR' ));
$c->addComponent( $o );
$o = new vtodo();
$o->setComment( 'A2t: long array( sec=>6,min=>5,hour=>4,day=>3,month=>2,year=>1,tz=Europe/Stockholm ), array with keys and timezon, param: array(VALUE=>DATE, TZID=>Europe/Helsinki)' );
$o->setRecurrenceid( array( 'sec'=>6, 'min'=>5, 'hour'=>4, 'day'=>3, 'month'=>2, 'year'=>1, 'tz'=>'Europe/Stockholm' ), array( 'VALUE'=>'DATE', 'TZID'=>'Europe/Helsinki' ));
$c->addComponent( $o );

// test date in an array (incl. timestamp)
$o = new vtodo();
$timestamp = mktime ( date('H') + 4, date('i'), date('s'), date('m'), date('d'), date('Y'));
$o->setProperty( 'Comment', 'B1a '.$timestamp.' =now+4hours tre xparams' );
$o->setProperty( 'Recurrence-id'
               , array( 'timestamp' => $timestamp )
               , array ( 'jestanes'
                       , 'xkey' => 'xvalue'
                       , 'xxx' => 'yyy' ) );
$c->addComponent( $o );
$o = new vtodo();
$timestamp = mktime ( date('H') + 4, date('i'), date('s'), date('m'), date('d'), date('Y'));
$o->setComment( 'B2a '.$timestamp.' =now+4hours tz=+0100 tre xparams' );
$o->setRecurrenceid( array( 'timestamp' => $timestamp, 'tz' => '+0100' ), array ( 'jestanes', 'xkey' => 'xvalue', 'xxx' => 'yyy' ) );
$c->addComponent( $o );
$o = new vtodo();
$timestamp = mktime ( date('H') + 4, date('i'), date('s'), date('m'), date('d'), date('Y'));
$o->setProperty( 'Comment', 'B2b '.$timestamp.' =now+4hours tz=CEST tre xparams' );
$o->setProperty( 'Recurrence-id'
               , array( 'timestamp' => $timestamp, 'tz' => 'CEST' )
               , array ( 'jestanes'
                       , 'xkey' => 'xvalue'
                       , 'xxx' => 'yyy' ) );
$c->addComponent( $o );
$o = new vtodo();
$timestamp = mktime ( date('H') + 4, date('i'), date('s'), date('m'), date('d'), date('Y'));
$o->setComment( 'B2c '.$timestamp.' =now+4hours tz=+0100 tre xparams+VALUE=>DATE' );
$o->setRecurrenceid( array( 'timestamp' => $timestamp, 'tz' => '+0100' ), array ( 'jestanes', 'xkey' => 'xvalue', 'xxx' => 'yyy', 'VALUE' => 'DATE' ) );
$c->addComponent( $o );
$o = new vtodo();
$timestamp = mktime ( date('H') + 4, date('i'), date('s'), date('m'), date('d'), date('Y'));
$o->setProperty( 'Comment', 'B2d '.$timestamp.' =now+4hours tz=CEST tre xparams+VALUE=>DATE-TIME' );
$o->setProperty( 'Recurrence-id'
               , array( 'timestamp' => $timestamp, 'tz' => 'CEST' )
               , array ( 'jestanes'
                       , 'xkey' => 'xvalue'
                       , 'xxx' => 'yyy'
                       , 'VALUE' => 'DATE-TIME' ) );
$c->addComponent( $o );

// test date in a string
$o = new vtodo();
$o->setComment( 'C1: 2001-02-03 04:05:06 US-Eastern' );
$o->setRecurrenceid( '2001-02-03 04:05:06 US-Eastern' );
$c->addComponent( $o );
$o = new vtodo();
$o->setProperty( 'Comment', "C2: 2001-02-03 04:05:06 US-Eastern, array( 'VALUE' => 'DATE' )" );
$o->setProperty( 'Recurrence-id'
               , '2001-02-03 04:05:06 US-Eastern'
               , array( 'VALUE' => 'DATE' ));
$c->addComponent( $o );
$o = new vtodo();
$o->setComment( "C3: '2001-02-03 04:05:06 US-Eastern', array( 'VALUE' => 'DATE-TIME' )" );
$o->setRecurrenceid( '2001-02-03 04:05:06 US-Eastern', array( 'VALUE' => 'DATE-TIME' ) );
$c->addComponent( $o );
$o = new vtodo();
$o->setProperty( 'Comment', 'C4: 2001-02-03' );
$o->setProperty( 'Recurrence-id', '2001-02-03' );
$c->addComponent( $o );
$o = new vtodo();
$o->setComment( 'C5: 20010203' );
$o->setRecurrenceid( '20010203' );
$c->addComponent( $o );
$o = new vtodo();
$o->setProperty( 'Comment', 'C6: 20010203040506 UTC' );
$o->setProperty( 'Recurrence-id', '20010203040506 UTC' );
$c->addComponent( $o );
$o = new vtodo();
$o->setComment( 'C7: 3 Feb 2001 GMT' );
$o->setRecurrenceid( '3 Feb 2001 GMT' );
$c->addComponent( $o );
$o = new vtodo();
$o->setProperty( 'Comment', 'C8: 02/03/2001' );
$o->setProperty( 'Recurrence-id', '02/03/2001' );
$c->addComponent( $o );

// test date with dateparts in all variables
$o = new vtodo();
$o->setComment( 'D1: 1, 2, 3' );
$o->setRecurrenceid( 1, 2, 3 );
$c->addComponent( $o );
$o = new vtodo();
$o->setProperty( 'Comment', 'D2: 1, 2, 3, 4, 5, 6' );
$o->setProperty( 'Recurrence-id', 1, 2, 3, 4, 5, 6 );
$c->addComponent( $o );
$o = new vtodo();
$o->setComment( "D3: 2006, 8, 11, 16, 30, 0, '-040000'" );
$o->setRecurrenceid( 2006, 8, 11, 16, 30, 0, '-040000' ); // 11 august 2006 16.30.00 -040000
$c->addComponent( $o );
$o = new vtodo();
$o->setProperty( 'Comment', "D4: 2006, 8, 11, 16, 30, 0, '-040000', array( 'VALUE' => 'DATE' )" );
$o->setProperty( 'Recurrence-id'
               , 2006, 8, 11, 16, 30, 0, '-040000'
               , array( 'VALUE' => 'DATE' )); // 11 august 2006 16.30.00 -040000
$c->addComponent( $o );
$o = new vtodo();
$o->setComment( "D5: 2006, 8, 11, 16, 30, 0, '-040000', array( 'VALUE' => 'DATE-TIME' )" );
$o->setRecurrenceid( 2006, 8, 11, 16, 30, 0, '-040000', array( 'VALUE' => 'DATE-TIME' ) ); // 11 august 2006 16.30.00 -040000
$c->addComponent( $o );
$o = new vtodo();
$o->setProperty( 'Comment', "D6: 2006, 8, 11, 16, 30, 0, 'Europe/Stockholm'" );
$o->setProperty( 'Recurrence-id'
               , 2006, 8, 11, 16, 30, 0, 'Europe/Stockholm' ); // 11 august 2006 16.30.00 -040000
$c->addComponent( $o );
$o = new vtodo();
$o->setComment( "D7: 2006, 8, 11, 16, 30, 0, 'Europe/Stockholm', array( 'VALUE' => 'DATE' )" );
$o->setRecurrenceid( 2006, 8, 11, 16, 30, 0, 'Europe/Stockholm', array( 'VALUE' => 'DATE' )); // 11 august 2006 16.30.00 -040000
$c->addComponent( $o );
$o = new vtodo();
$o->setProperty( 'Comment', "D8: 2006, 8, 11, 16, 30, 0, 'Europe/Stockholm', array( 'VALUE' => 'DATE-TIME' )" );
$o->setProperty( 'Recurrence-id'
               , 2006, 8, 11, 16, 30, 0, 'Europe/Stockholm'
               , array( 'VALUE' => 'DATE-TIME' ) ); // 11 august 2006 16.30.00 -040000
$c->addComponent( $o );

$str = $c->createCalendar();
$str = str_replace( "<", "&lt;", $str );
$str = str_replace( ">", "&gt;", $str );
echo $str;
// $c->returnCalendar( FALSE, 'test.xml' );

/*
echo strtotime ("now"), "<br />";
echo strtotime ("10 September 2000"), "<br />";
echo strtotime ("+1 day"), "<br />";
echo strtotime ("+1 week"), "<br />";
echo strtotime ("+1 week 2 days 4 hours 2 seconds"), "<br />";
echo strtotime ("next Thursday"), "<br />";
echo strtotime ("last Monday"), "<br />";


// LC_ALL=C TZ=UTC0 date
echo date( 'Y-m-d H:i:s Z', strtotime('Fri Dec 15 19:48:05 UTC 2000'));   echo "<br />"; // test ###
echo date( 'Y-m-d H:i:s',   strtotime('Fri Dec 15 19:48:05'));            echo "<br />"; // test ###
// TZ=UTC0 date +"%Y-%m-%d %H:%M:%SZ"
echo date( 'Y-m-d H:i:s Z', strtotime('2000-12-15 19:48:05Z'));           echo "<br />"; // test ###
// date --iso-8601=seconds  # a GNU extension
echo date( 'Y-m-d H:i:s Z', strtotime('2000-12-15T11:48:05-0800'));       echo "<br />"; // test ###
// date --rfc-822  # a GNU extension
echo date( 'Y-m-d H:i:s Z', strtotime('Fri, 15 Dec 2000 11:48:05 -0800'));echo "<br />"; // test ###
// date +"%Y-%m-%d %H:%M:%S %z"  # %z is a GNU extension.
echo date( 'Y-m-d H:i:s Z', strtotime('2000-12-15 11:48:05 -0800'));      echo "<br />"; // test ###

// string datestring // date in a string, acceptable by strtotime-command, only local time
*/
?>