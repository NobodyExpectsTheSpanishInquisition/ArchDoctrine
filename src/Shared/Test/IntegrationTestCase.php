<?php

declare(strict_types=1);

namespace App\Shared\Test;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class IntegrationTestCase extends KernelTestCase
{
    private EntityManagerInterface $entityManager;

    public function openTransaction(): void
    {
        $this->entityManager->beginTransaction();
    }

    public function rollbackTransaction(): void
    {
        $this->entityManager->rollback();
    }

    protected function getEntityManager(): EntityManagerInterface
    {
        return $this->entityManager;
    }

    protected function setUp(): void
    {
        parent::setUp();

        /** @var \Doctrine\ORM\EntityManagerInterface entityManager */
        $this->entityManager = $this->getInstance(EntityManagerInterface::class);
    }

    protected function getInstance(string $namespace): object
    {
        return self::getContainer()->get($namespace);
    }
}
