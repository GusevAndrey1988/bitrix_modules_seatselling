<?php

namespace Site\SeatSelling\Model\Entity\PricePolicy;

use Site\SeatSelling\Model\Entity;
use Site\SeatSelling\Model\Validator;
use Site\SeatSelling\Model\Exception;

class PricePolicy extends Entity\Entity
{
    /** @var string $name */
    private $name = '';

    public function __construct(int $id, string $name)
    {
        $this->setId($id);
        $this->setName($name);
    }

    /**
     * @throws Exception\NameLengthException
     */
    public function setName(string $name): void
    {
        if (!Validator\NameLengthValidator::validate($name))
        {
            throw new Exception\NameLengthException(
                $name,
                Validator\NameLengthValidator::MAX_NAME_LENGTH
            );
        }

        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }
}