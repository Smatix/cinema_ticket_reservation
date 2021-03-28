<?php declare(strict_types=1);

namespace App\Shared\ValueObject;

class Price
{
    private float $amount;

    public function __construct(float $amount)
    {
        $this->amount = $amount;
    }

    public function getAmount(): float
    {
        return $this->amount;
    }

    public function multiply(int $multiplier): self
    {
        $result = $this->amount*$multiplier;
        return new self($result);
    }
}