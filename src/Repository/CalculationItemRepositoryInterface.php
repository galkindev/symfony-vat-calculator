<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\CalculationItem;

interface CalculationItemRepositoryInterface
{
    public function getCalculationItemsCount(): int;

    public function getCalculationItemsList(int $offset, int $limit): array;

    public function save(CalculationItem $entity, bool $flush = false): void;

    public function remove(CalculationItem $entity, bool $flush = false): void;
}
