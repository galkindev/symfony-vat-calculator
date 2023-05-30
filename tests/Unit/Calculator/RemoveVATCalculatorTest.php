<?php

declare(strict_types=1);

namespace App\Tests\Unit\Calculator;

use App\Calculator\RemoveVATCalculator;
use PHPUnit\Framework\TestCase;

class RemoveVATCalculatorTest extends TestCase
{
    public function testRemovingVAT(): void
    {
        $calculator = new RemoveVATCalculator();
        $result = $calculator->calculate(100, 20);

        $this->assertEquals(83.33, $result);
    }
}
