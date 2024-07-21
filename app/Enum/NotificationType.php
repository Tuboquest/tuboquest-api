<?php

declare(strict_types=1);

namespace App\Enum;

enum NotificationType: string
{
    case SUCCESS = 1;
    case ERROR = 2;
    case INFO = 3;
    case DEFAUTL = 4;

    public static function getRandomValue(): int
    {
        return random_int(1, 4);
    }
}
