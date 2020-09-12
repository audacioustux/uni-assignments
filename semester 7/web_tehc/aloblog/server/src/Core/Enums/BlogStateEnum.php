<?php

namespace App\Core\Enums;

use App\Core\Traits\JsonTypeDef;
use App\Core\Enums\Enum;

class BlogStateEnum extends Enum
{
    private const DRAFT = 'd';
    private const NON_LISTED = 'n';
    private const LISTED = 'l';
}
