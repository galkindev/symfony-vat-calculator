<?php

declare(strict_types=1);

namespace App\Calculator;

interface VATCalculatorInterface
{
    public function calculate(float $amount, float $rate): float;
}
