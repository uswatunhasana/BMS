<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class PublishedType extends Enum
{
    const __default = self::ACTIVE;

    const ACTIVE = 1;
    const INACTIVE = 0;
}
