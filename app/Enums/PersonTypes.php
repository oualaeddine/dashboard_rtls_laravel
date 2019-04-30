<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class PersonTypes extends Enum
{
    const RESIDENT = 'RESIDENT';
    const EMPLOYEE = 'EMPLOYEE';
    const PENSIONNAIRE = 'PENSIONNAIRE';

    public static function getDescription($value): string
    {
        if($value == self::RESIDENT) {
            return 'Résident';
        }
        else if($value == self::EMPLOYEE) {
            return 'Employée';
        }
        else if($value == self::PENSIONNAIRE) {
            return 'Pensionnaire';
        }

        return $value;
    }


}
