<?php declare(strict_types=1);

namespace App\Cinema\Repository;

use App\Cinema\Entity\Hall;

interface HallRepositoryInterface
{
    public function getByIdOrThrowNotFound(string $id): Hall;

    public function save(Hall $hall): void;

    public function remove(Hall $hall): void;
}