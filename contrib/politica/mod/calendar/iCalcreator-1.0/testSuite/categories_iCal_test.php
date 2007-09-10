<?php // created_iCal_test.php

require_once '../iCalcreator.class.php';

$c = new vcalendar ();

$e = new vevent();
$e->setCategories( "category1" );
$c->addComponent( $e );

$e = new vevent();
$e->setProperty( 'Categories', "category1, category2", array('hejsan' => 'tjoflojt', 'hoppsan', 'language' => 'en' ));
$c->addComponent( $e );

$e = new vevent();
$e->setConfig( 'language', 'se' );
$e->setProperty( 'comment', '"category3", array("hejsan2" => "tjoflöjt2", "hoppsan" )');
$e->setCategories( "category3", array('hejsan2' => 'tjoflöjt2', 'hoppsan' ));
$e->setProperty( 'categories', "category4, category5", array('xKey' => 'xValue'));
$e->setProperty( 'comment', '"category4, category5", array("xKey" => "xValue")' );
$c->addComponent( $e );

// $str = $c->createCalendar();
// echo $str."<br />";
$c->returnCalendar( FALSE, 'test.ics' );
?>