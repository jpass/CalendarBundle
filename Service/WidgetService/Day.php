<?php
namespace TFox\CalendarBundle\Service\WidgetService;

use Carbon\Carbon;
use Symfony\Component\HttpFoundation\ParameterBag;

class Day extends CalendarItem
{
    protected $hours;

    public function __construct(Carbon $date)
    {
        parent::__construct($date);
        $this->hours = array();
    }

    public function addHour($hour)
    {
        $this->hours[] = $hour;
    }

    public function getHours()
    {
        return $this->hours;
    }

    public function getHour($hour)
    {
        return isset($this->hours[$hour]) ? $this->hours[$hour] : null;
    }

    public function getNumber()
    {
        return $this->date->format('j');
    }

    public function isFirstInWeek()
    {
        return $this->date->format('N') == 1;
    }

    public function isLastInWeek()
    {
        return $this->date->format('N') == 7;
    }

    public function isInWeek($week)
    {
        return $this->date->format('W') == $week->getNumber();
    }

    public function isInMonth($month)
    {
        return (($this->date->format('n') == $month->getNumber())
            && ($this->date->format('Y') == $month->getYear()));
    }

    public function isInYear($year)
    {
        return $this->date->format('Y') == $year;
    }
}
