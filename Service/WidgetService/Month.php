<?php
namespace TFox\CalendarBundle\Service\WidgetService;
class Month {
	private $number;
	private $days;
	private $year;
	
	public function __construct($number, $year)
	{
		$this->number = $number;
		$this->year = $year;
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
	
	public function getYear()
	{
		return $this->year;
	}
	
}
