<?php

namespace Site\SeatSelling\Model\Validator;

class CostValueValidator
{
    public static function validate(float $value): bool
    {
        if ($value < 0)
        {
            return false;
        }

        return true;
    }
}