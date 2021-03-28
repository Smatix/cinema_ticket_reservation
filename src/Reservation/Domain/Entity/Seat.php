<?php declare(strict_types=1);

namespace App\Reservation\Domain\Entity;

use App\Reservation\Domain\Reservation;

class Seat
{
    private int $id;
    private ?Reservation $reservation;
    private int $number;

    public function __construct(int $number)
    {
        $this->number = $number;
    }

    public function getNumber(): int
    {
        return $this->number;
    }

    public function setReservation(Reservation $reservation): void
    {
        $this->reservation = $reservation;
    }
}