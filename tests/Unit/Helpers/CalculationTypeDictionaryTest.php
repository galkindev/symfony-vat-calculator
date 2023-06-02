<?php

declare(strict_types=1);

namespace App\Tests\Unit\Helpers;

use App\Exception\UnknownCalculationTypeException;
use App\Helpers\CalculationTypeDictionary;
use PHPUnit\Framework\TestCase;

class CalculationTypeDictionaryTest extends TestCase
{
    /**
     * @throws UnknownCalculationTypeException
     */
    public function testGetDescription(): void
    {
        $result = CalculationTypeDictionary::getDescription(CalculationTypeDictionary::REMOVE_VAT_FROM_THE_PRICE);
        $this->assertEquals('Remove VAT from the price', $result);

        $result = CalculationTypeDictionary::getDescription(CalculationTypeDictionary::ADD_VAT_TO_THE_PRICE);
        $this->assertEquals('Add VAT to the price', $result);

        $this->expectException(UnknownCalculationTypeException::class);
        CalculationTypeDictionary::getDescription(100);
    }
}
