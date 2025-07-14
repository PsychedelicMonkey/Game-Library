<?php

declare(strict_types=1);

namespace App\Enums;

enum PlatformType: string
{
    case Console = 'console';
    case Service = 'service';
}
