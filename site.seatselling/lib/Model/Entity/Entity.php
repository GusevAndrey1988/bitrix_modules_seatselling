<?php

namespace Site\SeatSelling\Model\Entity;

use Site\SeatSelling\Model\Exception;
use Site\SeatSelling\Model\Validator;

class Entity
{
    /** @var int $id */
    private $id = 0;

    public function __construct(int $id)
    {
        if (!Validator\EntityIdValidator::validate($id))
        {
            throw new Exception\EntityIdException($id);
        }

        $this->id = $id;
    }

    public function getEntityId(): int
    {
        return $this->id;
    }
}