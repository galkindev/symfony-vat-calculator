<?php

declare(strict_types=1);

namespace App\Tests\Functional;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Request;

class DeleteCalculationItemControllerTest extends WebTestCase
{
    public function testDeleteCalculationItemIsSuccessful(): void
    {
        $client = static::createClient();
        $crawler = $client->request(Request::METHOD_GET, '/calculations/history');

        $link = $crawler->filter('a[class="delete-calculation-button"]')->first()->attr('href');
        $client->request('GET', $link);

        $this->assertResponseRedirects('/calculations/history');

        $client->followRedirect();

        $this->assertSelectorTextContains('body', 'Calculation history item with ID = 1 was successfully deleted');
    }
}
