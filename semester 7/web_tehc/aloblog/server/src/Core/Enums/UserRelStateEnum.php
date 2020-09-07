<?php

namespace App\Core\Enums;

use MyCLabs\Enum\Enum;

class UserRelStateEnum extends Enum {
    private const BLOCKED = 'b';
    private const SEE_FIRST = 's';
    private const FOLLOWING = 'f';
}
