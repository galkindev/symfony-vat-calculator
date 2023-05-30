<?php

declare(strict_types=1);

namespace App\Export;

interface CalculationHistoryExporterInterface
{
    public function getFileName(): string;

    public function export(array $calculationItemList): string;
}
