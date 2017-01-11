<?php

namespace Alc\CalDAV;

use SimpleCalDAV\SimpleCalDAVClient;

class CalDAV extends SimpleCalDAVClient
{
    public function getEvents($start = null, $finish = null, $relative_url = null)
    {
        if ($start instanceof \DateTime) {
            $start = $start->format("Ymd\THis\Z");
        }
        if ($finish instanceof \DateTime) {
            $finish = $finish->format("Ymd\THis\Z");
        }

        return parent::getEvents($start, $finish, $relative_url);
    }

    public function getEventsToVCal(\DateTime $start, \DateTime $finish) {

        $dataEvents = $this->getEvents($start, $finish);

        $events = array();

        foreach($dataEvents as $dataEvent ) {

            $events[] = vCalendar::createFromRaw($dataEvent->getData());
        }

        return $events;
    }
}
