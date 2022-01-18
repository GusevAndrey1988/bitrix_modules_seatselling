<?php

namespace Site\SeatSelling\Model\Entity\Exception;

use Site\SeatSelling\Model\Entity\Validator\SeatPositionValidator as Validator;

class SeatPositionException extends \Exception
{
    public function __construct(int $position, int $errorCode = 0)
    {
        parent::__construct(
            'Seat position must be between ' . Validator::MIN_SEAT_NUM
                . ' and ' . Validator::MAX_SEAT_NUM . ' , current value ' . $position,
            $errorCode
        );
    }
}