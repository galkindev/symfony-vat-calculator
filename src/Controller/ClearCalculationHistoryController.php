<?php

declare(strict_types=1);

namespace App\Controller;

use App\Repository\CalculationItemRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class ClearCalculationHistoryController extends AbstractController
{
    private CalculationItemRepository $calculationItemRepository;

    public function __construct(CalculationItemRepository $calculationItemRepository)
    {
        $this->calculationItemRepository = $calculationItemRepository;
    }

    public function __invoke(Request $request): Response
    {
        $calculationItemList = $this->calculationItemRepository->findAll();

        if (empty($calculationItemList)) {
            return $this->redirectToRoute('app_show_calculation_history');
        }

        foreach ($calculationItemList as $calculationItem) {
            $this->calculationItemRepository->remove($calculationItem, true);
        }

        $request->getSession()->getFlashBag()->add('info', 'Calculation history was successfully cleared');

        return $this->redirectToRoute('app_show_calculation_history');
    }
}
