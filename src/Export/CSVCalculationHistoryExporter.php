<?php

declare(strict_types=1);

namespace App\Export;

class CSVCalculationHistoryExporter implements CalculationHistoryExporterInterface
{
    private string $fileName = 'calculation_history.csv';

    public function getFileName(): string
    {
        return $this->fileName;
    }

    public function export(array $calculationItemList): string
    {
        $rows = [];

        $fields = [
            "Type",
            "Calculation based on",
            "VAT rate",
            "VAT amount",
            "Final amount",
            "Date and time",
        ];

        $rows[] = implode(';', $fields);

        foreach ($calculationItemList as $calculationItem) {
            $fields = [
                $calculationItem->getTypeDescription(),
                $calculationItem->getAmount(),
                $calculationItem->getRate(),
                $calculationItem->getCalculatedVatAmount(),
                $calculationItem->getCalculatedAmount(),
                $calculationItem->getInitDate(),
            ];

            $rows[] = implode(';', $fields);
        }

        return implode("\n", $rows);
    }
}
