<?php

namespace Site\SeatSelling\Model\Entity;

use Site\SeatSelling\Model\Entity\Exception;
use Site\SeatSelling\Model\Entity\Validator;

class Entity
{
    private $id = 0;

    public function getId(): int
    {
        return $this->id;
    }

     /**
     * @throws \InvalidArgumentException
     */
    protected function setId($id): void
    {
        if (!Validator\EntityIdValidator::validate($id))
        {
            throw new Exception\EntityIdException($id);
        }

        $this->id = $id;
    }
}