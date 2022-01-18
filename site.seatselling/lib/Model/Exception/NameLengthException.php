<?php

namespace Site\SeatSelling\Model\Exception;

class NameLengthException extends \Exception
{
    public function __construct(string $name, int $maxVal, int $errorCode = 0)
    {
        parent::__construct(
            'name length error: ' . mb_strlen($name) 
                . ' char(s) (max value\'s ' . $maxVal . ')',
            $errorCode
        );
    }
}