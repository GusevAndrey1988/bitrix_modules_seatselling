<?php

namespace Site\SeatSelling\Model\Exception;

class CostValueException extends \Exception
{
    public function __construct(string $value, int $errorCode = 0)
    {
        parent::__construct(
            'incorrect value of cost: ' . $value,
            $errorCode
        );
    }
}