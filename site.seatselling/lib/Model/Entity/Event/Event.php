<?php

namespace Site\SeatSelling\Model\Entity\Event;

use Site\SeatSelling\Model\Entity;

/* `ID` INT(11) PRIMARY KEY AUTO_INCREMENT,
`PRICE_POLICY_ID` INT(11) NOT NULL,
`NAME` VARCHAR(255) NOT NULL,
`DESCRIPTION` TEXT,
`EVENT_TIME` DATETIME NOT NULL,
`DURATION` SMALLINT, */

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
        $this->setId($id);
        $this->setPricePolicy($pricePolicy);
        $this->setName($name);
        $this->setEventTime($eventTime);
        $this->setText($text);
        $this->setDuration($duration);
    }
}