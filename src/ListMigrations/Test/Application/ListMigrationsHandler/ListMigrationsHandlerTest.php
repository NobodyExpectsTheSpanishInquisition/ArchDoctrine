<?php

declare(strict_types=1);

namespace App\ListMigrations\Test\Application\ListMigrationsHandler;

use App\ListMigrations\Application\ListMigrationsHandler;
use App\ListMigrations\Application\MigrationsListMapperInterface;
use App\ListMigrations\Domain\ProjectMigrationsProviderInterface;
use App\Shared\Application\Exception\UnprocessableEntityException;
use App\Shared\Domain\Entity\Project;
use App\Shared\Domain\Exception\ProjectHasNotRegisteredMigrationsException;
use App\Shared\Domain\Exception\ProjectNotFoundException;
use App\Shared\Domain\Provider\ProjectProviderInterface;
use App\Shared\Test\PrivatePropertiesAccessor;
use App\Shared\Test\UnitTestCase;
use LogicException;
use PHPUnit\Framework\MockObject\MockObject;

final class ListMigrationsHandlerTest extends UnitTestCase
{
    private ProjectMigrationsProviderInterface|MockObject $projectMigrationsProviderMock;
    private ProjectProviderInterface|MockObject $projectProviderMock;
    private MigrationsListMapperInterface|MockObject $migrationsListMapperMock;
    private ListMigrationsHandlerTestData $testData;
    private ListMigrationsHandlerTestAssertions $assertions;

    public function test_ShouldReturnMigrationsListViewWithDescription_WhenMigrationHasDescription(): void
    {
        $projectMock = $this->createMock(Project::class);
        $migration = $this->testData->getMigrationWithDescription();

        $this->projectProviderMock->method('getOne')->willReturn($projectMock);

        $projectMock->method('fetchMigrations')->willReturn([$migration]);
        $this->migrationsListMapperMock->method('mapToView')
            ->willReturn($this->testData->getMigrationsListViewWithMigrationWithDescription());

        $handler = $this->getHandler();

        $migrationsList = $handler->handle($this->testData->getQuery());

        $this->assertions->assertListWithMigrationWithDescriptionReturned($migrationsList);
    }

    private function getHandler(): ListMigrationsHandler
    {
        return new ListMigrationsHandler(
            $this->projectMigrationsProviderMock,
            $this->projectProviderMock,
            $this->migrationsListMapperMock
        );
    }

    public function test_ShouldReturnMigrationsListViewWithoutDescription_WhenMigrationDoesNotHaveDescription(): void
    {
        $projectMock = $this->createMock(Project::class);
        $migration = $this->testData->getMigration();

        $this->projectProviderMock->method('getOne')->willReturn($projectMock);

        $projectMock->method('fetchMigrations')->willReturn([$migration]);
        $this->migrationsListMapperMock->method('mapToView')
            ->willReturn($this->testData->getMigrationsListViewWithMigrationWithoutDescription());

        $handler = $this->getHandler();

        $migrationsList = $handler->handle($this->testData->getQuery());

        $this->assertions->assertListWithMigrationWithoutDescriptionReturned($migrationsList);
    }

    public function test_ShouldThrowException_WhenProjectHasNotRegisteredMigrations(): void
    {
        $projectMock = $this->createMock(Project::class);

        $this->projectProviderMock->method('getOne')->willReturn($projectMock);

        $projectMock->method('fetchMigrations')->willThrowException(new ProjectHasNotRegisteredMigrationsException());

        $handler = $this->getHandler();

        $this->expectException(UnprocessableEntityException::class);
        $handler->handle($this->testData->getQuery());
    }

    public function test_ShouldThrowException_WhenProjectNotFound(): void
    {
        $this->projectProviderMock->method('getOne')->willThrowException(new ProjectNotFoundException());

        $handler = $this->getHandler();

        $this->expectException(LogicException::class);
        $handler->handle($this->testData->getQuery());
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->projectMigrationsProviderMock = $this->createMock(ProjectMigrationsProviderInterface::class);
        $this->projectProviderMock = $this->createMock(ProjectProviderInterface::class);
        $this->migrationsListMapperMock = $this->createMock(MigrationsListMapperInterface::class);
        $this->testData = new ListMigrationsHandlerTestData();
        $this->assertions =
            new ListMigrationsHandlerTestAssertions($this, $this->testData, new PrivatePropertiesAccessor());
    }
}
