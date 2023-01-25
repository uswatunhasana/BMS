<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static self SUPERADMIN()
 * @method static self ADMIN()
 * @method static self WRITER()
 */
final class UserType extends Enum
{
    const SUPERADMIN = 0;
    const ADMIN = 1;
    const WRITER = 2;

    public  static function arrayStatus():array{

        return [
            'Superadmin'=>self::SUPERADMIN,
            'Admin'=>self::ADMIN,
            'Writer'=>self::WRITER
        ];
    }
}
