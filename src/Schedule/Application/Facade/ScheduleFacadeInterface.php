<?php declare(strict_types=1);

namespace App\Schedule\Application\Facade;

use App\Shared\Uuid\Uuid;

interface ScheduleFacadeInterface
{
    public function getShow(Uuid $id): ShowDTO;
}