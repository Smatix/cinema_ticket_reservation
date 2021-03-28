<?php declare(strict_types=1);

namespace App\Reservation\Domain\Policy;

use App\Reservation\Domain\Reservation;
use League\Period\Period;

interface Policy
{
    /**
     * @param int[] $seats
     * @param Reservation[] $reservations
     * @return bool
     */
    public function isSatisfied(array $seats, array $reservations): bool;

    public function getNotSatisfiedMessage(): string;
}