<?php

namespace Site\SeatSelling\Model\Repository;

use Site\SeatSelling\Model\Common\Singleton;

class ObjectPool
{
    use Singleton;

    /** @var array $objectList */
    private $objectList = [];

    public function addToPool(object $object, string $uniqueId): void
    {
        $this->objectList[$object::class][$uniqueId] = $object;
    }

    public function getFromPool(string $className, string $uniqueId): ?object
    {
        if (
            isset($this->objectList[$className]) 
            && isset($this->objectList[$className][$uniqueId])
        )
        {
            return $this->objectList[$className][$uniqueId];
        }

        return null;
    }

    public function getObjectPool(): array
    {
        return $this->objects;
    }
}