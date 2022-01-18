<?php

namespace Site\SeatSelling\Model\Type;

class Money 
{
    /** @var int $integer */
    private $integer = 0;

    /** @var int $fractional */
    private $fractional = 0;

    public function __construct(int $integer = 0, int $fractional = 0)
    {
        if ($fractional < 0)
        {
            throw new \InvalidArgumentException('fractional part is negative');
        }

        $this->integer = $integer;
        $this->fractional = $fractional;
    }

    // TODO
}