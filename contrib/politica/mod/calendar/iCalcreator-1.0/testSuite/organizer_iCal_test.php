<?php // organizer_iCal_text.php

require_once '../iCalcreator.class.php';

$c = new vcalendar ();
$c->unique_id = 'kigkonsult.se';

$e = new vevent();
$e->setComment( "1: 'jsmith@host1.com'" );
$e->setOrganizer( 'jsmith@host1.com' );
$c->addComponent( $e );

$e = new vevent();
$e->setLanguage( 'no' );
$e->setProperty( 'Comment'
               , "2: 'MAILTO:jsmith@host1.com', array( 'xparamKey' => 'xparamValue', 'yParam' )" );
$e->setProperty( 'Organizer'
               , 'MAILTO:jsmith@host1.com'
               , array( 'xparamKey' => 'xparamValue', 'yParam' ));
$c->addComponent( $e );

$e = new vevent();
$e->setLanguage( 'no' );
$e->setComment( "3: 'jsmith@host1.com', array( 'CN' => 'John Smith', 'xparamKey' => 'xparamValue', 'yParam' )" );
$e->setOrganizer( 'jsmith@host1.com'
                , array( 'CN' => 'John Smith'
                       , 'xparamKey' => 'xparamValue'
                       , 'yParam' ));
$c->addComponent( $e );

$e = new vevent();
$e->setLanguage( 'no' );
$e->setProperty( 'comment', "4: 'jsmith@host1.com', array( 'language' => 'se', 'CN' => 'John Smith', 'SENT-BY' => ".'"MAILTO:info@host1.com"'." )" );
$e->setProperty( 'ORGANIZER'
               , 'jsmith@host1.com'
               , array( 'language' => 'se'
                      , 'CN' => 'John Smith'
                      , 'SENT-BY' => '"MAILTO:info@host1.com"' ));
$c->addComponent( $e );

$e = new vevent();
$e->setLanguage( 'no' );
$e->setComment( "5: 'jsmith@host1.com', array( 'language' => 'se', 'CN' => 'John Smith', 'DIR' => 'ldap://host.com:6666/o=3DDC%20Associates,c=3DUS??(cn=3DJohn%20Smith)', 'SENT-BY' => 'info1@host1.com', 'xparamKey' => 'xparamValue', 'yParam' )" );
$e->setOrganizer( 'jsmith@host1.com'
                , array( 'language'  => 'se'
                       , 'CN'        => 'John Smith'
                       , 'DIR'       => 'ldap://host.com:6666/o=3DDC%20Associates,c=3DUS??(cn=3DJohn%20Smith)'
                       , 'SENT-BY'   => 'info1@host1.com'
                       , 'xparamKey' => 'xparamValue'
                       ,                'yParam' ));
$c->addComponent( $e );

// $str = $c->createCalendar();
// echo $str;
$c->returnCalendar( FALSE, 'test.ics' );
