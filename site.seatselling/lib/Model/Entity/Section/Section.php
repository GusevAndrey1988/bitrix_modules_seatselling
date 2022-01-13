<?php

namespace Site\SeatSelling\Model\Entity\Section;

class Section
{
    private $id = 0;
    private $name = '';

    public function __construct(int $id, string $name)
    {
        if (!$this->validateId($id))
        {
            throw new \InvalidArgumentException('incorrect id: ' . $id);
        }

        if (!$this->validateNameLength($name))
        {
            throw new NameLengthException($name, 255);
        }

        $this->id = $id;
        $this->name = $name;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name)
    {
        if (!$this->validateNameLength($name))
        {
            throw new NameLengthException($name, 255);
        }

        return $this->name;
    }

    private function validateId(int $id): bool
    {
        if ($id <= 0)
        {
            return false;
        }

        return true;
    }

    private function validateNameLength(string $name): bool
    {
        if (strlen($name) == 0 || mb_strlen($name) > 255)
        {
            return false;
        }

        return true;
    }
}