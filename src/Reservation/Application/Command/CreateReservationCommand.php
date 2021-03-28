<?php declare(strict_types=1);

namespace App\Reservation\Application\Command;

use App\Shared\Command\Command;
use App\Shared\Uuid\Uuid;

class CreateReservationCommand implements Command
{
    private Uuid $id;
    private Uuid $showId;

    /**
     * @var int[] $seats
     */
    private array $seats;

    /**
     * CreateReservationCommand constructor.
     * @param Uuid $showId
     * @param int[] $seats
     */
    public function __construct(Uuid $showId, array $seats)
    {
        $this->id = Uuid::generate();
        $this->showId = $showId;
        $this->seats = $seats;
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
    public function getSeats(): array
    {
        return $this->seats;
    }
}