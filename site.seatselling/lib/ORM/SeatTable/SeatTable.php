<?php

namespace Site\SeatSelling\ORM\SeatTable;

use Bitrix\Main\Localization\Loc;
use Bitrix\Main\ORM;
use Bitrix\Main\ORM\Event;
use Site\SeatSelling\ORM\TicketTable\TicketTable;

Loc::loadMessages(__FILE__);

class SeatTable extends ORM\Data\DataManager
{
    private const TABLE_NAME = 'site_seat_selling_seat';

    public static function getTableName(): string
    {
        return self::TABLE_NAME;
    }

    public static function getObjectClass(): string
    {
        return Seat::class;
    }

    public static function getCollectionClass(): string
    {
        return SeatCollection::class;
    }

    public static function getMap(): array
    {
        return [
            (new ORM\Fields\IntegerField('ID'))
                ->configurePrimary()
                ->configureAutocomplete(),

            (new ORM\Fields\IntegerField('SECTION_ID'))
                ->configureNullable(false),

            (new ORM\Fields\IntegerField('ROW', [
                'validation' => function() {
                    return [
                        new ORM\Fields\Validators\RangeValidator(0, 65535),
                    ];
                }
            ]))->configureNullable(false),

            (new ORM\Fields\IntegerField('COL', [
                'validation' => function() {
                    return [
                        new ORM\Fields\Validators\RangeValidator(0, 65535),
                    ];
                }
            ]))->configureNullable(false),

            (new ORM\Fields\Relations\Reference(
                'SECTION',
                \Site\SeatSelling\ORM\SectionTable\SectionTable::class,
                ORM\Query\Join::on('this.SECTION_ID', 'ref.ID')
            ))->configureJoinType('inner'),

            (new ORM\Fields\Relations\OneToMany(
                'COSTS',
                \Site\SeatSelling\ORM\CostTable\CostTable::class,
                'SEAT'
            ))->configureJoinType('inner'),

            (new ORM\Fields\Relations\OneToMany(
                'TICKETS',
                TicketTable::class,
                'SEAT'
            ))->configureJoinType('inner'),
        ];
    }

    public static function onBeforeAdd(ORM\Event $event): ORM\EventResult
    {
        return static::checkUnique($event);
    }

    public static function onBeforeUpdate(Event $event)
    {
        return static::checkUnique($event);
    }

    private static function checkUnique(ORM\Event $event): ORM\EventResult
    {
        $result = new ORM\EventResult();
        $data = $event->getParameter('fields');

        $sectionId = $data['SECTION_ID'];
        $row = $data['ROW'];
        $col = $data['COL'];

        $selectedRows = static::getList([
            'filter' => [
                'SECTION_ID' => $sectionId,
                'ROW' => $row,
                'COL' => $col,
            ]
        ])->fetchAll();

        if (!empty($selectedRows))
        {
            $result->addError(new ORM\EntityError(
                Loc::getMessage(
                    'SITE_SEAT_SELLING_SEAT_TABLE_UNIQUE_ERROR',
                    [
                        '#ROW#' => $row,
                        '#COL#' => $col,
                        '#SECTION_ID#' => $sectionId,
                    ]
                )
            ));
        }

        return $result;
    }
}