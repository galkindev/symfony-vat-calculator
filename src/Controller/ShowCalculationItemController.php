<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\CalculationItem;
use App\Repository\CalculationItemRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

final class ShowCalculationItemController extends AbstractController
{
    private CalculationItemRepository $calculationItemRepository;

    public function __construct(CalculationItemRepository $calculationItemRepository)
    {
        $this->calculationItemRepository = $calculationItemRepository;
    }

    public function __invoke(Request $request, int $id): Response
    {
        $calculationItem = $this->calculationItemRepository->find($id);

        if (!$calculationItem instanceof CalculationItem) {
            throw new NotFoundHttpException();
        }

        return $this->render('app/show_calculation_item.html.twig', [
            'item' => $calculationItem,
        ]);
    }
}
