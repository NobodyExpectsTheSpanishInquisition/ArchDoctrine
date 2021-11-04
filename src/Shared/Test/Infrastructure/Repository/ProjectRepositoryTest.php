<?php

declare(strict_types=1);

namespace App\Shared\Test\Infrastructure\Repository;

use App\Shared\Domain\Exception\ProjectNotFoundException;
use App\Shared\Infrastructure\Repository\ProjectRepository;
use App\Shared\Test\IntegrationTestCase;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;

final class ProjectRepositoryTest extends IntegrationTestCase
{
    private ProjectRepository $repository;
    private ProjectRepositoryTestData $testData;
    private ProjectRepositoryTestAssertions $assertions;

    public function test_FindAll_ShouldReturnEmptyArray_WhenNoProjectsRegistered(): void
    {
        $projects = $this->repository->findAll();

        $this->assertions->assertNoProjectsReturned($projects);
    }

    public function test_FindAll_ShouldReturnNonEmptyArray_WhenProjectsAreAlreadyRegistered(): void
    {
        $this->testData->loadProject();

        $projects = $this->repository->findAll();

        $this->assertions->assertProjectsReturned($projects);
    }

    public function test_GetOne_ShouldReturnProject(): void
    {
        $this->testData->loadProject();

        $project = $this->repository->getOne($this->testData->getId());

        $this->assertions->assertCorrectProjectWasReturned($project);
    }

    public function test_GetOne_ShouldThrowException_WhenProjectNotFound(): void
    {
        $this->expectException(ProjectNotFoundException::class);
        $this->repository->getOne($this->testData->getId());
    }

    public function test_Save_ShouldSaveProjectInDatabase(): void
    {
        $this->repository->save($this->testData->getProject());
        $this->repository->flush();

        $this->assertions->assertProjectWasSavedInDatabase();
    }

    public function test_Save_ShouldThrowException_WhenProjectIsAlreadyInDatabase(): void
    {
        $this->testData->loadProject();

        $this->repository->save($this->testData->getProject());

        $this->expectException(UniqueConstraintViolationException::class);
        $this->repository->flush();
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->testData = new ProjectRepositoryTestData($this->getEntityManager());
        $this->assertions = new ProjectRepositoryTestAssertions($this->getEntityManager(), $this->testData, $this);

        $this->repository = $this->getInstance(ProjectRepository::class);

        $this->openTransaction();
    }

    protected function tearDown(): void
    {
        $this->rollbackTransaction();

        parent::tearDown();
    }
}
