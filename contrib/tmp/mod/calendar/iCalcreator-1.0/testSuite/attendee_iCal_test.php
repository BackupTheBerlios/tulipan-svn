<?php // action_iCal_test.php

require_once '../iCalcreator.class.php';

$c = new vcalendar ();

$a = new valarm();
$tpl = "'someone@internet.com'
                , array( 'cutype'         => 'New York'
                       , 'member'         => array( ".'"kigsf1@sf.net", kigsf2@sf.net, kigsf3@sf.net'." )
                       , 'role'           => 'CHAIR'
                       , 'PARTSTAT'       => 'ACCEPTED'
                       , 'RSVP'           => 'TRUE'
                       , 'DELEgated-to'   => array( ".'"MAILTO:kigsf1@sf.net", "kigsf2@sf.net", MAILTO:kigsf3@sf.net'." )
                       , 'delegateD-FROM' => array( 'kigsf1@sf.net', 'kigsf2@sf.net', 'kigsf3@sf.net' )
                       , 'SENT-BY'        => 'info@kigkonsult.se'
                       , 'CN'             => 'John Doe'
                       , 'DIR'            => 'http://www.domain.net/doc/info.doc'
                       , 'LANGUAGE'       => 'us-EN'
                       , 'hejsan'         => 'hoppsan'   // xparam
                       ,                     'tjosan'    // also xparam
                  )";
while( 0 < substr_count( $tpl, '  '))
  $tpl = str_replace( "  ", " ", $tpl );

$a->setProperty( 'description', $tpl );
$a->setAttendee( 'someone@internet.com'
                , array( 'cutype'         => 'New York'
                       , 'member'         => array( 'kigsf1@sf.net', 'kigsf2@sf.net', 'kigsf3@sf.net' )
                       , 'role'           => 'CHAIR'
                       , 'PARTSTAT'       => 'ACCEPTED'
                       , 'RSVP'           => 'TRUE'
                       , 'DELEgated-to'   => array( 'kigsf1@sf.net', 'kigsf2@sf.net', 'kigsf3@sf.net' )
                       , 'delegateD-FROM' => array( 'kigsf1@sf.net', 'kigsf2@sf.net', 'kigsf3@sf.net' )
                       , 'SENT-BY'        => 'info@kigkonsult.se'
                       , 'CN'             => 'John Doe'
                       , 'DIR'            => 'http://www.domain.net/doc/info.doc'
                       , 'LANGUAGE'       => 'us-EN'
                       , 'hejsan'         => 'hoppsan'   // xparam
                       ,                     'tjosan'    // also xparam
                  ));
$c->addComponent( $a );

$a = new valarm();
$a->setConfig( 'language'
              , 'no' );
$a->setProperty( 'attendee'
                ,'someone@internet.com'
                , array( 'cutype'         => 'New York'
                       , 'member'         => array( 'kigsf1@sf.net', 'kigsf2@sf.net', 'kigsf3@sf.net' )
                       , 'role'           => 'CHAIR'
                       , 'PARTSTAT'       => 'ACCEPTED'
                       , 'RSVP'           => 'TRUE'
                       , 'DELEgated-to'   => array( 'kigsf4@sf.net' )
                       , 'delegateD-FROM' => array( 'kigsf5@sf.net' )
                       , 'SENT-BY'        => 'info@kigkonsult.se'
                       , 'CN'             => 'John Doe'
                       , 'DIR'            => 'http://www.domain.net/doc/info.doc'
                       , 'hejsan'         => 'hoppsan'   // xparam
                       ,                     'tjosan'    // also xparam
                  ));
$c->addComponent( $a );

$a = new valarm();
$a->setLanguage( 'no' );
$a->setAttendee( 'someone@internet.com'
                , array( 'cutype'         => 'Boston'
                       , 'member'         => array( 'kigs1@sf.net' )
                       , 'role'           => 'CHAIR'
                       , 'PARTSTAT'       => 'ACCEPTED'
                       , 'RSVP'           => 'TRUE'
                       , 'DELEgated-to'   => array( 'kigsf2@sf.net' )
                       , 'delegateD-FROM' => array( 'kigsf3@sf.net' )
                       , 'SENT-BY'        => 'info@kigkonsult.se'
                       , 'DIR'            => 'http://www.domain.net/doc/info.doc'
                       , 'hejsan'         => 'hoppsan'   // xparam
                       ,                     'tjosan'    // also xparam
                  ));
$a->setAttendee( 'someone.else@internet.com' );
$c->addComponent( $a );

$a = new valarm();
$a->setLanguage( 'no' );
$a->setProperty( 'ATTENDEE'
                ,'someone@internet.com'
                , array( 'cutype'         => 'Boston'
                       , 'member'         => array( 'kigs1@sf.net' )
                       , 'role'           => 'CHAIR'
                       , 'PARTSTAT'       => 'ACCEPTED'
                       , 'RSVP'           => 'TRUE'
                       , 'DELEgated-to'   => array( 'kigsf2@sf.net' )
                       , 'delegateD-FROM' => array( 'kigsf3@sf.net' )
                       , 'SENT-BY'        => 'info@kigkonsult.se'
                       , 'DIR'            => 'http://www.domain.net/doc/info.doc'
                       , 'hejsan'         => 'hoppsan'   // xparam
                       ,                     'tjosan'    // also xparam
                  ));
$a->setAttendee( 'someone.else@internet.com' );
$c->addComponent( $a );

// $str = $c->createCalendar();
// echo $str."<br />";
$c->returnCalendar( FALSE, 'test.ics' );


?>