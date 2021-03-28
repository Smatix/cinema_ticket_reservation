<?php declare(strict_types=1);

namespace App\Shared\Repository;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Doctrine\Persistence\ObjectRepository;

abstract class MysqlRepository
{
    /** @var EntityRepository */
    protected $repository;

    protected EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $entityManager, string $model)
    {
        $this->em = $entityManager;
        /** @var class-string<mixed> $model */
        /** @var EntityRepository $repository*/
        $repository = $this->em->getRepository($model);
        $this->repository = $repository;
    }
}