<?php

namespace Alc\CalDAV;

class vCalendar {

    /**
     * @var string
     */
    private $title;

    /**
     * @var \DateTime
     */
    private $start;

    /**
     * @var \DateTime
     */
    private $end;

    /**
     * Get the value of Title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set the value of Title
     *
     * @param string title
     *
     * @return self
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get the value of Start
     *
     * @return \DateTime
     */
    public function getStart()
    {
        return $this->start;
    }

    /**
     * Set the value of Start
     *
     * @param \DateTime start
     *
     * @return self
     */
    public function setStart(\DateTime $start)
    {
        $this->start = $start;

        return $this;
    }

    /**
     * Get the value of End
     *
     * @return \DateTime
     */
    public function getEnd()
    {
        return $this->end;
    }

    /**
     * Set the value of End
     *
     * @param \DateTime end
     *
     * @return self
     */
    public function setEnd(\DateTime $end)
    {
        $this->end = $end;

        return $this;
    }

    /**
     * To String
     *
     * @return string vcal
     */
    public function __toString() {

        return 'BEGIN:VCALENDAR
PRODID:-//Nextcloud calendar v1.4.1
VERSION:2.0
CALSCALE:GREGORIAN
BEGIN:VEVENT
UID:'.md5($this->getTitle()).'
SUMMARY:'.$this->getTitle().'
DTSTART;VALUE=DATE:'.$this->getStart()->format('Ymd').'
DTEND;VALUE=DATE:'.$this->getEnd()->format('Ymd').'
END:VEVENT
END:VCALENDAR';
    }

    public static function createFromRaw($raw) {

        preg_match_all('/(.+)\:(.+)\n/', $raw, $matches);

        $data = array();

        foreach($matches[0] as $key => $match) {

            $data[$matches[1][$key]] = $matches[2][$key];
        }

        $vcal = new static();
        $vcal->setTitle($data['SUMMARY']);

        return $vcal;
    }
}
