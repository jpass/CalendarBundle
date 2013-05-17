<?php
namespace TFox\CalendarBundle\Service\WidgetService;
class Month {
	protected $calendar;
	protected $days;
	
	public function __construct($calendar)
	{
		$this->calendar = $calendar;
		$this->days = array();
	}
	
	public function getNumber()
	{
		$firstDay = $this->days[0];
		$firstDate = $firstDay->getDate();
		return (int)$firstDate->format('n');
	}
	
	public function addDay($day)
	{
		$this->days[] = $day;
	}
	
	public function getDays()
	{
		return $this->days;
	}
	
	public function getYear()
	{
		$firstDay = $this->days[0];
		$firstDate = $firstDay->getDate();
		return (int)$firstDate->format('Y');
	}
	
	public function getDay($index)
	{
		if(isset($this->days[$index]))
			return $this->days[$index];
		else
			return null;
	}
	
	public function getFirstDay()
	{
		return $this->days[0];
	}
	
	public function getFirstDate()
	{
		return $this->getFirstDay()->getDate();
	}
	
	public function getLastDay()
	{
		return $this->days[count($this->days) - 1];
	}
	
	public function getLastDate()
	{
		return $this->getLastDay()->getDate();
	}
	
	public function getWeeks()
	{
		$_this = $this;
		$weeks = array_filter($this->calendar->getWeeks(), function($week) use($_this) {
			if(($week->getFirstDate() < $_this->getFirstDate()
					&& $week->getLastDate() < $_this->getFirstDate())
					||($week->getFirstDate() > $_this->getLastDate()
							&& $week->getLastDate() > $_this->getLastDate())) {
				return false;
			} else {
				return true;
			}
		});
	
		return $weeks;
	}
	
	public function getFullName()
	{
		$fullNames = $this->calendar->getMonthFullNames();
		return $fullNames[$this->getNumber() - 1];
	}
	
	public function getShortName()
	{
		$shortNames = $this->calendar->getMonthShortNames();
		return $shortNames[$this->getNumber() - 1];
	}
}
