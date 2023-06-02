<?php

declare(strict_types=1);

namespace App\Entity;

use App\Helpers\CalculationTypeDictionary;
use App\Repository\CalculationItemRepository;
use DateTimeInterface;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CalculationItemRepository::class)]
#[ORM\Table(name: 'calculation_items')]
class CalculationItem
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::INTEGER)]
    private ?int $type = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2)]
    private ?float $rate = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2)]
    private ?float $amount = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2)]
    private ?float $calculated_amount = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?DateTimeInterface $init_date = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?int
    {
        return $this->type;
    }

    public function setType(int $type): self
    {
        $this->type = $type;
        return $this;
    }

    public function getRate(): ?float
    {
        return $this->rate;
    }

    public function setRate(float $rate): self
    {
        $this->rate = $rate;
        return $this;
    }

    public function getAmount(): ?float
    {
        return $this->amount;
    }

    public function setAmount(float $amount): self
    {
        $this->amount = $amount;
        return $this;
    }

    public function getCalculatedAmount(): ?float
    {
        return $this->calculated_amount;
    }

    public function setCalculatedAmount(float $amount): self
    {
        $this->calculated_amount = $amount;
        return $this;
    }

    public function getCalculatedVatAmount(): ?float
    {
        return abs($this->amount - $this->calculated_amount);
    }

    public function getInitDate(): string
    {
        return $this->init_date->format('Y-m-d H:i:s');
    }

    public function setInitDate(DateTimeInterface $init_date): self
    {
        $this->init_date = $init_date;

        return $this;
    }

    public function getTypeDescription(): string
    {
        return CalculationTypeDictionary::getDescription($this->type);
    }
}
