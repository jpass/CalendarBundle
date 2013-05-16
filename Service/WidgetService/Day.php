<?php
namespace TFox\CalendarBundle\Service\WidgetService;

class Day {
	private $date;
	
	public function __construct(\DateTime $date)
	{
		$this->date = $date;
	}
	
	public function getDate()
	{
		return $this->date;
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
