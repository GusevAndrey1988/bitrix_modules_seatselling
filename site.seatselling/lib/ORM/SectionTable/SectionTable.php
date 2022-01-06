<?php

namespace Site\SeatSelling\ORM\SectionTable;

use Bitrix\Main\ORM;

class SectionTable extends ORM\Data\DataManager
{
    private const TABLE_NAME = 'site_seat_selling_section';

    public static function getTableName(): string
    {
        return self::TABLE_NAME;
    }

    public static function getObjectClass(): string
    {
        return Section::class;
    }

    public static function getCollectionClass(): string
    {
        return SectionCollection::class;
    }

    public static function getMap(): array
    {
        return [
            (new ORM\Fields\IntegerField('ID'))
                ->configurePrimary(true)
                ->configureAutocomplete(true),
            
            (new ORM\Fields\StringField('NAME', [
                'validation' => function() {
                    return [
                        new ORM\Fields\Validators\LengthValidator(1, 255)
                    ];
                },
            ]))->configureNullable(false),

            (new ORM\Fields\Relations\OneToMany(
                'SEATS',
                \Site\SeatSelling\ORM\SeatTable\SeatTable::class,
                'SECTION'
            ))
                ->configureJoinType('inner'),
        ];
    }
}