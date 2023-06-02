<?php

declare(strict_types=1);

namespace App\Calculator;

final class AddVATCalculator implements VATCalculatorInterface
{
    public function calculate(float $amount, float $rate): float
    {
        return round(($amount / 100) * (100 + $rate), 2);
    }
}
