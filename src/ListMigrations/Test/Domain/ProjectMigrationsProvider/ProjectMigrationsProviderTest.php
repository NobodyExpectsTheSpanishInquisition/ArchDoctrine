<?php

declare(strict_types=1);

namespace App\ListMigrations\Test\Domain\ProjectMigrationsProvider;

use App\ListMigrations\Domain\ProjectMigrationsProviderInterface;
use App\Shared\Test\IntegrationTestCase;
use App\Shared\Test\PrivatePropertiesAccessor;

final class ProjectMigrationsProviderTest extends IntegrationTestCase
{
    private ProjectMigrationsProviderInterface $projectMigrationsProvider;
    private ProjectMigrationsProviderTestData $testData;
    private ProjectMigrationsProviderTestAssertions $assertions;

    public function test_ShouldReturnArrayOfMigrations(): void
    {
        $migrations =
            $this->projectMigrationsProvider->provideMigrationsForProject($this->testData->getMigrationsFolderPath());

        $this->assertions->assertMigrationWasReturned($migrations);
    }

    protected function setUp(): void
    {
        parent::setUp();

        $entityManager = $this->getEntityManager();

        $this->testData = new ProjectMigrationsProviderTestData($entityManager);
        $this->assertions =
            new ProjectMigrationsProviderTestAssertions($this, $this->testData, new PrivatePropertiesAccessor());
        /** @var ProjectMigrationsProviderInterface projectMigrationsProvider */
        $this->projectMigrationsProvider = $this->getInstance(ProjectMigrationsProviderInterface::class);

        $this->openTransaction();
    }

    protected function tearDown(): void
    {
        $this->rollbackTransaction();

        parent::tearDown();
    }
}
