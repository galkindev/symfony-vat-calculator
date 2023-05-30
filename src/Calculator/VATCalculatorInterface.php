<?php

declare(strict_types=1);

namespace App\Calculator;

interface VATCalculatorInterface
{
    public function calculate($amount, $rate): float;
}
