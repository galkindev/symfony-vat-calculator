<?php

declare(strict_types=1);

namespace App\Tests\Unit\Export;

use DateTime;

use App\Entity\CalculationItem;
use App\Export\CSVCalculationHistoryExporter;
use App\Helpers\CalculationTypeDictionary;
use PHPUnit\Framework\TestCase;

class CSVCalculationHistoryExporterTest extends TestCase
{
    public function testExport(): void
    {
        $calculationItem = new CalculationItem();
        $calculationItem->setAmount(100);
        $calculationItem->setRate(20);
        $calculationItem->setType(CalculationTypeDictionary::REMOVE_VAT_FROM_THE_PRICE);
        $calculationItem->setCalculatedAmount(83.33);
        $calculationItem->setInitDate(new DateTime('2023-05-26 10:00:00'));

        $calculationItemList[] = $calculationItem;

        $exporter = new CSVCalculationHistoryExporter();
        $result = $exporter->export($calculationItemList);

        $expected = 'Type;Calculation based on;VAT rate;VAT amount;Final amount;Date and time
Remove VAT from the price;100;20;16.67;83.33;2023-05-26 10:00:00';

        $this->assertEquals($expected, $result);
    }
}
