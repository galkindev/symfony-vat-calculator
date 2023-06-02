<?php

declare(strict_types=1);

namespace App\Calculator;

use App\Exception\UnknownCalculationType;
use App\Helpers\TypeDictionary;

class VATCalculatorFactory
{
    /**
     * @throws UnknownCalculationType
     */
    public function create(int $type): VATCalculatorInterface
    {
        return match ($type) {
            TypeDictionary::REMOVE_VAT_FROM_THE_PRICE => new RemoveVATCalculator(),
            TypeDictionary::ADD_VAT_TO_THE_PRICE => new AddVATCalculator(),
            default => throw new UnknownCalculationType(),
        };
    }
}
