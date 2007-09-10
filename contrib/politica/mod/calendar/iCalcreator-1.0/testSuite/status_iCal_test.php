<?php // created_iCal_test.php

require_once '../iCalcreator.class.php';
/*
     statvalue  = "TENTATIVE"           ;Indicates event is tentative.
                / "CONFIRMED"           ;Indicates event is definite.
                / "CANCELLED"           ;Indicates event was cancelled.
        ;Status values for a "VEVENT"

     statvalue  =/ "NEEDS-ACTION"       ;Indicates to-do needs action.
                / "COMPLETED"           ;Indicates to-do completed.
                / "IN-PROCESS"          ;Indicates to-do in process of
                / "CANCELLED"           ;Indicates to-do was cancelled.
        ;Status values for "VTODO".

     statvalue  =/ "DRAFT"              ;Indicates journal is draft.
                / "FINAL"               ;Indicates journal is final.
                / "CANCELLED"           ;Indicates journal is removed.
        ;Status values for "VJOURNAL".
*/
$c = new vcalendar ();

$e = new vevent();
$e->setComment( "1: CONFIRMED" );
$e->setStatus( "CONFIRMED" );
$c->addComponent( $e );

$e = new vevent();
$e->setProperty( 'Comment', "2: 'FINAL', array ('x-final' => 'countdown' )");
$e->setProperty( 'Status', "FINAL", array ('x-final' => 'countdown' ));
$c->addComponent( $e );

$e = new vevent();
$e->setComment( "3: 'DRAFT', array ('RFC' )");
$e->setStatus( "DRAFT", array ('RFC' ));
$c->addComponent( $e );

// $str = $c->createCalendar();
// echo $str."<br />";
$c->returnCalendar( FALSE, 'test.ics' );

?>