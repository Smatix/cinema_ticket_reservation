<?php declare(strict_types=1);

namespace App\Schedule\Application\Command;

use App\Schedule\Domain\Factory\ShowFactory;
use App\Schedule\Domain\Repository\ShowRepositoryInterface;
use App\Shared\Command\CommandHandler;

class CreateShowHandler implements CommandHandler
{
    private ShowRepositoryInterface $showRepository;
    private ShowFactory $showFactory;

    public function __invoke(CreateShowCommand $command): void
    {
        $show = $this->showFactory->create(
            $command->getId(),
            $command->getStart(),
            $command->getEnd(),
            $command->getHallId(),
            $command->getPrice()
        );

        $this->showRepository->save($show);
    }
}