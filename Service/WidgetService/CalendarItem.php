<?php

namespace TFox\CalendarBundle\Service\WidgetService;

use Carbon\Carbon;
use Symfony\Component\HttpFoundation\ParameterBag;

abstract class CalendarItem
{
    protected $date;

    protected $parameters;

    public function __construct(Carbon $date)
    {
        $this->parameters = new ParameterBag();
        $this->date = $date;
    }

    /**
     * @return Carbon
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Get parameter value by $key
     * @param $key
     *
     * @return mixed
     */
    public function get($key)
    {
        return $this->parameters->get($key);
    }

    /**
     * Set $value for parameter $key
     *
     * @param $key
     * @param $value
     *
     * @return $this
     */
    public function set($key, $value)
    {
        $this->parameters->set($key, $value);

        return $this;
    }

    /**
     * Set $value for parameter $key
     *
     * @param $key
     * @param $value
     *
     * @return Day
     */
    public function setParameter($key, $value)
    {
        return $this->set($key, $value);
    }

    /**
     * Get parameter value by $key
     *
     * @param $key
     *
     * @return mixed
     */
    public function getParameter($key)
    {
        return $this->get($key);
    }
}
