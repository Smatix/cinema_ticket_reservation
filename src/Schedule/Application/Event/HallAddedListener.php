<?php declare(strict_types=1);

namespace App\Schedule\Application\Event;

use App\Cinema\Event\HallAdded;
use App\Schedule\Domain\Hall;
use App\Schedule\Domain\Repository\HallRepositoryInterface;
use App\Shared\Event\EventListener;

class HallAddedListener implements EventListener
{
    private HallRepositoryInterface $hallRepository;

    public function __construct(HallRepositoryInterface $hallRepository)
    {
        $this->hallRepository = $hallRepository;
    }

    public function __invoke(HallAdded $event): void
    {
        $hall = new Hall($event->getHallId());

        $this->hallRepository->save($hall);
    }
}