<?php

namespace App\Core\Enums;

use App\Core\Enums\Enum;

class UserRelStateEnum extends Enum
{
    private const BLOCKED = 'b';
    private const SEE_FIRST = 's';
    private const FOLLOWING = 'f';
}
