<?php declare(strict_types=1);

namespace App\Cinema\Repository;

use App\Cinema\Entity\Hall;
use App\Shared\Exception\NotFoundException;
use App\Shared\Repository\MysqlRepository;
use Doctrine\ORM\EntityManagerInterface;

class HallRepository extends MysqlRepository implements HallRepositoryInterface
{
    public function __construct(EntityManagerInterface $entityManager)
    {
        parent::__construct($entityManager, Hall::class);
    }

    public function getByIdOrThrowNotFound(string $id): Hall
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