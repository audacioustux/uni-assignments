<?php

namespace App\Core\Enums;

use App\Core\Traits\JsonTypeDef;
use MyCLabs\Enum\Enum;

class BlogStateEnum extends Enum
{
    use JsonTypeDef;

    private const DRAFT = 'd';
    private const NON_LISTED = 'n';
    private const LISTED = 'l';
}
