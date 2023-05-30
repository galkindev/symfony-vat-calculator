<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\CalculationItem;
use App\Repository\CalculationItemRepositoryInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

final class DeleteCalculationItemController extends AbstractController
{
    private CalculationItemRepositoryInterface $calculationItemRepository;

    public function __construct(CalculationItemRepositoryInterface $calculationItemRepository)
    {
        $this->calculationItemRepository = $calculationItemRepository;
    }

    public function __invoke(Request $request, int $id): Response
    {
        $csrfToken = $request->get('token');

        if (!$this->isCsrfTokenValid('delete-calculation-item', $csrfToken)) {
            $request->getSession()->getFlashBag()->add('error', 'An error occurred while executing the request');
            return $this->redirectToRoute('app_show_calculation_history');
        }

        $calculationItem = $this->calculationItemRepository->find($id);

        if (!$calculationItem instanceof CalculationItem) {
            throw new NotFoundHttpException();
        }

        $this->calculationItemRepository->remove($calculationItem, true);

        $request->getSession()->getFlashBag()->add('info', 'Calculation history item with ID = ' . $id . ' was successfully deleted');

        return $this->redirectToRoute('app_show_calculation_history');
    }
}
