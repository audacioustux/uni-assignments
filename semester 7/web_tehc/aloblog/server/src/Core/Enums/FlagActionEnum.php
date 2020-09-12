<?php

namespace App\Core\Enums;

use App\Core\Enums\Enum;

class FlagActionEnum extends Enum
{
    private const PENDING = 'p';
    private const BAN_USER = 'b';
    private const DELETE_BLOG = 'd';
    private const REJECT_FLAG = 'r';
}
