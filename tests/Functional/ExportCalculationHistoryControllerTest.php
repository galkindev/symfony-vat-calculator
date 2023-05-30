<?php

declare(strict_types=1);

namespace App\Tests\Functional;

use App\Entity\CalculationItem;
use App\Export\CSVCalculationHistoryExporter;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Request;

class ExportCalculationHistoryControllerTest extends WebTestCase
{
    public function testExportCalculationHistoryAsCSVFileIsSuccessful(): void
    {
        $client = static::createClient();
        $client->request(Request::METHOD_GET, '/calculations/history/export/csv');

        /** @var array $calculationItemList */
        $calculationItemList = $client->getContainer()->get('doctrine')->getManager()->getRepository(CalculationItem::class)->findAll();

        $exporter = new CSVCalculationHistoryExporter();
        $expectedResult = $exporter->export($calculationItemList);

        $this->assertEquals($expectedResult, $client->getResponse()->getContent());
    }
}
