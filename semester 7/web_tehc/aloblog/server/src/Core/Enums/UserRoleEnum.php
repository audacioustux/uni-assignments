<?php

namespace App\Core\Enums;

use App\Core\Enums\Enum;

class UserRoleEnum extends Enum
{
    private const SUPERUSER = 's';
    private const MODERATOR = 'm';
    private const REGULAR = 'r';
}
