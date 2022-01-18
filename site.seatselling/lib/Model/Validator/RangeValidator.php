<?php

namespace Site\SeatSelling\Model\Validator;

class RangeValidator
{
    /**
     * $min <= $value <= $max
     * 
     * @throws \InvalidArgumentException
     */
    static public function validate(int $min, int $max, int $value): bool
    {
        if ($min > $max)
        {
            throw new \InvalidArgumentException(
                'min value (' . $min . ') larger max value (' . $max . ')'
            );
        }

        return ($min <= $value) && ($value <= $max);
    }
}