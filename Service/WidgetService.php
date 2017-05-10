<?php
namespace TFox\CalendarBundle\Service;

use TFox\CalendarBundle\Service\WidgetService\Calendar;
use TFox\CalendarBundle\Service\WidgetService\CalendarInterface;

/**
 * Class for widget servuce. Creates an instance of calendar suitable for rendering in TWIG template.
 *
 * @author tfox
 *
 */
class WidgetService
{
    const DEFAULT_CALENDAR_MODEL = '\TFox\CalendarBundle\Service\WidgetService\Calendar';

    private $calendarModel = self::DEFAULT_CALENDAR_MODEL;
    private $monthModel = null;
    private $weekModel = null;
    private $dayModel = null;

    /**
     * Returns a calendar for specified year
     *
     * @param int $year
     */
    public function generateCalendar($year)
    {
        /** @var CalendarInterface $calendar */
        $calendar = new $this->calendarModel();
        $calendar->setModels($this->monthModel, $this->weekModel, $this->dayModel);
        $calendar->generateYear($year);

        return $calendar;
    }

    /**
     * @param $week
     *
     * @return CalendarInterface
     */
    public function generateWeekCalendar($week)
    {
        /** @var CalendarInterface $calendar */
        $calendar = new $this->calendarModel();
        $calendar->setModels($this->monthModel, $this->weekModel, $this->dayModel);
        $calendar->generateWeek($week);

        return $calendar;
    }

    /**
     * @param $month
     *
     * @return CalendarInterface
     */
    public function generateMonthCalendar($month)
    {
        /** @var CalendarInterface $calendar */
        $calendar = new $this->calendarModel();
        $calendar->setModels($this->monthModel, $this->weekModel, $this->dayModel);
        $calendar->generateMonth($month);

        return $calendar;
    }

    public function setModels($calendarModel, $monthModel, $weekModel, $dayModel)
    {
        $this->calendarModel = is_null($calendarModel) ? self::DEFAULT_CALENDAR_MODEL : $calendarModel;
        if (!class_exists($this->calendarModel))
        {
            throw new \Exception(sprintf('Class %s not found.', $this->calendarModel));
        }
        $this->monthModel = $monthModel;
        $this->weekModel = $weekModel;
        $this->dayModel = $dayModel;
    }
}
