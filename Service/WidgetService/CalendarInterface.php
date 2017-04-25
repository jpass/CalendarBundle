<?php

namespace TFox\CalendarBundle\Service\WidgetService;

interface CalendarInterface
{
    /**
     * @param string $monthModel
     * @param string $weekModel
     * @param string $dayModel
     *
     * @return self
     */
    public function setModels($monthModel, $weekModel, $dayModel);

    /**
     * @param integer $year
     *
     * @return CalendarInterface
     */
    public function generateYear($year);

    /**
     * @param integer $week
     *
     * @return CalendarInterface
     */
    public function generateWeek($week);

    /**
     * @return array
     */
    public function getDays();
}
