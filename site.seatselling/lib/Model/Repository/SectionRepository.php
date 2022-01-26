<?php

namespace Site\SeatSelling\Model\Repository;

use Site\SeatSelling\Model\Repository\ObjectPool;
use Site\SeatSelling\Model\Entity;
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
        $objectPull->addToPool($section, $id);

        return $section;
    }

    /**
     * @return Section\Section[]
     */
    public static function getAll(int $limit = 100, int $offset = 0): array
    {
        $rowList = SectionTable\SectionTable::getList([
            'limit' => $limit,
            'offset' => $offset,
            'order' => [
                'ID' => 'ASC',
            ],
        ])->fetchAll();

        $objectPull = ObjectPool::getInstance();

        $objectList = [];
        foreach ($rowList as $row)
        {
            $section = null;
            if ($section = $objectPull->getFromPool(Section\Section::class, $row['ID']))
            {
                $objectList[$row['ID']] = $section;
            }
            else
            {
                $section = Section\SectionBuilder::build($row);
                $objectPull->addToPool($section, $section->getEntityId());
            }
        }

        return $objectList;
    }

    public static function createNewSection(string $sectionName): ?Section\Section
    {
        $insertResult = SectionTable\SectionTable::add([
            'fields' => [
                'NAME' => $sectionName
            ]
        ]);

        if (!$insertResult->isSuccess())
        {
            return null;
        }

        $newSection = Section\SectionBuilder::build([
            'ID' => $insertResult->getId(),
            'NAME' => $sectionName
        ]);

        $objectPull = ObjectPool::getInstance();
        $objectPull->addToPool($newSection, $newSection->getEntityId());

        return $newSection;
    }

    public static function store(Section\Section $section): bool
    {
        $updateResult = SectionTable\SectionTable::update(
            $section->getEntityId(),
            [
                'fields' => [
                    'NAME' => $section->getName()
                ],
            ]
        );

        if (!$updateResult->isSuccess())
        {
            return false;
        }

        return true;
    }
}