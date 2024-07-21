<?php

declare(strict_types=1);

namespace App\Enum;

enum DiskApi: string
{
    case ROTATE = '/api/rotate';
    case ANGLE_STATUS = '/api/angle';
}