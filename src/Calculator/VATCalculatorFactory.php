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
        switch ($type) {
            case TypeDictionary::REMOVE_VAT_FROM_THE_PRICE:
                return new RemoveVATCalculator();
            case TypeDictionary::ADD_VAT_TO_THE_PRICE:
                return new AddVATCalculator();
            default:
                throw new UnknownCalculationType();
        }
    }
}
