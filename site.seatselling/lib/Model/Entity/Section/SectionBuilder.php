<?php

namespace Site\SeatSelling\Model\Entity\Section;

use Site\SeatSelling\Model\Entity\Section;

class SectionBuilder
{
    public static function build(array $row): Section\Section
    {
        $row = array_change_key_case($row, CASE_UPPER);

        $section = new Section\Section(
            $row['ID'],
            $row['NAME']
        );

        return $section;
    }
}