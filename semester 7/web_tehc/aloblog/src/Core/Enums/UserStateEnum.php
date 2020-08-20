<?php

namespace App\Core‌‌‌‌\Enums;

use MyCLabs\Enum\Enum;

class UserStateEnum extends Enum
{
    private const BANNED = 'b';
    private const DELETED = 'd';
    private const ACTIVE = 'a';
}
