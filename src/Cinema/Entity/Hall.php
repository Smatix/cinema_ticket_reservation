<?php declare(strict_types=1);

namespace App\Cinema\Entity;

use App\Shared\Uuid\Uuid;

class Hall
{
    const MIN_SEATS = 1;
    const MAX_SEATS = 500;

    private Uuid $id;
    private int $seats;

    public function __construct(Uuid $id, int $seats)
    {
        $this->id = $id;
        if ($seats < self::MIN_SEATS || $seats > self::MAX_SEATS) {
            throw new \InvalidArgumentException('Invalid seats number');
        }
        $this->seats = $seats;
    }

    public function getId(): Uuid
    {
        return $this->id;
    }

    public function getSeats(): int
    {
        return $this->seats;
    }
}