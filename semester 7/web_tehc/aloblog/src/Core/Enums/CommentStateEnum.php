<?php

namespace App\Core\Enums;

use MyCLabs\Enum\Enum;

class CommentStateEnum extends Enum
{
    private const PINNED = 'p';
    private const DELETED = 'd';
}
