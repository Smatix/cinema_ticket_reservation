<?php declare(strict_types=1);

namespace App\Tests\Reservation\Unit\Domain;

use App\Tests\Reservation\MotherObject\ReservationMother;
use PHPUnit\Framework\TestCase;

class ReservationTest extends TestCase
{
    public function test_add_two_same_seat(): void
    {
        $reservation = ReservationMother::withSeats([2]);

        $reservation->addSeat(2);

        $this->assertEquals(1, count($reservation->getSeatsNumbers()));
    }

    public function test_calculate_total_price(): void
    {
        $reservation = ReservationMother::withPrice(10);

        $reservation->addSeat(1);
        $reservation->addSeat(2);
        $reservation->addSeat(3);

        $totalPrice = $reservation->calculateTotalPrice();

        $this->assertEquals(30, $totalPrice->getAmount());
    }

    public function test_if_has_seats_with_overlap(): void
    {
        $reservation = ReservationMother::withSeats([2, 3]);

        $hasAnySeats = $reservation->hasAnySeat([3, 4, 5]);

        $this->assertTrue($hasAnySeats);
    }

    public function test_if_has_seats_without_overlap(): void
    {
        $reservation = ReservationMother::withSeats([2, 3]);

        $hasAnySeats = $reservation->hasAnySeat([4, 5]);

        $this->assertFalse($hasAnySeats);
    }
}