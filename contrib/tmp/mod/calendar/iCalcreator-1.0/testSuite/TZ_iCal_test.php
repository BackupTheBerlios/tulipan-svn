<?php // TZ_iCal_test.php

require_once '../iCalcreator.class.php';

echo "12345678901234567890123456789012345678901234567890123456789012345678901234567890<br />
";
echo "         1         2         3         4         5         6         7         8<br />
";

$tpl = "
     BEGIN:VTIMEZONE
     TZID:US-Eastern
     LAST-MODIFIED:19870101T000000Z
     BEGIN:STANDARD
     DTSTART:19971026T020000
     RDATE:19971026T020000
     TZOFFSETFROM:-0400
     TZOFFSETTO:-0500
     TZNAME:EST
     END:STANDARD
     BEGIN:DAYLIGHT
     DTSTART:19971026T020000
     RDATE:19970406T020000
     TZOFFSETFROM:-0500
     TZOFFSETTO:-0400
     TZNAME:EDT
     END:DAYLIGHT
     END:VTIMEZONE
     <br />
";
while( 0 < substr_count( $tpl, '  '))
  $tpl = str_replace('  ', ' ', $tpl );
$tpl = str_replace(',', ",
", $tpl );
echo $tpl;

$c = new vcalendar ();

$e = new vtimezone();
$e->setProperty( 'Tzid', 'US-Eastern' );
$e->setProperty( 'Last-Modified', '19870101' );

$s = new vtimezone( 'standard' );
$s->setProperty( 'Dtstart', '19971026020000' );
$s->setProperty( 'Rdate', array( '19971026020000' ));
$s->setProperty( 'Tzoffsetfrom', '-0400' );
$s->setProperty( 'tzoffsetTo', '-0500' );
$s->setProperty( 'tzname', 'EST' );
$e->addSubComponent( $s );

$d = new vtimezone( 'daylight' );
$d->setDtstart( '19971026020000' );
$d->setRdate( array( '19970406020000' ));
$d->setTzoffsetfrom( '-0500' );
$d->setTzoffsetto( '-0400' );
$d->setTzname( 'EDT' );
$e->addSubComponent( $d );

$c->addComponent( $e );

$str = $c->createCalendar();
echo $str."<br />
";

echo "################################################<br />
";
$tpl = "
     BEGIN:VTIMEZONE
     TZID:US-Eastern
     LAST-MODIFIED:19870101T000000Z
     TZURL:http://zones.stds_r_us.net/tz/US-Eastern
     BEGIN:STANDARD
     DTSTART:19671029T020000
     RRULE:FREQ=YEARLY;BYDAY=-1SU;BYMONTH=10
     TZOFFSETFROM:-0400
     TZOFFSETTO:-0500
     TZNAME:EST
     END:STANDARD
     BEGIN:DAYLIGHT
     DTSTART:19870405T020000
     RRULE:FREQ=YEARLY;BYDAY=1SU;BYMONTH=4
     TZOFFSETFROM:-0500
     TZOFFSETTO:-0400
     TZNAME:EDT
     END:DAYLIGHT
     END:VTIMEZONE
     <br />
";
while( 0 < substr_count( $tpl, '  '))
  $tpl = str_replace('  ', ' ', $tpl );
$tpl = str_replace(',', ",
", $tpl );
echo $tpl;

$c = new vcalendar ();

$e = new vtimezone();
$e->setProperty( 'Tzid', 'US-Eastern' );
$e->setProperty( 'Last-Modified', '19870101T000000' );
$e->setProperty( 'tzurl', 'http://zones.stds_r_us.net/tz/US-Eastern' );

$s = new vtimezone( 'standard' );
$s->setDtstart( '19671029T020000' );
$s->setRrule( array( 'FREQ'       => "YEARLY"
                   , 'BYMONTH'    => 10
                   , 'BYday'      => array( -1, 'DAY' => 'SU' )));
$s->setTzoffsetfrom( '-0400' );
$s->setTzoffsetto( '-0500' );
$s->setTzname( 'EST' );
$e->addSubComponent( $s );

$d = new vtimezone( 'daylight' );
$d->setProperty( 'Dtstart', '19870405T020000' );
$d->setProperty( 'Rrule'
               , array( 'FREQ'       => "YEARLY"
                      , 'BYMONTH'    => 4
                      , 'BYday'      => array( 1, 'DAY' => 'SU' )));
$d->setProperty( 'Tzoffsetfrom', '-0500' );
$d->setProperty( 'Tzoffsetto', '-0400' );
$d->setProperty( 'tzname', 'EDT' );
$e->addSubComponent( $d );

$c->addComponent( $e );

$str = $c->createCalendar();
echo $str."<br />
";
?>