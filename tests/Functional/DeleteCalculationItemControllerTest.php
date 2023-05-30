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
        $client->request(Request::METHOD_GET, '/calculations/delete/1');

        $this->assertResponseRedirects('/calculations/history');

        $client->followRedirect();

        $this->assertSelectorTextContains('body', 'Calculation history item with ID = 1 was successfully deleted');
    }
}
