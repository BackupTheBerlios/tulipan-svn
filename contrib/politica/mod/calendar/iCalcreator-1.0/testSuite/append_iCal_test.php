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
$e1 = new vevent();
$e1->setProperty( 'Description', "Description ONE event" );
$e1->setProperty( 'Dtstart', 2006, 4, 5, 7, 0, 0, 'Europe/Rome' );
$e1->setProperty( 'Duration', 0, 1, 0 );
$e1a1 = new valarm();
$e1a1->setProperty( 'Action', 'AUDIO' );
$e1a1->setProperty( 'Description', "Description ONE event alarm" );
$e1a1->setProperty( 'Trigger', 2006, 4, 4, FALSE, 23, 48, 0, TRUE, TRUE, 'Europe/Rome' );
$e1a1->setProperty( 'X-WR-ALARMID', 'SOUNDALARM:Glass' );
$e1a1->setProperty( 'X-WR-ALARMUID', 'E2393CA4-4B32-4DC4-93F2-EEAC86E598D0' );
$e1a1->setProperty( 'Attach', 'http://www.domain.net/agendas/Glass.wav' );
$e1->addSubComponent( $e1a1 );
$c->addComponent( $e1 );
$str = $c->createCalendar();
echo $str."<br />";
$c->setConfig( 'Filename', 'test.ics' ); // set filename
$filearr = $c->saveCalendar();     // save calendar in file
// echo "file=".$filearr[0].'/'.$filearr[1].' size='.$filearr[2]."<br />";
// ##############################################
// create calendar TWO with two components
$c = new vcalendar ();
$e21 = new vevent();
$e21->setProperty( 'Description', "Description TWO one" );
$e21->setProperty( 'Dtstart', 2006, 5, 4, 3, 2, 1, 'Europe/Rome' );
$c->addComponent( $e21 );
$e22 = new vevent();
$e22->setProperty( 'Description', "Description TWO 2", 'alt.text. 2' );
$e22->setProperty( 'Dtstart', 2001, 2, 3, 4, 4, 6, 'Europe/Rome' );
$c->addComponent( $e22 );
// ##############################################
// append components (in calendar TWO ) to calendar (ONE) file
$filearr = $c->appendCalendar( $filearr[0], $filearr[1] );
// echo "file=".$filearr[0].'/'.$filearr[1].' size='.$filearr[2]."<br />";
// ##############################################
// display results
$c->useCachedCalendar( $filearr[0], $filearr[1] );
?>