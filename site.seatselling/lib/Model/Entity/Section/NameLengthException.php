<?php

namespace Site\SeatSelling\Model\Entity\Section;

class NameLengthException extends \Exception
{
    public function __construct(string $name, int $maxVal)
    {
        parent::__construct(
            'name length error: '
            . mb_strlen($name) 
            . ' char(s) max value\'s '
            . $maxVal
        );
    }
}