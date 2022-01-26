<?php

namespace Site\SeatSelling\Model\Entity\Ticket;

use Site\SeatSelling\Model\Entity;

class Ticket extends Entity\Entity
{
    /** @var Entity\Event\Event $event */
    private $event = null;

    /** @var Entity\Seat\Seat $seat */
    private $seat = null;

    public function __construct(int $id, Entity\Event\Event $event, Entity\Seat\Seat $seat)
    {
        parent::__construct($id);

        $this->setEvent($event);
        $this->setSeat($seat);
    }

    public function setEvent(Entity\Event\Event $event): void
    {
        $this->event = $event;
    }

    public function getEvent(): Entity\Event\Event
    {
        return $this->event;
    }

    public function setSeat(Entity\Seat\Seat $seat): void
    {
        $this->seat = $seat;
    }

    public function getSeat(): Entity\Seat\Seat
    {
        return $this->seat;
    }
}