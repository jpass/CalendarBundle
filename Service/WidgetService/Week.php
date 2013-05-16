<?php
namespace TFox\CalendarBundle\Service\WidgetService;
class Week {
	private $number;
	private $days;
	
	public function __construct($number)
	{
		$this->number = $number;
		$this->days = array();
	}
	
	public function getNumber()
	{
		return $this->number;
	}
	
	public function addDay($day)
	{
		$this->days[] = $day;
	}
	
	public function getDays()
	{
		return $this->days;
	}
	
	public function isInMonth($month)
	{
		foreach($month->getDays() as $day) {
			foreach($this->getDays() as $day2) {
				if($day->getDate() == $day2->getDate()) {
					return true;
				}
			}
		}
		return false;
		/*
		if(!count($this->days))
			return false;
		
		$firstDay = $this->days[0];
		$lastDay = $this->days[(count($this->days) - 1)];
		$firstDate = $firstDay->getDate();
		$lastDate = $lastDay->getDate();
		
		if($month->getNumber() < 12) {
			return (($firstDate->format('n') == $month->getNumber())
					&& $lastDate->format('Y') == $month->getYear())
					|| (($lastDate->format('n') == $month->getNumber())
							&& $lastDate->format('Y') == $month->getYear()
					);
		} else {echo $firstDate->format('W');
			return ((($firstDate->format('n') == $month->getNumber())
					&& $lastDate->format('Y') == $month->getYear())
					|| (($lastDate->format('n') == $month->getNumber())
							&& $lastDate->format('Y') == $month->getYear()
					) && (int)$firstDate->format('W') > 6);
		}
*/
	}
}
