<?php

require __DIR__.'/../vendor/autoload.php';

use Alc\CalDAV\CalDAV;
use Alc\CalDAV\vCalendar;

$client = new CalDAV();
$client->connect('https://.../dav', 'username', 'password');

$calendars = $client->findCalendars();
$client->setCalendar($calendars["personal"]);

$event = new vCalendar();
$event->setTitle('Hello');
$event->setStart(new \DateTime());
$event->setEnd(new \DateTime('+1 days'));

try {

    $client->create((string)$event);

} catch (\Exception $e) {

    echo $e->getMessage();
}


$events = $client->getEventsToVCal($event->getStart(), $event->getEnd());

print_r($events);
