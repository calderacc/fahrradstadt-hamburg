<?php declare(strict_types=1);

namespace AppBundle\Util;

class DateTimeUtil
{
    public static function getYearStartDateTime(\DateTime $year): \DateTime
    {
        $dateTime = sprintf('%d-01-01 00:00:00', $year->format('Y'));

        return new \DateTime($dateTime, $year->getTimezone());
    }

    public static function getYearEndDateTime(\DateTime $year): \DateTime
    {
        $dateTime = sprintf('%d-12-31 23:59:59', $year->format('Y'));

        return new \DateTime($dateTime, $year->getTimezone());
    }

    public static function getMonthStartDateTime(\DateTime $month): \DateTime
    {
        $dateTime = sprintf('%d-%d-01 00:00:00', $month->format('Y'), $month->format('m'));

        return new \DateTime($dateTime, $month->getTimezone());
    }

    public static function getMonthEndDateTime(\DateTime $month): \DateTime
    {
        $dateTime = sprintf('%d-%d-%d 23:59:59', $month->format('Y'), $month->format('m'), $month->format('t'));

        return new \DateTime($dateTime, $month->getTimezone());
    }

    public static function getDayStartDateTime(\DateTime $day): \DateTime
    {
        $dateTime = sprintf('%d-%d-%d 00:00:00', $day->format('Y'), $day->format('m'), $day->format('d'));

        return new \DateTime($dateTime, $day->getTimezone());
    }

    public static function getDayEndDateTime(\DateTime $day): \DateTime
    {
        $dateTime = sprintf('%d-%d-%d 23:59:59', $day->format('Y'), $day->format('m'), $day->format('d'));

        return new \DateTime($dateTime, $day->getTimezone());
    }
}
