<?php declare(strict_types=1);

namespace App\Reservation\Domain;

use App\Reservation\Domain\Entity\Seat;
use App\Shared\Uuid\Uuid;
use App\Shared\ValueObject\Price;
use DateTimeImmutable;

class Reservation
{
    private Uuid $id;
    private Uuid $showId;
    private DateTimeImmutable $reservationDate;
    private Price $pricePerSeat;
    private bool $isPaid;
    /**
     * @var Seat[] $seats
     */
    private array $seats = [];

    public function __construct(Uuid $id, Uuid $showId, DateTimeImmutable $reservationDate, Price $pricePerSeat)
    {
        $this->id = $id;
        $this->showId = $showId;
        $this->reservationDate = $reservationDate;
        $this->pricePerSeat = $pricePerSeat;
        $this->isPaid = false;
    }

    public function getId(): Uuid
    {
        return $this->id;
    }

    public function getShowId(): Uuid
    {
        return $this->showId;
    }

    /**
     * @return int[]
     */
    public function getSeatsNumbers(): array
    {
        return array_map(function (Seat $seat) {
            return $seat->getNumber();
        }, $this->seats);
    }

    /**
     * @param int[] $numbers
     * @return void
     */
    public function addSeats(array $numbers): void
    {
        foreach ($numbers as $number) {
            $this->addSeat($number);
        }
    }

    public function addSeat(int $number): void
    {
        if (!$this->hasSeat($number)) {
            $seat = new Seat($number);
            $this->seats[] = $seat;
            $seat->setReservation($this);
        }
    }

    /**
     * @param int[] $numbers
     * @return bool
     */
    public function hasAnySeat(array $numbers): bool
    {
        foreach ($numbers as $number) {
            if($this->hasSeat($number)) {
                return true;
            }
        }
        return false;
    }

    public function hasSeat(int $number): bool
    {
        $seatsNumbers = $this->getSeatsNumbers();
        return in_array($number, $seatsNumbers);
    }

    public function isExpired(): bool
    {
//        $now = new DateTimeImmutable('now');
//        $afterSomeMinutes = $now->modify("+30 minutes");
//        return $afterSomeMinutes > $this->reservationDate && !$this->isPaid;
        return false;
    }

    public function calculateTotalPrice(): Price
    {
        return $this->pricePerSeat->multiply(count($this->seats));
    }

    public function paid(): void
    {
        if (!$this->isExpired()) {
            $this->isPaid = true;
        }
    }
}