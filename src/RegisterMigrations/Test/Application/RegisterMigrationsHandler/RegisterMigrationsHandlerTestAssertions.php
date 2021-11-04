<?php

declare(strict_types=1);

namespace App\RegisterMigrations\Test\Application\RegisterMigrationsHandler;

use App\Shared\Domain\Entity\Project;
use App\Shared\Test\PrivatePropertiesAccessor;
use Doctrine\ORM\EntityManagerInterface;

final class RegisterMigrationsHandlerTestAssertions
{
    public function __construct(
        private RegisterMigrationsHandlerTest $testCase,
        private RegisterMigrationsHandlerTestData $testData,
        private EntityManagerInterface $entityManager,
        private PrivatePropertiesAccessor $privatePropertiesAccessor
    ) {
    }

    public function assertMigrationsWereRegistered(): void
    {
        $project = $this->entityManager->find(Project::class, (string) $this->testData->getProjectId());

        $migrationsFolderPath = $this->privatePropertiesAccessor->getProperty($project, 'migrationsFolderPath');

        $this->testCase::assertEquals((string) $this->testData->getMigrationsFolderPath(), $migrationsFolderPath);
    }
}
