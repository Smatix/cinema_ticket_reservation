<?php declare(strict_types=1);

namespace App\Reservation\Application\Command;

use App\Reservation\Infrastructure\ModulesClient\ScheduleClient\ScheduleClientInterface;
use App\Reservation\Domain\Factory\ReservationFactory;
use App\Reservation\Domain\Repository\ReservationRepositoryInterface;
use App\Shared\Command\CommandHandler;

class CreateReservationHandler implements CommandHandler
{
    private ReservationRepositoryInterface $reservationRepository;
    private ScheduleClientInterface $scheduleClient;
    private ReservationFactory $reservationFactory;

    public function __construct(
        ReservationRepositoryInterface $reservationRepository,
        ScheduleClientInterface $scheduleClient,
        ReservationFactory $reservationFactory
    )
    {
        $this->reservationRepository = $reservationRepository;
        $this->scheduleClient = $scheduleClient;
        $this->reservationFactory = $reservationFactory;
    }

    public function __invoke(CreateReservationCommand $command): void
    {
        $showData = $this->scheduleClient->getShowData($command->getShowId());

        $reservation = $this->reservationFactory->create(
            $command->getId(),
            $command->getShowId(),
            $showData,
            $command->getSeats()
        );

        $this->reservationRepository->save($reservation);
    }
}