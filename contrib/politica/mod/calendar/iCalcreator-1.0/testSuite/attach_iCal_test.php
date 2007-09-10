<?php // action_iCal_test.php

require_once '../iCalcreator.class.php';

$c = new vcalendar ();

$e = new valarm();
$e->setAttach( 'http://doclib.domain.net/lib1234567890/docfile1.txt' );
$c->addComponent( $e );

$e2 = new valarm();
$e2->setAttach( 'MIICajCCAdOgAwIBAgICBEUwDQYJKoZIhvcNAQEEBQAwdzELMAkGA1UEBhMCVVMxLDAqBgNVBAoTI05ldHNjYXBlIENvbW11bmljYXRpb25zIE.. .. .', array('FMTTYPE' => 'image/basic', 'ENCODING' => 'BASE64', 'VALUE' => 'BINARY', 'hejsan' ));
$e2->setProperty( 'attach', 'http://doclib.domain.net/lib1234567890/docfile2.txt', array( 'filetype' => 'text' ));
$c->addComponent( $e2 );

// $str = $c->createCalendar();
// echo $str."<br />";
$c->returnCalendar( FALSE, 'test.ics' );

?>