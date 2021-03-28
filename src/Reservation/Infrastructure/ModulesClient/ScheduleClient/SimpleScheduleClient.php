<?php declare(strict_types=1);

namespace App\Reservation\Infrastructure\ModulesClient\ScheduleClient;

use App\Schedule\Application\Facade\ScheduleFacadeInterface;
use App\Shared\Uuid\Uuid;

class SimpleScheduleClient implements ScheduleClientInterface
{
    private ScheduleFacadeInterface $scheduleFacade;

    public function __construct(ScheduleFacadeInterface $scheduleFacade)
    {
        $this->scheduleFacade = $scheduleFacade;
    }

    public function getShowData(Uuid $showId): ShowDataDTO
    {
        $show = $this->scheduleFacade->getShow($showId);
        return new ShowDataDTO($show->getPrice(), $show->getStart());
    }
}