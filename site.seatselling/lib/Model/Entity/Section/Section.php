<?php

namespace Site\SeatSelling\Model\Entity\Section;

use Site\SeatSelling\Model\Entity;
use Site\SeatSelling\Model\Exception;
use Site\SeatSelling\Model\Validator;

class Section extends Entity\Entity
{
    /** @var string $name */
    private $name = '';

    /** @var Entity\Seat\Seat[] $seatList */
    private $seatList = [];

    /**
     * @throws \InvalidArgumentException
     * @throws Exception\NameLengthException
     */
    public function __construct(int $id, string $name)
    {
        parent::__construct($id);

        $this->setName($name);
    }

    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @throws Exception\NameLengthException
     */
    public function setName(string $name): void
    {
        if (!Validator\NameLengthValidator::validate($name))
        {
            throw new Exception\NameLengthException($name,
                Validator\NameLengthValidator::MAX_NAME_LENGTH);
        }

        $this->name = $name;
    }

    public function addSeat(Entity\Seat\Seat $seat): bool
    {
        if (!$this->hasSeatById($seat->getEntityId()))
        {
            $this->seatList[$seat->getEntityId()] = $seat;
            return true;
        }

        return false;
    }

    public function hasSeatById(string $id): bool
    {
        return array_key_exists($id, $this->seatList);
    }

    public function getSeatById(int $id): ?Entity\Seat\Seat
    {
        if ($this->hasSeatById($id))
        {
            return $this->seatList[$id];
        }

        return null;
    }

    public function getSeatByPosition(int $row, int $col): ?Entity\Seat\Seat
    {
        foreach ($this->seatList as $seat)
        {
            if ($seat->getRow() == $row && $seat->getCol() == $col)
            {
                return $seat;
            }
        }

        return null;
    }

    /**
     * @throws Exception\EntityIdException
     */
    public function removeSeatById(int $id): bool
    {
        if ($this->hasSeatById($id))
        {
            unset($this->seatList[$id]);
            return true;
        }

        return false;
    }
}