<?php declare(strict_types=1);

namespace App\Reservation\Domain\Repository;

use App\Reservation\Domain\Reservation;
use App\Shared\Uuid\Uuid;

interface ReservationRepositoryInterface
{
    public function getById(Uuid $id): Reservation;

    /**
     * @param Uuid $showId
     * @return Reservation[]
     */
    public function getByShowId(Uuid $showId): array;

    public function save(Reservation $reservation): void;
}