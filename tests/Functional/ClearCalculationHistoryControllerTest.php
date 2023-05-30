<?php

declare(strict_types=1);

namespace App\Tests\Functional;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Request;

class ClearCalculationHistoryControllerTest extends WebTestCase
{
    public function testDeleteCalculationItemIsSuccessful(): void
    {
        $client = static::createClient();
        $crawler = $client->request(Request::METHOD_GET, '/calculations/history');

        $link = $crawler->filter('a[id="js-clear-calculation-history"]')->attr('href');
        $client->request('GET', $link);

        $this->assertResponseRedirects('/calculations/history');

        $crawler = $client->followRedirect();

        $this->assertSelectorTextContains('body', 'Calculation history was successfully cleared');
        $this->assertEquals(0, $crawler->filter('tr')->getIterator()->count() - 1);
    }
}
