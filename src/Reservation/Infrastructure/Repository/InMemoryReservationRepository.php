<?php declare(strict_types=1);

namespace App\Reservation\Infrastructure\Repository;

use App\Reservation\Domain\Repository\ReservationRepositoryInterface;
use App\Reservation\Domain\Reservation;
use App\Shared\Exception\NotFoundException;
use App\Shared\Uuid\Uuid;

class InMemoryReservationRepository implements ReservationRepositoryInterface
{
    /**
     * @var Reservation[] $reservations
     */
    private array $reservations;

    public function getByIdOrThrowNotFound(Uuid $id): Reservation
    {
        foreach ($this->reservations as $reservation) {
            if ($reservation->getId()->equals($id)) {
                return $reservation;
            }
        }
        throw new NotFoundException();
    }

    public function getByShowId(Uuid $showId): array
    {
        return $this->reservations;
    }

    public function save(Reservation $reservation): void
    {
        $this->reservations[] = $reservation;
    }
}