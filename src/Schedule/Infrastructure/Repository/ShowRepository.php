<?php declare(strict_types=1);

namespace App\Schedule\Infrastructure\Repository;

use App\Schedule\Domain\Repository\ShowRepositoryInterface;
use App\Schedule\Domain\Show;
use App\Shared\Exception\NotFoundException;
use App\Shared\Repository\MysqlRepository;
use App\Shared\Uuid\Uuid;
use DateTimeImmutable;

class ShowRepository extends MysqlRepository implements ShowRepositoryInterface
{
    public function getByIdOrThrowNotFound(Uuid $id): Show
    {
        /** @var Show|null $show */
        $show = $this->repository->find($id);
        if (is_null($show)) {
            throw new NotFoundException('Hall not found');
        }
        return $show;
    }

    public function getByDatesAndHallId(DateTimeImmutable $start, DateTimeImmutable $end, Uuid $hallId): array
    {
        return $this->repository->createQueryBuilder('show')
            ->select('show')
            ->andWhere('show.hall = :hall')
            ->andWhere('p.startDate >= :start')
            ->andWhere('p.endDate <= :end')
            ->setParameter('hall', $hallId)
            ->setParameter('start', $start)
            ->setParameter('end', $end)
            ->getQuery()
            ->getResult();
    }

    public function save(Show $show): void
    {
        $this->em->persist($show);
        $this->em->flush();
    }

    public function remove(Show $show): void
    {
        $this->em->remove($show);
        $this->em->flush();
    }

}