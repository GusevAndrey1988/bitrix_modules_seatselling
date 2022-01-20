<?php

namespace Site\SeatSelling\Model\Repository;

use Site\SeatSelling\Model\Common\Singleton;

class ObjectPool
{
    use Singleton;

    /** @var array $objects */
    private $objects = [];

    public function addToPool(object $object, ...$primaryKeyList): void
    {
        $link = &$this->objects[$object::class];

        foreach ($primaryKeyList as $primary)
        {
            $link = &$link[$primary];
        }

        $link = $object;
    }

    public function getFromPool(string $className, ...$primaryKeyList): ?object
    {
       $link = &$this->objects[$className];

        foreach ($primaryKeyList as $primary)
        {
            if (is_object($link))
            {
                return null;
            }

            $link = &$link[$primary];
        }

        if (!$link || !is_object($link))
        {
            return null;
        }

        return $link;
    }

    public function getObjectPool(): array
    {
        return $this->objects;
    }
}