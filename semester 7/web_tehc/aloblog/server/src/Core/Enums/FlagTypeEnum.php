<?php

namespace App\Core\Enums;

use App\Core\Enums\Enum;

class FlagTypeEnum extends Enum
{
    private const RUDE_OR_VULGAR = 'r';
    private const HARASSMENT_OR_HATE_SPEECH = 'h';
    private const SPAM_OR_COPYRIGHT = 's';
    private const INAPPROPRIATE = 'i';
    private const OTHER = 'o';
}
