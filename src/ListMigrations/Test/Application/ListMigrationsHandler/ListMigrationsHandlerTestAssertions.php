<?php

declare(strict_types=1);

namespace App\ListMigrations\Test\Application\ListMigrationsHandler;

use App\ListMigrations\Application\View\MigrationsListView;
use App\Shared\Test\PrivatePropertiesAccessor;

final class ListMigrationsHandlerTestAssertions
{
    public function __construct(
        private ListMigrationsHandlerTest $testCase,
        private ListMigrationsHandlerTestData $testData,
        private PrivatePropertiesAccessor $privatePropertiesAccessor
    ) {
    }

    public function assertListWithMigrationWithDescriptionReturned(MigrationsListView $migrationsList): void
    {
        $migrations = $this->privatePropertiesAccessor->getProperty($migrationsList, 'migrations');

        $this->testCase::assertCount(1, $migrations);

        $migration = $migrations[0];
        $this->testCase::assertEquals(
            $this->testData->getMigrationName(),
            $this->privatePropertiesAccessor->getProperty($migration, 'name')
        );
        $this->testCase::assertEquals(
            $this->testData->getMigrationDate(),
            $this->privatePropertiesAccessor->getProperty($migration, 'createdAt')
        );
        $this->testCase::assertEquals(
            $this->testData->getDescription(),
            $this->privatePropertiesAccessor->getProperty($migration, 'description')
        );
    }

    public function assertListWithMigrationWithoutDescriptionReturned(MigrationsListView $migrationsList): void
    {
        $migrations = $this->privatePropertiesAccessor->getProperty($migrationsList, 'migrations');

        $this->testCase::assertCount(1, $migrations);

        $migration = $migrations[0];
        $this->testCase::assertEquals(
            $this->testData->getMigrationName(),
            $this->privatePropertiesAccessor->getProperty($migration, 'name')
        );
        $this->testCase::assertEquals(
            $this->testData->getMigrationDate(),
            $this->privatePropertiesAccessor->getProperty($migration, 'createdAt')
        );
        $this->testCase::assertNull(
            $this->privatePropertiesAccessor->getProperty($migration, 'description')
        );
    }
}
