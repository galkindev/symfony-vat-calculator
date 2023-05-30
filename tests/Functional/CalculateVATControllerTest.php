<?php

declare(strict_types=1);

namespace App\Tests\Functional;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Request;

class CalculateVATControllerTest extends WebTestCase
{
    public function testVATCalculationIsSuccessful(): void
    {
        $client = static::createClient();

        $client->request(Request::METHOD_GET, '/');

        $this->assertResponseIsSuccessful();

        $client->submitForm('Calculate', [
            'calculate_vat_form[rate]' => 20,
            'calculate_vat_form[amount]' => 100,
        ]);

        $this->assertResponseRedirects();
    }

    public function testValidationErrorWhenRateIsBlank(): void
    {
        $client = static::createClient();

        $client->request(Request::METHOD_GET, '/');

        $this->assertResponseIsSuccessful();

        $client->submitForm('Calculate', [
            'calculate_vat_form[rate]' => '',
            'calculate_vat_form[amount]' => 100,
        ]);

        $this->assertSelectorTextContains('body', 'This value should not be blank.');
    }

    public function testValidationErrorWhenRateIsNotInMinRange(): void
    {
        $client = static::createClient();

        $client->request(Request::METHOD_GET, '/');

        $this->assertResponseIsSuccessful();

        $client->submitForm('Calculate', [
            'calculate_vat_form[rate]' => -1,
            'calculate_vat_form[amount]' => 100,
        ]);

        $this->assertSelectorTextContains('body', 'This value should be between 0 and 100.');
    }

    public function testValidationErrorWhenRateIsNotInMaxRange(): void
    {
        $client = static::createClient();

        $client->request(Request::METHOD_GET, '/');

        $this->assertResponseIsSuccessful();

        $client->submitForm('Calculate', [
            'calculate_vat_form[rate]' => 101,
            'calculate_vat_form[amount]' => 100,
        ]);

        $this->assertSelectorTextContains('body', 'This value should be between 0 and 100.');
    }

    public function testValidationErrorWhenAmountIsBlank(): void
    {
        $client = static::createClient();

        $client->request(Request::METHOD_GET, '/');

        $this->assertResponseIsSuccessful();

        $client->submitForm('Calculate', [
            'calculate_vat_form[rate]' => 20,
            'calculate_vat_form[amount]' => '',
        ]);

        $this->assertSelectorTextContains('body', 'This value should not be blank.');
    }
}
