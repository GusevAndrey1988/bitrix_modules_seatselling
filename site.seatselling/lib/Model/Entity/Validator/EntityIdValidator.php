<?php

namespace Site\SeatSelling\Model\Entity\Validator;

class EntityIdValidator
{
    public static function validate(int $id): bool
    {
        if ($id <= 0)
        {
            return false;
        }

        return true;
    }
}