<?php
namespace TFox\CalendarBundle\Service;
use TFox\CalendarBundle\Service\WidgetService\Calendar;
/**
 * Class for widget servuce. Creates an instance of calendar suitable for rendering in TWIG template.
 * @author tfox
 *
 */
class WidgetService {

	/**
	 * Returns a calendar for specified year
	 * @param int $year
	 */
	public function generateCalendar($year) {
		$calendar = new Calendar($year);
		
		return $calendar;
	}
}
