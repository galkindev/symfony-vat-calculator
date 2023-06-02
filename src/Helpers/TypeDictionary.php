<?php

declare(strict_types=1);

namespace App\Helpers;

use BadMethodCallException;

final class TypeDictionary
{
    const REMOVE_VAT_FROM_THE_PRICE = 1;
    const ADD_VAT_TO_THE_PRICE = 2;

    public static function getDescription(int $type): string
    {
        return match ($type) {
            self::REMOVE_VAT_FROM_THE_PRICE => 'Remove VAT from the price',
            self::ADD_VAT_TO_THE_PRICE => 'Add VAT to the price',
            default => throw new BadMethodCallException(),
        };
    }
}
