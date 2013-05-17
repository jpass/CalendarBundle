<?php
namespace TFox\CalendarBundle\Service\WidgetService;
class Week {
	private $calendar;
	private $days;
	
	public function __construct($calendar)
	{
		$this->calendar = $calendar;
		$this->days = array();
	}
	
	public function getNumber()
	{
		$lastDay = $this->days[count($this->days) - 1];
		$lastDate = $lastDay->getDate();
		return (int)$lastDate->format('W');
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
		$firstDay = $this->days[count($this->days) - 1];
		$firstDate = $firstDay->getDate();
		return (int)$firstDate->format('Y');
	}
	
	public function getMonths()
	{		
		$_this = $this;
		$months = array_filter($this->calendar->getMonths(), function($month) use($_this) {
			if(($_this->getFirstDate() < $month->getFirstDate()
					&& $_this->getLastDate() < $month->getFirstDate())
					||($_this->getFirstDate() > $month->getLastDate()
							&& $_this->getLastDate() > $month->getLastDate())) {
				return false;
			} else {
				return true;
			}
		});
		
		return $months;
	}
	
	public function isInMonth($month)
	{
		$months = $this->getMonths();
		foreach($months as $monthIterator) {
			if($monthIterator->getNumber() == $month->getNumber()
					&& $monthIterator->getYear() == $month->getYear())
				return true;
		}
		return false;
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
}
