<?php // xprop_iCal_test.php

require_once '../iCalcreator.class.php';

$c = new vcalendar ();
$c->setProperty( 'X-PROP'
               , 'a test setting a x-prop property in calendar' );
$c->setProperty( 'X-WR-CALNAME', 'Games Night Meetup', array( 'xKey' => 'xValue' ));
$c->setProperty( 'X-WR-CALDESC', 'Calendar Description' );
$c->setProperty( 'X-WR-TIMEZONE', 'Europe/Stockholm' );

$e1 = new vevent();
$e1->setProperty( 'comment', '4: Games Night Meetup' );
$e1->setProperty( 'X-WR-CALNAME', 'Games Night Meetup' );
$e1->setProperty( 'Comment', "5: 'X-ABC-MMSUBJ', 'http://load.noise.org/mysubj.wav'");
$e1->setProperty( 'X-ABC-MMSUBJ', 'http://load.noise.org/mysubj.wav' );
$c->addComponent( $e1 );

$e2 = new vevent();
$e2->setLanguage( 'de' );
$e2->setProperty( 'Comment'
               , "6: 'X-ABC-MMSUBJ', 'http://load.noise.org/mysubj.wav'");
$e2->setProperty( 'X-ABC-MMSUBJ'
               , 'http://load.noise.org/mysubj.wav' );
$c->addComponent( $e2 );

$e3 = new vevent();
$e3->setConfig( 'Language', 'de' );
$e3->setProperty( 'Comment', "7: 'X-ABC-MMSUBJ', 'http://load.noise.org/mysubj.wav', array( 'xparamKey' => 'xparamValue', 'language' => 'en' )");
$e3->setProperty( 'X-ABC-MMSUBJ', 'http://load.noise.org/mysubj.wav', array( 'xparamKey' => 'xparamValue', 'language' => 'en' ));
$c->addComponent( $e3 );

$e4 = new vevent();
$e4->setProperty( 'Comment'
               , "8: 'X-ABC-MMSUBJ', 'http://load.noise.org/mysubj.wav', array( 'xparamKey' => 'xparamValue', 'language' => 'en' )");
$e4->setProperty( 'X-ABC-MMSUBJ'
               , 'http://load.noise.org/mysubj.wav'
               , array( 'xparamKey' => 'xparamValue'
                      , 'language' => 'en' ));
$a1 = new valarm();
$a1->setProperty( 'Action', 'AUDIO' );
$a1->setProperty( 'Description'
               , '9: AUDIO-decription' );
$a1->setProperty( 'X-ALARM-PROPERTY'
               , 'X-ALARM-VALUE' );
$a1->setProperty( 'Attach'
               , 'http://www.domain.net/audiolib/ticktack.wav' );
$e4->addSubComponent( $a1 );
$c->addComponent( $e4 );

$str = $c->createCalendar();
echo $str;
// $c->returnCalendar( FALSE, 'test.ics' );

?>