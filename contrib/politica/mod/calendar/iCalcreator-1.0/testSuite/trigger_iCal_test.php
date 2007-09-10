<?php /* trigger_iCal_test.php */

require_once '../iCalcreator.class.php';

/*
echo "setTrigger( year, month, day, week , hour, min, sec, relatedEnd=FALSE, after=FALSE, tz, xparams )<br />
";
setTrigger( int year/FALSE, int month/FALSE, int day/FALSE [, int week/FALSE ] [, int hour/FALSE, int min/FALSE, int sec/FALSE ] [, bool relatedend=FALSE ] [, bool before=TRUE )
example
$c->setTrigger( FALSE, FALSE, FALSE, FALSE, 1, 2, 3, TRUE, TRUE ); // 1 hour 2 min 3 sec, before end,
*/
$c = new vcalendar ();
$e = new valarm();
$e->setDescription( '1: F, F, F, FALSE, 1, 2, 3, F, T (start, after)' );
$e->setTrigger( FALSE, FALSE, FALSE, FALSE, 1, 2, 3, FALSE, TRUE );
$c->addComponent( $e );

$e = new valarm();
$e->setProperty( 'Description'
               , "1B: array( 'hour' => 1, 'min' => 2, 'sec' => 3 ), TRUE, FALSE (end, before)" );
$e->setProperty( 'Trigger'
               ,array( 'hour' => 1, 'min' => 2, 'sec' => 3 ), TRUE, FALSE );
$c->addComponent( $e );

$e = new valarm();
$e->setDescription( '2: FALSE, FALSE, FALSE, 4 (start, before' );
$e->setTrigger( FALSE, FALSE, FALSE, 4 );
$c->addComponent( $e );

$e = new valarm();
$e->setProperty( 'Description'
               , "2b: array( 'week' => 4 ) (start, before)" );
$e->setProperty( 'trigger'
               , array( 'week' => 4 ) );
$c->addComponent( $e );

$e = new valarm();
$e->setDescription( "2c: array( 'week' => 4 ), TRUE (end, before)" );
$e->setTrigger( array( 'week' => 4 ), TRUE );
$c->addComponent( $e );

$e = new valarm();
$e->setProperty( 'Description'
               , "2d: array( 'week' => 4 ), FALSE (start, before)" );
$e->setProperty( 'Trigger'
               , array( 'week' => 4 ), FALSE );
$c->addComponent( $e );

$e = new valarm();
$e->setDescription( "2e: array( 'week' => 4 ), TRUE, TRUE (end, after)" );
$e->setTrigger( array( 'week' => 4 ), TRUE, TRUE );
$c->addComponent( $e );

$e = new valarm();
$e->setProperty( 'Description'
               , "2f: array( 'week' => 4 ), FALSE, TRUE (start, after)" );
$e->setProperty( 'Trigger'
               , array( 'week' => 4 ), FALSE, TRUE );
$c->addComponent( $e );

$e = new valarm();
$e->setDescription( "2g: array( 'week' => 4 ), TRUE, FALSE (end, before),array('VALUE'=>'DURATION'" );
$e->setTrigger( array( 'week' => 4 ), TRUE, FALSE, array('VALUE'=>'DURATION' ));
$c->addComponent( $e );

$e = new valarm();
$e->setProperty( 'Description'
               , "2h: array( 'week' => 4 ), FALSE, FALSE (start, before)" );
$e->setProperty( 'Trigger'
               , array( 'week' => 4 ), FALSE, FALSE );
$c->addComponent( $e );

$e = new valarm();
$e->setDescription( '3: FALSE, FALSE, 5, FALSE, 1, 2, 3, FALSE (start, before)' );
$e->setTrigger( FALSE, FALSE, 5, FALSE, 1, 2, 3, FALSE );
$c->addComponent( $e );

$e = new valarm();
$e->setProperty( 'Description'
               , "3b: array('day'=>5,'hour'=>1,'min'=>2,'sec'=>3), FALSE (start, before" );
$e->setProperty( 'Trigger'
               , array( 'day' => 5, 'hour' => 1, 'min' => 2, 'sec' => 3 ), FALSE );
$c->addComponent( $e );

$e = new valarm();
$e->setDescription( "4a1: 2007,6,5,F,1,2,3',F,F,'-0200', array( 'xparamKey' => 'xparamValue' )" );
$e->setTrigger( 2007, 6, 5, FALSE, 1, 2, 3, FALSE, FALSE, '-0200', array( 'xparamKey' => 'xparamValue' ) );
$c->addComponent( $e );
$e = new valarm();
$e->setProperty( 'description'
               , "4a2: 2007,6,5,F,F,F,F,F,F,'-0200', array( 'xparamKey' => 'xparamValue' )" );
$e->setProperty( 'trigger'
               , 2007, 6, 5, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, '-0200'
               , array( 'xparamKey' => 'xparamValue' ) );
$c->addComponent( $e );

$e = new valarm();
$e->setDescription( "4b1: array( 'year'=>2007,'month'=>6,'day'=>5,'hour'=>2,'min'=>2,'sec'=>3,'tz'=> '-0200'),array( 'xparamKey' => 'xparamValue' )" );
$e->setTrigger( array( 'year' => 2007, 'month' => 6, 'day' => 5, 'hour' => 2, 'min' => 2, 'sec' => 3, 'tz' => '-0200' ), array( 'xparamKey' => 'xparamValue' ) );
$c->addComponent( $e );
$e = new valarm();
$e->setProperty( 'description'
               , "4b2: array( 'year'=>2007,'month'=>6,'day'=>5,'tz'=> 'Europe/Stockholm'),array( 'xparamKey' => 'xparamValue' )" );
$e->setProperty( 'triGGer'
               , array( 'year' => 2007, 'month' => 6, 'day' => 5, 'tz' => 'Europe/Stockholm' )
               , array( 'xparamKey' => 'xparamValue' ) );
$c->addComponent( $e );

$e = new valarm();
$e->setDescription( "5: '14 august 2006 16.00.00', array( 'xparamKey' => 'xparamValue' )" );
$e->setTrigger( '14 august 2006 16.00.00', array( 'xparamKey' => 'xparamValue' ) );
$c->addComponent( $e );

$e = new valarm();
$e->setProperty( 'Description'
               , "6: '14 august 2006', array( 'xparamKey'=>'xparamValue', 'VALUE'=>'DATE-TIME' )");
$e->setProperty( 'Trigger'
               , '14 august 2006'
               , array( 'xparamKey' => 'xparamValue' ) );
$c->addComponent( $e );

$a = new valarm();
$timestamp = mktime ( date('H'), date('i'), date('s'), date('m'), date('d'), date('Y'));
$a->setTrigger( array( 'timestamp' => $timestamp ), array ( 'jestanes', 'xkey' => 'xvalue', 'xxx' => 'yyy' ) );
$a->setDescription( '7a: '.$timestamp.'=now tre xparams' );
$c->addComponent( $a );

$a = new valarm();
$timestamp = mktime ( date('H'), date('i'), date('s'), date('m'), date('d'), date('Y'));
$a->setProperty( 'Description'
               , '7b: '.$timestamp.'=now, tz=-0200 and tre xparams+VALUE=>DATE' );
$a->setProperty( 'triggeR'
               , array( 'timestamp' => $timestamp, 'tz' => '-0200' )
               , array ( 'jestanes','VALUE'=>'DATE', 'xkey' => 'xvalue', 'xxx' => 'yyy' ) );
$c->addComponent( $a );

$str = $c->createCalendar();
echo $str;
// $c->returnCalendar( FALSE, 'test.ics' );

?>