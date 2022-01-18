<?php

namespace Site\SeatSelling\Model\Entity;

use Site\SeatSelling\Model\Exception;
use Site\SeatSelling\Model\Validator;

class Entity
{
    private $id = 0;

    public function getId(): int
    {
        return $this->id;
    }

     /**
     * @throws Exception\EntityIdException
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