<?php

declare(strict_types=1);

namespace App\Tests\Functional;

use App\Entity\CalculationItem;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Request;

class ShowCalculationItemControllerTest extends WebTestCase
{
    private int $calculationItemId = 1;

    public function testShowCalculationItemIsSuccessful(): void
    {
        $client = static::createClient();
        $crawler = $client->request(Request::METHOD_GET, '/calculations/show/' . $this->calculationItemId);

        /** @var CalculationItem $calculationItem */
        $calculationItem = $client->getContainer()->get('doctrine')->getManager()->getRepository(CalculationItem::class)->find($this->calculationItemId);

        $this->assertResponseIsSuccessful();

        $calculationItemData = $crawler->filter('ul')->eq(1)->text();

        $this->assertStringContainsString('Remove VAT from the price', $calculationItemData);
        $this->assertStringContainsString('Calculation based on: ' . $calculationItem->getAmount(), $calculationItemData);
        $this->assertStringContainsString('VAT rate: ' . $calculationItem->getRate(), $calculationItemData);
        $this->assertStringContainsString('VAT amount: ' . $calculationItem->getCalculatedVatAmount(), $calculationItemData);
        $this->assertStringContainsString('Final amount: ' . $calculationItem->getCalculatedAmount(), $calculationItemData);
        $this->assertStringContainsString('Date and time: ' . $calculationItem->getInitDate(), $calculationItemData);
    }
}
