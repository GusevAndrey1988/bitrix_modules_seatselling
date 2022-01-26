<?php

namespace Site\SeatSelling\ORM\TicketTable;

use Bitrix\Main\ORM;
use Site\SeatSelling\ORM\EventTable\EventTable;
use Site\SeatSelling\ORM\SeatTable\SeatTable;

class TicketTable extends ORM\Data\DataManager
{
    private const TABLE_NAME = 'site_seat_selling_ticket';

    public static function getTableName()
    {
        return self::TABLE_NAME;
    }

    public static function getObjectClass()
    {
        return Ticket::class;
    }

    public static function getCollectionClass()
    {
        return TicketCollection::class;
    }

    public static function getMap()
    {
        return [
            (new ORM\Fields\IntegerField('ID'))
                ->configurePrimary(true),
            
            (new ORM\Fields\IntegerField('SEAT_ID'))
                ->configureNullable(false),

            (new ORM\Fields\IntegerField('EVENT_ID'))
                ->configureNullable(false),

            (new ORM\Fields\Relations\Reference(
                'SEAT',
                SeatTable::class,
                ORM\Query\Join::on('this.SEAT_ID', 'ref.ID')
            ))->configureJoinType('inner'),

            (new ORM\Fields\Relations\Reference(
                'EVENT',
                EventTable::class,
                ORM\Query\Join::on('this.EVENT_ID', 'ref.ID')
            ))->configureJoinType('inner')
        ];
    }
}