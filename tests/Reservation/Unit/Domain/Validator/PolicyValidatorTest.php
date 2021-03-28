<?php declare(strict_types=1);

namespace App\Tests\Reservation\Unit\Domain\Validator;

use App\Reservation\Domain\Policy\NoReservationWithTheSameSeatPolicy;
use App\Reservation\Domain\Repository\ReservationRepositoryInterface;
use App\Reservation\Domain\Validator\PolicyValidator;
use App\Reservation\Infrastructure\Repository\InMemoryReservationRepository;
use App\Shared\Exception\InvalidPolicyException;
use App\Shared\Uuid\Uuid;
use App\Tests\Reservation\MotherObject\ReservationMother;
use PHPUnit\Framework\TestCase;

class PolicyValidatorTest extends TestCase
{
    private ReservationRepositoryInterface $repository;

    protected function setUp(): void
    {
        parent::setUp();
        $this->repository = new InMemoryReservationRepository();
        $reservation = ReservationMother::withSeats([1, 2, 3]);
        $this->repository->save($reservation);
    }

    public function test_when_data_are_correct_for_all_policies(): void
    {
        $validator = new PolicyValidator($this->repository);
        $validator->registerPolicies([
            new NoReservationWithTheSameSeatPolicy()
        ]);
        try {
            $validator->validate([4, 5], Uuid::fromString(ReservationMother::SHOW_ID));
        } catch (InvalidPolicyException $e) {
            $this->fail();
        }

        $this->assertTrue(true);
    }

    public function test_when_data_are_incorrect_for_policy(): void
    {
        $validator = new PolicyValidator($this->repository);
        $validator->registerPolicies([
            new NoReservationWithTheSameSeatPolicy()
        ]);

        $this->expectException(InvalidPolicyException::class);
        $validator->validate([4, 3], Uuid::fromString(ReservationMother::SHOW_ID));
    }
}