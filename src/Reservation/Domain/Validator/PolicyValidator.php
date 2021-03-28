<?php declare(strict_types=1);

namespace App\Reservation\Domain\Validator;

use App\Reservation\Domain\Policy\Policy;
use App\Reservation\Domain\Repository\ReservationRepositoryInterface;
use App\Shared\Exception\InvalidPolicyException;
use App\Shared\Uuid\Uuid;

class PolicyValidator
{
    /**
     * @var Policy[] $policies
     */
    private array $policies;
    private ReservationRepositoryInterface $reservationRepository;

    public function __construct(ReservationRepositoryInterface $reservationRepository)
    {
        $this->reservationRepository = $reservationRepository;
    }

    /**
     * @param int[] $seats
     * @param Uuid $showId
     * @throws InvalidPolicyException
     */
    public function validate(array $seats, Uuid $showId): void
    {
        $reservations = $this->reservationRepository->getByShowId($showId);

        foreach ($this->policies as $policy) {
            if (!$policy->isSatisfied($seats, $reservations)) {
                throw new InvalidPolicyException($policy->getNotSatisfiedMessage());
            }
        }
    }

    /**
     * @param Policy[] $policies
     */
    public function registerPolicies(array $policies): void
    {
        $this->policies = $policies;
    }
}