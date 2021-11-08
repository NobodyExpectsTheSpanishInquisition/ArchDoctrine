<?php

declare(strict_types=1);

namespace App\Shared\Test\Domain\Entity\Project;

use App\ListMigrations\Domain\ProjectMigrationsProviderInterface;
use App\Shared\Domain\Exception\ProjectHasNotRegisteredMigrationsException;
use App\Shared\Test\UnitTestCase;
use PHPUnit\Framework\MockObject\MockObject;

final class ProjectTest extends UnitTestCase
{
    private ProjectTestData $testData;
    private ProjectMigrationsProviderInterface|MockObject $projectMigrationsProviderMock;

    public function test_FetchMigrations_ShouldReturnArrayOfMigrations_WhenMigrationsAreRegistered(): void
    {
        $project = $this->testData->getProject();

        $this->projectMigrationsProviderMock->method('provideMigrationsForProject')
            ->willReturn($this->testData->getArrayOfMigrations());

        $project->registerMigrations($this->testData->getMigrationsFolderPath());

        $migrations = $project->fetchMigrations($this->projectMigrationsProviderMock);

        self::assertEquals($this->testData->getArrayOfMigrations(), $migrations);
    }

    public function test_FetchMigrations_ShouldThrowExceptionWhenProjectHasNotRegisteredMigrations(): void
    {
        $project = $this->testData->getProject();

        $this->expectException(ProjectHasNotRegisteredMigrationsException::class);

        $project->fetchMigrations($this->projectMigrationsProviderMock);
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->testData = new ProjectTestData();
        $this->projectMigrationsProviderMock = $this->createMock(ProjectMigrationsProviderInterface::class);
    }
}
