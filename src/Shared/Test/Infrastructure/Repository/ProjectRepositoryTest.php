<?php

declare(strict_types=1);

namespace App\Shared\Test\Infrastructure\Repository;

use App\Shared\Infrastructure\Repository\ProjectRepository;
use App\Shared\Test\IntegrationTestCase;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;

final class ProjectRepositoryTest extends IntegrationTestCase
{
    private ProjectRepository $repository;
    private ProjectRepositoryTestData $testData;
    private ProjectRepositoryTestAssertions $assertions;

    public function test_ShouldSaveProjectInDatabase(): void
    {
        $this->repository->save($this->testData->getProject());
        $this->repository->flush();

        $this->assertions->assertProjectWasSavedInDatabase();
    }

    public function test_ShouldThrowException_WhenProjectIsAlreadyInDatabase(): void
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

        /** @var \App\Shared\Infrastructure\Repository\ProjectRepository repository */
        $this->repository = $this->getInstance(ProjectRepository::class);

        $this->openTransaction();
    }

    protected function tearDown(): void
    {
        $this->rollbackTransaction();

        parent::tearDown();
    }
}
