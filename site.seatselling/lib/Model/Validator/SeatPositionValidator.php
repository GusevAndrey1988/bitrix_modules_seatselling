<?php

namespace Site\SeatSelling\Model\Validator;

class SeatPositionValidator
{
    public const MIN_SEAT_NUM = 0;
    public const MAX_SEAT_NUM = 65535;

    public static function validate(int $value): bool
    {
        return RangeValidator::validate(
            static::MIN_SEAT_NUM, static::MAX_SEAT_NUM, $value
        );
    }
}