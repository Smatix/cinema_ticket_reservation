<?php declare(strict_types=1);

namespace App\Schedule\Application\Facade;

use App\Schedule\Domain\Repository\ShowRepositoryInterface;
use App\Shared\Uuid\Uuid;

class ScheduleFacade implements ScheduleFacadeInterface
{
    private ShowRepositoryInterface $repository;

    public function getShow(Uuid $id): ShowDTO
    {
        $show = $this->repository->getByIdOrThrowNotFound($id);

        return new ShowDTO(
            $show->getId(),
            $show->getPeriod()->getStartDate(),
            $show->getPeriod()->getEndDate(),
            $show->getHall()->getId(),
            $show->getPrice()
        );
    }

}