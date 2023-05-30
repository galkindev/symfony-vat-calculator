<?php

declare(strict_types=1);

namespace App\Tests\Functional;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Request;

class ExportCalculationHistoryControllerTest extends WebTestCase
{
    public function testExportCalculationHistoryAsCSVFileIsSuccessful(): void
    {
        $client = static::createClient();
        $client->request(Request::METHOD_GET, '/calculations/history/export/csv');

        $expectedResult = file_get_contents(__DIR__ . '/../Data/calculation_history.csv');
        $this->assertEquals($expectedResult, $client->getResponse()->getContent());
    }
}
