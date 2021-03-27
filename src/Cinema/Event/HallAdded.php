<?php declare(strict_types=1);

namespace App\Cinema\Event;

use App\Shared\Event\Event;
use App\Shared\Uuid\Uuid;

class HallAdded implements Event
{
    private Uuid $hallId;

    public function __construct(Uuid $hallId)
    {
        $this->hallId = $hallId;
    }

    public function getHallId(): Uuid
    {
        return $this->hallId;
    }
}