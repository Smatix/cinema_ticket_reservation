<?php declare(strict_types=1);

namespace App\Schedule\Domain\Repository;

use App\Schedule\Domain\Hall;
use App\Shared\Uuid\Uuid;

interface HallRepositoryInterface
{
    public function getByIdOrThrowNotFound(Uuid $id): Hall;

    public function save(Hall $hall): void;

    public function remove(Hall $hall): void;
}