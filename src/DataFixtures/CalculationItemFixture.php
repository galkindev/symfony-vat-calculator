<?php

namespace App\DataFixtures;

use DateTime;

use App\Exception\UnknownCalculationTypeException;
use App\Calculator\VATCalculatorFactory;
use App\Entity\CalculationItem;
use App\Helpers\CalculationTypeDictionary;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

final class CalculationItemFixture extends Fixture
{
    private VATCalculatorFactory $calculatorFactory;

    public function __construct(VATCalculatorFactory $calculatorFactory)
    {
        $this->calculatorFactory = $calculatorFactory;
    }

    /**
     * @throws UnknownCalculationTypeException
     */
    public function load(ObjectManager $manager): void
    {
        for ($i = 0; $i < 20; $i++) {
            $calculationTypes = [
                CalculationTypeDictionary::REMOVE_VAT_FROM_THE_PRICE,
                CalculationTypeDictionary::ADD_VAT_TO_THE_PRICE
            ];

            $rates = [5, 20];

            $amount = rand(10, 100) * 10;
            $rate = $rates[array_rand($rates)];
            $calculationType = $calculationTypes[array_rand($calculationTypes)];

            $calculator = $this->calculatorFactory->create($calculationType);
            $calculatedAmount = $calculator->calculate($amount, $rate);

            $calculationItem = new CalculationItem();
            $calculationItem->setAmount($amount);
            $calculationItem->setRate($rate);
            $calculationItem->setType($calculationType);
            $calculationItem->setCalculatedAmount($calculatedAmount);
            $calculationItem->setInitDate(new DateTime('2023-05-26 10:00:00'));

            $manager->persist($calculationItem);
            $manager->flush();
        }
    }
}
