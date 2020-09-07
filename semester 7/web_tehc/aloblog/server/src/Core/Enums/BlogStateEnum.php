<?php

namespace App\Core\Enums;

use MyCLabs\Enum\Enum;

class BlogStateEnum extends Enum {
    private const DRAFT = 'd';
    private const NON_LISTED = 'n';
    private const LISTED = 'l';
}
