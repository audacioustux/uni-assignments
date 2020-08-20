<?php

namespace App\Core\FlagTypeEnum;

abstract class FlagTypeEnum
{
    const rude_or_vulgar = 'r';
    const harassment_or_hate_speech = 'h';
    const spam_or_copyright = 's';
    const inappropriate = 'i';
    const other = 'o';
}
