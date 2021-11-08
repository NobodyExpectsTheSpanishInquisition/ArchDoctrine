<?php

declare(strict_types=1);

namespace App\ListMigrations\Test\Domain\ProjectMigrationsProvider;

use App\Shared\Test\PrivatePropertiesAccessor;

final class ProjectMigrationsProviderTestAssertions
{
    public function __construct(
        private ProjectMigrationsProviderTest $testCase,
        private ProjectMigrationsProviderTestData $testData,
        private PrivatePropertiesAccessor $privatePropertiesAccessor
    ) {
    }

    /**
     * @param \App\Shared\Domain\Model\Migration[]
     */
    public function assertMigrationWasReturned(array $migrations): void
    {
        $this->testCase::assertCount(1, $migrations);

        $migration = $migrations[0];

        $this->testCase::assertEquals(
            $this->testData->getMigrationFileName(),
            $this->privatePropertiesAccessor->getProperty($migration, 'name')
        );
    }
}
