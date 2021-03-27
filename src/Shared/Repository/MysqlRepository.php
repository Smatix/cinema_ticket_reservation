<?php declare(strict_types=1);

namespace App\Shared\Repository;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectRepository;

abstract class MysqlRepository
{
    /**
     * @var ObjectRepository<mixed>
     */
    protected $repository;

    protected EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $entityManager, string $model)
    {
        $this->em = $entityManager;
        /** @var class-string<mixed> $model */
        $this->repository = $this->em->getRepository($model);
    }
}