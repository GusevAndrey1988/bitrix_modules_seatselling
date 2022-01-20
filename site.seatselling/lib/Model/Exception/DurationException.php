<?php

namespace Site\SeatSelling\Model\Exception;

use Site\SeatSelling\Model\Validator;

class DurationException extends \Exception
{
    public function __construct(int $duration, int $errorCode = 0)
    {
        parent::__construct(
            'duration out of range: ' . $duration
                . ', (min: ' . Validator\DurationValidator::MIN_DURATION
                . ', max: ' . Validator\DurationValidator::MAX_DURATION . ')',

            $errorCode
        );
    }
}