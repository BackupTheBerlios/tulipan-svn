<?php // relatedTo_iCal_test.php

require_once '../iCalcreator.class.php';


$c = new vcalendar ();
/* setRelatedTo( string relid [, string reltype ] )
   "PARENT" ( Default") / "CHILD" / "SIBLING / iana-token 
   ; (Some other IANA registered ; iCalendar relationship type) / x-name)
   ; A non-standard, experimental
*/
$e = new vevent();
$e->setComment( '1: 19960401-080045-4000F192713@host.com' );
$e->setRelatedTo( '19960401-080045-4000F192713@host.com' );
$c->addComponent( $e );
$e = new vevent();
$e->setProperty( 'comment'
               , "2: 19960401-080045-4000F192713@host.com, array( 'reltype' => 'CHILD' )" );
$e->setProperty ( 'RelATed-To'
                 , '19960401-080045-4000F192713@host.com'
                 , array( 'reltype' => 'CHILD' ));
$c->addComponent( $e );
$e = new vevent();
$e->setComment( "3: '19960401-080045-4000F192713@host.com', array( 'yParam' )" );
$e->setRelatedTo( '19960401-080045-4000F192713@host.com', array( 'yParam' ));
$c->addComponent( $e );
$e = new vevent();
$e->setProperty( 'comment'
                ,"4: 19960401-080045-4000F192713@host.com, array( 'reltype' => 'SIBLING', 'yParam', 'xparamKey' => 'xparamValue' )" );
$e->setProperty( 'Related-TO'
               , '19960401-080045-4000F192713@host.com'
               , array( 'reltype' => 'SIBLING'
                      , 'yParam'
                      , 'xparamKey' => 'xparamValue' ));
$c->addComponent( $e );

// $str = $c->createCalendar();
// echo $str."<br />";
$c->returnCalendar( FALSE, 'test.ics' );

?>