<?php

namespace Site\SeatSelling\Model\Exception;

class EntityIdException extends \Exception
{
    public function __construct(int $id, int $errorCode = 0)
    {
        parent::__construct('incorrect id: ' . $id, $errorCode);
    }
}