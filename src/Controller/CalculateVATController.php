<?php

declare(strict_types=1);

namespace App\Controller;

use DateTime;
use App\Repository\CalculationItemRepositoryInterface;
use App\Calculator\VATCalculatorFactory;
use App\Exception\UnknownCalculationTypeException;
use App\Entity\CalculationItem;
use App\Form\CalculateVATFormData;
use App\Form\CalculateVATFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class CalculateVATController extends AbstractController
{
    private CalculationItemRepositoryInterface $calculationItemRepository;
    private VATCalculatorFactory $calculatorFactory;

    public function __construct(
        CalculationItemRepositoryInterface $calculationItemRepository,
        VATCalculatorFactory               $calculatorFactory
    )
    {
        $this->calculationItemRepository = $calculationItemRepository;
        $this->calculatorFactory = $calculatorFactory;
    }

    /**
     * @throws UnknownCalculationTypeException
     */
    public function __invoke(Request $request): Response
    {
        $calculateVATFormData = new CalculateVATFormData();

        $form = $this->createForm(CalculateVATFormType::class, $calculateVATFormData);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $calculator = $this->calculatorFactory->create($calculateVATFormData->getType());
            $calculatedAmount = $calculator->calculate($calculateVATFormData->getAmount(), $calculateVATFormData->getRate());

            $calculationItem = new CalculationItem();
            $calculationItem->setAmount($calculateVATFormData->getAmount());
            $calculationItem->setRate($calculateVATFormData->getRate());
            $calculationItem->setType($calculateVATFormData->getType());
            $calculationItem->setCalculatedAmount($calculatedAmount);
            $calculationItem->setInitDate(new DateTime('now'));

            $this->calculationItemRepository->save($calculationItem, true);

            return $this->redirectToRoute('app_show_calculation_item', ['id' => $calculationItem->getId()]);
        }

        return $this->render('app/calculate_vat.html.twig', [
            'form' => $form,
        ]);
    }
}
