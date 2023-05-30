<?php

declare(strict_types=1);

namespace App\Form;

use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Range;

class CalculateVATFormData
{
    /**
     * @NotBlank()
     * @Range(min=0, max=100)
     */
    public float $rate;

    /**
     * @NotBlank()
     */
    public float $amount;

    /**
     * @NotBlank()
     */
    public int $type;

    public function getRate(): float
    {
        return $this->rate;
    }

    public function getAmount(): float
    {
        return $this->amount;
    }

    public function getType(): int
    {
        return $this->type;
    }
}
