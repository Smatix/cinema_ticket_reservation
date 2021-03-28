<?php declare(strict_types=1);

namespace App\Tests\Schedule\MotherObject;

use App\Schedule\Domain\Hall;
use App\Shared\Uuid\Uuid;

class HallMother
{
    const HALL_ID = 'a2e9a93e-adcc-4fd5-b92f-636ffb3eac46';

    public static function create(): Hall
    {
        return new Hall(Uuid::fromString(self::HALL_ID));
    }
}