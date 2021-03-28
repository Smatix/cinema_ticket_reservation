<?php declare(strict_types=1);

namespace App\Tests\Reservation\Unit\Domain\Policy;

use App\Reservation\Domain\Policy\NoReservationWithTheSameSeatPolicy;
use App\Tests\Reservation\MotherObject\ReservationMother;
use PHPUnit\Framework\TestCase;

class NoReservationWithTheSameSeatPolicyTest extends TestCase
{
    public function test_when_is_reservation_with_the_same_seats(): void
    {
        $reservations = [
            ReservationMother::withSeats([1, 2, 3]),
            ReservationMother::withSeats([4, 5, 6]),
        ];
        $seats = [5, 6];

        $policy = new NoReservationWithTheSameSeatPolicy();

        $this->assertFalse($policy->isSatisfied($seats, $reservations));
    }

    public function test_when_is_not_reservation_with_the_same_seats(): void
    {
        $reservations = [
            ReservationMother::withSeats([1, 2, 3]),
            ReservationMother::withSeats([4, 5, 6]),
        ];
        $seats = [7, 8];

        $policy = new NoReservationWithTheSameSeatPolicy();

        $this->assertTrue($policy->isSatisfied($seats, $reservations));
    }
}