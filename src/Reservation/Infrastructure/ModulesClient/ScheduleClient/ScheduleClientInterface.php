<?php declare(strict_types=1);

namespace App\Reservation\Infrastructure\ModulesClient\ScheduleClient;

use App\Shared\Uuid\Uuid;

interface ScheduleClientInterface
{
    public function getShowData(Uuid $showId): ShowDataDTO;
}