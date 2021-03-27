<?php declare(strict_types=1);

namespace App\Schedule\Domain\Repository;

use App\Schedule\Domain\Hall;

interface HallRepositoryInterface
{
    public function getByIdOrThrowNotFound(string $id): Hall;

    public function save(Hall $hall): void;

    public function remove(Hall $hall): void;
}