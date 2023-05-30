<?php

declare(strict_types=1);

namespace App\Controller;

use App\Export\CalculationHistoryExporterInterface;
use App\Repository\CalculationItemRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

final class ExportCalculationHistoryController extends AbstractController
{
    private CalculationItemRepository $calculationItemRepository;
    private CalculationHistoryExporterInterface $calculationHistoryExporter;

    public function __construct(
        CalculationItemRepository       $calculationItemRepository,
        CalculationHistoryExporterInterface $calculationHistoryExporter
    )
    {
        $this->calculationItemRepository = $calculationItemRepository;
        $this->calculationHistoryExporter = $calculationHistoryExporter;
    }

    public function __invoke(): Response
    {
        $calculationItemList = $this->calculationItemRepository->findAll();

        $result = $this->calculationHistoryExporter->export($calculationItemList);

        $response = new Response($result);
        $response->headers->set('Content-type', 'text/csv');
        $response->headers->set('Content-Disposition', 'attachment; filename="' . $this->calculationHistoryExporter->getFileName() . '";');
        $response->sendHeaders();

        return $response;
    }
}
