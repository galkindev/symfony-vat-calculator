<?php

declare(strict_types=1);

namespace App\Tests\Unit\Calculator;

use App\Calculator\VATCalculatorFactory;
use App\Calculator\VATCalculatorInterface;
use App\Exception\UnknownCalculationType;
use App\Helpers\TypeDictionary;
use PHPUnit\Framework\TestCase;

class VATCalculatorFactoryTest extends TestCase
{
    private VATCalculatorFactory $calculatorFactory;

    public function setUp(): void
    {
        $this->calculatorFactory = new VATCalculatorFactory();
    }

    /**
     * @throws UnknownCalculationType
     */
    public function testCalculatorObjectIsCreated(): void
    {
        $calculator = $this->calculatorFactory->create(TypeDictionary::REMOVE_VAT_FROM_THE_PRICE);
        $this->assertInstanceOf(VATCalculatorInterface::class, $calculator);

        $calculator = $this->calculatorFactory->create(TypeDictionary::ADD_VAT_TO_THE_PRICE);
        $this->assertInstanceOf(VATCalculatorInterface::class, $calculator);
    }

    public function testUnknownCalculationTypeThrowsException()
    {
        $this->expectException(UnknownCalculationType::class);
        $this->calculatorFactory->create(100);
    }
}
