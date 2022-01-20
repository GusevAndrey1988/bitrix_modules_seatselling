<?php

namespace Site\SeatSelling\Model\Validator;

class DurationValidator
{
    public const MIN_DURATION = 0;
    public const MAX_DURATION = 65535;

    public static function validate(int $duration): bool
    {
        if ($duration < self::MIN_DURATION || $duration > self::MAX_DURATION)
        {
            return false;
        }
        
        return true;
    }
}