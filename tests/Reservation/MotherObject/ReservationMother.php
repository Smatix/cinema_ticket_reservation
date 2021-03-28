<?php declare(strict_types=1);

namespace App\Tests\Reservation\MotherObject;

use App\Reservation\Domain\Reservation;
use App\Shared\Uuid\Uuid;
use App\Shared\ValueObject\Price;
use InvalidArgumentException;

class ReservationMother
{
    const ID = '261f61b4-f9a3-4fbb-910d-03e24f01d6ee';
    const SHOW_ID = 'ef542fd8-11a1-4f7e-9cee-7d2cc7fb417c';

    public static function withDate(string $date): Reservation
    {
        $dateTime = \DateTimeImmutable::createFromFormat('Y-m-d H:i', $date);
        if ($dateTime === false) {
            throw new InvalidArgumentException();
        }

        return new Reservation(
            Uuid::fromString(self::ID),
            Uuid::fromString(self::SHOW_ID),
            $dateTime,
            new Price(10)
        );
    }

    public static function withPrice(float $price): Reservation
    {
        return new Reservation(
            Uuid::fromString(self::ID),
            Uuid::fromString(self::SHOW_ID),
            new \DateTimeImmutable(),
            new Price($price)
        );
    }

    /**
     * @param int[] $seats
     * @return Reservation
     */
    public static function withSeats(array $seats): Reservation
    {
        $reservation =  new Reservation(
            Uuid::fromString(self::ID),
            Uuid::fromString(self::SHOW_ID),
            new \DateTimeImmutable(),
            new Price(10)
        );

        $reservation->addSeats($seats);
        return $reservation;
    }
}