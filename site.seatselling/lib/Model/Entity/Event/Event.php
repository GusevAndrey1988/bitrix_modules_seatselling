<?php

namespace Site\SeatSelling\Model\Entity\Event;

use Site\SeatSelling\Model\Entity;
use Site\SeatSelling\Model\Exception;
use Site\SeatSelling\Model\Validator;

class Event extends Entity\Entity
{
    /** @var Entity\PricePolicy\PricePolicy $pricePolicy */
    private $pricePolicy = null;

    /** @var string $name */
    private $name = '';

    /** @var string $description */
    private $text = '';

    /** @var \DateTime $eventTime */
    private $eventTime = null;

    /** @var int $duration in sec */
    private $duration = 0;

    public function __construct(
        int $id,
        Entity\PricePolicy\PricePolicy $pricePolicy,
        string $name,
        \DateTime $eventTime,
        string $text = '',
        int $duration = 0
    )
    {
        parent::__construct($id);

        $this->setPricePolicy($pricePolicy);
        $this->setName($name);
        $this->setEventTime($eventTime);
        $this->setText($text);
        $this->setDuration($duration);
    }

    public function setPricePolicy(Entity\PricePolicy\PricePolicy $pricePolicy): void
    {
        $this->pricePolicy = $pricePolicy;
    }

    public function getPricePolicy(): Entity\PricePolicy\PricePolicy
    {
        return $this->pricePolicy;
    }

    /**
     * @throws Exception\NameLengthException
     */
    public function setName(string $name): void
    {
        if (!Validator\NameLengthValidator::validate($name))
        {
            throw new Exception\NameLengthException(
                $name,
                Validator\NameLengthValidator::MAX_NAME_LENGTH
            );
        }

        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setEventTime(\DateTime $eventTime): void
    {
        $this->eventTime = $eventTime;
    }

    public function getEventTime(): \DateTime
    {
        return $this->eventTime;
    }

    public function setText(string $text): void
    {
        $this->text = $text;
    }

    public function getText(): string
    {
        return $this->text;
    }

    /**
     * @throws Exception\DurationException
     */
    public function setDuration(int $duration): void
    {
        if (!Validator\DurationValidator::validate($duration))
        {
            throw new Exception\DurationException($duration);
        }

        $this->duration = $duration;
    }

    public function getDuration(): int
    {
        return $this->duration;
    }
}