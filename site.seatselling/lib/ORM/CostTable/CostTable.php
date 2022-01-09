<?php

namespace Site\SeatSelling\ORM\CostTable;

use Bitrix\Main\ORM;

class CostTable extends ORM\Data\DataManager
{
    private const TABLE_NAME = 'site_seat_selling_cost';

    public static function getTableName(): string
    {
        return self::TABLE_NAME;
    }

    public static function getObjectClass(): string
    {
        return Cost::class;
    }

    public static function getCollectionClass(): string
    {
        return CostCollection::class;
    }

    public static function getMap(): array
    {
        return [
            (new ORM\Fields\IntegerField('SEAT_ID'))
                ->configurePrimary(),

            (new ORM\Fields\IntegerField('PRICE_POLICY_ID'))
                ->configurePrimary(),

            (new ORM\Fields\DecimalField('VALUE'))
                ->configureNullable(false),
            
            (new ORM\Fields\Relations\Reference(
                'SEAT',
                \Site\SeatSelling\ORM\SeatTable\SeatTable::class,
                ORM\Query\Join::on('this.SEAT_ID', 'ref.ID')
            ))->configureJoinType('inner'),

            (new ORM\Fields\Relations\Reference(
                'PRICE_POLICY',
                \Site\SeatSelling\ORM\PricePolicyTable\PricePolicyTable::class,
                ORM\Query\Join::on('this.PRICE_POLICY_ID', 'ref.ID')
            ))->configureJoinType('inner'),
        ];
    }
}