<?php

namespace Site\SeatSelling\Model\Entity\SeatCost;

use Site\SeatSelling\Model\Entity;
use Site\SeatSelling\Model\Exception;
use Site\SeatSelling\Model\Validator;

class SeatCost extends Entity\Entity
{
    /** @var Entity\PricePolicy\PricePolicy $pricePolicy */
    private $pricePolicy = null;

    /** @var float $value */
    private $value = 0;

    public function __construct(
        int $id,
        Entity\PricePolicy\PricePolicy $pricePolicy,
        float $value = 0
    )
    {
        $this->setId($id);
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

    public function getPricePolicy(): Entity\PricePolicy\PricePolicy
    {
        return $this->pricePolicy;
    }

    private function setPricePolicy(Entity\PricePolicy\PricePolicy $pricePolicy): void
    {
        $this->pricePolicy = $pricePolicy;
    }
}