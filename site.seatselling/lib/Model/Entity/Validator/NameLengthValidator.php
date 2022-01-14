<?php

namespace Site\SeatSelling\Model\Entity\Validator;

class NameLengthValidator
{
    public const MAX_NAME_LENGTH = 255;

    public static function validate(string $name): bool
    {
        if (strlen($name) == 0 || mb_strlen($name) > static::MAX_NAME_LENGTH)
        {
            return false;
        }

        return true;
    }
}