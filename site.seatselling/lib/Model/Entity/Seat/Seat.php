<?php

namespace Site\SeatSelling\Model\Entity\Seat;

use Site\SeatSelling\Model\Entity;
use Site\SeatSelling\Model\Entity\Exception;
use Site\SeatSelling\Model\Entity\Validator;

class Seat extends Entity\Entity
{
    /** @var int $row */
    private $row = 0;

    /** @var int $col */
    private $col = 0;

    /** @var Entity\Section\Section */
    private $section = null;

    public function __construct(int $id, int $row, int $col, Entity\Section\Section $section)
    {
        $this->setId($id);
        $this->setRow($row);
        $this->setCol($col);
        $this->setSection($section);

        $section->addSeat($this);
    }

    public function setRow(int $row): void
    {
        if (!Validator\SeatPositionValidator::validate($row))
        {
            throw new Exception\SeatPositionException($row);
        }

        $this->row = $row;
    }

    public function getRow(): int
    {
        return $this->row;
    }

    public function setCol(int $col): void
    {
        if (!Validator\SeatPositionValidator::validate($col))
        {
            throw new Exception\SeatPositionException($col);
        }

        $this->col = $col;
    }

    public function getCol(): int
    {
        return $this->col;
    }

    public function getSection(): ?Entity\Section\Section
    {
        return $this->section;
    }

    private function setSection(Entity\Section\Section $section): void
    {
        if ($this->section)
        {
            $this->section->removeSeatById($this->getId());
        }

        $this->section = $section;
        $section->addSeat($this);
    }
}