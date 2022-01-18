<?php

namespace Site\SeatSelling\Model\Entity\Section;

use Site\SeatSelling\Model\Entity;
use Site\SeatSelling\Model\Entity\Exception;
use Site\SeatSelling\Model\Entity\Validator;

class Section extends Entity\Entity
{
    /** @var string $name */
    private $name = '';

    /** @var Entity\Seat\Seat[] $seatList */
    private $seatList = [];

    /**
     * @throws \InvalidArgumentException
     * @throws \Site\SeatSelling\Model\Entity\Exception\NameLengthException
     */
    public function __construct(int $id, string $name)
    {
        $this->setId($id);
        $this->setName($name);
    }

    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @throws \Site\SeatSelling\Model\Entity\Exception\NameLengthException
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
        if (!$this->hasSeatById($seat->getId()))
        {
            $this->seatList[$seat->getId()] = $seat;
            return true;
        }

        return false;
    }

    public function hasSeatById(int $id): bool
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

    public function removeSeatById(int $id): bool
    {
        if (!Validator\EntityIdValidator::validate($id))
        {
            throw new Exception\EntityIdException($id);
        }

        if ($this->hasSeatById($id))
        {
            unset($this->seatList[$id]);
            return true;
        }

        return false;
    }
}