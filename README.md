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
