<?php

namespace Site\SeatSelling\Model\Entity\SeatCost;

use Site\SeatSelling\Model\Entity;
use Site\SeatSelling\Model\Exception;
use Site\SeatSelling\Model\Validator;

class SeatCost
{
    /** @var Entity\Seat\Seat $seat*/
    private $seat = null;

    /** @var Entity\PricePolicy\PricePolicy $pricePolicy */
    private $pricePolicy = null;

    /** @var float $value */
    private $value = 0;

    public function __construct(
        Entity\Seat\Seat $seat,
        Entity\PricePolicy\PricePolicy $pricePolicy,
        float $value = 0
    )
    {
        $this->setSeat($seat);
        $this->setPricePolicy($pricePolicy);
        $this->setValue($value);
    }

    /**
     * @throws Exception\CostValueException
     */
    public function setValue(float $value): void
    {
        if (Validator\CostValueValidator::validate($value))
        {
            throw new Exception\CostValueException($value);
        }

        $this->value = $value;
    }

    public function getValue(): float
    {
        return $this->value;
    }

    public function getSeat(): Entity\Seat\Seat
    {
        return $this->seat;
    }

    public function getPricePolicy(): Entity\PricePolicy\PricePolicy
    {
        return $this->pricePolicy;
    }

    private function setSeat(Entity\Seat\Seat $seat)
    {
        $this->seat = $seat;
    }

    private function setPricePolicy(Entity\PricePolicy\PricePolicy $pricePolicy): void
    {
        $this->pricePolicy = $pricePolicy;
    }
}