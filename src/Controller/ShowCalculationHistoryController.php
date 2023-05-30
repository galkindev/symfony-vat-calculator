<?php

declare(strict_types=1);

namespace App\Controller;

use App\Repository\CalculationItemRepositoryInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class ShowCalculationHistoryController extends AbstractController
{
    private const NUMBER_OF_ITEMS_PER_PAGE = 10;
    private CalculationItemRepositoryInterface $calculationItemRepository;

    public function __construct(CalculationItemRepositoryInterface $calculationItemRepository)
    {
        $this->calculationItemRepository = $calculationItemRepository;
    }

    public function __invoke(Request $request): Response
    {
        $page = $request->query->getInt('page', 1);

        $limit = self::NUMBER_OF_ITEMS_PER_PAGE;
        $totalItems = $this->calculationItemRepository->getCalculationItemsCount();
        $totalPages = ceil($totalItems / $limit);
        $offset = ($page - 1) * $limit;

        $items = $this->calculationItemRepository->getCalculationItemsList($offset, $limit);

        return $this->render('app/calculation_history.html.twig', [
            'items' => $items,
            'totalItems' => $totalItems,
            'totalPages' => $totalPages,
            'currentPage' => $page,
        ]);
    }
}
