<?php

declare(strict_types=1);

namespace App\Calculator;

final class RemoveVATCalculator implements VATCalculatorInterface
{
    public function calculate($amount, $rate): float
    {
        return round($amount / (100 + $rate) * 100, 2);
    }
}
