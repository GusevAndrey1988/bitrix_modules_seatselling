<?php

namespace Site\SeatSelling\ORM\EventTable;

use Bitrix\Main\ORM;

class EventTable extends ORM\Data\DataManager
{
    private const TABLE_NAME = 'site_seat_selling_event';

    public static function getTableName(): string
    {
        return self::TABLE_NAME;
    }

    public static function getObjectClass(): string
    {
        return Event::class;
    }

    public static function getCollectionClass(): string
    {
        return EventCollection::class;
    }

    public static function getMap(): array
    {
        return [
            (new ORM\Fields\IntegerField('ID'))
                ->configurePrimary()
                ->configureAutocomplete(),
            
            (new ORM\Fields\IntegerField('PRICE_POLICY_ID'))
                ->configureNullable(false),

            (new ORM\Fields\StringField('NAME', [
                'validation' => function() {
                    return [
                        new ORM\Fields\Validators\LengthValidator(1, 255)
                    ];
                },
            ]))->configureNullable(false),
            
            (new ORM\Fields\TextField('DESCRIPTION')),

            (new ORM\Fields\DatetimeField('EVENT_TIME'))
                ->configureNullable(false),
            
            (new ORM\Fields\IntegerField('DURATION', [
                'validation' => function() {
                    return [
                        new ORM\Fields\Validators\RangeValidator(0, 65535),
                    ];
                }
            ])),

            (new ORM\Fields\Relations\Reference(
                'PRICE_POLICY',
                \Site\SeatSelling\ORM\PricePolicyTable\PricePolicyTable::class,
                ORM\Query\Join::on('this.PRICE_POLICY_ID', 'ref.ID'),
            ))->configureJoinType('inner'),
        ];
    }
}