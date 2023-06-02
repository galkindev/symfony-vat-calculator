<?php

declare(strict_types=1);

namespace App\Calculator;

use App\Exception\UnknownCalculationTypeException;
use App\Helpers\CalculationTypeDictionary;

class VATCalculatorFactory
{
    /**
     * @throws UnknownCalculationTypeException
     */
    public function create(int $type): VATCalculatorInterface
    {
        return match ($type) {
            CalculationTypeDictionary::REMOVE_VAT_FROM_THE_PRICE => new RemoveVATCalculator(),
            CalculationTypeDictionary::ADD_VAT_TO_THE_PRICE => new AddVATCalculator(),
            default => throw new UnknownCalculationTypeException(),
        };
    }
}
