<?php declare(strict_types=1);

namespace App\Reservation\Domain\Factory;

use App\Reservation\Infrastructure\ModulesClient\ScheduleClient\ShowDataDTO;
use App\Reservation\Domain\Policy\NoReservationWithTheSameSeatPolicy;
use App\Reservation\Domain\Reservation;
use App\Reservation\Domain\Validator\PolicyValidator;
use App\Shared\Uuid\Uuid;

class ReservationFactory
{
    private PolicyValidator $policyValidator;

    /**
     * @param Uuid $id
     * @param Uuid $showId
     * @param ShowDataDTO $showData
     * @param int[] $seats
     * @return Reservation
     * @throws \App\Shared\Exception\InvalidPolicyException
     */
    public function create(Uuid $id, Uuid $showId, ShowDataDTO $showData, array $seats): Reservation
    {
        $this->policyValidator->registerPolicies([
            new NoReservationWithTheSameSeatPolicy()
        ]);
        $this->policyValidator->validate($seats, $showId);

        $reservation = new Reservation(
            $id,
            $showId,
            $showData->getStart(),
            $showData->getPrice()
        );
        $reservation->addSeats($seats);

        return $reservation;
    }
}