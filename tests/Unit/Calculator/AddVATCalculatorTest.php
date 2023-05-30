<?php

declare(strict_types=1);

namespace App\Tests\Unit\Calculator;

use App\Calculator\AddVATCalculator;
use PHPUnit\Framework\TestCase;

class AddVATCalculatorTest extends TestCase
{
    public function testAddingVAT(): void
    {
        $calculator = new AddVATCalculator();
        $result = $calculator->calculate(100, 20);

        $this->assertEquals(120, $result);
    }
}
