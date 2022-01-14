<?php

namespace Site\SeatSelling\Model\Entity\Seat;

use Site\SeatSelling\Model\Entity;

class Seat extends Entity\Entity
{
    private $row = 0;
    private $col = 0;

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
    }

    public function getRow(): int
    {
    }

    public function setCol(int $col): void
    {
    }

    public function getCol(): int
    {
    }

    public function setSection(Entity\Section\Section $section): void
    {
        /**
         * if ($section) {
         *     $section->removeSeat($this)
         * }
         */
    }

    public function getSection(): ?Entity\Section\Section
    {
    }
}