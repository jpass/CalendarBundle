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

//src/TFox/TestBundle/Calendar/Day.php

namespace TFox\TestBundle\Calendar;

class Day extends \TFox\CalendarBundle\Service\WidgetService\Day {

	private $isHoliday = false;
	
	public function getIsHoliday()
	{
		return in_array((int)$this->date->format('N'), array(6,7)) || $this->isHoliday;
	}
	
	public function setIsHoliday($value)
	{
		$this->isHoliday = $value;
	}
}


//src/TFox/TestBundle/Calendar/Month.php
//src/TFox/TestBundle/Resources/views/Calendar/Default/index.html.twig

namespace TFox\TestBundle\Calendar;

class Month extends \TFox\CalendarBundle\Service\WidgetService\Month
{

	public function getIsSummer()
	{
		return in_array($this->getNumber(), array(6, 7, 8));
	}
}


//And finally twig

<html>
<head>

<style type="text/css">
table {
	border: 1px solid black;
	margin: 10px;
	border-collapse: collapse;
}

table td {
	border: 1px solid black;
	padding: 5px;
	width: 20px;
	height: 20px;
	text-align: center;
}
</style>

</head>
<body>

<h1>Calendar for {{ calendar.year }} year</h1>

{% for month in calendar.months %}
	<div style="float: left">
		<table>
			<tr>
				<td colspan="8">
					{% if month.isSummer %}<font style='color: green; font-weight: bold; font-style: italic;'>{% endif %}
						{{ month.fullName }}
					{% if month.isSummer %}</font>{% endif %}
				</td>
			</tr>
			<tr>
				<td></td>
				{% for week_name in calendar.weekShortNames %}
					<td>
						<b>
							{{ week_name }}
						</b>
					</td>
				{% endfor %}
			</tr>
		{% for week in month.weeks %}	
			<tr>
				<td>
					<b>{{ week.number }}</b>
				</td>
				{% for day in week.days %}
					{% set style = day.parameter('today') ? 'background-color: green' : '' %}
					<td style="{{ style }}">
						{% if day.inMonth(month) %}
							{% if day.isHoliday %}<font style='color: red; font-weight: bold'>{% endif %}
							{{ day.date | date('j') }}
							{% if day.isHoliday %}</font>{% endif %}
						{% endif %}
					</td>
				{% endfor %}
			</tr>	
		{% endfor %}
		</table>
	</div>
	{% if loop.index % 4 == 0 %}
		<div style="clear: both; float: left; display: block;"></div>
	{% endif %}
{% endfor %}


</body>
</html>


~~~

