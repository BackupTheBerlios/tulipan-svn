<?php // append_iCal_test.php
/* NO OUTPUT=redirect, only appending testing
echo"12345678901234567890123456789012345678901234567890123456789012345678901234567890<br />";
echo "         1         2         3         4         5         6         7         8<br />";
echo 'TRIGGER;TZID=Europe/Rome:20060404T234800'."
    .'X-WR-ALARMID:SOUNDALARM:Glass'."
    .'X-WR-ALARMUID:E2393CA4-4B32-4DC4-93F2-EEAC86E598D0'."
    .'ATTACH;VALUE=URI:Glass';
echo "<br /><br />";
*/
require_once '../iCalcreator.class.php';
// ##############################################
// create calendar ONE with one component/subcomponent
$c = new vcalendar();
$e = new vevent();
$e->setProperty( 'Description', "Description ONE event" );
$e->setProperty( 'Dtstart', 2006, 4, 5, 7, 0, 0, 'Europe/Rome' );
$e->setProperty( 'Duration', 0, 1, 0 );
$a = new valarm();
$a->setProperty( 'Action', 'AUDIO' );
$a->setProperty( 'Description', "Description ONE event alarm" );
$a->setProperty( 'Trigger', 2006, 4, 4, FALSE, 23, 48, 0, TRUE, TRUE, 'Europe/Rome' );
$a->setProperty( 'X-WR-ALARMID', 'SOUNDALARM:Glass' );
$a->setProperty( 'X-WR-ALARMUID', 'E2393CA4-4B32-4DC4-93F2-EEAC86E598D0' );
$a->setProperty( 'Attach', 'http://www.domain.net/agendas/Glass.wav' );
$e->addSubComponent( $a );
$c->addComponent( $e );
$str = $c->createCalendar();
echo $str."<br />";
// $c->setFilename( '', 'test.ics' ); // set filename
$filearr = $c->saveCalendar();     // save calendar in file
// echo "file=".$filearr[0].'/'.$filearr[1].' size='.$filearr[2]."<br />";
// ##############################################
// create calendar TWO with two components
$c = new vcalendar ();
$e = new vevent();
$e->setProperty( 'Description', "Description TWO one" );
$e->setProperty( 'Dtstart', 2006, 5, 4, 3, 2, 1, 'Europe/Rome' );
$c->addComponent( $e );
$e = new vevent();
$e->setProperty( 'Description', "Description TWO 2", 'alt.text. 2' );
$e->setProperty( 'Dtstart', 2001, 2, 3, 4, 4, 6, 'Europe/Rome' );
$c->addComponent( $e );
// ##############################################
// append components (in calendar TWO ) to calendar (ONE) file
$filearr = $c->appendCalendar( $filearr[0], $filearr[1] );
// echo "file=".$filearr[0].'/'.$filearr[1].' size='.$filearr[2]."<br />";
// ##############################################
// display results
$c->useCachedCalendar( $filearr[0], $filearr[1] );
?>