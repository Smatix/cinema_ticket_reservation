<?php declare(strict_types=1);

namespace App\Reservation\Infrastructure\Repository;

use App\Reservation\Domain\Repository\ReservationRepositoryInterface;
use App\Reservation\Domain\Reservation;
use App\Shared\Exception\NotFoundException;
use App\Shared\Repository\MysqlRepository;
use App\Shared\Uuid\Uuid;
use Doctrine\ORM\EntityManagerInterface;

class ReservationRepository extends MysqlRepository implements ReservationRepositoryInterface
{
    public function __construct(EntityManagerInterface $entityManager)
    {
        parent::__construct($entityManager, Reservation::class);
    }

    public function getByIdOrThrowNotFound(Uuid $id): Reservation
    {
        /** @var Reservation|null $reservation */
        $reservation = $this->repository->find($id);
        if (is_null($reservation)) {
            throw new NotFoundException('Hall not found');
        }
        return $reservation;
    }

    public function getByShowId(Uuid $showId): array
    {
        return $this->repository->createQueryBuilder('reservation')
            ->select('reservation')
            ->andWhere('reservation.showId = :showId')
            ->setParameter('showId', $showId)
            ->getQuery()
            ->getResult();
    }

    public function save(Reservation $reservation): void
    {
        $this->em->persist($reservation);
        $this->em->flush();
    }

}