<?php

namespace TFox\CalendarBundle\Service\WidgetService;

class Hour extends CalendarItem
{
    public function __toString()
    {
        return $this->getDate()->format('H:i');
    }
}
