<?php declare(strict_types=1);

namespace App\Schedule\Infrastructure\Repository;

use App\Schedule\Domain\Hall;
use App\Schedule\Domain\Repository\HallRepositoryInterface;
use App\Shared\Exception\NotFoundException;
use App\Shared\Repository\MysqlRepository;
use App\Shared\Uuid\Uuid;
use Doctrine\ORM\EntityManagerInterface;

class HallRepository extends MysqlRepository implements HallRepositoryInterface
{
    public function __construct(EntityManagerInterface $entityManager)
    {
        parent::__construct($entityManager, Hall::class);
    }

    public function getByIdOrThrowNotFound(Uuid $id): Hall
    {
        /** @var Hall|null $hall */
        $hall = $this->repository->find($id);
        if (is_null($hall)) {
            throw new NotFoundException('Hall not found');
        }
        return $hall;
    }

    public function save(Hall $hall): void
    {
        $this->em->persist($hall);
        $this->em->flush();
    }

    public function remove(Hall $hall): void
    {
        $this->em->remove($hall);
        $this->em->flush();
    }
}