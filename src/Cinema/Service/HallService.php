<?php declare(strict_types=1);

namespace App\Cinema\Service;

use App\Cinema\Entity\Hall;
use App\Cinema\DTO\HallDto;
use App\Cinema\Event\HallAdded;
use App\Cinema\Mapper\HallMapper;
use App\Cinema\Repository\HallRepositoryInterface;
use App\Shared\EventBus\EventBus;
use App\Shared\Uuid\Uuid;

class HallService
{
    private HallRepositoryInterface $hallRepository;
    private EventBus $eventBus;

    public function __construct(HallRepositoryInterface $hallRepository, EventBus $eventBus)
    {
        $this->hallRepository = $hallRepository;
        $this->eventBus = $eventBus;
    }

    public function getHall(string $id): ?HallDto
    {
        $hall = $this->hallRepository->getByIdOrThrowNotFound($id);
        return HallMapper::toDto($hall);
    }

    public function addHall(HallDto $hallDto): string
    {
        $hall = new Hall(
            Uuid::generate(),
            $hallDto->getSeatsNumber()
        );

        $this->hallRepository->save($hall);
        $this->eventBus->dispatch(new HallAdded($hall->getId()));

        return $hall->getId()->toString();
    }

    public function editHall(string $id, HallDto $hallDto): void
    {
        //TODO
    }

    public function deleteHall(string $id): void
    {
        $hall = $this->hallRepository->getByIdOrThrowNotFound($id);
        $this->hallRepository->remove($hall);
    }
}