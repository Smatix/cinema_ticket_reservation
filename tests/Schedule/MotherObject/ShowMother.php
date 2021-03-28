<?php declare(strict_types=1);

namespace App\Tests\Schedule\MotherObject;

use App\Schedule\Domain\Show;
use App\Shared\Uuid\Uuid;
use App\Shared\ValueObject\Price;
use League\Period\Period;

class ShowMother
{
    const SHOW_ID = 'ef542fd8-11a1-4f7e-9cee-7d2cc7fb417c';

    public static function withDates(string $start, string $end): Show
    {
        $period = new Period(
            \DateTimeImmutable::createFromFormat('Y-m-d H:i', $start),
            \DateTimeImmutable::createFromFormat('Y-m-d H:i', $end),
        );

        $show = new Show(
            Uuid::fromString(self::SHOW_ID),
            $period,
            HallMother::create(),
            new Price(10)
        );

        return $show;
    }
}