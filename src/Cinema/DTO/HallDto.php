<?php declare(strict_types=1);

namespace App\Cinema\DTO;

class HallDto
{
    private string $id = '';
    private int $seatsNumber;

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): void
    {
        $this->id = $id;
    }

    public function getSeatsNumber(): int
    {
        return $this->seatsNumber;
    }

    public function setSeatsNumber(int $seatsNumber): void
    {
        $this->seatsNumber = $seatsNumber;
    }
}