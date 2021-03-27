<?php declare(strict_types=1);

namespace App\Tests\Helpers;

use Doctrine\ORM\Tools\SchemaTool;
use Symfony\Component\HttpKernel\KernelInterface;

class DatabaseHelper
{
    public static function createSchema(KernelInterface $kernel): void
    {

        if ('test' !== $kernel->getEnvironment()) {
            throw new \LogicException('createSchema must be executed in the test environment');
        }

        $entityManager = $kernel->getContainer()->get('doctrine.orm.entity_manager');

        $metadatas = $entityManager->getMetadataFactory()->getAllMetadata();
        $schemaTool = new SchemaTool($entityManager);
        $schemaTool->dropSchema($metadatas);
        $schemaTool->createSchema($metadatas);
    }

    public static function dropSchema(KernelInterface $kernel): void
    {

        if ('test' !== $kernel->getEnvironment()) {
            throw new \LogicException('dropSchema must be executed in the test environment');
        }

        $entityManager = $kernel->getContainer()->get('doctrine.orm.entity_manager');

        $metadatas = $entityManager->getMetadataFactory()->getAllMetadata();
        $schemaTool = new SchemaTool($entityManager);
        $schemaTool->dropSchema($metadatas);
    }
}