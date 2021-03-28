<?php declare(strict_types=1);

namespace App\Schedule\Domain\Repository;

use App\Schedule\Domain\Show;
use App\Shared\Uuid\Uuid;
use DateTimeImmutable;

interface ShowRepositoryInterface
{
    public function getByIdOrThrowNotFound(Uuid $id): Show;

    /**
     * @param DateTimeImmutable $start
     * @param DateTimeImmutable $end
     * @param Uuid $hallId
     * @return Show[]
     */
    public function getByDatesAndHallId(DateTimeImmutable $start, DateTimeImmutable $end, Uuid $hallId): array;

    public function save(Show $show): void;

    public function remove(Show $show): void;
}