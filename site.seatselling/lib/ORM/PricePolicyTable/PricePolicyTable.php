<?php

namespace Site\SeatSelling\ORM\PricePolicyTable;

use Bitrix\Main\ORM;

class PricePolicyTable extends ORM\Data\DataManager
{
    private const TABLE_NAME = 'site_seat_selling_price_policy';

    public static function getTableName(): string
    {
        return self::TABLE_NAME;
    }

    public static function getObjectClass(): string
    {
        return PricePolicy::class;
    }

    public static function getCollectionClass(): string
    {
        return PricePolicyCollection::class;
    }

    public static function getMap(): array
    {
        return [
            (new ORM\Fields\IntegerField('ID'))
                ->configurePrimary()
                ->configureAutocomplete(),
            
            (new ORM\Fields\StringField('NAME', [
                'validation' => function() {
                    return [
                        new ORM\Fields\Validators\LengthValidator(1, 255),
                    ];
                }
            ]))->configureNullable(false),
        ];
    }
}