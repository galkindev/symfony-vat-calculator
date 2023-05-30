<?php

declare(strict_types=1);

namespace App\Tests\Functional;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Request;

class ShowCalculationHistoryControllerTest extends WebTestCase
{
    public function testShowCalculationHistoryIsSuccessful(): void
    {
        $client = static::createClient();
        $crawler = $client->request(Request::METHOD_GET, '/calculations/history');

        $this->assertResponseIsSuccessful();

        $this->assertEquals(10, $crawler->filter('tr')->getIterator()->count() - 1);
    }
}
