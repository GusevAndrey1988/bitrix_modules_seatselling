<?php

namespace Site\SeatSelling\Model\Repository;

use Site\SeatSelling\Model\Repository\ObjectPool;
use Site\SeatSelling\Model\Entity\Section;
use Site\SeatSelling\ORM\SectionTable;

class SectionRepository
{
    public static function getById(int $id): ?Section\Section
    {
        $objectPull = ObjectPool::getInstance();

        $section = null;
        if ($section = $objectPull->getFromPool(Section\Section::class, $id))
        {
            return $section;
        }

        $row = SectionTable\SectionTable::getById($id)->fetchRaw();

        if (!$row)
        {
            return null;
        }

        $section = Section\SectionBuilder::build($row);
        $objectPull->addToPool($section, $section->getId());

        return $section;
    }
}