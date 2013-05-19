CalendarBundle
==============

This bundle allows to render calendars using Twig engine. Additional parameters might be added for each day, month and week. Also default classes might be extended using inheritance.

Installation
==============
1. Add to composer.json the next line:
~~~
"require": {
  ...
  "tfox/calendar-bundle": "1.0.0"
}
~~~

2. Add to app/AppKernel.php:

~~~
public function registerBundles()
{
    $bundles = array(
      ...
      new TFox\CalendarBundle\TFoxCalendarBundle()
    );
    ...
}
~~~ 


Usage
==============
~~~
  //src/TFox/TestBundle/Controller/DefaultController.php

  /**
	 * @Route
	 * @Template
	 */
	public function indexAction()
	{
		$now = new \DateTime();
		$year = $now->format('Y');
		
		$service = $this->get('tfox.calendar.widget'); //calling a calendar service

    //Defining a custom classes for rendering of months and days
  	$dayModelClass = '\TFox\TestBundle\Calendar\Day';
		$monthModelClass = '\TFox\TestBundle\Calendar\Month';
    /*
     * Set model classes for calendar. Arguments:
     * 1. For the whole calendar (watch $calendar variable). Default: \TFox\CalendarBundle\Service\WidgetService\Calendar
     * 2. Month. Default: \TFox\CalendarBundle\Service\WidgetService\Month
     * 3. Week. Default: '\TFox\CalendarBundle\Service\WidgetService\Week
     * 4. Day. Default: '\TFox\CalendarBundle\Service\WidgetService\Day'
     * To set default classes null should be passed as argument
     */
		$service->setModels(null, $monthModelClass, null, $dayModelClass);
		$calendar = $service->generateCalendar($year); //Generate a calendar for specified year
    /*
     * Get the 26th of December and make it hodiday.
     * Function setIsHoliday is defined in a class which 
     * extends default \TFox\CalendarBundle\Service\WidgetService\Day class
     */
		$calendar->getDay('26.12')->setIsHoliday(true);
		
    /*
     * Another way to pass additional parametes without extension of default model
     * Sets the parameter 'today' for current day
     */
		$calendar->getDay($now->format('d.m'))->setParameter('today', 1);
		
    /*
     * Pass calendar to Twig
     */
		return array('calendar' => $calendar);
	}
~~~
