<?php declare(strict_types=1);

namespace App\Reservation\Domain\Policy;

use App\Reservation\Domain\Reservation;

class NoReservationWithTheSameSeatPolicy implements Policy
{
    public function isSatisfied(array $seats, array $reservations): bool
    {
        $reservationsWithTheSameSeats = array_filter($reservations, function (Reservation $reservation) use ($seats) {
            return (!$reservation->isExpired() && $reservation->hasAnySeat($seats));
        });

        return empty($reservationsWithTheSameSeats);
    }

    public function getNotSatisfiedMessage(): string
    {
        return "Reservation has the same seats";
    }

}